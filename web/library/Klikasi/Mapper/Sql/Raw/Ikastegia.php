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
 * Data Mapper implementation for Klikasi\Model\Ikastegia
 *
 * @package Klikasi\Mapper\Sql
 * @subpackage Raw
 * @author Irontec
 */

namespace Klikasi\Mapper\Sql\Raw;
class Ikastegia extends MapperAbstract
{
    protected $_modelName = 'Klikasi\\Model\\Ikastegia';


    protected $_urlIdentifiers = array(
        'url' => 'izena',
    );

    /**
     * Returns an array, keys are the field names.
     *
     * @param Klikasi\Model\Raw\Ikastegia $model
     * @return array
     */
    public function toArray($model, $fields = array())
    {

        if (!$model instanceof \Klikasi\Model\Raw\Ikastegia) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \Klikasi\Model\Raw\Ikastegia object in toArray for " . get_class($this);
            } else {
                $message = "$model is not a \\Klikasi\Model\\Ikastegia object in toArray for " . get_class($this);
            }

            $this->_logger->log($message, \Zend_Log::ERR);
            throw new \Exception('Unable to create array: invalid model passed to mapper', 2000);
        }

        if (empty($fields)) {
            $result = array(
                'id' => $model->getId(),
                'izena' => $model->getIzena(),
                'deskribapenLaburra' => $model->getDeskribapenLaburra(),
                'deskribapena' => $model->getDeskribapena(),
                'herria' => $model->getHerria(),
                'probintzia' => $model->getProbintzia(),
                'kokapena' => $model->getKokapena(),
                'kokapenaLat' => $model->getKokapenaLat(),
                'kokapenaLng' => $model->getKokapenaLng(),
                'mota' => $model->getMota(),
                'irudiaFileSize' => $model->getIrudiaFileSize(),
                'irudiaMimeType' => $model->getIrudiaMimeType(),
                'irudiaBaseName' => $model->getIrudiaBaseName(),
                'linkedin' => $model->getLinkedin(),
                'facebook' => $model->getFacebook(),
                'twitter' => $model->getTwitter(),
                'google' => $model->getGoogle(),
                'youtube' => $model->getYoutube(),
                'instagram' => $model->getInstagram(),
                'pinterest' => $model->getPinterest(),
                'aktibatua' => $model->getAktibatua(),
                'url' => $model->getUrl(),
                'webSite' => $model->getWebSite(),
                'sortzeData' => $model->getSortzeData(),
                'karma' => $model->getKarma(),
                'flickr' => $model->getFlickr(),
                'ikasleKopurua' => $model->getIkasleKopurua(),
                'edukiKopurua' => $model->getEdukiKopurua(),
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
     * @return Klikasi\\Mapper\\Sql\\DbTable\\Ikastegia
     */
    public function getDbTable()
    {
        if (is_null($this->_dbTable)) {
            $this->setDbTable('Klikasi\\Mapper\\Sql\\DbTable\\Ikastegia');
        }

        return $this->_dbTable;
    }

    /**
     * Deletes the current model
     *
     * @param Klikasi\Model\Raw\Ikastegia $model The model to delete
     * @see Klikasi\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\Klikasi\Model\Raw\ModelAbstract $model)
    {
        if (!$model instanceof \Klikasi\Model\Raw\Ikastegia) {
            if (is_object($model)) {
                $message = get_class($model) . " is not a \\Klikasi\\Model\\Ikastegia object in delete for " . get_class($this);
            } else {
                $message = "$model is not a \\Klikasi\\Model\\Ikastegia object in delete for " . get_class($this);
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
                            $references = $relDbAdapter->getReference('Klikasi\\Mapper\\Sql\\DbTable\\Ikastegia', $capitalizedFk);

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
                            $references = $relDbAdapter->getReference('Klikasi\\Mapper\\Sql\\DbTable\\Ikastegia', $capitalizedFk);

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
    public function save(\Klikasi\Model\Raw\Ikastegia $model, $forceInsert = false)
    {
        return $this->_save($model, false, false, null, $forceInsert);
    }

    /**
     * Saves current and all dependent rows
     *
     * @param \Klikasi\Model\Raw\Ikastegia $model
     * @param boolean $useTransaction Flag to indicate if save should be done inside a database transaction
     * @return integer primary key for autoincrement fields if the save action was successful
     */
    public function saveRecursive(\Klikasi\Model\Raw\Ikastegia $model, $useTransaction = true,
            $transactionTag = null, $forceInsert = false)
    {
        return $this->_save($model, true, $useTransaction, $transactionTag, $forceInsert);
    }

    protected function _save(\Klikasi\Model\Raw\Ikastegia $model,
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
                if ($model->getEdukiaRelIkastegia(null, null, true) !== null) {
                    $edukiaRelIkastegia = $model->getEdukiaRelIkastegia();

                    if (!is_array($edukiaRelIkastegia)) {

                        $edukiaRelIkastegia = array($edukiaRelIkastegia);
                    }

                    foreach ($edukiaRelIkastegia as $value) {
                        $value->setIkastegiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getErabiltzaileaRelIkastegia(null, null, true) !== null) {
                    $erabiltzaileaRelIkastegia = $model->getErabiltzaileaRelIkastegia();

                    if (!is_array($erabiltzaileaRelIkastegia)) {

                        $erabiltzaileaRelIkastegia = array($erabiltzaileaRelIkastegia);
                    }

                    foreach ($erabiltzaileaRelIkastegia as $value) {
                        $value->setIkastegiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getErabiltzaileaRelIrakaslea(null, null, true) !== null) {
                    $erabiltzaileaRelIrakaslea = $model->getErabiltzaileaRelIrakaslea();

                    if (!is_array($erabiltzaileaRelIrakaslea)) {

                        $erabiltzaileaRelIrakaslea = array($erabiltzaileaRelIrakaslea);
                    }

                    foreach ($erabiltzaileaRelIrakaslea as $value) {
                        $value->setIkastegiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIkastegiaRelGaiak(null, null, true) !== null) {
                    $ikastegiaRelGaiak = $model->getIkastegiaRelGaiak();

                    if (!is_array($ikastegiaRelGaiak)) {

                        $ikastegiaRelGaiak = array($ikastegiaRelGaiak);
                    }

                    foreach ($ikastegiaRelGaiak as $value) {
                        $value->setIkastegiaId($primaryKey)
                              ->saveRecursive(false, $transactionTag);
                    }
                }

                if ($model->getIkastegiaRelMota(null, null, true) !== null) {
                    $ikastegiaRelMota = $model->getIkastegiaRelMota();

                    if (!is_array($ikastegiaRelMota)) {

                        $ikastegiaRelMota = array($ikastegiaRelMota);
                    }

                    foreach ($ikastegiaRelMota as $value) {
                        $value->setIkastegiaId($primaryKey)
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
     * @param Klikasi\Model\Raw\Ikastegia|null $entry The object to load the data into, or null to have one created
     * @return Klikasi\Model\Raw\Ikastegia The model with the data provided
     */
    public function loadModel($data, $entry = null)
    {
        if (!$entry) {
            $entry = new \Klikasi\Model\Ikastegia();
        }

        // We don't need to log changes as we will reset them later...
        $entry->stopChangeLog();

        if (is_array($data)) {
            $entry->setId($data['id'])
                  ->setIzena($data['izena'])
                  ->setDeskribapenLaburra($data['deskribapenLaburra'])
                  ->setDeskribapena($data['deskribapena'])
                  ->setHerria($data['herria'])
                  ->setProbintzia($data['probintzia'])
                  ->setKokapena($data['kokapena'])
                  ->setKokapenaLat($data['kokapenaLat'])
                  ->setKokapenaLng($data['kokapenaLng'])
                  ->setMota($data['mota'])
                  ->setIrudiaFileSize($data['irudiaFileSize'])
                  ->setIrudiaMimeType($data['irudiaMimeType'])
                  ->setIrudiaBaseName($data['irudiaBaseName'])
                  ->setLinkedin($data['linkedin'])
                  ->setFacebook($data['facebook'])
                  ->setTwitter($data['twitter'])
                  ->setGoogle($data['google'])
                  ->setYoutube($data['youtube'])
                  ->setInstagram($data['instagram'])
                  ->setPinterest($data['pinterest'])
                  ->setAktibatua($data['aktibatua'])
                  ->setUrl($data['url'])
                  ->setWebSite($data['webSite'])
                  ->setSortzeData($data['sortzeData'])
                  ->setKarma($data['karma'])
                  ->setFlickr($data['flickr'])
                  ->setIkasleKopurua($data['ikasleKopurua'])
                  ->setEdukiKopurua($data['edukiKopurua']);
        } else if ($data instanceof \Zend_Db_Table_Row_Abstract || $data instanceof \stdClass) {
            $entry->setId($data->{'id'})
                  ->setIzena($data->{'izena'})
                  ->setDeskribapenLaburra($data->{'deskribapenLaburra'})
                  ->setDeskribapena($data->{'deskribapena'})
                  ->setHerria($data->{'herria'})
                  ->setProbintzia($data->{'probintzia'})
                  ->setKokapena($data->{'kokapena'})
                  ->setKokapenaLat($data->{'kokapenaLat'})
                  ->setKokapenaLng($data->{'kokapenaLng'})
                  ->setMota($data->{'mota'})
                  ->setIrudiaFileSize($data->{'irudiaFileSize'})
                  ->setIrudiaMimeType($data->{'irudiaMimeType'})
                  ->setIrudiaBaseName($data->{'irudiaBaseName'})
                  ->setLinkedin($data->{'linkedin'})
                  ->setFacebook($data->{'facebook'})
                  ->setTwitter($data->{'twitter'})
                  ->setGoogle($data->{'google'})
                  ->setYoutube($data->{'youtube'})
                  ->setInstagram($data->{'instagram'})
                  ->setPinterest($data->{'pinterest'})
                  ->setAktibatua($data->{'aktibatua'})
                  ->setUrl($data->{'url'})
                  ->setWebSite($data->{'webSite'})
                  ->setSortzeData($data->{'sortzeData'})
                  ->setKarma($data->{'karma'})
                  ->setFlickr($data->{'flickr'})
                  ->setIkasleKopurua($data->{'ikasleKopurua'})
                  ->setEdukiKopurua($data->{'edukiKopurua'});

        } else if ($data instanceof \Klikasi\Model\Raw\Ikastegia) {
            $entry->setId($data->getId())
                  ->setIzena($data->getIzena())
                  ->setDeskribapenLaburra($data->getDeskribapenLaburra())
                  ->setDeskribapena($data->getDeskribapena())
                  ->setHerria($data->getHerria())
                  ->setProbintzia($data->getProbintzia())
                  ->setKokapena($data->getKokapena())
                  ->setKokapenaLat($data->getKokapenaLat())
                  ->setKokapenaLng($data->getKokapenaLng())
                  ->setMota($data->getMota())
                  ->setIrudiaFileSize($data->getIrudiaFileSize())
                  ->setIrudiaMimeType($data->getIrudiaMimeType())
                  ->setIrudiaBaseName($data->getIrudiaBaseName())
                  ->setLinkedin($data->getLinkedin())
                  ->setFacebook($data->getFacebook())
                  ->setTwitter($data->getTwitter())
                  ->setGoogle($data->getGoogle())
                  ->setYoutube($data->getYoutube())
                  ->setInstagram($data->getInstagram())
                  ->setPinterest($data->getPinterest())
                  ->setAktibatua($data->getAktibatua())
                  ->setUrl($data->getUrl())
                  ->setWebSite($data->getWebSite())
                  ->setSortzeData($data->getSortzeData())
                  ->setKarma($data->getKarma())
                  ->setFlickr($data->getFlickr())
                  ->setIkasleKopurua($data->getIkasleKopurua())
                  ->setEdukiKopurua($data->getEdukiKopurua());

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
        $etag = $etags->findOneByField('table', 'Ikastegia');

        if (empty($etag)) {
            $etag = new \Klikasi\Model\EtagVersions();
            $etag->setTable('Ikastegia');
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