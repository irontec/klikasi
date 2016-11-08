<?php

use Klikasi\Model as Models;
use Klikasi\Mapper\Sql as Mappers;

class JakinarazpenakController extends Zend_Controller_Action
{
    protected $_session = false;
    protected $_jakinarazpenakUrl;

    protected $_edukiaMapper;
    protected $_iruzkinaMapper;
    protected $_gustokoaMapper;
    protected $_ikastegiaMapper;
    protected $_atseginDutMapper;
    protected $_hobekuntzakMapper;
    protected $_jakinarazpenakMapper;
    protected $_jakinarazpenakMotaMapper;
    protected $_erabiltzaileaRelEdukiaMapper;
    protected $_erabiltzaileaRelIkastegiaMapper;

    public function init()
    {
        $this->_helper->layout->setLayout(
            'container-principal-title'
        );

        $this->_helper->ironContextSwitch()
            ->addActionContext('send-messages-json', 'json')
            ->initContext();

        $this->_session = $this->_sessionStart();
        $this->_jakinarazpenakUrl = $this->view->baseUrl('jakinarazpenak');
        $this->_initMappers();

        $this->view->appendJs = array(
            '/js/klikasi.jakinarazpenak.js'
        );

        $this->view->MusacheTemplates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;

    }

    protected function _initMappers()
    {

        $this->_edukiaMapper = new Mappers\Edukia();
        $this->_iruzkinaMapper = new Mappers\Iruzkina();
        $this->_gustokoaMapper = new Mappers\Gustokoa();
        $this->_ikastegiaMapper = new Mappers\Ikastegia();
        $this->_atseginDutMapper = new Mappers\AtseginDut();
        $this->_hobekuntzakMapper = new Mappers\Hobekuntzak();
        $this->_jakinarazpenakMapper = new Mappers\Jakinarazpenak();
        $this->_jakinarazpenakMotaMapper = new Mappers\JakinarazpenakMota();
        $this->_erabiltzaileaRelEdukiaMapper = new Mappers\ErabiltzaileaRelEdukia();
        $this->_erabiltzaileaRelIkastegiaMapper = new Mappers\ErabiltzaileaRelIkastegia();

    }

    /**
     *
     */
    public function indexAction()
    {

        $this->view->title = 'Jakinarazpenak';
        $this->view->titleLink = 'jakinarazpenak';

        $motaTypes = array(
            'kolaborazioEskaera' => 1,
            'ikasleEskaera' => 2,
            'edukiBerria' => 4,
            'iruzkinBerria' => 5,
            'iradokizunBerria' => 7,
            'gustokoBerria' => 9,
            'ikastegiakBerria' => 10,
            'atseginDut' => 11,
            'edukiariSalaketa' => 12,
            'irakasleEskaera' => 17,
            'irakasleEskaeraIkastegia' => 18
        );

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $result = $this->_jakinarazpenakAction(
                $postData['action'],
                $postData['instance'],
                $postData['jakinarazpena']
            );

            $this->_helper->json($result);
            die();

        }//isXmlHttpRequest

        $notification = false;
        $jakinarazpenakList = array();

        $motaFilter = $this->getRequest()->getParam('mota', false);

        $where = array();
        $where['erabiltzaileaId = ?'] = $this->_session->getId();
        $where['deletedByErabiltzailea = ?'] = 0;

        $order = array(
            'sortzeData DESC'
        );

        if ($motaFilter) {

            $mota = $this->_jakinarazpenakMotaMapper->findOneByField(
                'url',
                $motaFilter
            );

            if (!empty($mota)) {

                $motaTypeFilter = array_search($mota->getId(), $motaTypes);

                $where['motaId = ?'] = $mota->getId();

                $jakinarazpenakList = $this->_jakinarazpenakMapper->fetchList(
                    $where,
                    $order
                );

                $this->view->$motaTypeFilter = $jakinarazpenakList;

                $notification = !empty($jakinarazpenakList);

            }

        } else {

            foreach ($motaTypes as $type => $typeId) {

                $where['motaId = ?'] = $typeId;
                $jakinarazpenak = $this->_jakinarazpenakMapper->fetchList(
                    $where,
                    $order
                );

                if (!empty($jakinarazpenak)) {
                    $notification = true;
                    $this->view->$type = $jakinarazpenak;
                }

            }

        }

        $this->view->notification = $notification;

    }

    public function mezuakAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();
            $status = true;
            $message = '';

            if ($postData['actionInstance'] == 'contactPersonal') {

                $jakinarazpena = $this->_jakinarazpenakMapper->find(
                    $postData['jakinarazpenakId']
                );

                $kexa = new Mappers\Kexa();
                $kexa = $kexa->find(
                    $jakinarazpena->getIdKanpotarra()
                );

                $edukia = $kexa->getEdukia();
                $erabiltzailea = $edukia->getErabiltzailea();

                $mail = new Zend_Mail('utf-8');
                $mail->addTo(
                    $erabiltzailea->getPosta(),
                    $erabiltzailea->getCompletName()
                );

                $body = $postData['message'];

                $mail->setSubject('[Klikasi] Salatu: ' . $edukia->getTitulua());
                $mail->setBodyText($body);
                $mail->setFrom('no-reply@dani-irontec.com', 'no-reply');

                try {

                    $mail->send();
                    $message = $this->view->translate('[es] Email Enviado');

                } catch (Exception $e) {

                    $status = false;
                    $error = $e->getMessage();
                    $message = '<br />[' . $error . ']<br />Consulte con su Administrador.';
                }

            } elseif ($postData['actionInstance'] == 'reply') {

                $jakinarazpena = $this->_jakinarazpenakMapper->find(
                    $postData['jakinarazpenakId']
                );

                $hobekuntzak = new Mappers\Hobekuntzak();
                $hobekuntzak = $hobekuntzak->find($jakinarazpena->getIdKanpotarra());

                $now = new Zend_Date();
                $now = $now->toString('yyyy-MM-dd HH:mm:ss');

                $mezuak = new Models\Mezuak();
                $mezuak->setNorkId($this->_session->getId());
                $mezuak->setNoriId($jakinarazpena->getThatUserId());
                $mezuak->setMezua(strip_tags($postData['message']));
                $mezuak->setIkusita(1);
                $mezuak->setSortzeData($now);
                $mezuak->setEdukiaId($hobekuntzak->getEdukiaId());
                $mezuak->setMota('edukia');
                $mezuak->save();

                $message = $this->view->translate('[es] Mensaje Enviado');

            } else {
                $status = false;
                $message = $this->view->translate('[es] Error indefinido');
            }

            $this->_helper->json(
                array(
                    'status' => $status,
                    'message' => $message
                )
            );

        }//isXmlHttpRequest
    }

    /**
     * Sistema para bloquear un recurso con denuncias.
     */
    public function lockedAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();
            $status = false;
            $message = $this->view->translate('[es] Algo va mal');

            if (isset($postData['jakinarazpenaId']) && isset($postData['action'])) {

                $jakinarazpena = $this->_jakinarazpenakMapper->find(
                    $postData['jakinarazpenaId']
                );

                if (!empty($jakinarazpena)) {

                    $kexa = new Mappers\Kexa();
                    $kexa = $kexa->find(
                        $jakinarazpena->getIdKanpotarra()
                    );

                    if (!empty($kexa)) {

                        $edukia = $kexa->getEdukia();
                        $edukia->setEgoera('blokeatuta')->save();
                        $jakinarazpena->setIkusita(1)->save();

                        $status = true;
                        $message = $this->view->translate('[es] Recurso bloqueado.');

                    }
                }
            }

            $this->_helper->json(
                array(
                    'status' => $status,
                    'message' => $message
                )
            );

        }//isXmlHttpRequest
    }

    /**
     * Se encargar de enviar al apartado de cada tipo de Notificación.
     * @param String $action
     * @param String $instance
     * @param Model $jakinarazpena
     * @return multitype:boolean string
     */
    protected function _jakinarazpenakAction($action, $instance, $jakinarazpena)
    {

        $jakinarazpena = $this->_jakinarazpenakMapper->find($jakinarazpena);

        switch ($instance) {

            case 'kolaborazioEskaera':
                return $this->_kolaborazioEskaera(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'ikasleEskaera':
                return $this->_ikasleEskaera(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'edukiBerria':
                return $this->_edukiBerria(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'iruzkinBerria':
                return $this->_iruzkinBerria(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'edukiariSalaketa':
                return $this->_edukiariSalaketa(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'iradokizunBerria':
                return $this->_iradokizunBerria(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'gustokoBerria':
                return $this->_gustokoBerria(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'ikastegiakBerria':
                return $this->_ikastegiakBerria(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'atseginDut':
                return $this->_atseginDut(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'irakasleEskaera':
                return $this->_irakasleEskaera(
                    $action,
                    $jakinarazpena
                );
                break;

            case 'irakasleEskaeraIkastegia':
                return $this->_irakasleEskaeraIkastegia(
                    $action,
                    $jakinarazpena
                );
                break;

            default:
                return array(
                    'status' => false,
                    'error' => $this->view->translate('[es] algo va mal')
                );
                break;
        }

        //var_dump($action, $instance, $jakinarazpena);
        //die();

    }

    /**
     * Encargado de las Aciones de kolaborazioEskaera
     * @param String $action
     * @param Model $jakinarazpena
     */
    protected function _kolaborazioEskaera($action, $jakinarazpena)
    {

        $where = array(
            'edukiaId = ? ' =>  $jakinarazpena->getIdKanpotarra(),
            'erabiltzaileaId = ?' => $this->_sessionStart()->getId()
        );

        $kolaborazioEskaera = $this->_erabiltzaileaRelEdukiaMapper->fetchOne(
            $where
        );

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();
        $edukia = $this->_edukiaMapper->find(
            $jakinarazpena->getIdKanpotarra()
        );

        if (empty($edukia) || empty($kolaborazioEskaera)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $url = $this->view->serverUrl(
            $edukia->edukiaUrl()
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $kolaborazioEskaera,
            $url
        );

    }

    /**
     * Encargado de las Aciones de ikasleEskaera
     * @param String $action
     * @param Model $jakinarazpena
     */
    protected function _ikasleEskaera($action, $jakinarazpena)
    {

        $where = array(
            'ikastegiaId = ? ' =>  $jakinarazpena->getIdKanpotarra(),
            'erabiltzaileaId = ?' => $jakinarazpena->getThatUserId()
        );

        $ikasleEskaera = $this->_erabiltzaileaRelIkastegiaMapper->fetchOne(
            $where
        );

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();

        $ikastegia = $this->_ikastegiaMapper->find(
            $ikasleEskaera->getIkastegiaId()
        );

        if (empty($ikastegia) || empty($ikasleEskaera)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $url = $this->view->serverUrl(
            $ikastegia->ikastegiaUrl()
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $ikasleEskaera,
            $url
        );

    }

    /**
     * Encargado de las Aciones de edukiBerria
     * @param String $action
     * @param Model $jakinarazpena
     */
    protected function _edukiBerria($action, $jakinarazpena)
    {
        $edukiBerria = $this->_edukiaMapper->find(
            $jakinarazpena->getIdKanpotarra()
        );

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();

        $edukiaUrl = $edukiBerria ? $edukiBerria->edukiaUrl() : null;
        $url = $this->view->serverUrl($edukiaUrl);

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $edukiBerria,
            $url
        );

    }

    /**
     * Encargado de las Aciones de iruzkinBerria
     * @param String $action
     * @param Model $jakinarazpena
     */
    protected function _iruzkinBerria($action, $jakinarazpena)
    {

        $iruzkinBerria = $this->_iruzkinaMapper->find(
            $jakinarazpena->getIdKanpotarra()
        );

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();

        $edukia = $this->_edukiaMapper->find(
            $iruzkinBerria->getEdukiaId()
        );

        if (empty($edukia) || empty($iruzkinBerria)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $url = $this->view->serverUrl(
            $edukia->edukiaUrl()
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $iruzkinBerria,
            $url
        );

    }

    /**
     * Encargado de las Aciones de gustokoBerria
     * @param String $action
     * @param Model $jakinarazpena
     */
    protected function _gustokoBerria($action, $jakinarazpena)
    {
        $gustokoBerria = $this->_gustokoaMapper->find(
            $jakinarazpena->getIdKanpotarra()
        );

        $jakinarazpena->setIkusita(1)->save();
        $currentUser = $this->_sessionStart();

        if ($gustokoBerria) {

            $edukia = $this->_edukiaMapper->find(
                $gustokoBerria->getEdukiaId()
            );
        }

        if (empty($edukia) || empty($gustokoBerria)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $url = $this->view->serverUrl(
            $edukia->edukiaUrl()
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $gustokoBerria,
            $url
        );

    }

    /**
     * Encargado de las Aciones de atseginDut
     * @param String $action
     * @param Model $jakinarazpena
     */
    protected function _atseginDut($action, $jakinarazpena)
    {

        $atseginDut = $this->_atseginDutMapper->find(
            $jakinarazpena->getIdKanpotarra()
        );

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();

        $edukia = $this->_edukiaMapper->find(
            $atseginDut->getEdukiaId()
        );

        if (empty($edukia) || empty($atseginDut)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $url = $this->view->serverUrl(
            $edukia->edukiaUrl()
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $atseginDut,
            $url
        );

    }

    protected function _iradokizunBerria($action, $jakinarazpena)
    {

        $hobekuntzak = $this->_hobekuntzakMapper->find(
            $jakinarazpena->getIdKanpotarra()
        );

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();

        $edukia = $this->_edukiaMapper->find(
            $hobekuntzak->getEdukiaId()
        );

        if (empty($edukia) || empty($hobekuntzak)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $url = $this->view->serverUrl(
            $edukia->edukiaUrl()
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $hobekuntzak,
            $url
        );

    }

    protected function _ikastegiakBerria($action, $jakinarazpena)
    {

        $ikastegia = $this->_ikastegiaMapper->find(
            $jakinarazpena->getIdKanpotarra()
        );

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();

        if (empty($ikastegia)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $url = $this->view->serverUrl(
            $ikastegia->ikastegiaUrl()
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $ikastegia,
            $url,
            'ikastegia'
        );

    }

    protected function _irakasleEskaera($action, $jakinarazpena)
    {

        $relIrakaslea = new Mappers\ErabiltzaileaRelIrakaslea();
        $relIrakaslea = $relIrakaslea->find(
            $jakinarazpena->getIdKanpotarra()
        );

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();

        if (empty($relIrakaslea)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $url = $this->view->serverUrl(
            ''
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $relIrakaslea,
            $url
        );
    }

    protected function _irakasleEskaeraIkastegia($action, $jakinarazpena)
    {
        $ikastegia = new \Klikasi\Mapper\Sql\Ikastegia();
        $ikastegia = $ikastegia->find(
            $jakinarazpena->getIdKanpotarra()
        );

        $where = array(
            'erabiltzaileaId = ?' => $jakinarazpena->getThatUserId(),
            'ikastegiaId = ?' => $jakinarazpena->getIdKanpotarra()
        );
        $relIkastegia = new Mappers\ErabiltzaileaRelIkastegia();
        $relIkastegia = $relIkastegia->fetchOne($where);

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();

        if (empty($relIkastegia) || empty($ikastegia)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $url = $this->view->serverUrl(
            $ikastegia->ikastegiaUrl()
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $relIkastegia,
            $url
        );

    }

    protected function _edukiariSalaketa($action, $jakinarazpena)
    {

        $kexa = new \Klikasi\Mapper\Sql\Kexa();
        $kexa = $kexa->find($jakinarazpena->getIdKanpotarra());

        if (empty($kexa)) {
            return array(
                'status' => false,
                'error' => $this->view->translate('[es] Algo va mal.')
            );
        }

        $edukia = $kexa->getEdukia();

        $jakinarazpena->setIkusita(1)->save();

        $currentUser = $this->_sessionStart();

        $url = $this->view->serverUrl(
            $edukia->edukiaUrl()
        );

        return $this->_switchAction(
            $action,
            $jakinarazpena,
            $kexa,
            $url
        );

    }

    /**
     * @param String $action
     * @param Model $jakinarazpena
     * @param Model $model
     * @param String $url
     * @param String $isSpecial Es para modelos en los que la activación es diferente.
     */
    protected function _switchAction($action, $jakinarazpena, $model, $url, $isSpecial = false)
    {
        switch ($action) {
            case 'accept':
                if ($isSpecial === false) {

                    $egoeraPrev = $model->getEgoera();
                    $model->setEgoera('onartua')->save();

                    if ($egoeraPrev == "onartua") {

                        if ("Klikasi\\Model\\ErabiltzaileaRelIkastegia" == get_class($model)) {
                            $elementsToBeAccepted = array($model);
                        } else {
                            $elementsToBeAccepted = $model->getEdukiaRelIkastegia();
                        }

                        foreach ($elementsToBeAccepted as $rel) {
                            $rel->setEgoera("onartua")
                                ->save();
                        }
                    }
                    
                } else {
                    if ($isSpecial == 'ikastegia') {
                        $model->setAktibatua(1)->save();
                    }
                }

                $jakinarazpena->setEgoera('onartua')->save();

                return array(
                    'status' => true,
                    'instance' => 'accept'
                );

                break;

            case 'reject':
                
                if ($model->getEgoera() !== "onartua") {
                    $model->setEgoera('ezOnartua')->save();   
                }

                /*
                $relIkastegia = $model->getEdukiaRelIkastegia();
                foreach ($relIkastegia as $rel) {
                    $rel->delete();
                }*/

                $jakinarazpena->setEgoera('ezOnartua')->save();
                return array(
                    'status' => true,
                    'instance' => 'reject'
                );
                break;

            case 'viewContent':
                return array(
                    'status' => true,
                    'url' => $url,
                    'instance' => 'viewContent'
                );
                break;

            case 'deleteNotification':

                if ($this->_session->getId() == $jakinarazpena->getErabiltzaileaId()) {
                    $jakinarazpena->setDeletedByErabiltzailea(1)->save();
                } else {
                    $jakinarazpena->setDeletedBySender(1)->save();
                }

                $jakinarazpena->save();

                return array(
                    'status' => true,
                    'instance' => 'deleteNotification'
                );
                break;

            case 'markView':
                return array(
                    'status' => true,
                    'instance' => 'markView'
                );
                break;

            default:
                return array(
                    'status' => false,
                    'error' => $this->view->translate('[es] Algo va mal.')
                );
                break;

        }

    }

    /**
     * @return CurrentUserModel
     */
    protected function _sessionStart()
    {

        $session = $this->_helper->SessionUser();

        if (!$session) {
            $this->_redirect('sartu');
        }

        return $session;

    }

}