<?php

/**
 * Application Model Mapper
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for Klikasi\Model\Erabiltzailea
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;

use Klikasi\Model\ErabiltzaileaRelIkastegia as ErabiltzaileaRelIkastegiaModel;
use Klikasi\Model\ErabiltzaileaRelIrakaslea as ErabiltzaileaRelIrakasleaModel;

class Erabiltzailea extends Raw\Erabiltzailea
{

    public function altaBerria($data)
    {
        $orain = \Zend_Date::now("eu_ES");
        $orain->addHour("1");

        $erabiltzaileBerria = new \Klikasi\Model\Erabiltzailea();

        $erabiltzaileBerria
            ->setErabiltzaileIzena($data["erabiltzailea"])
            ->setPosta($data["posta"])
            ->setJaiotzeData($data["jaiotzeData"])
            ->setPasahitza($this->cryptValue($data["pasahitza"]))
            ->setProfila('ikasle')
            ->setEgoera("sortua")
            ->setHash(md5(uniqid(rand(), true)))
            ->setHashIraungiData($orain->toString("yyy-MM-dd H:m:s"))
            ->save();

        return $erabiltzaileBerria;

    }

    public function checkErabiltzaileaLibre($erabiltzaileIzena)
    {

        $erabiltzailea = $this->findOneByField(
            'erabiltzaileIzena',
            $erabiltzaileIzena
        );

        if ($erabiltzailea) {
            return false;
        }

        return true;

    }

    public function checkPostaLibre($posta)
    {

        $erabiltzailea = $this->findOneByField("posta", $posta);

        if ($erabiltzailea) {
            return false;
        }

        return true;

    }

    protected function _salt()
    {

        $salt = '';
        $letters = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        for ($i = 0; $i < 22; $i++) {
            $salt .= substr($letters, mt_rand(0, 63), 1);
        }

        return $salt;

    }

    public function cryptValue($password)
    {

        $strength = "08";
        $salt = $this->_salt();
        $ret = crypt($password, "$2a$" . $strength . "$" . $salt . "$");

        return $ret;

    }

    public function populateIzenaEmainIru($erabiltzaileaModel, $datuak)
    {

        $erabiltzaileaModel->setProfila($datuak["profila"]);
        $erabiltzaileaModel->save();

        $relIkastegia = new ErabiltzaileaRelIkastegiaModel();
        $relIrakaslea = new ErabiltzaileaRelIrakasleaModel();

        if (isset($datuak["ikastegiak"]) && is_numeric($datuak["ikastegiak"])) {

            $relIkastegia->setErabiltzaileaId($erabiltzaileaModel->getId());
            $relIkastegia->setIkastegiaId($datuak["ikastegiak"]);
            $relIkastegia->setAdministratzailea(0);
            $relIkastegia->setJabea(0);
            $relIkastegia->setEgoera("onartzeko");
            $relIkastegia->save();
        }

        if (isset($datuak["irakasle"]) && is_numeric($datuak["irakasle"])) {

            $relIrakaslea->setErabiltzaileaId($erabiltzaileaModel->getId());
            $relIrakaslea->setIrakasleaId($datuak["irakasle"]);
            $relIrakaslea->setEgoera("onartzeko");
            $relIrakaslea->save();
        }

    }

    public function superErabiltzailea()
    {

        $where = array();
        $where['superErabiltzailea = ?'] = 1;
        $where['egoera = ?'] = 'aktibatua';

        return $this->fetchList($where);

    }

}