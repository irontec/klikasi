<?php

class Klikasi_Controller_Plugin_Auth extends Zend_Controller_Plugin_Abstract
{

    /**
     * @var Klear_Bootstrap
     */
    protected $_bootstrap;

    /**
     * Este método se ejecuta una vez se ha matcheado la ruta adecuada
     * (non-PHPdoc)
     * @see Zend_Controller_Plugin_Abstract::routeShutdown()
     */
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {

        if ('rest' !== $request->getModuleName()) {
            return;
        }

        if ('OPTIONS' === $request->getMethod()) {
            return;
        }

        if (!$this->_checkConfigRequiredAuth($request)) {
            return;
        }

        ini_set('xdebug.overload_var_dump', 0);
        $this->_initAuth($request);

    }

    protected function _checkConfigRequiredAuth($request)
    {

        $methodsOptions = APPLICATION_PATH . '/configs/restApi.ini';

        if (!file_exists($methodsOptions)) {
            throw new Exception(
                'No existe el archivos de configuración restApi.ini'
            );
        }

        $methodsConfig = new \Zend_Config_Ini(
            $methodsOptions,
            APPLICATION_ENV
        );
        $controller = $request->getControllerName();
        $method = strtolower($request->getMethod());

        if (empty($methodsConfig->$controller)) {
            $check = $methodsConfig->defaultPolicy;
        } else {
            $check = $methodsConfig->$controller;
        }

        if (empty($check->$method)) {
            $auth = $methodsConfig->defaultPolicy->$method->authorization;
        } else {
            $auth = $check->$method->authorization;
        }

        return (boolval($auth));

    }

    protected function _initAuth(Zend_Controller_Request_Abstract $request)
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