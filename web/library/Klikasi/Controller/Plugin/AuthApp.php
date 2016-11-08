<?php

use Klikasi\Mapper\Sql as Mappers;

class Klikasi_Controller_Plugin_AuthApp
    extends Zend_Controller_Plugin_Abstract
{

    protected $_life = 10000000;
    //example
    //protected $_key = 'r4h56dgf4h56df4h65r4h564hh4dgf56';
    protected $key = 'USER_CONFIGURABLE:AUTH_BASE_KEY';

    /**
     *
     * @param $token
     * @param $requestDate
     * @return $model | JSON error
     */
    public function authenticate($token, $requestDate)
    {

        if (!$requestDate) {
            $this->_errorAuth();
        }

        try {
            $dateHash = new \Zend_Date($requestDate);
            $dateHash->setTimezone('UTC');
            $dateHash = $dateHash->toString(Zend_Date::W3C);
        } catch (\Exception $e) {
            $this->_errorAuth($e->getMessage());
        }

        $date = new \Zend_Date();
        $date->setTimezone('UTC');
        $nowUTC = $date->toString(Zend_Date::W3C);

        if (!$this->_validDate($nowUTC, $dateHash)) {
            $this->_errorAuth('Token Expired');
        }

        $token = trim($token, '[');
        $token = trim($token, ']');

        $tokenParts = explode(':', $token);

        if (sizeof($tokenParts) !== 2) {
            $this->_errorAuth();
        }

        $userName = $tokenParts[0];
        $secret   = $tokenParts[1];

        $mapper = new Mappers\Erabiltzailea();
        $user   = $mapper->findOneByField(
            'erabiltzaileIzena',
            $userName
        );

        if (empty($user)) {
            $this->_errorAuth();
        }

        $serverDigest = hash_hmac(
            'sha256',
            $user->getPasahitza(),
            $this->_key
        );

        if ($secret !== $serverDigest) {
            $this->_errorAuth();
        }

        return $user;

    }

    /**
     * Comprueba que el token este en una fecha valida.
     * @param Zend_Date $nowUTC
     * @param Zend_Date $dateHash
     * @return boolean
     */
    protected function _validDate($nowUTC, $dateHash)
    {
        $timeHash = strtotime($dateHash);
        $timeNow = strtotime($nowUTC);

        $diff = $timeNow - $timeHash;

        if ($diff > $this->_life || $diff < 0) {
            return false;
        }

        return true;

    }

    /**
     * Mensaje de error en la autenticación.
     */
    protected function _errorAuth($msg = 'Authorization incorrecta')
    {

        $front = Zend_Controller_Front::getInstance();

        $resutl = array(
            'success' => false,
            'message' => $msg
        );

        $response = $front->getResponse();
        $response->setHttpResponseCode(401);
        $response->setBody(json_encode($resutl));
        $response->sendResponse();
        exit();

    }

}