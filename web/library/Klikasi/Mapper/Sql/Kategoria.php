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
 * Data Mapper implementation for Klikasi\Model\Kategoria
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class Kategoria extends Raw\Kategoria
{
    public function fetchOrderByEdukiakNumber($limit = null, $offset = null)
    {
        $dbAdapter = $this->getDbTable()->getAdapter();
        $sql = 'select id,izena,url,karma,sum(kont) as sumKont from ( select Kategoria.*, count(EdukiaRelKategoria.id) as kont from Kategoria left outer join EdukiaRelKategoria on EdukiaRelKategoria.kategoriaId = Kategoria.id left outer join Edukia on EdukiaRelKategoria.edukiaId = Edukia.id where (egoera is null or egoera = "onartua") group by EdukiaRelKategoria.edukiaId, Kategoria.id ) as tmp group by id order by sumKont desc, izena';
        $sql = $dbAdapter->limit($sql, $limit, $offset);

        $dbResultSet = $dbAdapter->fetchAll($sql);

        $resultSet = array();
        foreach ($dbResultSet as $record) {

            $model = new \Klikasi\Model\Kategoria;
            $model->setFromArray($record);
            $resultSet[] = $model;
        }

        return $resultSet;
    }

    public function fetchOrderByBisitak($limit = null, $offset = null)
    {
        $dbAdapter = $this->getDbTable()->getAdapter();
        $sql = 'select Kategoria.*, sum(bisitaKopurua) as kontBisita from Kategoria left join EdukiaRelKategoria on EdukiaRelKategoria.kategoriaId = Kategoria.id left join Edukia on Edukia.id = EdukiaRelKategoria.edukiaId group by Kategoria.id order by kontBisita desc';
        $sql = $dbAdapter->limit($sql, $limit, $offset);
        $dbResultSet = $dbAdapter->fetchAll($sql);

        $resultSet = array();
        foreach ($dbResultSet as $record) {

            $model = new \Klikasi\Model\Kategoria;
            $model->setFromArray($record);
            $resultSet[] = $model;
        }

        return $resultSet;
    }

    public function fetchOrderByUpdate($limit = null, $offset = null)
    {
        $dbAdapter = $this->getDbTable()->getAdapter();
        $sql = 'select id, izena, url, karma, sortzeData from (select * from (select Kategoria.id, Kategoria.izena, Kategoria.url, Kategoria.karma, EdukiaRelKategoria.kategoriaId, Edukia.titulua, Edukia.bisitaKopurua, Edukia.sortzeData from Kategoria left join EdukiaRelKategoria on EdukiaRelKategoria.kategoriaId = Kategoria.id left join Edukia on Edukia.id = EdukiaRelKategoria.edukiaId) as tmp order by sortzeData desc) as tmp2 group by id order by sortzeData desc';
        $sql = $dbAdapter->limit($sql, $limit, $offset);
        $dbResultSet = $dbAdapter->fetchAll($sql);

        $resultSet = array();
        foreach ($dbResultSet as $record) {

            $model = new \Klikasi\Model\Kategoria;
            $model->setFromArray($record);
            $resultSet[] = $model;
        }

        return $resultSet;
    }
}
