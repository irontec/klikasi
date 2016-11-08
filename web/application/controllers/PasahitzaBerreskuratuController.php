<?php

use \Klikasi\Mapper\Sql\Erabiltzailea as ErabiltzaileaMapper;
use \Klikasi\Custom\Notifikazioa as CustomNotifikazioa;

class PasahitzaBerreskuratuController extends Zend_Controller_Action
{

    protected $_auth = NULL;
    protected $_erabiltzaileaMapper;

    public function init()
    {

        $this->_helper->layout->setLayout('container-principal-title');

        $this->_auth = Zend_Auth::getInstance();

        $this->view->flashmezuak = $this->_helper->FlashMessenger->getMessages();

        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;

        $this->_initMappers();

    }

    protected function _initMappers()
    {

        $this->_erabiltzaileaMapper = new ErabiltzaileaMapper();

    }

    public function indexAction()
    {

        $this->view->title = 'Pasahitza Berreskuratu';
        $request = $this->getRequest();

        $kodea = $request->getParam('kodea', false);
        $nor = $request->getParam('nor', false);

        if ($this->_auth->hasIdentity()) {

            $url = $this->_calculateReferer();
            $this->_redirect($url);

        } elseif ($kodea && $nor) {

            $this->_changePassword(
                $kodea,
                $nor
            );

        } else {

            if ($this->getRequest()->isPost()) {

                $postData = $this->getRequest()->getPost();
                $this->_postAction($postData);

            }

            $this->view->currentForm = $this->_templates
                ->loadTemplate('erabiltzailea')
                ->render();

        }

    }

    /**
     * Se encarga de el proceso de envio de email.
     * @param Array $postData
     */
    protected function _postAction($postData)
    {

        if ($this->_postValid($postData)) {

            $dataForm = $postData['erabiltzailea'];
            $where = array(
                'posta = "' . $dataForm . '"',
                'url = "' . $dataForm . '"'
            );

            $user = $this->_erabiltzaileaMapper->fetchOne(
                implode(' OR ', $where)
            );

            if (empty($user)) {

                $this->view->erroreMezuak = array(
                    'Erabiltzailea edo posta ez da existitzen'
                );

            } else {

                $orain = \Zend_Date::now('eu_ES');
                $orain->addHour('1');

                $user->setHash(md5(uniqid(rand(), true)));
                $user->setHashIraungiData(
                    $orain->toString('yyy-MM-dd H:m:s')
                );
                $user->save();

                $nor = $user->getErabiltzaileIzena();
                $kodea = $user->getHash();

                $dataGet = '?nor=' . $nor . '&kodea=' . $kodea;
                $dataUrl = 'pasahitza-berreskuratu' . $dataGet;

                $baseUrl = $this->view->baseUrl($dataUrl);
                $url = array(
                    'remember' => $this->view->serverUrl($baseUrl)
                );

                $notifikazioa = new CustomNotifikazioa(
                    'pasahitza-berreskuratu',
                    $user,
                    $url
                );

                $notifikazioa->notifikazioaBidali(
                    'Pasahitza Berreskuratu'
                );

                $this->view->alertSuccess = array('Posta bidali da');

            }

        }

    }

    /**
     * Lo parametros del post son correctos
     * @param Array $postData
     * @return Boolean
     */
    protected function _postValid($postData)
    {

        $isValid = false;

        if (isset($postData['bidali'])) {
            if (isset($postData['erabiltzailea'])) {
                if (trim($postData['erabiltzailea']) != '') {
                    $isValid = true;
                }
            }
        }

        return $isValid;

    }

    /**
     * Gestiona el cambio de contraseña y redirecciona al formulario de login.
     * @param String $kodea
     * @param String $nor
     * @throws Zend_Exception
     */
    protected function _changePassword($kodea, $nor)
    {

        $where = array(
            'hash = ?' => $kodea,
            'erabiltzaileIzena = ?' => $nor
        );

        $erabiltzailea = $this->_erabiltzaileaMapper->fetchOne(
            $where
        );

        if (!$erabiltzailea) {
            throw new Zend_Exception(
                'Helbidea txarto dago edo kodeak akatsen bat du.'
            );
        }

        $orain = Zend_Date::now();
        $iraungiData = new Zend_Date($erabiltzailea->getHashIraungiData());

        if ($orain->isLater($iraungiData)) {
            throw new Zend_Exception(
                'Kodea iraungi da iada eta ez du balio.'
            );
        }

        $this->view->currentForm = $this->_templates->
            loadTemplate('pasahitza-berreskuratu')->
            render();

        if ($this->getRequest()->isPost()) {

            $pasahitza = $this->getRequest()->getPost('pasahitza', false);
            $pasahitzaBaieztatu = $this->getRequest()->getPost('pasahitzaBaieztatu', false);

            if ($this->_validPasahitza($pasahitza, $pasahitzaBaieztatu) === true) {

                $erabiltzailea->setPasahitza(
                    $erabiltzailea->cryptValue($pasahitza)
                );
                $erabiltzailea->setHash(
                    md5(uniqid(rand(), true))
                );
                $erabiltzailea->setHashIraungiData(
                    $orain->subHour(2)->toString('yyy-MM-dd H:m:s')
                );
                $erabiltzailea->save();

                $this->_helper->flashMessenger(
                    array(
                        'success' => 'Aldaketa burutua'
                    )
                );

                $this->_redirect('/sartu/');

            } else {

                $this->view->erroreMezuak = $this->_validPasahitza(
                    $pasahitza,
                    $pasahitzaBaieztatu
                );

            }

        }

    }

    /**
     * Comprueba que las contraseñas sean correctas
     * @param String $pasahitza
     * @param String $pasahitzaBaieztatu
     * @return boolean
     */
    protected function _validPasahitza($pasahitza, $pasahitzaBaieztatu)
    {

        $pasahitzaStatus = false;
        $pasahitzaBaieztatuStatus = false;

        if ($pasahitza !== false && trim($pasahitza) != '') {
            $pasahitzaStatus = true;
        }

        if ($pasahitzaBaieztatu !== false && trim($pasahitzaBaieztatu) != '') {
            $pasahitzaBaieztatuStatus = true;
        }

        if ($pasahitzaBaieztatuStatus && $pasahitzaStatus) {
            if ($pasahitza === $pasahitzaBaieztatu) {
                return true;
            } else {
                return array(
                    'Pasahitzak berdinak izan behar dute.'
                );
            }
        } else {
            return array(
                'Atal guztiak beharrezkoak dira.'
            );
        }

        return false;

    }

    /**
     * Calcula la pagina de origen
     * @return String
     */
    protected function _calculateReferer()
    {

        $serverUrl = $this->view->serverUrl($this->view->baseUrl());
        if (!isset($_SERVER['HTTP_REFERER'])) {
            $url = $serverUrl;
        } elseif (strpos($_SERVER['HTTP_REFERER'], $serverUrl < 0)
            || strpos($_SERVER['HTTP_REFERER'], 'sartu') > 0) {
            $url = $serverUrl;
        } else {
            $url = $_SERVER['HTTP_REFERER'];
        }

        return $url;

    }

}