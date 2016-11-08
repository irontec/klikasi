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
 * Data Mapper implementation for Klikasi\Model\Erabiltzailea
 *
 * @package Klikasi\Mapper\Sql
 * @subpackage Raw
 * @author Irontec
 */

namespace Klikasi\Mapper\Sql\Raw;
class Erabiltzailea extends MapperAbstract
{
    protected $_modelName = 'Klikasi\\Model\\Erabiltzailea';


    protected $_urlIdentifiers = array(
        'url' => 'erabiltzaileIzena',
    );

    /**
     * Returns an array, keys are the field names.
     *
     * @param Klikasi\Model\Raw\Erabiltzailea $model
     * @return array
     */
    public function toArray($model, $fields = array())
    {

        if (!$model instanceof \Klikasi\Model\Raw\Erabiltzailea) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \Klikasi\Model\Raw\Erabiltzailea object in toArray for " . get_class($this);
            } else {
                $message = "$model is not a \\Klikasi\Model\\Erabiltzailea object in toArray for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to create array: invalid model passed to mapper', 2000);
        }

        if (empty($fields)) {
            $result = array(
                'id' => $model->getId(),
                'izena' => $model->getIzena(),
                'abizena' => $model->getAbizena(),
                'abizena2' => $model->getAbizena2(),
                'deskribapena' => $model->getDeskribapena(),
                'erabiltzaileIzena' => $model->getErabiltzaileIzena(),
                'pasahitza' => $model->getPasahitza(),
                'posta' => $model->getPosta(),
                'egoera' => $model->getEgoera(),
                'url' => $model->getUrl(),
                'jaiotzeData' => $model->getJaiotzeData(),
                'sortzeData' => $model->getSortzeData(),
                'altaData' => $model->getAltaData(),
                'superErabiltzailea' => $model->getSuperErabiltzailea(),
                'profila' => $model->getProfila(),
                'hash' => $model->getHash(),
                'hashIraungiData' => $model->getHashIraungiData(),
                'irudiaId' => $model->getIrudiaId(),
                'irudiaDefault' => $model->getIrudiaDefault(),
                'typeAvatar' => $model->getTypeAvatar(),
                'newsletter' => $model->getNewsletter(),
                'twitter' => $model->getTwitter(),
                'facebook' => $model->getFacebook(),
                'google' => $model->getGoogle(),
                'linkedin' => $model->getLinkedin(),
                'pinterest' => $model->getPinterest(),
                'flickr' => $model->getFlickr(),
                'youtube' => $model->getYoutube(),
                'instagram' => $model->getInstagram(),
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
     * @return Klikasi\\Mapper\\Sql\\DbTable\\Erabiltzailea
     */
    public function getDbTable()
    {
        if (is_null($this->_dbTable)) {
            $this->setDbTable('Klikasi\\Mapper\\Sql\\DbTable\\Erabiltzailea');
        }

        return $this->_dbTable;
    }

    /**
     * Deletes the current model
     *
     * @param Klikasi\Model\Raw\Erabiltzailea $model The model to delete
     * @see Klikasi\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\Klikasi\Model\Raw\ModelAbstract $model)
    {
        if (!$model instanceof \Klikasi\Model\Raw\Erabiltzailea) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \\Klikasi\\Model\\Erabiltzailea object in delete for " . get_class($this);
            } else {
                $message = "$model is not a \\Klikasi\\Model\\Erabiltzailea object in delete for " . get_class($this);
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
                            $references = $relDbAdapter->getReference('Klikasi\\Mapper\\Sql\\DbTable\\Erabiltzailea', $capitalizedFk);

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
                            $references = $relDbAdapter->getReference('Klikasi\\Mapper\\Sql\\DbTable\\Erabiltzailea', $capitalizedFk);

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
    public function save(\Klikasi\Model\Raw\Erabiltzailea $model, $forceInsert = false)
    {
        return $this->_save($model, false, false, null, $forceInsert);
    }

    /**
     * Saves current and all dependent rows
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $model
     * @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    public function saveRecursive(\Klikasi\Model\Raw\Erabiltzailea $model, $useTransaction = true,
            $transactionTag = null, $forceInsert = false)
    {
        return $this->_save($model, true, $useTransaction, $transactionTag, $forceInsert);
    }

    protected function _save(\Klikasi\Model\Raw\Erabiltzailea $model,
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
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getEdukia(null, null, true) !== null) {
                    $edukia = $model->getEdukia();

                    if (!is_array($edukia)) {

                        $edukia = array($edukia);
                    }

                    foreach ($edukia as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getEmailHistory(null, null, true) !== null) {
                    $emailHistory = $model->getEmailHistory();

                    if (!is_array($emailHistory)) {

                        $emailHistory = array($emailHistory);
                    }

                    foreach ($emailHistory as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getErabiltzaileaRelEdukia(null, null, true) !== null) {
                    $erabiltzaileaRelEdukia = $model->getErabiltzaileaRelEdukia();

                    if (!is_array($erabiltzaileaRelEdukia)) {

                        $erabiltzaileaRelEdukia = array($erabiltzaileaRelEdukia);
                    }

                    foreach ($erabiltzaileaRelEdukia as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getErabiltzaileaRelIkastegia(null, null, true) !== null) {
                    $erabiltzaileaRelIkastegia = $model->getErabiltzaileaRelIkastegia();

                    if (!is_array($erabiltzaileaRelIkastegia)) {

                        $erabiltzaileaRelIkastegia = array($erabiltzaileaRelIkastegia);
                    }

                    foreach ($erabiltzaileaRelIkastegia as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getErabiltzaileaRelIrakasleaByErabiltzailea(null, null, true) !== null) {
                    $erabiltzaileaRelIrakaslea = $model->getErabiltzaileaRelIrakasleaByErabiltzailea();

                    if (!is_array($erabiltzaileaRelIrakaslea)) {

                        $erabiltzaileaRelIrakaslea = array($erabiltzaileaRelIrakaslea);
                    }

                    foreach ($erabiltzaileaRelIrakaslea as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getErabiltzaileaRelIrakasleaByIrakaslea(null, null, true) !== null) {
                    $erabiltzaileaRelIrakaslea = $model->getErabiltzaileaRelIrakasleaByIrakaslea();

                    if (!is_array($erabiltzaileaRelIrakaslea)) {

                        $erabiltzaileaRelIrakaslea = array($erabiltzaileaRelIrakaslea);
                    }

                    foreach ($erabiltzaileaRelIrakaslea as $value) {
                        $value->setIrakasleaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getErabiltzaileaSettings(null, null, true) !== null) {
                    $erabiltzaileaSettings = $model->getErabiltzaileaSettings();

                    if (!is_array($erabiltzaileaSettings)) {

                        $erabiltzaileaSettings = array($erabiltzaileaSettings);
                    }

                    foreach ($erabiltzaileaSettings as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getGustokoa(null, null, true) !== null) {
                    $gustokoa = $model->getGustokoa();

                    if (!is_array($gustokoa)) {

                        $gustokoa = array($gustokoa);
                    }

                    foreach ($gustokoa as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getHobekuntzak(null, null, true) !== null) {
                    $hobekuntzak = $model->getHobekuntzak();

                    if (!is_array($hobekuntzak)) {

                        $hobekuntzak = array($hobekuntzak);
                    }

                    foreach ($hobekuntzak as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIruzkina(null, null, true) !== null) {
                    $iruzkina = $model->getIruzkina();

                    if (!is_array($iruzkina)) {

                        $iruzkina = array($iruzkina);
                    }

                    foreach ($iruzkina as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getJakinarazpenakByErabiltzailea(null, null, true) !== null) {
                    $jakinarazpenak = $model->getJakinarazpenakByErabiltzailea();

                    if (!is_array($jakinarazpenak)) {

                        $jakinarazpenak = array($jakinarazpenak);
                    }

                    foreach ($jakinarazpenak as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getJakinarazpenakByThatUser(null, null, true) !== null) {
                    $jakinarazpenak = $model->getJakinarazpenakByThatUser();

                    if (!is_array($jakinarazpenak)) {

                        $jakinarazpenak = array($jakinarazpenak);
                    }

                    foreach ($jakinarazpenak as $value) {
                        $value->setThatUserId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getJakinarazpenakGroup(null, null, true) !== null) {
                    $jakinarazpenakGroup = $model->getJakinarazpenakGroup();

                    if (!is_array($jakinarazpenakGroup)) {

                        $jakinarazpenakGroup = array($jakinarazpenakGroup);
                    }

                    foreach ($jakinarazpenakGroup as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getKexa(null, null, true) !== null) {
                    $kexa = $model->getKexa();

                    if (!is_array($kexa)) {

                        $kexa = array($kexa);
                    }

                    foreach ($kexa as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getLagunakByErabiltzailea(null, null, true) !== null) {
                    $lagunak = $model->getLagunakByErabiltzailea();

                    if (!is_array($lagunak)) {

                        $lagunak = array($lagunak);
                    }

                    foreach ($lagunak as $value) {
                        $value->setErabiltzaileaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getLagunakByErabiltzaileaId1(null, null, true) !== null) {
                    $lagunak = $model->getLagunakByErabiltzaileaId1();

                    if (!is_array($lagunak)) {

                        $lagunak = array($lagunak);
                    }

                    foreach ($lagunak as $value) {
                        $value->setErabiltzaileaId1($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getMezuakByNork(null, null, true) !== null) {
                    $mezuak = $model->getMezuakByNork();

                    if (!is_array($mezuak)) {

                        $mezuak = array($mezuak);
                    }

                    foreach ($mezuak as $value) {
                        $value->setNorkId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getMezuakByNori(null, null, true) !== null) {
                    $mezuak = $model->getMezuakByNori();

                    if (!is_array($mezuak)) {

                        $mezuak = array($mezuak);
                    }

                    foreach ($mezuak as $value) {
                        $value->setNoriId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getNewsletterHash(null, null, true) !== null) {
                    $newsletterHash = $model->getNewsletterHash();

                    if (!is_array($newsletterHash)) {

                        $newsletterHash = array($newsletterHash);
                    }

                    foreach ($newsletterHash as $value) {
                        $value->setErabiltzaileaId($primaryKey)
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
     * @param Klikasi\Model\Raw\Erabiltzailea|null $entry The object to load the data into, or null to have one created
     * @return Klikasi\Model\Raw\Erabiltzailea The model with the data provided
     */
    public function loadModel($data, $entry = null)
    {
        if (!$entry) {
            $entry = new \Klikasi\Model\Erabiltzailea();
        }

        // We don't need to log changes as we will reset them later...
        $entry->stopChangeLog();

        if (is_array($data)) {
            $entry->setId($data['id'])
                  ->setIzena($data['izena'])
                  ->setAbizena($data['abizena'])
                  ->setAbizena2($data['abizena2'])
                  ->setDeskribapena($data['deskribapena'])
                  ->setErabiltzaileIzena($data['erabiltzaileIzena'])
                  ->setPasahitza($data['pasahitza'])
                  ->setPosta($data['posta'])
                  ->setEgoera($data['egoera'])
                  ->setUrl($data['url'])
                  ->setJaiotzeData($data['jaiotzeData'])
                  ->setSortzeData($data['sortzeData'])
                  ->setAltaData($data['altaData'])
                  ->setSuperErabiltzailea($data['superErabiltzailea'])
                  ->setProfila($data['profila'])
                  ->setHash($data['hash'])
                  ->setHashIraungiData($data['hashIraungiData'])
                  ->setIrudiaId($data['irudiaId'])
                  ->setIrudiaDefault($data['irudiaDefault'])
                  ->setTypeAvatar($data['typeAvatar'])
                  ->setNewsletter($data['newsletter'])
                  ->setTwitter($data['twitter'])
                  ->setFacebook($data['facebook'])
                  ->setGoogle($data['google'])
                  ->setLinkedin($data['linkedin'])
                  ->setPinterest($data['pinterest'])
                  ->setFlickr($data['flickr'])
                  ->setYoutube($data['youtube'])
                  ->setInstagram($data['instagram'])
                  ->setKarma($data['karma']);
        } else if ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof \stdClass) {
            $entry->setId($data->{'id'})
                  ->setIzena($data->{'izena'})
                  ->setAbizena($data->{'abizena'})
                  ->setAbizena2($data->{'abizena2'})
                  ->setDeskribapena($data->{'deskribapena'})
                  ->setErabiltzaileIzena($data->{'erabiltzaileIzena'})
                  ->setPasahitza($data->{'pasahitza'})
                  ->setPosta($data->{'posta'})
                  ->setEgoera($data->{'egoera'})
                  ->setUrl($data->{'url'})
                  ->setJaiotzeData($data->{'jaiotzeData'})
                  ->setSortzeData($data->{'sortzeData'})
                  ->setAltaData($data->{'altaData'})
                  ->setSuperErabiltzailea($data->{'superErabiltzailea'})
                  ->setProfila($data->{'profila'})
                  ->setHash($data->{'hash'})
                  ->setHashIraungiData($data->{'hashIraungiData'})
                  ->setIrudiaId($data->{'irudiaId'})
                  ->setIrudiaDefault($data->{'irudiaDefault'})
                  ->setTypeAvatar($data->{'typeAvatar'})
                  ->setNewsletter($data->{'newsletter'})
                  ->setTwitter($data->{'twitter'})
                  ->setFacebook($data->{'facebook'})
                  ->setGoogle($data->{'google'})
                  ->setLinkedin($data->{'linkedin'})
                  ->setPinterest($data->{'pinterest'})
                  ->setFlickr($data->{'flickr'})
                  ->setYoutube($data->{'youtube'})
                  ->setInstagram($data->{'instagram'})
                  ->setKarma($data->{'karma'});

        } else if ($data instanceof \Klikasi\Model\Raw\Erabiltzailea) {
            $entry->setId($data->getId())
                  ->setIzena($data->getIzena())
                  ->setAbizena($data->getAbizena())
                  ->setAbizena2($data->getAbizena2())
                  ->setDeskribapena($data->getDeskribapena())
                  ->setErabiltzaileIzena($data->getErabiltzaileIzena())
                  ->setPasahitza($data->getPasahitza())
                  ->setPosta($data->getPosta())
                  ->setEgoera($data->getEgoera())
                  ->setUrl($data->getUrl())
                  ->setJaiotzeData($data->getJaiotzeData())
                  ->setSortzeData($data->getSortzeData())
                  ->setAltaData($data->getAltaData())
                  ->setSuperErabiltzailea($data->getSuperErabiltzailea())
                  ->setProfila($data->getProfila())
                  ->setHash($data->getHash())
                  ->setHashIraungiData($data->getHashIraungiData())
                  ->setIrudiaId($data->getIrudiaId())
                  ->setIrudiaDefault($data->getIrudiaDefault())
                  ->setTypeAvatar($data->getTypeAvatar())
                  ->setNewsletter($data->getNewsletter())
                  ->setTwitter($data->getTwitter())
                  ->setFacebook($data->getFacebook())
                  ->setGoogle($data->getGoogle())
                  ->setLinkedin($data->getLinkedin())
                  ->setPinterest($data->getPinterest())
                  ->setFlickr($data->getFlickr())
                  ->setYoutube($data->getYoutube())
                  ->setInstagram($data->getInstagram())
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
        $etag = $etags->findOneByField('table', 'Erabiltzailea');

        if (empty($etag)) {
            $etag = new \Klikasi\Model\EtagVersions();
            $etag->setTable('Erabiltzailea');
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