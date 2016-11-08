<?php

/**
 * Application Model
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 *
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 */

namespace Klikasi\Model;
class ErabiltzaileaRelIrakaslea extends Raw\ErabiltzaileaRelIrakaslea
{

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function createRelIkasleaIrakaslea($irakasleaId, $ikastegiaId)
    {

        $currentUser = new \Klikasi_Controller_Action_Helper_SessionUser();
        $currentUser = $currentUser->getSessionUser();

        $this->setErabiltzaileaId($currentUser->getId());
        $this->setIrakasleaId($irakasleaId);
        $this->setEgoera('onartzeko');
        $this->setIkastegiaId($ikastegiaId);
        $this->save();

        return $this->getId();

    }

}