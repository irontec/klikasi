<?php
use \Klikasi\Mapper\Sql\Erabiltzailea as erabilMapper;

class Klikasi_Auth_PublicAdapter implements Zend_Auth_Adapter_Interface
{
    protected $_erabiltzaileIzena;
    protected $_pasahitza;

    protected $_erabilMapper;
    protected $_erabiltzailea;

    public function __construct($erabiltzailea, $pasahitza)
    {
        $this->_erabilMapper = new erabilMapper();
        $this->_erabiltzaileIzena = $erabiltzailea;
        $this->_pasahitza = $pasahitza;
    }

    public function authenticate()
    {
        try {
            $erabiltzailea = $this->_erabilMapper->findOneByField(
                'erabiltzaileIzena',
                $this->_erabiltzaileIzena
            );

            if ($this->_userHasValidCredentials($erabiltzailea)) {
                $this->_erabiltzailea = $erabiltzailea;
                $authResult = Zend_Auth_Result::SUCCESS;
                $authMessage['message'] = "Dena ondo joanda da";
                $this->saveStorage();
            } elseif (!$erabiltzailea) {
                $authResult = Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND;
                $authMessage['message'] = "Erabiltzailea ez da existitzen";
            } else {
                $authResult = Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
                $authMessage['message'] = "Pasahitza ez da zuzena";
            }

            return new Zend_Auth_Result($authResult, $this->_erabiltzaileIzena, $authMessage);

        } catch (Exception $e) {

            $authResult = Zend_Auth_Result::FAILURE_UNCATEGORIZED;
            $authMessage['message'] = $e->getMessage();
            return new Zend_Auth_Result($authResult, $this->_erabiltzaileIzena, $authMessage);
        }
    }

    protected function _userHasValidCredentials($erabiltzailea = null)
    {
        if (!$erabiltzailea instanceof \Klikasi\Model\Erabiltzailea) {
            return false;
        }

        $hash = $erabiltzailea->getPasahitza();
        if ($this->_checkPassword($this->_pasahitza, $hash)) {
            return true;
        }

        return false;
    }

    protected function _checkPassword($clearPass, $hash)
    {
        $hashParts = explode('$', trim($hash, '$'), 2);

        switch ($hashParts[0]) {
         case '1': //md5
             list(,,$salt,) = explode("$", $hash);
             $salt = '$1$' . $salt . '$';
             break;

         case '5': //sha
             list(,,$rounds,$salt,) = explode("$", $hash);
             $salt = '$5$' . $rounds . '$' . $salt . '$';
             break;

         case '2a': //blowfish
             $salt = substr($hash, 0, 29);
             break;
        }

        $res = crypt($clearPass, $salt . '$');
        return $res == $hash;
    }

    public function saveStorage()
    {
        $auth = Zend_Auth::getInstance();
        $authStorage = $auth->getStorage();
        $authStorage->write($this->_erabiltzailea);
    }
}