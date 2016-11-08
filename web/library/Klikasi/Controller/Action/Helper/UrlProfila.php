<?php

class Klikasi_Controller_Action_Helper_UrlProfila extends Zend_Controller_Action_Helper_Abstract
{

    public function getUrlProfila($session)
    {

        if ($session) {
            return '/erabiltzaileak/ikusi/erabiltzailea/' . $session->getUrl();
        }

        return '/sartu';

    }

    public function direct($session)
    {

        return $this->getUrlProfila($session);

    }

}