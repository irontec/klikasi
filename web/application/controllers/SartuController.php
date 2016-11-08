<?php
class SartuController extends Zend_Controller_Action
{

    protected $_auth = NULL;

    public function init()
    {

        $this->_helper->layout->setLayout('container-principal-title');
        $this->_auth = Zend_Auth::getInstance();

        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;

        $this->_helper->ironContextSwitch()
            ->addActionContext('sartu-dialog', 'json')
            ->initContext();

        $this->view->title = 'Sartu';

    }

    public function indexAction()
    {

        if ($this->_auth->hasIdentity()) {

            $url = $this->_calculateReferer();
            $this->_redirect($url);

        } else {

            if ($this->getRequest()->isPost()) {

                $postData = $this->getRequest()->getPost();

                $klikasiAuth = $this->_postDataValid($postData);

                if ($klikasiAuth->authenticate()->isValid()) {

                    $this->_createSession($klikasiAuth, $postData);
                    $this->_redirect($postData['referer']);

                } else {

                    $this->view->erroreMezuak = $klikasiAuth
                        ->authenticate()
                        ->getMessages();
                }
            }
        }

        $this->view->referer = $this->_calculateReferer();
    }


    /**
     * Login por Dialog JSON
     */
    public function sartuDialogAction()
    {

        if ($this->getRequest()->isPost()) {

            $postData = $this->getRequest()->getPost();

            $klikasiAuth = $this->_postDataValid($postData);

            if ($klikasiAuth->authenticate()->isValid()) {

                $this->_createSession($klikasiAuth, $postData);

                $this->view->status = true;
                $this->view->message = null;

            } else {

                $this->view->status = false;
                $this->view->message = 'Erabiltzailea edo pasahitza ez dira zuzenak';

            }

        } else {

            $this->_redirect('sartu');

        }

    }

    /**
     * Cerrar Sessión
     */
    public function irtenAction()
    {
        $this->_auth->clearIdentity();
        Zend_Session::forgetMe();

        $url = $this->_calculateReferer();
        $this->_redirect($url);
    }

    /**
     * Klikasi_Auth_PublicAdapter
     * @param Array $params
     * @return Klikasi_Auth_PublicAdapter
     */
    protected function _postDataValid($params)
    {

        $authAdapter = new Klikasi_Auth_PublicAdapter(
            $params['erabiltzailea'],
            $params['pasahitza']
        );

        return $authAdapter;

    }

    /**
     * Save to Storage
     */
    protected function _createSession($klikasiAuth, $postData)
    {

        $klikasiAuth->saveStorage();

        $session = new Zend_Session_Namespace('Zend_Klikasi_Auth');
        $session->setExpirationSeconds('28800');

        if (isset($postData['gogoratu']) && $postData['gogoratu'] == '1') {

            $time = '12096000'; //2 aste
            Zend_Session::rememberMe($time);
            $session->setExpirationSeconds($time);

        }

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