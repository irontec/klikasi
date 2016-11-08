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
class Hobekuntzak extends Raw\Hobekuntzak
{

    protected $_now;
    protected $_currentUser;
    protected $_manualInit;

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {

    }

    protected function _manualInit()
    {

        $currentTime = new \Zend_Date();
        $this->_now = $currentTime->toString('yyyy-MM-dd HH:mm:ss');

        $currentUser = new \Klikasi_Controller_Action_Helper_SessionUser();
        $this->_currentUser = $currentUser->getSessionUser();

    }

    /**
     *
     * @param array $params
     */
    public function createHobekuntzak($params = array())
    {

        $this->_manualInit();

        $this->setErabiltzaileaId($this->_currentUser->getId());
        $this->setEdukiaId($params['edukiaId']);
        $this->setHobekuntzak(
            strip_tags($params['hobekuntzak'])
        );
        $this->setSortzeData($this->_now);
        $this->save();

    }

}