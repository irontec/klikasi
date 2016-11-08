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
class ErabiltzaileaSettings extends Raw\ErabiltzaileaSettings
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Crea un registro de configuración para un usuario,
     * con los datos Default's.
     * @param Int $erabiltzaileaId
     * @return Model;
     */
    public function firstPopulate($erabiltzaileaId)
    {

        $this->setErabiltzaileaId($erabiltzaileaId);
        $this->setModerazioBerria(1);
        $this->setIkastegiakBerria(1);
        $this->setIkasleEskaera(1);
        $this->setKolaborazioEskaera(1);
        $this->setEdukiBerria(1);
        $this->setIruzkinBerria(1);
        $this->setIradokizunBerria(1);
        $this->setGustokoBerria(1);
        $this->setAtseginDut(1);
        $this->setEdukiariSalaketa(1);
        $this->save();
    }

    public function postEditEgileak($post)
    {
        if (isset($post['moderazioBerria'])) {
            $this->setModerazioBerria($post['moderazioBerria']);
        } else {
            $this->setModerazioBerria(0);
        }

        if (isset($post['ikastegiakBerria'])) {
            $this->setIkastegiakBerria($post['ikastegiakBerria']);
        } else {
            $this->setIkastegiakBerria(0);
        }

        if (isset($post['ikasleEskaera'])) {
            $this->setIkasleEskaera($post['ikasleEskaera']);
        } else {
            $this->setIkasleEskaera(0);
        }

        if (isset($post['kolaborazioEskaer'])) {
            $this->setKolaborazioEskaera($post['kolaborazioEskaer']);
        } else {
            $this->setKolaborazioEskaera(0);
        }

        if (isset($post['edukiBerria'])) {
            $this->setEdukiBerria($post['edukiBerria']);
        } else {
            $this->setEdukiBerria(0);
        }

        if (isset($post['iruzkinBerria'])) {
            $this->setIruzkinBerria($post['iruzkinBerria']);
        } else {
            $this->setIruzkinBerria(0);
        }

        if (isset($post['iradokizunBerria'])) {
            $this->setIradokizunBerria($post['iradokizunBerria']);
        } else {
            $this->setIradokizunBerria(0);
        }

        if (isset($post['gustokoBerria'])) {
            $this->setGustokoBerria($post['gustokoBerria']);
        } else {
            $this->setGustokoBerria(0);
        }

        if (isset($post['atseginDut'])) {
            $this->setAtseginDut($post['atseginDut']);
        } else {
            $this->setAtseginDut(0);
        }
        if (isset($post['edukiariSalaketa'])) {
            $this->setEdukiariSalaketa($post['edukiariSalaketa']);
        } else {
            $this->setEdukiariSalaketa(0);
        }

        if (isset($post['mezuBerria'])) {
            $this->setMezuBerria($post['mezuBerria']);
        } else {
            $this->setMezuBerria(0);
        }

    }

}