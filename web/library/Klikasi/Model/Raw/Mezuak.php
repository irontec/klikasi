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
class Mezuak extends ModelAbstract
{

    protected $_motaAcceptedValues = array(
        'iradokizuna',
        'mezua',
        'moderazioa',
        'edukia',
    );
    protected $_ikusitaAcceptedValues = array(
        '0',
        '1',
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
    protected $_norkId;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_noriId;

    /**
     * Database var type mediumtext
     *
     * @var text
     */
    protected $_mezua;

    /**
     * [enum:iradokizuna|mezua|moderazioa|edukia]
     * Database var type varchar
     *
     * @var string
     */
    protected $_mota;

    /**
     * [enum:0|1]
     * Database var type varchar
     *
     * @var string
     */
    protected $_ikusita;

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
    protected $_edukiaId;


    /**
     * Parent relation fk_Mezuak_Erabiltzailea1
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Nork;

    /**
     * Parent relation fk_Mezuak_Erabiltzailea2
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Nori;


    protected $_columnsList = array(
        'id'=>'id',
        'norkId'=>'norkId',
        'noriId'=>'noriId',
        'mezua'=>'mezua',
        'mota'=>'mota',
        'ikusita'=>'ikusita',
        'sortzeData'=>'sortzeData',
        'edukiaId'=>'edukiaId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'mota'=> array('enum:iradokizuna|mezua|moderazioa|edukia'),
            'ikusita'=> array('enum:0|1'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
            'FkMezuakErabiltzailea1'=> array(
                    'property' => 'Nork',
                    'table_name' => 'Erabiltzailea',
                ),
            'FkMezuakErabiltzailea2'=> array(
                    'property' => 'Nori',
                    'table_name' => 'Erabiltzailea',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'ikusita' => '0',
            'sortzeData' => 'CURRENT_TIMESTAMP',
            'edukiaId' => '0',
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
     * @return \Klikasi\Model\Raw\Mezuak
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
     * @return \Klikasi\Model\Raw\Mezuak
     */
    public function setNorkId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_norkId != $data) {
            $this->_logChange('norkId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_norkId = $data;

        } else if (!is_null($data)) {
            $this->_norkId = (int) $data;

        } else {
            $this->_norkId = $data;
        }
        return $this;
    }

    /**
     * Gets column norkId
     *
     * @return int
     */
    public function getNorkId()
    {
        return $this->_norkId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Mezuak
     */
    public function setNoriId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_noriId != $data) {
            $this->_logChange('noriId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_noriId = $data;

        } else if (!is_null($data)) {
            $this->_noriId = (int) $data;

        } else {
            $this->_noriId = $data;
        }
        return $this;
    }

    /**
     * Gets column noriId
     *
     * @return int
     */
    public function getNoriId()
    {
        return $this->_noriId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\Mezuak
     */
    public function setMezua($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_mezua != $data) {
            $this->_logChange('mezua');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mezua = $data;

        } else if (!is_null($data)) {
            $this->_mezua = (string) $data;

        } else {
            $this->_mezua = $data;
        }
        return $this;
    }

    /**
     * Gets column mezua
     *
     * @return text
     */
    public function getMezua()
    {
        return $this->_mezua;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Mezuak
     */
    public function setMota($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_mota != $data) {
            $this->_logChange('mota');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mota = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_motaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for mota'));
            }
            $this->_mota = (string) $data;

        } else {
            $this->_mota = $data;
        }
        return $this;
    }

    /**
     * Gets column mota
     *
     * @return string
     */
    public function getMota()
    {
        return $this->_mota;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Mezuak
     */
    public function setIkusita($data)
    {

        if ($this->_ikusita != $data) {
            $this->_logChange('ikusita');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ikusita = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_ikusitaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for ikusita'));
            }
            $this->_ikusita = (string) $data;

        } else {
            $this->_ikusita = $data;
        }
        return $this;
    }

    /**
     * Gets column ikusita
     *
     * @return string
     */
    public function getIkusita()
    {
        return $this->_ikusita;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Mezuak
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
     * @return \Klikasi\Model\Raw\Mezuak
     */
    public function setEdukiaId($data)
    {

        if ($this->_edukiaId != $data) {
            $this->_logChange('edukiaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_edukiaId = $data;

        } else if (!is_null($data)) {
            $this->_edukiaId = (int) $data;

        } else {
            $this->_edukiaId = $data;
        }
        return $this;
    }

    /**
     * Gets column edukiaId
     *
     * @return int
     */
    public function getEdukiaId()
    {
        return $this->_edukiaId;
    }

    /**
     * Sets parent relation Nork
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\Mezuak
     */
    public function setNork(\Klikasi\Model\Raw\Erabiltzailea $data)
    {
        $this->_Nork = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setNorkId($primaryKey);
        }

        $this->_setLoaded('FkMezuakErabiltzailea1');
        return $this;
    }

    /**
     * Gets parent Nork
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getNork($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkMezuakErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Nork = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Nork;
    }

    /**
     * Sets parent relation Nori
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\Mezuak
     */
    public function setNori(\Klikasi\Model\Raw\Erabiltzailea $data)
    {
        $this->_Nori = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setNoriId($primaryKey);
        }

        $this->_setLoaded('FkMezuakErabiltzailea2');
        return $this;
    }

    /**
     * Gets parent Nori
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getNori($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkMezuakErabiltzailea2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Nori = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Nori;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Mezuak
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Mezuak')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Mezuak);

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
     * @return null | \Klikasi\Model\Validator\Mezuak
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Mezuak')) {

                $this->setValidator(new \Klikasi\Validator\Mezuak);
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
     * @see \Mapper\Sql\Mezuak::delete
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