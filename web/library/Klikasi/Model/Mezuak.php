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
 * [entity]
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 */

namespace Klikasi\Model;
class Mezuak extends Raw\Mezuak
{
    protected $_now;
    protected $_currentUser;

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
        $currentTime = new \Zend_Date();
        $this->_now = $currentTime->toString('yyyy-MM-dd HH:mm:ss');

        $currentUser = new \Klikasi_Controller_Action_Helper_SessionUser();
        $this->_currentUser = $currentUser->getSessionUser();
    }

    /**
     * @param Int $norkId > de quien ID
     * @param Int $noriId > a quien ID
     * @param String $mezua
     * @param Model $edukia
     * @return number
     */
    public function newLaguntzaileak($norkId, $noriId, $mezua, $edukia)
    {
        $this->setNorkId($norkId);
        $this->setNoriId($noriId);
        $this->setMezua($mezua);
        $this->setMota('edukia');
        $this->setIkusita(1);
        $this->setEdukiaId($edukia);
        $this->setSortzeData($this->_now);
        $this->save();

        return $this->getId();
    }

    /**
     * @param Int $norkId > de quien ID
     * @param Int $noriId > a quien ID
     * @param String $mezua
     */
    public function createMezuak($norkId, $noriId, $mezua, $mota, $edukiaId)
    {

        $this->setNorkId($norkId);
        $this->setNoriId($noriId);
        $this->setMezua($mezua);
        $this->setMota('edukia');
        $this->setIkusita(1);
        $this->setEdukiaId($edukiaId);
        $this->setSortzeData($this->_now);
        $this->save();

    }

    /**
     * @param Int $norkId > de quien ID
     * @param Int $noriId > a quien ID
     * @param String $mezua
     */
    public function replyMezuak($norkId, $noriId, $mezua)
    {

        $this->setNorkId($norkId);
        $this->setNoriId($noriId);
        $this->setMezua($mezua);
        $this->setMota('mezua');
        $this->setIkusita(1);
        //$this->setEdukiaId($edukiaId);
        $this->setSortzeData($this->_now);
        $this->save();

    }

}