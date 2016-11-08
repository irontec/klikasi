<?php

/**
 * Application Model
 *
 * @package Klikasi\Model\Raw
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

namespace Klikasi\Model\Raw;
class Jakinarazpenak extends ModelAbstract
{

    protected $_egoeraAcceptedValues = array(
        'onartzeko',
        'onartua',
        'ezOnartua',
    );

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_erabiltzaileaId;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_idKanpotarra;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_ikusita;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_message;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_postazJakinarazi;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_sortzeData;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_thatUserId;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_motaId;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_deletedBySender;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_deletedByErabiltzailea;

    /**
     * [enum:onartzeko|onartua|ezOnartua]
     * Database var type varchar
     *
     * @var string
     */
    protected $_egoera;


    /**
     * Parent relation fk_Jakinarazpenak_Erabiltzailea1
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Erabiltzailea;

    /**
     * Parent relation Jakinarazpenak_motaId
     *
     * @var \Klikasi\Model\Raw\JakinarazpenakMota
     */
    protected $_Mota;

    /**
     * Parent relation Jakinarazpenak_thatUserId
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_ThatUser;


    /**
     * Dependent relation JakinarazpenakGroup_jakinarazpenakId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\JakinarazpenakGroup[]
     */
    protected $_JakinarazpenakGroup;

    protected $_columnsList = array(
        'id'=>'id',
        'erabiltzaileaId'=>'erabiltzaileaId',
        'idKanpotarra'=>'idKanpotarra',
        'ikusita'=>'ikusita',
        'message'=>'message',
        'postazJakinarazi'=>'postazJakinarazi',
        'sortzeData'=>'sortzeData',
        'thatUserId'=>'thatUserId',
        'motaId'=>'motaId',
        'deletedBySender'=>'deletedBySender',
        'deletedByErabiltzailea'=>'deletedByErabiltzailea',
        'egoera'=>'egoera',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'egoera'=> array('enum:onartzeko|onartua|ezOnartua'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
            'FkJakinarazpenakErabiltzailea1'=> array(
                    'property' => 'Erabiltzailea',
                    'table_name' => 'Erabiltzailea',
                ),
            'JakinarazpenakMotaId'=> array(
                    'property' => 'Mota',
                    'table_name' => 'JakinarazpenakMota',
                ),
            'JakinarazpenakThatUserId'=> array(
                    'property' => 'ThatUser',
                    'table_name' => 'Erabiltzailea',
                ),
        ));

        $this->setDependentList(array(
            'JakinarazpenakGroupJakinarazpenakId' => array(
                    'property' => 'JakinarazpenakGroup',
                    'table_name' => 'JakinarazpenakGroup',
                ),
        ));




        $this->_defaultValues = array(
            'ikusita' => '0',
            'postazJakinarazi' => '0',
            'sortzeData' => 'CURRENT_TIMESTAMP',
            'deletedBySender' => '0',
            'deletedByErabiltzailea' => '0',
            'egoera' => 'onartzeko',
        );

        $this->_initFileObjects();
        parent::__construct();
    }

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }
    /**************************************************************************
    ************************** File System Object (FSO)************************
    ***************************************************************************/

    protected function _initFileObjects()
    {

        return $this;
    }

    public function getFileObjects()
    {

        return array();
    }


    /**************************************************************************
    *********************************** /FSO ***********************************
    ***************************************************************************/

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_id = $data;

        } else if (!is_null($data)) {
            $this->_id = (int) $data;

        } else {
            $this->_id = $data;
        }
        return $this;
    }

    /**
     * Gets column id
     *
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setErabiltzaileaId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_erabiltzaileaId != $data) {
            $this->_logChange('erabiltzaileaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_erabiltzaileaId = $data;

        } else if (!is_null($data)) {
            $this->_erabiltzaileaId = (int) $data;

        } else {
            $this->_erabiltzaileaId = $data;
        }
        return $this;
    }

    /**
     * Gets column erabiltzaileaId
     *
     * @return int
     */
    public function getErabiltzaileaId()
    {
        return $this->_erabiltzaileaId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setIdKanpotarra($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_idKanpotarra != $data) {
            $this->_logChange('idKanpotarra');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_idKanpotarra = $data;

        } else if (!is_null($data)) {
            $this->_idKanpotarra = (int) $data;

        } else {
            $this->_idKanpotarra = $data;
        }
        return $this;
    }

    /**
     * Gets column idKanpotarra
     *
     * @return int
     */
    public function getIdKanpotarra()
    {
        return $this->_idKanpotarra;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setIkusita($data)
    {

        if ($this->_ikusita != $data) {
            $this->_logChange('ikusita');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ikusita = $data;

        } else if (!is_null($data)) {
            $this->_ikusita = (int) $data;

        } else {
            $this->_ikusita = $data;
        }
        return $this;
    }

    /**
     * Gets column ikusita
     *
     * @return int
     */
    public function getIkusita()
    {
        return $this->_ikusita;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setMessage($data)
    {

        if ($this->_message != $data) {
            $this->_logChange('message');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_message = $data;

        } else if (!is_null($data)) {
            $this->_message = (string) $data;

        } else {
            $this->_message = $data;
        }
        return $this;
    }

    /**
     * Gets column message
     *
     * @return text
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setPostazJakinarazi($data)
    {

        if ($this->_postazJakinarazi != $data) {
            $this->_logChange('postazJakinarazi');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_postazJakinarazi = $data;

        } else if (!is_null($data)) {
            $this->_postazJakinarazi = (int) $data;

        } else {
            $this->_postazJakinarazi = $data;
        }
        return $this;
    }

    /**
     * Gets column postazJakinarazi
     *
     * @return int
     */
    public function getPostazJakinarazi()
    {
        return $this->_postazJakinarazi;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setSortzeData($data)
    {
        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }
        if ($data === 'CURRENT_TIMESTAMP' || is_null($data)) {
            $data = \Zend_Date::now()->setTimezone('UTC');
        }

        if ($data instanceof \Zend_Date) {

            $data = new \DateTime($data->toString('yyyy-MM-dd HH:mm:ss'), new \DateTimeZone($data->getTimezone()));

        } elseif (!is_null($data) && !$data instanceof \DateTime) {

            $data = new \DateTime($data, new \DateTimeZone('UTC'));
        }
        if ($data instanceof \DateTime && $data->getTimezone()->getName() != 'UTC') {

            $data->setTimezone(new \DateTimeZone('UTC'));
        }

        if ($this->_sortzeData != $data) {
            $this->_logChange('sortzeData');
        }

        $this->_sortzeData = $data;
        return $this;
    }

    /**
     * Gets column sortzeData
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getSortzeData($returnZendDate = false)
    {
        if (is_null($this->_sortzeData)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_sortzeData->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_sortzeData->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setThatUserId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_thatUserId != $data) {
            $this->_logChange('thatUserId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_thatUserId = $data;

        } else if (!is_null($data)) {
            $this->_thatUserId = (int) $data;

        } else {
            $this->_thatUserId = $data;
        }
        return $this;
    }

    /**
     * Gets column thatUserId
     *
     * @return int
     */
    public function getThatUserId()
    {
        return $this->_thatUserId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setMotaId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_motaId != $data) {
            $this->_logChange('motaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_motaId = $data;

        } else if (!is_null($data)) {
            $this->_motaId = (int) $data;

        } else {
            $this->_motaId = $data;
        }
        return $this;
    }

    /**
     * Gets column motaId
     *
     * @return int
     */
    public function getMotaId()
    {
        return $this->_motaId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setDeletedBySender($data)
    {

        if ($this->_deletedBySender != $data) {
            $this->_logChange('deletedBySender');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_deletedBySender = $data;

        } else if (!is_null($data)) {
            $this->_deletedBySender = (int) $data;

        } else {
            $this->_deletedBySender = $data;
        }
        return $this;
    }

    /**
     * Gets column deletedBySender
     *
     * @return int
     */
    public function getDeletedBySender()
    {
        return $this->_deletedBySender;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setDeletedByErabiltzailea($data)
    {

        if ($this->_deletedByErabiltzailea != $data) {
            $this->_logChange('deletedByErabiltzailea');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_deletedByErabiltzailea = $data;

        } else if (!is_null($data)) {
            $this->_deletedByErabiltzailea = (int) $data;

        } else {
            $this->_deletedByErabiltzailea = $data;
        }
        return $this;
    }

    /**
     * Gets column deletedByErabiltzailea
     *
     * @return int
     */
    public function getDeletedByErabiltzailea()
    {
        return $this->_deletedByErabiltzailea;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setEgoera($data)
    {

        if ($this->_egoera != $data) {
            $this->_logChange('egoera');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_egoera = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_egoeraAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for egoera'));
            }
            $this->_egoera = (string) $data;

        } else {
            $this->_egoera = $data;
        }
        return $this;
    }

    /**
     * Gets column egoera
     *
     * @return string
     */
    public function getEgoera()
    {
        return $this->_egoera;
    }

    /**
     * Sets parent relation Erabiltzailea
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setErabiltzailea(\Klikasi\Model\Raw\Erabiltzailea $data)
    {
        $this->_Erabiltzailea = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setErabiltzaileaId($primaryKey);
        }

        $this->_setLoaded('FkJakinarazpenakErabiltzailea1');
        return $this;
    }

    /**
     * Gets parent Erabiltzailea
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkJakinarazpenakErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Erabiltzailea = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Erabiltzailea;
    }

    /**
     * Sets parent relation Mota
     *
     * @param \Klikasi\Model\Raw\JakinarazpenakMota $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setMota(\Klikasi\Model\Raw\JakinarazpenakMota $data)
    {
        $this->_Mota = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setMotaId($primaryKey);
        }

        $this->_setLoaded('JakinarazpenakMotaId');
        return $this;
    }

    /**
     * Gets parent Mota
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\JakinarazpenakMota
     */
    public function getMota($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'JakinarazpenakMotaId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Mota = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Mota;
    }

    /**
     * Sets parent relation ThatUser
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setThatUser(\Klikasi\Model\Raw\Erabiltzailea $data)
    {
        $this->_ThatUser = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setThatUserId($primaryKey);
        }

        $this->_setLoaded('JakinarazpenakThatUserId');
        return $this;
    }

    /**
     * Gets parent ThatUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getThatUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'JakinarazpenakThatUserId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ThatUser = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ThatUser;
    }

    /**
     * Sets dependent relations JakinarazpenakGroup_jakinarazpenakId
     *
     * @param array $data An array of \Klikasi\Model\Raw\JakinarazpenakGroup
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function setJakinarazpenakGroup(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_JakinarazpenakGroup === null) {

                $this->getJakinarazpenakGroup();
            }

            $oldRelations = $this->_JakinarazpenakGroup;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_JakinarazpenakGroup = array();

        foreach ($data as $object) {
            $this->addJakinarazpenakGroup($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations JakinarazpenakGroup_jakinarazpenakId
     *
     * @param \Klikasi\Model\Raw\JakinarazpenakGroup $data
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function addJakinarazpenakGroup(\Klikasi\Model\Raw\JakinarazpenakGroup $data)
    {
        $this->_JakinarazpenakGroup[] = $data;
        $this->_setLoaded('JakinarazpenakGroupJakinarazpenakId');
        return $this;
    }

    /**
     * Gets dependent JakinarazpenakGroup_jakinarazpenakId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\JakinarazpenakGroup
     */
    public function getJakinarazpenakGroup($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'JakinarazpenakGroupJakinarazpenakId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_JakinarazpenakGroup = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_JakinarazpenakGroup;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Jakinarazpenak
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Jakinarazpenak')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Jakinarazpenak);

            } else {

                 new \Exception("Not a valid mapper class found");
            }

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(false);
        }

        return $this->_mapper;
    }

    /**
     * Returns the validator class for this model
     *
     * @return null | \Klikasi\Model\Validator\Jakinarazpenak
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Jakinarazpenak')) {

                $this->setValidator(new \Klikasi\Validator\Jakinarazpenak);
            }
        }

        return $this->_validator;
    }

    public function setFromArray($data)
    {
        return $this->getMapper()->loadModel($data, $this);
    }

    /**
     * Deletes current row by deleting the row that matches the primary key
     *
     * @see \Mapper\Sql\Jakinarazpenak::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getId() === null) {
            $this->_logger->log('The value for Id cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'id = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getId())
        );
    }

    public function mustUpdateEtag()
    {
        return true;
    }

}