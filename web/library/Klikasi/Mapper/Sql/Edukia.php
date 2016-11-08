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
 * Data Mapper implementation for Klikasi\Model\Edukia
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class Edukia extends Raw\Edukia
{
    protected function _save(\Klikasi\Model\Raw\Edukia $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = false;
        $justApproved = false;

        if (!$model->getPrimarykey()  && $model->getEgoera() != 'onartua') {
            $isNew = true;
        } else {
            if ($model->hasChange('egoera') && $model->getEgoera() == 'onartua') {
                $justApproved = true;
            }
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);
        if ($isNew) {

            $erabiltzailea = $model->getErabiltzailea();
            $isAdmin = $erabiltzailea->getSuperErabiltzailea() === 1;
            if (!$isAdmin) {

                $moderatzaileak = $erabiltzailea->getEdukiBatenModeratzaileak($model);

                foreach ($moderatzaileak as $moderatzailea) {
                    $jakinarazpenak = new \Klikasi\Model\Jakinarazpenak();
                    $jakinarazpenak->setErabiltzaileaId($moderatzailea->getId())
                                   ->setIdKanpotarra($model->getId())
                                   ->setThatUserId($model->getErabiltzailea()->getId())
                                   ->setMotaId(4)
                                   ->setEgoera('onartzeko')
                                   ->setIkusita(0)
                                   ->save();
                }
            }

        } else if ($justApproved) {

            $relIkastegia = $model->getEdukiaRelIkastegia();
            foreach ($relIkastegia as $rel) {

                $rel->setEgoera("onartua")
                    ->save();
            }
        }

        return $response;
    }

    
    /**
     * Deletes the current model
     *
     * @param Klikasi\Model\Raw\Edukia $model The model to delete
     * @see Klikasi\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\Klikasi\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);

        $jakinarazpenakMapper = new \Klikasi\Mapper\Sql\Jakinarazpenak();
        $jakinarazpenak = $jakinarazpenakMapper->fetchList("idKanpotarra = " . $model->getId() . " AND (motaId = 4 OR motaId = 1)");

        foreach ($jakinarazpenak as $jakinarazpena) {
            $jakinarazpena->delete();
        }

        return $response;        
    } 

    public function fetchEdukiaIdByIdKategoria($idKategoria)
    {
        $filterByIds = array(0);
        if (is_numeric($idKategoria)) {

            $mapperEdukiaRelKategoria = new \Klikasi\Mapper\Sql\EdukiaRelKategoria;
            $related = $mapperEdukiaRelKategoria->fetchList("kategoriaId = " . $idKategoria);

            foreach ($related as $record) {
                $filterByIds[] = $record->getEdukiaId();
            }
        }

        return $filterByIds;
    }

    public function fetchEdukiaIdByIdIkastegia($idIkastegia)
    {
        $filterByIds = array(0);
        if (is_numeric($idIkastegia)) {

            $mapperEdukiaRelKategoria = new \Klikasi\Mapper\Sql\EdukiaRelIkastegia;
            $related = $mapperEdukiaRelKategoria->fetchList("egoera = 'onartua' and ikastegiaId = " . $idIkastegia);

            foreach ($related as $record) {
                $filterByIds[] = $record->getEdukiaId();
            }
        }

        return $filterByIds;
    }

    public function fetchOrderByIruzkinakNumber($limit = null, $offset = null, $idKategoria = null, $idIkastegia = null)
    {
        $dbResultSet = $this->_prepareOrderByIruzkinakNumber($limit, $offset, $idKategoria, $idIkastegia);
        $resultSet = array();
        foreach ($dbResultSet as $record) {

            $model = new \Klikasi\Model\Edukia;
            $model->setFromArray($record);
            $resultSet[] = $model;
        }

        return $resultSet;
    }

    public function countByKategoria($idKategoria)
    {
        $where = 'egoera = "onartua"';
        $filterByIds = $this->fetchEdukiaIdByIdKategoria($idKategoria);
        if (!empty($filterByIds)) {
            $where .= ' and Edukia.id in ('. implode(',', $filterByIds) .') ';
        }

        return $this->countByQuery(
            $where
        );
    }

    public function countByIkastegia($idIkastegia)
    {
        $where = 'egoera = "onartua"';
        $filterByIds = $this->fetchEdukiaIdByIdIkastegia($idIkastegia);
        if (!empty($filterByIds)) {
            $where .= ' and Edukia.id in ('. implode(',', $filterByIds) .') ';
        }

        return $this->countByQuery(
            $where
        );
    }


    public function _prepareOrderByIruzkinakNumber($limit = null, $offset = null, $idKategoria = null, $idIkastegia = null)
    {
        $filterByIds = array();
        if (is_numeric($idKategoria)) {
            $filterByIds = $this->fetchEdukiaIdByIdKategoria($idKategoria);
        } else if (is_numeric($idIkastegia)) {
            $filterByIds = $this->fetchEdukiaIdByIdIkastegia($idIkastegia);
        }

        $dbAdapter = $this->getDbTable()->getAdapter();

        $sql = 'select Edukia.*, sum(Iruzkina.id is not null) as iruzkinak from Edukia left join Iruzkina on Edukia.id = Iruzkina.edukiaId ';
        
        $where = array('Edukia.egoera = "onartua"');
        if (!empty($filterByIds)) {
            $where[] = "Edukia.id in (". implode(",", $filterByIds) .")";
        }

        $searchFilter = $this->getSearchBoxFilteredIds();
        if (!empty($searchFilter)) {
           $where[] = 'Edukia.id in (select id from Edukia where '. implode(' AND ', $searchFilter) .') ';
        }

        $sql .= ' where  ('. implode(' AND ', $where) .') ';
        $sql .= ' group by id order by iruzkinak desc';

        $sql = $dbAdapter->limit($sql, $limit, $offset);

        return $dbAdapter->fetchAll($sql);
    }

    public function searchEdukia($order = 'izena asc', $limit = null, $offset = null)
    {
        $where = $this->getSearchBoxFilteredIds();
        if (!empty($filterByIds)) {
           $where[] = 'Edukia.id in ('. implode(',', $filterByIds) .') ';
        }
        $where[] = 'Edukia.egoera = "onartua"';

        $dbResultSet = $this->fetchList(implode(' AND ', $where), $order, $limit, $offset);

        $resultSet = array();
        foreach ($dbResultSet as $record) {

            $model = new \Klikasi\Model\Edukia;
            $model->setFromArray($record);
            $resultSet[] = $model;
        }

        return $resultSet;
    }

    /**
     * @return array
     */
    public function getSearchBoxFilteredIds()
    {
        $request = \Zend_Controller_Front::getInstance()->getRequest();

        $edukiaMapper = new Edukia;
        $dbAdapter = $edukiaMapper->getDbTable()->getAdapter();

        $relatedWhere = array();

        if (is_array($request->getParam("searchkategoria")) && !empty($request->getParam("searchkategoria"))) {

            //searchkategoria => EdukiaRelKategoria
            $relatedWhere[] = "select edukiaId as id from EdukiaRelKategoria where kategoriaId in (" .
                              implode(',', $request->getParam("searchkategoria")) . ")";
        }

        if ($request->getParam("searchikastegia")) {
            //searchikastegia => EdukiaRelIkastegia
            $relatedWhere[] = "select edukiaId as id from EdukiaRelIkastegia where ikastegiaId = " .
                              intval($request->getParam("searchikastegia")) . " AND egoera='onartua'";
        }

        if ($request->getParam("searchikasturtea")) {
            //searchikasturtea => EdukiaRelMaila
            $relatedWhere[] = "select edukiaId as id from EdukiaRelMaila where mailaId = " .
                              intval($request->getParam("searchikasturtea"));
        }

        if ($request->getParam("searchfitxategia")) {
            //searchikasturtea => EdukiaRelMaila
            $relatedWhere[] = "select distinct edukiaId as id from " .
                              $request->getParam("searchfitxategia");
        }

        $whereStr = null;
        $mustFilterById = false;
        $edukiaIdFilter = array();

        if (!empty($relatedWhere)) {

            $mustFilterById = true;
            if (false && count($relatedWhere) < 2) {

                $whereStr = current($relatedWhere);

            } else {

                $whereStr = 'select t1.id/*, count(*) as kont*/ from (' .
                            implode(" union all ", $relatedWhere) .
                            ') as t1 group by id having count(*) > ' . (count($relatedWhere)-1);
            }

            $dbRecords = $dbAdapter->fetchAll($whereStr);
            foreach ($dbRecords as $dbRecord) {
                $edukiaIdFilter[] = $dbRecord["id"];
            }
        }

        $where = array();
        if ($mustFilterById) {

            if (empty($edukiaIdFilter)) {
                return array("false");
            }

            $where[] = " Edukia.id in (". implode(',', $edukiaIdFilter) .")";
        }

        if ($request->getParam("searchvalue")) {
            $textSearch = $request->getParam("searchvalue");
            $where[] = "(titulua like '%$textSearch%' OR deskribapenLaburra like '%$textSearch%' OR deskribapena like '%$textSearch%')";
        }

        if ($request->getParam("searchdatefrom")) {
            $where[] = "sortzeData >= '". $request->getParam("searchdatefrom") ."'";
        }

        if ($request->getParam("searchdateto")) {
            $where[] = "sortzeData <= '". $request->getParam("searchdateto") ." 23:59:59'";
        }

        if ($request->getParam("searchadina")) {

            $adina = $request->getParam("searchadina");
            list($adinaFrom, $adinaTo) = explode(",", $adina);

            if (is_numeric($adinaFrom) && is_numeric($adinaTo)) {
                $where[] = "urteakNoiztik >= " . $adinaFrom;
                $where[] = "urteakNoizarte <= " . $adinaTo;
            }
        }

        return $where;
    }

    public function fetchListToTemplateListArray(
        $size = 'list',
        $where = null, $order = null,
        $limit = null, $offset = null
    )
    {

        $edukiak = array();
        $edukiakList = $this->fetchList($where, $order, $limit, $offset);

        foreach ($edukiakList as $edukia) {
            $edukiak[] = $edukia->toTemplateListArray($size);
        }

        return $edukiak;
    }

    public function createEdukiaRelAssets(array $post, \Klikasi\Model\Edukia $edukia)
    {
        $edukiaId = $edukia->getPrimarykey();
        if (!$edukiaId) {
            return;
        }

        $videos = array();
        $presentations = array();
        $images = array();
        $files = array();
        $links = array();

        foreach ($post as $key => $values) {

            $table = null;
            $type = null;

            if (strpos($key, '_')) {
                list($table, $type) = explode("_", $key);
            }

            if (!in_array($table, array('bideoa', 'aurkezpena', 'irudia', 'fitxategia', 'esteka'))) {
                continue;
            }

            if ($table == 'bideoa') {
                $videos[$type] = $values;
            }

            if ($table == 'aurkezpena') {
                $presentations[$type] = $values;
            }

            if ($table == 'irudia') {
                $images[$type] = $values;
            }

            if ($table == 'fitxategia') {
                $files[$type] = $values;
            }

            if ($table == 'esteka') {
                $links[$type] = $values;
            }
        }

        //print_r($links); die;

        $this->_createEdukiaRelBideo($videos, $edukia);
        $this->_createEdukiaRelAurkezpena($presentations, $edukia);
        $this->_createEdukiaRelIrudiak($images, $edukia);
        $this->_createEdukiaRelFitxategiak($files, $edukia);
        $this->_createEdukiaRelEstekak($links, $edukia);
    }

    protected function _createEdukiaRelBideo(array $receivedVideos, \Klikasi\Model\Edukia $edukia)
    {
        $edukiaRelBideoak = $edukia->getBideoa();
        $urls = array();

        foreach ($edukiaRelBideoak as $bideoa) {
            $urls[$bideoa->getId()] = $bideoa->getUrl();
        }

        foreach ($receivedVideos as $type => $bideoak) {
            foreach ($bideoak as $asset) {

                $newBideo = new \Klikasi\Model\Bideoa;
                $newBideo->setEdukiaId($edukia->getId())
                         ->setUrl($asset)
                         ->setMota($type);

                if (!in_array($newBideo->getUrl(), $urls)) {
                    $newBideo->save();
                } else {
                    $vkey = array_search($newBideo->getUrl(), $urls);
                    if($vkey !== false) {
                        unset($urls[$vkey]);
                    }
                }
            }
        }

        foreach ($edukiaRelBideoak as $potencialOrphanBideo) {
             if (in_array($potencialOrphanBideo->getUrl(), $urls)) {
                $potencialOrphanBideo->delete();
            }
        }
    }

    protected function _createEdukiaRelAurkezpena(array $presentations, \Klikasi\Model\Edukia $edukia)
    {
        $edukiaRelAurkezpena = $edukia->getAurkezpena();
        $urls = array();

        foreach ($edukiaRelAurkezpena as $aurkezpena) {
            $urls[$aurkezpena->getId()] = $aurkezpena->getUrl();
        }

        foreach ($presentations as $type => $aurkezpenak) {
            foreach ($aurkezpenak as $asset) {

                $newAurkezpena = new \Klikasi\Model\Aurkezpena();
                $newAurkezpena->setEdukiaId($edukia->getId())
                              ->setUrl($asset)
                              ->setMota($type);

                if (!in_array($newAurkezpena->getUrl(), $urls)) {
                    $newAurkezpena->save();
                } else {
                    $vkey = array_search($newAurkezpena->getUrl(), $urls);
                    if($vkey !== false) {
                        unset($urls[$vkey]);
                    }
                }
            }
        }

        foreach ($edukiaRelAurkezpena as $potencialOrphanBideo) {
             if (in_array($potencialOrphanBideo->getUrl(), $urls)) {
                $potencialOrphanBideo->delete();
            }
        }
    }


    protected function _createEdukiaRelIrudiak (array $images, \Klikasi\Model\Edukia $edukia)
    {
        $edukiaRelIrudia = $edukia->getIrudia();
        $urls = array();

        foreach ($edukiaRelIrudia as $irudia) {
            $urls[$irudia->getId()] = $irudia->getUrl();
        }

        foreach ($images as $type => $irudiak) {
            foreach ($irudiak as $asset) {

                $newIrudia = new \Klikasi\Model\Irudia();
                $newIrudia->setEdukiaId($edukia->getId())
                          ->setUrl($asset)
                          ->setMota($type);

                if (!in_array($newIrudia->getUrl(), $urls)) {
                    $newIrudia->save();
                } else {
                    $vkey = array_search($newIrudia->getUrl(), $urls);
                    if($vkey !== false) {
                        unset($urls[$vkey]);
                    }
                }
            }
        }

        foreach ($edukiaRelIrudia as $potencialOrphan) {
             if (in_array($potencialOrphan->getUrl(), $urls)) {
                $potencialOrphan->delete();
            }
        }
    }


    protected function _createEdukiaRelFitxategiak (array $files, \Klikasi\Model\Edukia $edukia)
    {
        $edukiaRelFitxategia = $edukia->getFitxategia();
        $urls = array();

        foreach ($edukiaRelFitxategia as $fitxategia) {
            $urls[$fitxategia->getId()] = $fitxategia->getUrl();
        }

        foreach ($files as $type => $fitxategiak) {
            foreach ($fitxategiak as $asset) {

                $newFitxategia = new \Klikasi\Model\Fitxategia();
                $newFitxategia->setEdukiaId($edukia->getId())
                              ->setUrl($asset)
                              ->setMota($type);

                if (!in_array($newFitxategia->getUrl(), $urls)) {
                    $newFitxategia->save();
                } else {
                    $vkey = array_search($newFitxategia->getUrl(), $urls);
                    if($vkey !== false) {
                        unset($urls[$vkey]);
                    }
                }
            }
        }

        foreach ($edukiaRelFitxategia as $potencialOrphan) {
             if (in_array($potencialOrphan->getUrl(), $urls)) {
                $potencialOrphan->delete();
            }
        }
    }

    protected function _createEdukiaRelEstekak(array $links, \Klikasi\Model\Edukia $edukia)
    {
        $edukiaRelEsteka = $edukia->getEsteka();
        $urls = array();

        foreach ($edukiaRelEsteka as $esteka) {
            $urls[$esteka->getId()] = $esteka->getUrl();
        }

        foreach ($links as $type => $estekak) {
            foreach ($estekak as $asset) {

                $newEsteka = new \Klikasi\Model\Esteka();
                $newEsteka->setEdukiaId($edukia->getId())
                          ->setUrl($asset)
                          ->setMota($type);

                if (!in_array($newEsteka->getUrl(), $urls)) {
                    $newEsteka->save();
                } else {
                    $vkey = array_search($newEsteka->getUrl(), $urls);
                    if($vkey !== false) {
                        unset($urls[$vkey]);
                    }
                }
            }
        }

        foreach ($edukiaRelEsteka as $potencialOrphan) {
             if (in_array($potencialOrphan->getUrl(), $urls)) {
                $potencialOrphan->delete();
            }
        }
    }
}