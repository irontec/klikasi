<?php

use Klikasi\Model as Models;
use Klikasi\Mapper\Sql as Mappers;

class EdukiakAdministrazioanController extends Zend_Controller_Action
{

    protected $_currentUser;
    protected $_currentEdukia;

    public function init()
    {
        $this->_helper->layout->setLayout('edukia-administrazioan');
        $this->view->editEdukiak = true;
        $this->view->edukiakHeader = true;
        $this->view->flashmezuak = $this->_helper->FlashMessenger->getMessages();

        $this->_loadLibraries();
        $this->_checkCurrentUser();
    }

    protected function _loadLibraries()
    {
        $baseUrl = $this->view->baseUrl();

        $this->view->appendJs =  array(
            '/bower/mustache.js/mustache.js',
            '/js/klikasi.edukia-igo.js'
        );

        $this->view->headLink()
            ->appendStylesheet($baseUrl . '/css/slider.css')
            ->appendStylesheet($baseUrl . '/css/edukiak-igo.css')
            ->appendStylesheet($baseUrl . '/css/ikastegia.css');

    }

    public function indexAction()
    {
        $edukia = $this->_edukiakModel();

        $this->view->title = 'Administrazioan';
        $this->view->edukia = $edukia;

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();
            $result = $this->_edukiakModel()->isValidForm(
                $postData,
                $this->_currentUser
            );

            if ($result['status'] == true) {
                $result = $this->_saveDatuak($postData);
            }

            $this->_helper->json($result);
            die();
        }

        $kategoriaGlobalaView = array();
        $kategoriaGlobala = new Mappers\KategoriaGlobala();
        $kategoriaGlobalaList = $kategoriaGlobala->fetchList(null, 'izena');

        if (!empty($kategoriaGlobalaList)) {
            foreach ($kategoriaGlobalaList as $kategoriaGlobala) {
                $kategoriaRel = new Mappers\KategoriakRelKategoriaGlobalak();
                $where = array(
                    'kategoriaGlobalaId = ? ' => $kategoriaGlobala->getId()
                );
                $kategoriaRelList = $kategoriaRel->fetchList($where);
                if (!empty($kategoriaRelList)) {
                    $katsIds = array();
                    foreach ($kategoriaRelList as $kategoriaRel) {
                        $katsIds[] = $kategoriaRel->getKategoriaId();
                    }

                    $kategoriaList = new Mappers\Kategoria();
                    $whereKate = 'id IN (' . implode(',', $katsIds) . ')';
                    $kategoriaList = $kategoriaList->fetchList(
                        $whereKate,
                        'izena'
                    );
                    $kategoriaKey = $kategoriaGlobala->getIzena();
                    $kategoriaGlobalaView[$kategoriaKey] = $kategoriaList;
                }
            }
        }

        $currentKolaboratzaileakIds = array();
        $kolaboratzaileakRelList = $edukia->getErabiltzaileaRelEdukia();
        if (!empty($kolaboratzaileakRelList)) {
            foreach ($kolaboratzaileakRelList as $kolaboratzaileak) {
                $currentKolaboratzaileakIds[] = $kolaboratzaileak->getErabiltzaileaId();
            }
        }

        $currentEtiketakIds = array();
        $etiketakRelList = $edukia->getEtiketaRelEdukia();
        if (!empty($etiketakRelList)) {
            foreach ($etiketakRelList as $etiketakRel) {
                $currentEtiketakIds[] = $etiketakRel->getEtiketaId();
            }
        }

        $currentMailaId = '';
        if (!empty($edukia->getEdukiaRelMaila())) {
            $currentMailaId = current($edukia->getEdukiaRelMaila())->getMailaId();
        }

        $currentKategoriakIds = array();
        if (!empty($edukia->getEdukiaRelKategoria())) {

            foreach ($edukia->getEdukiaRelKategoria() as $item) {
                $currentKategoriakIds[] = $item->getKategoriaId();
            }
        }

        $currentEskolaId = '';
        if (!empty($edukia->getEdukiaRelIkastegia())) {
            $currentEskolaId = current($edukia->getEdukiaRelIkastegia())->getIkastegiaId();
        }

        $mailak = new Mappers\Maila();
        $eskolak = new Mappers\Ikastegia();
        $whereIkastegia = array(
            'aktibatua = ? ' => 1
        );

        $this->view->kategoriakGlobala = $kategoriaGlobalaView;
        $this->view->mailak = $mailak->fetchList(null, new \Zend_Db_Expr("FIELD(grupo, 'haurHezkuntza', 'LH', 'DBH', 'Batxilergoa', 'bestelakoak'), izena"));

        $kanpainaKodeak = array();
        $kanpainaMapper = new Mappers\Kanpaina;
        $where = 'bukaera >= now() and hasiera <= now() and egoera = 1 and kodea is not null';
        $kanpainak = $kanpainaMapper->fetchList($where);

        foreach ($kanpainak as $kanpaina) {
            $kanpainaKodeak[$kanpaina->getKodea()] = $kanpaina->getIzena();
        }

        $edukiaRelKanpainaMapper = new Mappers\EdukiaRelKanpaina;
        $edukiaRelKanpaina = $edukiaRelKanpainaMapper->findOneByField("edukiaId", $this->view->edukia->getId());

        $selectedKanpainaKodeak = array();
        foreach ($edukiaRelKanpaina as $kanpaina) {

            $selectedKanpainaKodeak[] = $kanpaina->getKanpaina()->getKodea();
        }

        $relIkastegiaMapper = new Mappers\ErabiltzaileaRelIkastegia;
        $relIkastegiak = $relIkastegiaMapper->fetchList(array("erabiltzaileaId = ?" => $this->_currentUser->getPrimaryKey()));

        if ($this->_currentUser->isSenior()) {

            $order = 'izena asc';
            if (!empty($relIkastegiak)) {

                $orderIds = array();
                foreach ($relIkastegiak as $relation) {
                    $orderIds[] = $relation->getIkastegiaId();
                }

                $order = new \Zend_Db_Expr("FIELD(id, ". implode(',', $orderIds) .") desc, " . $order);
            }

            $this->view->eskolak = $eskolak->fetchList($whereIkastegia, $order);

        } else {

            $this->view->eskolak = array();
            foreach ($relIkastegiak as $relItem) {
                $this->view->eskolak[] = $relItem->getIkastegia();
            }
        }

        $this->view->currentKolaboratzaileak = $currentKolaboratzaileakIds;
        $this->view->currentEtiketak = $currentEtiketakIds;
        $this->view->currentMaila = $currentMailaId;
        $this->view->currentKategoriak = $currentKategoriakIds;
        $this->view->currentEskola = $currentEskolaId;
        $this->view->kanpainaKodeak = $kanpainaKodeak;
        $this->view->selectedKanpainaKodeak = $selectedKanpainaKodeak;
    }

    public function moderateLaguntzaileaAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $result = array(
                'status' => false,
                'message' => $this->view->translate('[es] Error en la moderación.')
            );

            $relation = new Mappers\ErabiltzaileaRelEdukia();
            $relation = $relation->find($postData['relLaguntzailea']);

            if (!empty($relation)) {

                if ($postData['moderation'] == 'acceptLaguntzaileak') {
                    $relation->setEgoera('onartua');
                } elseif ($postData['moderation'] == 'rejectLaguntzaileak') {
                    $relation->setEgoera('ezOnartua');
                }
                $relation->save();

                $result = array(
                    'status' => true,
                    'message' => $this->view->translate('[es] Laguntzaileak moderado correctamente.')
                );

            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('ikastegiak');
        }

    }

    public function hobekuntzakAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $now = new \Zend_Date();

            $postData = $this->getRequest()->getPost();

            $result = array(
                'status' => false,
                'message' => $this->view->translate('[es] Error al enviar el mensaje.')
            );

            $hobekuntzak = new Mappers\Hobekuntzak();
            $hobekuntzak = $hobekuntzak->find($postData['hobekuntzakId']);

            if (!empty($hobekuntzak)) {

                try {

                    $mezuak = new Models\Mezuak();
                    $mezuak->setNorkId($this->_currentUser->getId());
                    $mezuak->setNoriId($hobekuntzak->getErabiltzaileaId());
                    $mezuak->setMezua(strip_tags($postData['mezuak']));
                    $mezuak->setMota('edukia');
                    $mezuak->setIkusita(1);
                    $mezuak->setSortzeData($now);
                    $mezuak->setEdukiaId($this->_currentEdukia->getId());
                    $mezuak->save();

                    $result = array(
                        'status' => true,
                        'message' => $this->view->translate('[es] Mensaje Enviado.')
                    );

                } catch (\Exception $e) {

                    $result = array(
                        'status' => false,
                        'message' => $e->getMessage()
                    );

                }

            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('ikastegiak');
        }

    }

    public function hobekuntzakDeleteAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $now = new \Zend_Date();

            $postData = $this->getRequest()->getPost();

            $result = array(
                'status' => false,
                'message' => $this->view->translate('[es] Error al eliminar Hobekuntzak.')
            );

            $hobekuntzak = new Mappers\Hobekuntzak();
            $hobekuntzak = $hobekuntzak->find($postData['hobekuntzak']);

            if (!empty($hobekuntzak)) {

                $hobekuntzak->delete();

                $result = array(
                    'status' => true,
                    'message' => $this->view->translate('[es] Hobekuntzak Eliminado.')
                );

            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('ikastegiak');
        }

    }

    public function deleteEdukiaAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $edukiak = new Mappers\Edukia();
            $edukia = $edukiak->find($postData['edukiaId']);

            if (!empty($edukia)) {

                try {

                    $edukia->delete();

                    $this->_helper->flashMessenger(
                        array(
                            'warning' => $this->view->translate('[es] Recurso, eliminado correctamente')
                        )
                    );

                } catch (\Exception $e) {

                    $this->_helper->flashMessenger(
                        array(
                            'warning' => $e->getMessage()
                        )
                    );

                }

            }

            $result = array(
                'status' => true,
            );

            $this->_helper->json($result);

        } else {
            $this->_redirect('edukiak');
        }

    }

    /**********************
     * Protected Functions
     **********************/

    /**
     * @param Array $params
     * @return boolean
     */
    protected function _saveDatuak($params)
    {
    	
        $mapper = new Mappers\Edukia();
        $model = $mapper->find($params['edukia-id']);
        $edukiaId = $model->getId();
        try {

            $model->setPostData(
                $params,
                $this->_currentUser->getId(),
                false
            );
            $model->save();

            $model->saveKategoriaRel($params['kategoriak']);
            $model->saveMailaRel($params['maila']);
            $model->saveEtiketakRel($params['etiketak']);
            $model->saveEskolaRel(
                $params['eskola'],
                $this->_currentUser
            );

            $kanpaina = isset($params['kanpaina']) ? $params['kanpaina'] : array();
            $model->saveKanpainaRel($kanpaina);
            $model->saveBesteEgile($params['beste-egile']);

            $edukiaMapper = new Mappers\Edukia;
            $edukiaMapper->createEdukiaRelAssets($params, $model);

            return array(
                'status' => true,
                'message' => 'Aldaketak gorde dira',
                'title' => $model->getTitulua(),
                'href' => 'edukiak/ikusi/edukia/' . $model->getUrl()
            );

        } catch (\Exception $e) {

            return array(
                'status' => false,
                'message' => $e->getMessage()
            );

        }

    }

    protected function _checkCurrentUser()
    {
        $currentUser = $this->_helper->SessionUser();

        if (!$currentUser) {
            $this->_redirect(
                $this->view->baseUrl('sartu'),
                array(
                    'prependBase' => false
                )
            );
        }

        $isAdmin = false;
        $currentEdukia = $this->_edukiakModel();

        if (!$currentEdukia || !$currentUser) {
            $this->_redirect('edukiak');
        }

        $erabiltzaileaIds = $currentEdukia->erabiltzaileakRelIds();
        $searchIds = array_search($currentUser->getId(), $erabiltzaileaIds);
        if ($searchIds !== false) {
            $isAdmin = true;
        }

        if (!$isAdmin) {
            $this->_redirect(
                'edukiak/ikusi/edukia/' . $currentEdukia->getUrl()
            );
        }

        $this->_currentUser = $currentUser;
        $this->_currentEdukia = $currentEdukia;

        return true;
    }

    /**
     * Buscar el modelo del Edukia
     */
    protected function _edukiakModel()
    {
        $edukiak = new Mappers\Edukia();
        $edukiaParam = $this->getRequest()->getParam('edukia', false);

        $currentEdukia = $edukiak->findOneByField(
            'url',
            $edukiaParam
        );

        return $currentEdukia;
    }
}