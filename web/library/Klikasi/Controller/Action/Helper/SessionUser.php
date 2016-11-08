<?php

use Klikasi\Mapper\Sql\Erabiltzailea;

/**
 * Sesioko erabiltzailea bueltatzen duen helper-a
 */
class Klikasi_Controller_Action_Helper_SessionUser extends Zend_Controller_Action_Helper_Abstract
{

    public function getSessionUser()
    {
        $front = Zend_Controller_Front::getInstance();
        if ($front->getRequest()->getParam("module") != 'default') {
            return;
        }

        $auth = \Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {

            $erabiltzailea = $auth->getIdentity();
            if ($erabiltzailea instanceof __PHP_Incomplete_Class) {
                $auth->clearIdentity();
                return false;
            }

            $erabiltzaileMapper = new Erabiltzailea();
            $erabiltzailea = $erabiltzaileMapper->find($erabiltzailea->getId());

            $auth->getStorage()->write($erabiltzailea);

            return $erabiltzailea;
        }

        return false;
    }

    public function direct()
    {
        return $this->getSessionUser();
    }

}