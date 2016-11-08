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
class ErabiltzaileaRelIkastegia extends Raw\ErabiltzaileaRelIkastegia
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function setNewPetition($erabiltzaileaId, $ikastegiaId)
    {

        $this->setErabiltzaileaId($erabiltzaileaId);
        $this->setIkastegiaId($ikastegiaId);
        $this->setAdministratzailea(0);
        $this->setJabea(0);
        $this->setEgoera('onartzeko');

    }

}