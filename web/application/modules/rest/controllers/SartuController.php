<?php

class Rest_SartuController extends Iron_Controller_Rest_BaseController
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {

        $token = $this->getRequest()->getHeader('Authorization', false);

        if (!$token) {
            $this->_errorAuth();
        }

        $tokenParts = explode(' ', $token);

        if (count($tokenParts) != 2) {
            $this->_errorAuth();
        }

        $authType = $tokenParts[0];

        if ($authType = 'Klikasi') {

            $reqDate = $this->getRequest()->getHeader('Request-Date', false);

            $authMethod = new Klikasi_Controller_Plugin_AuthApp();
            $model = $authMethod->authenticate($tokenParts[1], $reqDate);

            if (empty($model)) {
                $this->_errorAuth();
            }

            $user = $model->authData();

            $this->addViewData($user);

        } else {
            $this->_errorAuth();
        }

    }

    /**
     * Mensaje de error en la autenticación.
     */
    protected function _errorAuth($msg = 'Authorization incorrecta')
    {

        $resutl = array(
            'success' => false,
            'message' => $msg
        );

        $response = $this->getResponse();
        $response->setHeader(
            'Content-type',
            'application/json; charset=UTF-8;'
        );

        $response->setHttpResponseCode(401);
        $response->setBody(json_encode($resutl));
        $response->sendResponse();

        exit();

    }

}