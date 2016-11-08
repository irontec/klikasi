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
class Jakinarazpenak extends Raw\Jakinarazpenak
{
    protected $_now;
    protected $_egoera = 'onartzeko';
    protected $_ikusita = 0;
    // protected $_fromIzena = 'Klikasi';
    // protected $_fromPosta = 'no-reply@klikasi.com';
    protected $_currentUser;
    protected $_manualInit;

    /**
     * This method is called just after parent's constructor
     */
    protected function _manualInit()
    {
        $currentTime = new \Zend_Date();
        $this->_now = $currentTime->toString('yyyy-MM-dd HH:mm:ss');

        $currentUser = new \Klikasi_Controller_Action_Helper_SessionUser();
        $this->_currentUser = $currentUser->getSessionUser();
    }

    /**
     * Comprueba si ya existe una notifiación previa, para no duplicarla.
     * @param Model $erabiltzailea
     * @param Model $komodin
     * @param Int $mota
     */
    public function jakinarazpenExistitzen($komodin, $mota)
    {
        $this->_manualInit();
        $currentUser = $this->_currentUser;
        $erabiltzailea = $komodin->getErabiltzailea();

        $where = array(
            'erabiltzaileaId = ?' => $erabiltzailea->getId(),
            'idKanpotarra = ?' => $komodin->getId(),
            'thatUserId = ?' => $currentUser->getId(),
            'motaId = ?' => $mota
        );

        $existitzen = new \Klikasi\Mapper\Sql\Jakinarazpenak();
        $existitzen = $existitzen->fetchList($where);

        if (empty($existitzen)) {
            return false;
        } else {
            return true;
        }
    }


    public function populateIkasleEskaera($erabiltzailea, $ikastegia)
    {

        //var_dump(get_class($erabiltzailea), get_class($ikastegia)); die;

    }

    public function populateIkastegiakBerria($superAdmin, $ikastegiBerria)
    {
        return;
        $this->_manualInit();
        $currentUser = $this->_currentUser;

        $this->setErabiltzaileaId($superAdmin->getId());
        $this->setIdKanpotarra($ikastegiBerria->getId());
        $this->setMotaId(10);
        $this->setEgoera($this->_egoera);
        $this->setIkusita($this->_ikusita);
        $this->setThatUserId($currentUser->getId());
        $this->setSortzeData($this->_now);
        $this->save();
/*
        $settings = $superAdmin->getErabiltzaileaSettings();
        if (sizeof($settings) > 0) {
            $setting = reset($settings);
            if ($setting->getIkastegiakBerria() === 1) {
                $this->_sendEmail(
                    $superAdmin,
                    $this->getId(),
                    $ikastegiBerria,
                    'Ikastegi Berria'
                );
            }
        }
*/
    }

    public function createIrakasleEskaera($erabiltzaileaId, $ikastegiaId)
    {
        return;
        $this->_manualInit();
        $currentUser = $this->_currentUser;

        $this->setErabiltzaileaId($erabiltzaileaId);
        $this->setIdKanpotarra($ikastegiaId);
        $this->setThatUserId($currentUser->getId());
        $this->setMotaId(17);
        $this->setEgoera($this->_egoera);
        $this->setIkusita($this->_ikusita);
        $this->setSortzeData($this->_now);
        $this->save();

    }

    public function createIkasleEskaera($erabiltzaileaId, $relIrakaslea)
    {
        return;
        $this->_manualInit();
        $currentUser = $this->_currentUser;

        $this->setErabiltzaileaId($erabiltzaileaId);
        $this->setIdKanpotarra($relIrakaslea);
        $this->setThatUserId($currentUser->getId());
        $this->setMotaId(2);
        $this->setEgoera($this->_egoera);
        $this->setIkusita($this->_ikusita);
        $this->setSortzeData($this->_now);
        $this->save();
    }


    /**
     * Crear la notificación de que hay una nueva sugerencia.
     * Comprueba si quiere resivir esta notificación por mail
     * y de ser así lo envia.
     * @param Model $edukia
     * @param Model $hobekuntzak
     */
    public function createHobekuntzak($edukia, $hobekuntzak)
    {
        return;
        $this->_manualInit();
        $erabiltzailea = $edukia->getErabiltzailea();
        $currentUser = $this->_currentUser;

        $this->setErabiltzaileaId($erabiltzailea->getId());
        $this->setIdKanpotarra($hobekuntzak->getId());
        $this->setThatUserId($currentUser->getId());
        $this->setMotaId(7);
        $this->setEgoera($this->_egoera);
        $this->setIkusita($this->_ikusita);
        $this->setSortzeData($this->_now);
        $this->save();
/*
        $settings = $erabiltzailea->getErabiltzaileaSettings();
        if (sizeof($settings) > 0) {
            $setting = reset($settings);
            if ($setting->getIradokizunBerria() === 1) {
                $this->_sendEmail(
                    $erabiltzailea,
                    $this->getId(),
                    $hobekuntzak,
                    'Iradokizun Berria'
                );
            }
        }
*/
    }

    /**
     * Crea una nueva notificación de Comentarios
     * @param Model $edukia
     * @param Int $iruzkinaId
     */
    public function createIruzkinak($edukia, $iruzkinaId)
    {
        return;
        $this->_manualInit();
        $erabiltzailea = $edukia->getErabiltzailea();
        $currentUser = $this->_currentUser;

        $this->setErabiltzaileaId($erabiltzailea->getId());
        $this->setIdKanpotarra($iruzkinaId);
        $this->setThatUserId($currentUser->getId());
        $this->setMotaId(5);
        $this->setEgoera('onartzeko');
        $this->setSortzeData($this->_now);
        $this->save();
/*
        $settings = $erabiltzailea->getErabiltzaileaSettings();
        if (sizeof($settings) > 0) {
            $setting = reset($settings);
            if ($setting->getIruzkinBerria() === 1) {
                $this->_saveForSendEmail(
                    $erabiltzailea->getId(),
                    $this->getId()
                );
            }
        }
*/
    }

    /**
     * Crea una notificación de nuevo Me Gusta.
     * Comprueba si quiere un resumen de notificaciones por mail
     * y lo guarda, para enviarlo luego.
     * @param Model $edukia
     */
    public function createAtseginDut($edukia)
    {
        return;
        $this->_manualInit();
        $erabiltzailea = $edukia->getErabiltzailea();
        $currentUser = $this->_currentUser;

        $this->setErabiltzaileaId($erabiltzailea->getId());
        $this->setIdKanpotarra($edukia->getId());
        $this->setThatUserId($currentUser->getId());
        $this->setMotaId(11);
        $this->setEgoera($this->_egoera);
        $this->setIkusita($this->_ikusita);
        $this->setSortzeData($this->_now);
        $this->save();
/*
        $settings = $erabiltzailea->getErabiltzaileaSettings();
        if (sizeof($settings) > 0) {
            $setting = reset($settings);
            if ($setting->getAtseginDut() === 1) {
                $this->_saveForSendEmail(
                    $erabiltzailea->getId(),
                    $this->getId()
                );
            }
        }
*/
    }

    /**
     * Crea una notificación de nuevo Favorito.
     * Comprueba si quiere un resumen de notificaciones por mail
     * y lo guarda, para enviarlo luego.
     * @param Model $edukia
     */
    public function createGogokoenetaraGehitu($edukia)
    {
        return;
        $this->_manualInit();
        $erabiltzailea = $edukia->getErabiltzailea();
        $currentUser = $this->_currentUser;

        $this->setErabiltzaileaId($erabiltzailea->getId());
        $this->setThatUserId($currentUser->getId());
        $this->setIdKanpotarra($edukia->getId());
        $this->setMotaId(9);
        $this->setEgoera($this->_egoera);
        $this->setIkusita($this->_ikusita);
        $this->setSortzeData($this->_now);
        $this->save();
/*
        $settings = $erabiltzailea->getErabiltzaileaSettings();
        if (sizeof($settings) > 0) {
            $setting = reset($settings);
            if ($setting->getGustokoBerria() === 1) {
                $this->_saveForSendEmail(
                    $erabiltzailea->getId(),
                    $this->getId()
                );
            }
        }
*/
    }

    /**
     * Crear la notificación de que hay un nuevo Mensaje.
     * Comprueba si quiere resivir esta notificación por mail
     * y de ser así lo envia.
     * @param Model
     * @param Model
     */
    public function createMezuBerria($erabiltzaileaId, $mezuaId)
    {
        return;
        $this->_manualInit();

        $currentUser = $this->_currentUser;

        $this->setErabiltzaileaId($erabiltzaileaId);
        $this->setIdKanpotarra($mezuaId);
        $this->setThatUserId($currentUser->getId());
        $this->setMota('mezu berria');
        $this->setEgoera($this->_egoera);
        $this->setIkusita($this->_ikusita);
        $this->setSortzeData($this->_now);
        $this->save();
/*
        $settings = $currentUser->getErabiltzaileaSettings();
        if (sizeof($settings) > 0) {
            $setting = reset($settings);
            if ($setting->getMezuBerria() === 1) {
                $this->_saveForSendEmail(
                    $erabiltzaileaId,
                    $this->getId()
                );
            }
        }
 */
    }

    public function createEdukikBerria($edukia, $erabiltzailea)
    {
        return;
        $this->setErabiltzaileaId($erabiltzailea->getId());
        $this->setIdKanpotarra($edukia->getId());
        $this->setThatUserId($edukia->getErabiltzailea()->getId());
        $this->setMotaId(4);
        $this->setEgoera($this->_egoera);
        $this->setIkusita($this->_ikusita);
        $this->setSortzeData($this->_now);
        $this->save();
/*
        $settings = $erabiltzailea->getErabiltzaileaSettings();
        if (sizeof($settings) > 0) {
            $setting = reset($settings);
            if ($setting->getEdukiBerria() === 1) {
                $this->_sendEmail(
                    $erabiltzailea,
                    $this->getId(),
                    $edukia,
                    'Edukia Berria'
                );
            }
        }
*/
    }

    public function createKolaborazioEskaera($model)
    {
        return;
        $this->_manualInit();

        $this->setErabiltzaileaId($model->getErabiltzaileaId());
        $this->setIdKanpotarra($model->getEdukiaId());
        $this->setThatUserId($this->_currentUser->getId());
        $this->setMotaId(1);
        $this->setEgoera($this->_egoera);
        $this->setIkusita($this->_ikusita);
        $this->setSortzeData($this->_now);
        $this->save();
/*
        $settings = $model->getErabiltzailea()->getErabiltzaileaSettings();

        if (sizeof($settings) > 0) {
            $setting = reset($settings);
            if ($setting->getKolaborazioEskaera() === 1) {
                $this->_sendEmail(
                    $model->getErabiltzailea(),
                    $this->getId(),
                    $model,
                    'Kolaborazio Eskaera'
                );
            }
        }
*/
    }

    /**
     * Prepara la información para enviarla por Email.
     * @param Model $erabiltzailea
     * @param Int $jakinarazpenaId
     * @param Model $model
     * @param String $type

    protected function _sendEmail(
        $erabiltzailea,
        $jakinarazpenaId,
        $model,
        $type
    )
    {

        if ($type == 'Iradokizun Berria') {
            $this->_sendAndSave(
                $type,
                $erabiltzailea
            );
        } elseif ($type == 'Edukia Berria') {
            $this->_sendAndSave(
                $type,
                $erabiltzailea
            );
        } elseif ($type == 'Kolaborazio Eskaera') {
            $this->_sendAndSave(
                $type,
                $erabiltzailea
            );
        }

    }

    /**
     * Envia direcatamente Un Email de Notificación.
     * @param unknown_type $type
     * @param unknown_type $erabiltzailea

    protected function _sendAndSave($type, $erabiltzailea)
    {

        $mail = new \Zend_Mail("UTF-8");
        $mail->setFrom(
            $this->_fromPosta,
            $this->_fromIzena
        );

        $mail->addTo(
            $erabiltzailea->getPosta(),
            $erabiltzailea->getCompletName()
        );

        $mail->setSubject('Jakinarazpen berria [' . $type . ']');

        $body = "mensaje de prueba \n\n (-(-(-.-)-)-)";

        $mail->setBodyText($body);
        $mail->send();
    }

    /**
     * Guarda la notificación en la tabla 'JakinarazpenakGroup'
     * que sera revisada por un cron, y enviara las notificaciones.
     * @param Int $erabiltzaileaId
     * @param Int $jakinarazpenaId
    protected function _saveForSendEmail($erabiltzaileaId, $jakinarazpenaId)
    {

        $newEmail = new \Klikasi\Model\JakinarazpenakGroup();
        $newEmail->setJakinarazpenakId($jakinarazpenaId);
        $newEmail->setErabiltzaileaId($erabiltzaileaId);
        $newEmail->setSortzeData($this->_now);
        $newEmail->save();

    }
 */

}
