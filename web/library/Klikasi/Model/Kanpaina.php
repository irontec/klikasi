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
class Kanpaina extends Raw\Kanpaina
{
    protected $_erabiltzailea;
    protected $_ikastegia;
    protected $_edukiaMapper;
    protected $_kategoriaMapper;
    protected $_eduaKategMapper;

    public function init()
    {
        $this->_erabiltzailea = new \Klikasi\Mapper\Sql\Erabiltzailea();
        $this->_ikastegia = new \Klikasi\Mapper\Sql\Ikastegia();
        $this->_edukiaMapper = new \Klikasi\Mapper\Sql\Edukia();
        $this->_kategoriaMapper = new \Klikasi\Mapper\Sql\Kategoria();

        $this->_eduaKategMapper = new \Klikasi\Mapper\Sql\EdukiaRelKategoria();
    }

    /**
     * Lista los 3 ultimos recursos las categorias seleccionadas
     * @return Ambigous <multitype:, mixed, multitype:unknown >
     */
    public function listEdukiakWidget()
    {
        $edukiakList = array();
        $where = array();
        
        $kategoriakIds = array();
        $kategoriakRelList = $this->getKanpainaRelEdukiKategoriak();
        if (sizeof($kategoriakRelList) > 0) {
            foreach ($kategoriakRelList as $kategoriakRel) {
                $kategoriakIds[] = $kategoriakRel->getKategoria()->getId();
            }

            if (!empty($kategoriakIds)) {
                $kategoriakIdsWhere =  'kategoriaId in (' . implode(',', $kategoriakIds) . ')';

                $edukiaRelKategoriaMapper = new \Klikasi\Mapper\Sql\EdukiaRelKategoria;
                $edukiaRelKategoria = $edukiaRelKategoriaMapper->fetchList($kategoriakIdsWhere);
                $edukiaIds = array(0);

                foreach ($edukiaRelKategoria as $item) {
                    $edukiaIds[] = $item->getEdukiaId();
                }

                $where[] = "id in (". implode(',', $edukiaIds)  .")";
            }
        } 

        if ($this->getKanpaina()) {

            $edukiaRelKanpainaMapper = new \Klikasi\Mapper\Sql\EdukiaRelKanpaina;
            $edukiaRelKanpaina = $edukiaRelKanpainaMapper->fetchList("irabazlea < 1 and kanpainaId = " . intval($this->getId()));
            $edukiaIds = array(0);

            foreach ($edukiaRelKanpaina as $item) {
                $edukiaIds[] = $item->getEdukiaId();
            }

            $where[] = "id in (". implode(',', $edukiaIds)  .")";
        }

        $order = $this->getWidgetEdukiakOrdena() == 'karma' ?  'karma desc' : 'sortzeData desc';

        $edukiakList = $this->_edukiaMapper->fetchList(
            implode(" AND ", $where),
            $order,
            3
        );

        return $edukiakList;
    }

    /**
     * Lista los 3 ultimos centros.
     * * @return Ambigous <multitype:, mixed, multitype:unknown >
     */
    public function listIkastegiakWidget()
    {
        $ikastegiakList = array();

        $limit = 3;
        $order = '';
        switch ($this->getWidgetIkastegiakOrdena())
        {
            case 'data':
                $query = "select * from (select edukiaId, ikastegiaId from EdukiaRelIkastegia where egoera = 'onartua' order by id desc) as tmp group by ikastegiaId limit " . intval($limit);
                $dbAdapter = $this->getMapper()->getDbTable()->getAdapter();

                $orderIds = array();
                $records = $dbAdapter->fetchAll($query);

                foreach ($records as $record) {
                    $orderIds[] = $record['ikastegiaId'];     
                }
                
                $order = new \Zend_Db_Expr("FIELD(id, ". implode($orderIds, ',') . ")");
                $limit = count($orderIds); 

                break;
            case 'edukiKopurua':
                $order = "edukiKopurua desc";
                break;
            case 'karma':
                $order = "karma desc";
                break;
            case 'erabiltzaileKopurua':
                $order = "ikasleKopurua desc";
                break;
        }

        $ikastegiakList = $this->_ikastegia->fetchList(
            'aktibatua = "1"',
            $order,
            $limit
        );

        return $ikastegiakList;
    }

    /**
     * Lista los 3 ultimos usuarios.
     * * @return Ambigous <multitype:, mixed, multitype:unknown >
     */
    public function listErabiltzaileaWidget()
    {
        $erabiltzaileaList = array();

        $limit = 3;
        $order = 'id DESC';
        switch ($this->getWidgetErabiltzaileakOrdena()) {

            case 'edukiKopurua':

                $query = "select id, erabiltzaileaId, count(*) as kont from Edukia where egoera='onartua' group by erabiltzaileaId order by kont desc limit " . intval($limit);
                $dbAdapter = $this->getMapper()->getDbTable()->getAdapter();

                $orderIds = array();
                $records = $dbAdapter->fetchAll($query);

                foreach ($records as $record) {
                    
                    array_unshift($orderIds, $record['erabiltzaileaId']);
                    //$orderIds[] = $record['erabiltzaileaId'];     
                }

                $order = new \Zend_Db_Expr("FIELD(id, ". implode($orderIds, ',') . ") desc");
                $limit = count($orderIds); 
                break;

            case 'karma':
                $order = 'karma DESC';
                break;
        }

        $erabiltzaileaList = $this->_erabiltzailea->fetchList(
            'egoera = "aktibatua"',
            $order,
            $limit
        );

        return $erabiltzaileaList;
    }

    /**
     * Lista las categorias seleccionadas
     */
    public function listKategoriaWidget()
    {
        $kategoriakList = array();

        if (sizeof($this->getKanpainaRelKategoria()) > 0) {
            foreach ($this->getKanpainaRelKategoria() as $kastegoriaRel) {
                $kategoriakList[] = $kastegoriaRel->getKategoria();
            }
        }

        shuffle($kategoriakList);
        return array_slice($kategoriakList, 0, 3);
    }

}