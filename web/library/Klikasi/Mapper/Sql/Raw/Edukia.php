<?php

/**
 * Application Model Mapper
 *
 * @package Klikasi\Mapper\Sql
 * @subpackage Raw
 * @author Irontec
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for Klikasi\Model\Edukia
 *
 * @package Klikasi\Mapper\Sql
 * @subpackage Raw
 * @author Irontec
 */

namespace Klikasi\Mapper\Sql\Raw;
class Edukia extends MapperAbstract
{
    protected $_modelName = 'Klikasi\\Model\\Edukia';


    protected $_urlIdentifiers = array(
        'url' => 'titulua',
    );

    /**
     * Returns an array, keys are the field names.
     *
     * @param Klikasi\Model\Raw\Edukia $model
     * @return array
     */
    public function toArray($model, $fields = array())
    {

        if (!$model instanceof \Klikasi\Model\Raw\Edukia) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \Klikasi\Model\Raw\Edukia object in toArray for " . get_class($this);
            } else {
                $message = "$model is not a \\Klikasi\Model\\Edukia object in toArray for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to create array: invalid model passed to mapper', 2000);
        }

        if (empty($fields)) {
            $result = array(
                'id' => $model->getId(),
                'erabiltzaileaId' => $model->getErabiltzaileaId(),
                'titulua' => $model->getTitulua(),
                'deskribapenLaburra' => $model->getDeskribapenLaburra(),
                'deskribapena' => $model->getDeskribapena(),
                'bisitaKopurua' => $model->getBisitaKopurua(),
                'urteakNoiztik' => $model->getUrteakNoiztik(),
                'urteakNoizarte' => $model->getUrteakNoizarte(),
                'egoera' => $model->getEgoera(),
                'url' => $model->getUrl(),
                'sortzeData' => $model->getSortzeData(),
                'karma' => $model->getKarma(),
            );
        } else {
            $result = array();
            foreach ($fields as $fieldData) {
                $trimField = trim($fieldData);
                if (!empty($trimField)) {
                    if (strpos($trimField, ":") !== false) {
                        list($field,$params) = explode(":", $trimField, 2);
                    } else {
                        $field = $trimField;
                        $params = null;
                    }
                    $get = 'get' . ucfirst($field);
                    $value = $model->$get($params);

                    if (is_array($value) || is_object($value)) {
                        if (is_array($value) || $value instanceof Traversable) {
                            foreach ($value as $key => $item) {
                                if ($item instanceof \Klikasi\Model\Raw\ModelAbstract) {
                                    $value[$key] = $item->toArray();
                                }
                            }
                        } else if ($value instanceof \Klikasi\Model\Raw\ModelAbstract) {
                            $value = $value->toArray();
                        }
                    }
                    $result[lcfirst($field)] = $value;
                }
            }
        }

        return $result;

    }

    /**
     * Returns the DbTable class associated with this mapper
     *
     * @return Klikasi\\Mapper\\Sql\\DbTable\\Edukia
     */
    public function getDbTable()
    {
        if (is_null($this->_dbTable)) {
            $this->setDbTable('Klikasi\\Mapper\\Sql\\DbTable\\Edukia');
        }

        return $this->_dbTable;
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
        if (!$model instanceof \Klikasi\Model\Raw\Edukia) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \\Klikasi\\Model\\Edukia object in delete for " . get_class($this);
            } else {
                $message = "$model is not a \\Klikasi\\Model\\Edukia object in delete for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to delete: invalid model passed to mapper', 2000);
        }

        $useTransaction = true;

        $dbTable = $this->getDbTable();
        $dbAdapter = $dbTable->getAdapter();

        try {

            $dbAdapter->beginTransaction();

        } catch (\Exception $e) {

            //Transaction already started
            $useTransaction = false;
        }

        try {

            //onDeleteCascades emulation
            if ($this->_simulateReferencialActions && count($deleteCascade = $model->getOnDeleteCascadeRelationships()) > 0) {

                $depList = $model->getDependentList();

                foreach ($deleteCascade as $fk) {

                    $capitalizedFk = '';
                    foreach (explode("_", $fk) as $part) {

                        $capitalizedFk .= ucfirst($part);
                    }

                    if (!isset($depList[$capitalizedFk])) {

                        continue;

                    } else {

                        $relDbAdapName = 'Klikasi\\Mapper\\Sql\\DbTable\\' . $depList[$capitalizedFk]["table_name"];
                        $depMapperName = 'Klikasi\\Mapper\\Sql\\' . $depList[$capitalizedFk]["table_name"];
                        $depModelName = 'Klikasi\\Model\\' . $depList[$capitalizedFk]["table_name"];

                        if ( class_exists($relDbAdapName) && class_exists($depModelName) ) {

                            $relDbAdapter = new $relDbAdapName;
                            $references = $relDbAdapter->getReference('Klikasi\\Mapper\\Sql\\DbTable\\Edukia', $capitalizedFk);

                            $targetColumn = array_shift($references["columns"]);
                            $where = $relDbAdapter->getAdapter()->quoteInto($targetColumn . ' = ?', $model->getPrimaryKey());

                            $depMapper = new $depMapperName;
                            $depObjects = $depMapper->fetchList($where);

                            if (count($depObjects) === 0) {

                                continue;
                            }

                            foreach ($depObjects as $item) {

                                $item->delete();
                            }
                        }
                    }
                }
            }

            //onDeleteSetNull emulation
            if ($this->_simulateReferencialActions && count($deleteSetNull = $model->getOnDeleteSetNullRelationships()) > 0) {

                $depList = $model->getDependentList();

                foreach ($deleteSetNull as $fk) {

                    $capitalizedFk = '';
                    foreach (explode("_", $fk) as $part) {

                        $capitalizedFk .= ucfirst($part);
                    }

                    if (!isset($depList[$capitalizedFk])) {

                        continue;

                    } else {

                        $relDbAdapName = 'Klikasi\\Mapper\\Sql\\DbTable\\' . $depList[$capitalizedFk]["table_name"];
                        $depMapperName = 'Klikasi\\Mapper\\Sql\\' . $depList[$capitalizedFk]["table_name"];
                        $depModelName = 'Klikasi\\Model\\' . $depList[$capitalizedFk]["table_name"];

                        if ( class_exists($relDbAdapName) && class_exists($depModelName) ) {

                            $relDbAdapter = new $relDbAdapName;
                            $references = $relDbAdapter->getReference('Klikasi\\Mapper\\Sql\\DbTable\\Edukia', $capitalizedFk);

                            $targetColumn = array_shift($references["columns"]);
                            $where = $relDbAdapter->getAdapter()->quoteInto($targetColumn . ' = ?', $model->getPrimaryKey());

                            $depMapper = new $depMapperName;
                            $depObjects = $depMapper->fetchList($where);

                            if (count($depObjects) === 0) {

                                continue;
                            }

                            foreach ($depObjects as $item) {

                                $setterName = 'set' . ucfirst($targetColumn);
                                $item->$setterName(null);
                                $item->save();
                            } //end foreach

                        } //end if
                    } //end else

                }//end foreach ($deleteSetNull as $fk)
            } //end if

            $where = $dbAdapter->quoteInto($dbAdapter->quoteIdentifier('id') . ' = ?', $model->getId());
            $result = $dbTable->delete($where);

            if ($this->_cache) {

                $this->_cache->remove(get_class($model) . "_" . $model->getPrimarykey());
            }

            $fileObjects = array();
            $availableObjects = $model->getFileObjects();

            foreach ($availableObjects as $fso) {

                $removeMethod = 'remove' . $fso;
                $model->$removeMethod();
            }


            if ($useTransaction) {
                $dbAdapter->commit();
            }
        } catch (\Exception $exception) {

            $message = 'Exception encountered while attempting to delete ' . get_class($this);
            if (!empty($where)) {
                $message .= ' Where: ';
                $message .= $where;
            } else {
                $message .= ' with an empty where';
            }

            $message .= ' Exception: ' . $exception->getMessage();
            $this->_logger->log($message, \Zend_Log::ERR);
            $this->_logger->log($exception->getTraceAsString(), \Zend_Log::DEBUG);

            if ($useTransaction) {

                $dbAdapter->rollback();
            }

            throw $exception;
        }

        $this->_etagChange();
        return $result;

    }

    /**
     * Saves current row
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    public function save(\Klikasi\Model\Raw\Edukia $model, $forceInsert = false)
    {
        return $this->_save($model, false, false, null, $forceInsert);
    }

    /**
     * Saves current and all dependent rows
     *
     * @param \Klikasi\Model\Raw\Edukia $model
     * @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    public function saveRecursive(\Klikasi\Model\Raw\Edukia $model, $useTransaction = true,
            $transactionTag = null, $forceInsert = false)
    {
        return $this->_save($model, true, $useTransaction, $transactionTag, $forceInsert);
    }

    protected function _save(\Klikasi\Model\Raw\Edukia $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $this->_setCleanUrlIdentifiers($model);

        $fileObjects = array();

        $availableObjects = $model->getFileObjects();

        foreach ($availableObjects as $item) {

            $objectMethod = 'fetch' . $item;
            $fso = $model->$objectMethod(false);
            $specMethod = 'get' . $item . 'Specs';
            $fileSpects = $model->$specMethod();

            $fileSizeSetter = 'set' . $fileSpects['sizeName'];
            $baseNameSetter = 'set' . $fileSpects['baseNameName'];
            $mimeTypeSetter = 'set' . $fileSpects['mimeName'];

            if (!is_null($fso) && $fso->mustFlush()) {

                $fileObjects[$item] = $fso;

                $model->$fileSizeSetter($fso->getSize())
                      ->$baseNameSetter($fso->getBaseName())
                      ->$mimeTypeSetter($fso->getMimeType());
            }

            if (is_null($fso)) {
                $model->$fileSizeSetter(null)
                ->$baseNameSetter(null)
                ->$mimeTypeSetter(null);
            }
        }

        $data = $model->sanitize()->toArray();

        $primaryKey = $model->getId();
        $success = true;

        if ($useTransaction) {

            try {

                if ($recursive && is_null($transactionTag)) {

                    //$this->getDbTable()->getAdapter()->query('SET transaction_allow_batching = 1');
                }

                $this->getDbTable()->getAdapter()->beginTransaction();

            } catch (\Exception $e) {

                //transaction already started
            }


            $transactionTag = 't_' . rand(1, 999) . str_replace(array('.', ' '), '', microtime());
        }

        if (!$forceInsert) {
            unset($data['id']);
        }

        try {
            if (is_null($primaryKey) || empty($primaryKey) || $forceInsert) {
                if (is_null($primaryKey) || empty($primaryKey)) {
                }
                $primaryKey = $this->getDbTable()->insert($data);

                if ($primaryKey) {
                    $model->setId($primaryKey);
                } else {
                    throw new \Exception("Insert sentence did not return a valid primary key", 9000);
                }

                if ($this->_cache) {

                    $parentList = $model->getParentList();

                    foreach ($parentList as $constraint => $values) {

                        $refTable = $this->getDbTable();

                        $ref = $refTable->getReference('Klikasi\\Mapper\\Sql\\DbTable\\' . $values["table_name"], $constraint);
                        $column = array_shift($ref["columns"]);

                        $cacheHash = 'Klikasi\\Model\\' . $values["table_name"] . '_' . $data[$column] .'_' . $constraint;

                        if ($this->_cache->test($cacheHash)) {

                            $cachedRelations = $this->_cache->load($cacheHash);
                            $cachedRelations->results[] = $primaryKey;

                            if ($useTransaction) {

                                $this->_cache->save($cachedRelations, $cacheHash, array($transactionTag));

                            } else {

                                $this->_cache->save($cachedRelations, $cacheHash);
                            }
                        }
                    }
                }
            } else {
                $this->getDbTable()
                     ->update(
                         $data,
                         array(
                             $this->getDbTable()->getAdapter()->quoteIdentifier('id') . ' = ?' => $primaryKey
                         )
                     );
            }

            if (!empty($primaryKey) && !empty($fileObjects)) {

                foreach ($fileObjects as $key => $fso) {

                    $baseName = $fso->getBaseName();
                    if (!empty($baseName)) {
                        $fso->flush($primaryKey);
                    }
                }
            }


            if ($recursive) {
                if ($model->getAtseginDut(null, null, true) !== null) {
                    $atseginDut = $model->getAtseginDut();

                    if (!is_array($atseginDut)) {

                        $atseginDut = array($atseginDut);
                    }

                    foreach ($atseginDut as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getAurkezpena(null, null, true) !== null) {
                    $aurkezpena = $model->getAurkezpena();

                    if (!is_array($aurkezpena)) {

                        $aurkezpena = array($aurkezpena);
                    }

                    foreach ($aurkezpena as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getBideoa(null, null, true) !== null) {
                    $bideoa = $model->getBideoa();

                    if (!is_array($bideoa)) {

                        $bideoa = array($bideoa);
                    }

                    foreach ($bideoa as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getEdukiaRelIkastegia(null, null, true) !== null) {
                    $edukiaRelIkastegia = $model->getEdukiaRelIkastegia();

                    if (!is_array($edukiaRelIkastegia)) {

                        $edukiaRelIkastegia = array($edukiaRelIkastegia);
                    }

                    foreach ($edukiaRelIkastegia as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getEdukiaRelKanpaina(null, null, true) !== null) {
                    $edukiaRelKanpaina = $model->getEdukiaRelKanpaina();

                    if (!is_array($edukiaRelKanpaina)) {

                        $edukiaRelKanpaina = array($edukiaRelKanpaina);
                    }

                    foreach ($edukiaRelKanpaina as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getEdukiaRelKategoria(null, null, true) !== null) {
                    $edukiaRelKategoria = $model->getEdukiaRelKategoria();

                    if (!is_array($edukiaRelKategoria)) {

                        $edukiaRelKategoria = array($edukiaRelKategoria);
                    }

                    foreach ($edukiaRelKategoria as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getEdukiaRelMaila(null, null, true) !== null) {
                    $edukiaRelMaila = $model->getEdukiaRelMaila();

                    if (!is_array($edukiaRelMaila)) {

                        $edukiaRelMaila = array($edukiaRelMaila);
                    }

                    foreach ($edukiaRelMaila as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getErabiltzaileaRelEdukia(null, null, true) !== null) {
                    $erabiltzaileaRelEdukia = $model->getErabiltzaileaRelEdukia();

                    if (!is_array($erabiltzaileaRelEdukia)) {

                        $erabiltzaileaRelEdukia = array($erabiltzaileaRelEdukia);
                    }

                    foreach ($erabiltzaileaRelEdukia as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getEsteka(null, null, true) !== null) {
                    $esteka = $model->getEsteka();

                    if (!is_array($esteka)) {

                        $esteka = array($esteka);
                    }

                    foreach ($esteka as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getEtiketaRelEdukia(null, null, true) !== null) {
                    $etiketaRelEdukia = $model->getEtiketaRelEdukia();

                    if (!is_array($etiketaRelEdukia)) {

                        $etiketaRelEdukia = array($etiketaRelEdukia);
                    }

                    foreach ($etiketaRelEdukia as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getFitxategia(null, null, true) !== null) {
                    $fitxategia = $model->getFitxategia();

                    if (!is_array($fitxategia)) {

                        $fitxategia = array($fitxategia);
                    }

                    foreach ($fitxategia as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getGustokoa(null, null, true) !== null) {
                    $gustokoa = $model->getGustokoa();

                    if (!is_array($gustokoa)) {

                        $gustokoa = array($gustokoa);
                    }

                    foreach ($gustokoa as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getHobekuntzak(null, null, true) !== null) {
                    $hobekuntzak = $model->getHobekuntzak();

                    if (!is_array($hobekuntzak)) {

                        $hobekuntzak = array($hobekuntzak);
                    }

                    foreach ($hobekuntzak as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIrudia(null, null, true) !== null) {
                    $irudia = $model->getIrudia();

                    if (!is_array($irudia)) {

                        $irudia = array($irudia);
                    }

                    foreach ($irudia as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIruzkina(null, null, true) !== null) {
                    $iruzkina = $model->getIruzkina();

                    if (!is_array($iruzkina)) {

                        $iruzkina = array($iruzkina);
                    }

                    foreach ($iruzkina as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getKexa(null, null, true) !== null) {
                    $kexa = $model->getKexa();

                    if (!is_array($kexa)) {

                        $kexa = array($kexa);
                    }

                    foreach ($kexa as $value) {
                        $value->setEdukiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

            }

            if ($success === true) {

                foreach ($model->getOrphans() as $itemToDelete) {

                    $itemToDelete->delete();
                }

                $model->resetOrphans();
            }

            if ($useTransaction && $success) {

                $this->getDbTable()->getAdapter()->commit();

            } elseif ($useTransaction) {

                $this->getDbTable()->getAdapter()->rollback();

                if ($this->_cache) {

                    $this->_cache->clean(\Zend_Cache::CLEANING_MODE_MATCHING_TAG, array($transactionTag));
                }
            }

        } catch (\Exception $e) {
            $message = 'Exception encountered while attempting to save ' . get_class($this);
            if (!empty($primaryKey)) {
                $message .= ' id: ' . $primaryKey;
            } else {
                $message .= ' with an empty primary key ';
            }

            $message .= ' Exception: ' . $e->getMessage();
            $this->_logger->log($message, \Zend_Log::ERR);
            $this->_logger->log($e->getTraceAsString(), \Zend_Log::DEBUG);

            if ($useTransaction) {
                $this->getDbTable()->getAdapter()->rollback();

                if ($this->_cache) {

                    if ($transactionTag) {

                        $this->_cache->clean(\Zend_Cache::CLEANING_MODE_MATCHING_TAG, array($transactionTag));

                    } else {

                        $this->_cache->clean(\Zend_Cache::CLEANING_MODE_MATCHING_TAG);
                    }
                }
            }

            throw $e;
        }

        if ($success && $this->_cache) {

            if ($useTransaction) {

                $this->_cache->save($model->toArray(), get_class($model) . "_" . $model->getPrimaryKey(), array($transactionTag));

            } else {

                $this->_cache->save($model->toArray(), get_class($model) . "_" . $model->getPrimaryKey());
            }
        }

        if ($model->mustUpdateEtag()) {
            $this->_etagChange();
        }

        if ($success === true) {
            return $primaryKey;
        }

        return $success;
    }

    /**
     * Loads the model specific data into the model object
     *
     * @param \Zend_Db_Table_Row_Abstract|array $data The data as returned from a \Zend_Db query
     * @param Klikasi\Model\Raw\Edukia|null $entry The object to load the data into, or null to have one created
     * @return Klikasi\Model\Raw\Edukia The model with the data provided
     */
    public function loadModel($data, $entry = null)
    {
        if (!$entry) {
            $entry = new \Klikasi\Model\Edukia();
        }

        // We don't need to log changes as we will reset them later...
        $entry->stopChangeLog();

        if (is_array($data)) {
            $entry->setId($data['id'])
                  ->setErabiltzaileaId($data['erabiltzaileaId'])
                  ->setTitulua($data['titulua'])
                  ->setDeskribapenLaburra($data['deskribapenLaburra'])
                  ->setDeskribapena($data['deskribapena'])
                  ->setBisitaKopurua($data['bisitaKopurua'])
                  ->setUrteakNoiztik($data['urteakNoiztik'])
                  ->setUrteakNoizarte($data['urteakNoizarte'])
                  ->setEgoera($data['egoera'])
                  ->setUrl($data['url'])
                  ->setSortzeData($data['sortzeData'])
                  ->setKarma($data['karma']);
        } else if ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof \stdClass) {
            $entry->setId($data->{'id'})
                  ->setErabiltzaileaId($data->{'erabiltzaileaId'})
                  ->setTitulua($data->{'titulua'})
                  ->setDeskribapenLaburra($data->{'deskribapenLaburra'})
                  ->setDeskribapena($data->{'deskribapena'})
                  ->setBisitaKopurua($data->{'bisitaKopurua'})
                  ->setUrteakNoiztik($data->{'urteakNoiztik'})
                  ->setUrteakNoizarte($data->{'urteakNoizarte'})
                  ->setEgoera($data->{'egoera'})
                  ->setUrl($data->{'url'})
                  ->setSortzeData($data->{'sortzeData'})
                  ->setKarma($data->{'karma'});

        } else if ($data instanceof \Klikasi\Model\Raw\Edukia) {
            $entry->setId($data->getId())
                  ->setErabiltzaileaId($data->getErabiltzaileaId())
                  ->setTitulua($data->getTitulua())
                  ->setDeskribapenLaburra($data->getDeskribapenLaburra())
                  ->setDeskribapena($data->getDeskribapena())
                  ->setBisitaKopurua($data->getBisitaKopurua())
                  ->setUrteakNoiztik($data->getUrteakNoiztik())
                  ->setUrteakNoizarte($data->getUrteakNoizarte())
                  ->setEgoera($data->getEgoera())
                  ->setUrl($data->getUrl())
                  ->setSortzeData($data->getSortzeData())
                  ->setKarma($data->getKarma());

        }

        $entry->resetChangeLog()->initChangeLog()->setMapper($this);

        return $entry;
    }

    protected function _etagChange()
    {

        $date = new \Zend_Date();
        $date->setTimezone('UTC');
        $nowUTC = $date->toString('yyyy-MM-dd HH:mm:ss');

        $etags = new \Klikasi\Mapper\Sql\EtagVersions();
        $etag = $etags->findOneByField('table', 'Edukia');

        if (empty($etag)) {
            $etag = new \Klikasi\Model\EtagVersions();
            $etag->setTable('Edukia');
        }

        $random = substr(
            str_shuffle(
                str_repeat(
                    'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
                    5
                )
            ), 0, 5
        );

        $etag->setEtag(md5($nowUTC . $random));
        $etag->setLastChange($nowUTC);
        $etag->save();

    }

}