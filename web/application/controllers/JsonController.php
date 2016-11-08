<?php
use Klikasi\Model as Models;
use Klikasi\Mapper\Sql as Mappers;

use Klikasi\Model\Mezuak as MezuakModel;

use Klikasi\Mapper\Sql\Etiketa as EtiketaMapper;
use Klikasi\Mapper\Sql\Erabiltzailea as ErabiltzaileaMapper;

class JsonController extends Zend_Controller_Action
{

    protected $_etiketaMapper;
    protected $_erabiltzaileaMapper;
    protected $_currentUser;

    public function init()
    {
        $this->_helper->layout()->disableLayout();

        $this->_currentUser =$this->_helper->SessionUser();
        if (!$this->_currentUser) {
            $this->_redirect('edukiak');
        }

        $this->_helper->ironContextSwitch()
            ->addActionContext('etiketak', 'json')
            ->addActionContext('kolaboratzaileak', 'json')
            ->addActionContext('kolaboratzaileak-array', 'json')
            ->addActionContext('template', 'json')
            ->addActionContext('mezua', 'json')
            ->addActionContext('search-irakasleak', 'json')
            ->addActionContext('jakinarazpena-kexa', 'json')
            ->initContext();

        $this->_initMappers();

        if (!$this->getRequest()->getParam('format', false)) {
            $this->_redirect('/');
        }

    }

    protected function _initMappers()
    {
        $this->_etiketaMapper = new EtiketaMapper();
        $this->_erabiltzaileaMapper = new ErabiltzaileaMapper();
    }

    public function indexAction()
    {
        $this->_redirect('edukiak');
    }

    public function etiketakAction()
    {

        $etiketakResutls = array();
        $etiketakList = $this->_etiketaMapper->fetchList();

        foreach ($etiketakList as $etiketak) {
            $etiketakResutls[] = $etiketak->toArrayEdukiak();
        }

        $this->view->data = $etiketakResutls;

    }

    public function kolaboratzaileakAction()
    {

        $erabiltzaileak = $this->getRequest()->getParam(
            'erabiltzaileak',
            false
        );

        if ($erabiltzaileak) {
            if (strlen($erabiltzaileak) >= 3) {

                $where = array(
                    'izena like "%' . $erabiltzaileak . '%"',
                    'abizena like "%' . $erabiltzaileak . '%"',
                    'abizena2 like "%' . $erabiltzaileak . '%"',
                    'url like "%' . $erabiltzaileak . '%"'
                );

                $order = array(
                    'izena',
                    'abizena',
                    'abizena2'
                );

                $whereOr = ' (' . implode(' OR ', $where) . ') ';
                $whereAnd = ' AND id != ' . $this->_currentUser->getId();

                $erabiltzaileakList = $this->_erabiltzaileaMapper->fetchList(
                    $whereOr . $whereAnd,
                    $order
                );

                $erabiltzaileaDataList = array();
                foreach ($erabiltzaileakList as $erabiltzaileak) {
                    $erabiltzaileaDataList[] = $erabiltzaileak->toArray();

                }

                $this->view->data = $erabiltzaileaDataList;
            }
        }

    }

    public function kolaboratzaileakArrayAction()
    {

        $erabiltzaileak = $this->getRequest()->getParam(
            'erabiltzaileak',
            false
        );

        if ($erabiltzaileak) {

            $order = array(
                'izena',
                'abizena',
                'abizena2'
            );

            $erabiltzaileakList = $this->_erabiltzaileaMapper->fetchList(
                ' id in (' . $erabiltzaileak . ') ',
                $order
            );

            $erabiltzaileaDataList = array();
            foreach ($erabiltzaileakList as $erabiltzaileak) {
                $erabiltzaileaDataList[] = $erabiltzaileak->toArray();

            }

            $this->view->data = $erabiltzaileaDataList;

        }

    }

    public function templateAction()
    {

        $template = $this->getRequest()->getParam('template', false);
        $currentForm = $this->getRequest()->getParam('currentForm', false);

        if ($template!= false && $currentForm != false) {

            if ($currentForm == 'edit-edukia') {
                $path = 'edukiak-administrazioan';
            } elseif ($currentForm == 'new-edukia') {
                $path = 'edukiak-igo';
            }

            $templateName =  $path . '/' . $template . '.phtml';
            $viewsPath = '/views/scripts/';
            $templatePath = APPLICATION_PATH . $viewsPath . $templateName;

            $this->view->data = file_get_contents($templatePath);

        } else {
            $this->view->data = array();
        }

    }

    public function searchIrakasleakAction()
    {

        //Typo en el nombre del parámetro
        $ikastegia = $this->getRequest()->getParam('irakasleak', false);

        if ($ikastegia) {

            $where = array(
                'profila = ? ' => 'irakasle',
                'egoera = ? ' => 'aktibatua'
            );
            $order = array(
                'izena',
                'abizena',
                'abizena2'
            );

            $erabiltzaileaList = $this->_erabiltzaileaMapper->fetchList(
                $where,
                $order
            );

            $irakasleakList = array();

            if (sizeof($erabiltzaileaList) > 0) {
                foreach ($erabiltzaileaList as $erabiltzailea) {
                    if (sizeof($erabiltzailea->getErabiltzaileaRelIkastegia()) > 0) {
                        foreach ($erabiltzailea->getErabiltzaileaRelIkastegia() as $relIkastegia) {

                            if (
                                $relIkastegia->getIkastegiaId() == $ikastegia
                            &&
                                $relIkastegia->getEgoera() == 'onartua'
                            // &&
                                // (
                                    // $relIkastegia->getAdministratzailea() == 1
                                // ||
                                    // $relIkastegia->getJabea() == 1
                                // )
                                ) {

                                $irakasleakList[] = array(
                                    'id' => $erabiltzailea->getId(),
                                    'izena' => $erabiltzailea->getCompletName()
                                );
                            }

                        }
                    }
                }
            }

            $this->view->data = $irakasleakList;
            $this->view->status = true;

        } else {
            $this->view->data = array();
            $this->view->status = false;
        }

    }

    public function mezuaAction()
    {
        $status = true;
        $error = '';
        $datuak = $this->getRequest()->getPost();

        if (isset($datuak['erabiltzaileaId']) && $datuak['erabiltzaileaId'] == 0) {
            $status = false;
        }

        if (isset($datuak['currentId']) && $datuak['currentId'] == 0) {
            $status = false;
        }

        if (isset($datuak['mezuak']) && trim($datuak['mezuak']) == '') {
            $status = false;
            $error['mezuak'] = 'Mezua betetzea beharrezkoa da';
        }

        if ($status) {

            $now = new Zend_Date();
            $now = $now->toString('yyyy-MM-dd HH:mm:ss');

            $mezuak = new MezuakModel();

            $mezuak->setNorkId($datuak['currentId']);
            $mezuak->setNoriId($datuak['erabiltzaileaId']);
            $mezuak->setMezua($datuak['mezuak']);
            $mezuak->setIkusita(1);
            $mezuak->setMota('mezua');
            $mezuak->setSortzeData($now);
            $mezuak->save();

            $this->view->status = $status;
            $this->view->mezuak = $this->view->translate('[es] Mensaje enviado.');

        } else {
            $this->view->status = $status;
            $this->view->error = $error;
        }

    }

    public function jakinarazpenaKexaAction()
    {

        $jakinarazpenaId = $this->getRequest()->getParam('jakinarazpenaKexa', false);
        $actionMezuak = $this->getRequest()->getParam('actionMezuak', false);

        if ($jakinarazpenaId !== false) {

            $jakinarazpena = new Mappers\Jakinarazpenak();
            $jakinarazpena = $jakinarazpena->find($jakinarazpenaId);

            if ($actionMezuak == 'reply') {

                $erabiltzailea = $jakinarazpena->getThatUser();
                $this->view->jakinarazpenaId = $jakinarazpena->getId();
                $this->view->erabiltzaileaIzena = $erabiltzailea->getCompletName();

            } else {

                $kexa = new Mappers\Kexa();
                $kexa = $kexa->find(
                    $jakinarazpena->getIdKanpotarra()
                );

                $edukia = $kexa->getEdukia();
                $erabiltzailea = $edukia->getErabiltzailea();

                $this->view->jakinarazpenaId = $jakinarazpena->getId();
                $this->view->erabiltzaileaIzena = $erabiltzailea->getCompletName();
                $this->view->erabiltzaileaPosta = $erabiltzailea->getPosta();
                $this->view->kexa = $kexa->getKexa();
                $this->view->edukiaUrl = $edukia->edukiaUrl();
                $this->view->edukiaTitulua = $edukia->getTitulua();

            }

            $this->view->status = true;

        } else {

            $this->view->status = false;
            $this->view->error = $this->view->translate('[es] Notificación incorrecta.');

        }

    }

}