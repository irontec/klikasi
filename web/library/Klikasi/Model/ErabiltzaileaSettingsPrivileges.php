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
class ErabiltzaileaSettingsPrivileges
{
    protected $_moderazioBerria;
    protected $_edukiariSalaketa;
    protected $_iradokizunak;

    public function setModerazioBerria($value)
    {
        $this->_moderazioBerria = $value;
        return $this;
    }

    public function getModerazioBerria()
    {
        return $this->_moderazioBerria;
    }

    public function setEdukiariSalaketa($value)
    {
        $this->_edukiariSalaketa = $value;
        return $this;
    }

    public function getEdukiariSalaketa()
    {
        return $this->_edukiariSalaketa;
    }

    public function setIradokizunak($value)
    {
        $this->_iradokizunak = $value;
        return $this;
    }

    public function getIradokizunak()
    {
        return $this->_iradokizunak;
    }
}