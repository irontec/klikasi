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
class Kexa extends Raw\Kexa
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
    public function createKexa($params = array())
    {

        $this->_manualInit();

        $this->setErabiltzaileaId($this->_currentUser->getId());
        $this->setEdukiaId($params['edukiaId']);
        $this->setKexa(
            strip_tags($params['salatu'])
        );
        $this->setIkusita('1');
        $this->setKonponduta('0');
        $this->setSortzeData($this->_now);
        $this->save();

        /**
         * Notificaciones a los adminsitradores y email.
         * arbol de prioridades segun el propietario
         *  - irakasle => superadmin o azkue
         *  - other => azkue
         *  - ikale => irakasle
         */

    }

}