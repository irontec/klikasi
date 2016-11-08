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
class AtseginDut extends Raw\AtseginDut
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {

    }

    public function createAtseginDut($edukiaId)
    {

        $currentUser = new \Klikasi_Controller_Action_Helper_SessionUser();
        $currentUser = $currentUser->getSessionUser();

        $this->setEdukiaId($edukiaId);
        $this->setErabiltzaileaId($currentUser->getId());
        $this->save();

    }

}
