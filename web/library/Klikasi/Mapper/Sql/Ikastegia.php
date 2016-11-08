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
 * Data Mapper implementation for Klikasi\Model\Ikastegia
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class Ikastegia extends Raw\Ikastegia
{
    protected function _save(\Klikasi\Model\Raw\Ikastegia $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = false;
        if (!$model->getPrimarykey()) {
            $isNew = true;
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);

        if ($isNew && $model->getAktibatua() == 0) {

            $senderId = 1;
            $sender = $model->getErabiltzaileaRelIkastegia('egoera = "onartzeko"', null, false);

            if (!empty($sender)) {
                $erabiltzailea = $sender[0]->getErabiltzailea();
                if ($erabiltzailea) {
                    $senderId = $erabiltzailea->getId();
                }
            }

            $superErabiltzaileakMapper = new \Klikasi\Mapper\Sql\Erabiltzailea;
            $superErabiltzaileak = $superErabiltzaileakMapper->fetchList("superErabiltzailea = 1");

            foreach ($superErabiltzaileak as $superErabiltzailea) {

                $jakinarazpenak = new \Klikasi\Model\Jakinarazpenak();
                $jakinarazpenak->setErabiltzaileaId($superErabiltzailea->getId())
                               ->setIdKanpotarra($model->getId())
                               ->setThatUserId($senderId)
                               ->setMotaId(10)
                               ->setEgoera('onartzeko')
                               ->setIkusita(0)
                               //->setSortzeData(new \Zend_Date()->toString('yyyy-MM-dd HH:mm:ss'))
                               ->save();
            }
        }

        return $response;
    }



    public function getUsedCatIdList()
    {
        $adapter = $this->getAdapter();
        $zutabea = "ikastegiMotaId";
        $sql = "SELECT DISTINCT($zutabea) FROM IkastegiaRelMota"
                . " INNER JOIN Ikastegia ON Ikastegia.id = IkastegiaRelMota.ikastegiaId"
                . " WHERE aktibatua = '1'";
        if ( $kategoriaSet = $adapter->fetchAll($sql) ) {
            $kategoriaIdZerrenda = array();
            foreach ($kategoriaSet as $kategoriLerroa) {
                $kategoriaIdZerrenda[] = $kategoriLerroa[$zutabea];
            }
            return $kategoriaIdZerrenda;
        }
        return false;
    }

    public function getExistingProvinceList()
    {
        $adapter = $this->getAdapter();
        $zutabea = "probintzia";
        $sql = "SELECT DISTINCT($zutabea) FROM Ikastegia";
        if ( $probintziaSet = $adapter->fetchAll($sql) ) {
            $probintziaZerrenda = array();
            foreach ($probintziaSet as $probintzia) {
                $probintziaZerrenda[] = $probintzia[$zutabea];
            }
            return $probintziaZerrenda;
        }
        return false;
    }

    public function getExistingTownsList($probintzia = false)
    {
        $adapter = $this->getAdapter();
        $zutabea = "herria";
        $sql = "SELECT DISTINCT($zutabea) FROM Ikastegia";
        if ($probintzia) {
            $sql .= " WHERE probintzia ='$probintzia'";
        }
        if ( $herriSet = $adapter->fetchAll($sql) ) {
            $herriZerrenda = array();
            foreach ($herriSet as $herria) {
                $herriZerrenda[] = $herria[$zutabea];
            }
            return $herriZerrenda;
        }
        return false;
    }

    public function getIkastegikoIrakasleak($id)
    {
        $adapter = $this->getAdapter();
        $sql = "SELECT Erabiltzailea.id as id FROM Erabiltzailea"
                . " LEFT JOIN ErabiltzaileaRelIkastegia ON ErabiltzaileaRelIkastegia.erabiltzaileaId = Erabiltzailea.id"
                . " LEFT JOIN Ikastegia ON Ikastegia.id = ErabiltzaileaRelIkastegia.ikastegiaId"
                . " WHERE Ikastegia.id =  '$id'"
                . " AND ErabiltzaileaRelIkastegia.egoera = 'onartua'";
        if ( $irakasleakSet = $adapter->fetchAll($sql) ) {
            $irakasleIdak = array();
            foreach ($irakasleakSet as $irakasle) {
                $irakasleIdak[] = $irakasle['id'];
            }
            $irakasleMapper = new \Klikasi\Mapper\Sql\Erabiltzailea();
            return $irakasleMapper->fetchListToArray('id IN (' . implode(',', array_values($irakasleIdak)) .')');
        }
        return false;
    }

    public function fetchAllByType($katUrl)
    {

        $zutabea = "ikastegiaId";

        $adapter = $this->getAdapter();
        $ikastegiMotaMapper = new \Klikasi\Mapper\Sql\IkastegiMota();

        $mota = $ikastegiMotaMapper->fetchOne("url = '".$katUrl."'");
        $sql = "SELECT DISTINCT($zutabea) FROM IkastegiaRelMota WHERE ikastegiMotaId = '"
            . $mota->getId()."'";

        if ($ikastxeIdSet = $adapter->fetchAll($sql)) {

            $ikastxeIdZerrenda = array();

            foreach ($ikastxeIdSet as $ikastegiId) {
                $ikastxeIdZerrenda[] = $ikastegiId[$zutabea];
            }

            return $this->fetchList(
                "id IN (".implode(',', array_values($ikastxeIdZerrenda)).") AND aktibatua = '1'"
            );
        }

        return false;
    }

    public function fetchListToTemplateListArray(
        $where = null, $order = null,
        $limit = null, $offset = null
    )
    {
        $ikastegiak = array();
        $ikastegiakList = $this->fetchList($where, $order, $limit, $offset);

        foreach ($ikastegiakList as $ikastegi) {
            $ikastegiak[] = $ikastegi->toTemplateListArray();
        }

        return $ikastegiak;
    }

}