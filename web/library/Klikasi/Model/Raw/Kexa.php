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
class Kexa extends ModelAbstract
{


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
    protected $_edukiaId;

    /**
     * Database var type mediumtext
     *
     * @var text
     */
    protected $_kexa;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_ikusita;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_konponduta;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_sortzeData;


    /**
     * Parent relation Kexa_ibfk_1
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Erabiltzailea;

    /**
     * Parent relation Kexa_ibfk_2
     *
     * @var \Klikasi\Model\Raw\Edukia
     */
    protected $_Edukia;


    protected $_columnsList = array(
        'id'=>'id',
        'erabiltzaileaId'=>'erabiltzaileaId',
        'edukiaId'=>'edukiaId',
        'kexa'=>'kexa',
        'ikusita'=>'ikusita',
        'konponduta'=>'konponduta',
        'sortzeData'=>'sortzeData',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
            'KexaIbfk1'=> array(
                    'property' => 'Erabiltzailea',
                    'table_name' => 'Erabiltzailea',
                ),
            'KexaIbfk2'=> array(
                    'property' => 'Edukia',
                    'table_name' => 'Edukia',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'ikusita' => '0',
            'konponduta' => '0',
            'sortzeData' => 'CURRENT_TIMESTAMP',
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
     * @return \Klikasi\Model\Raw\Kexa
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
     * @return \Klikasi\Model\Raw\Kexa
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
     * @return \Klikasi\Model\Raw\Kexa
     */
    public function setEdukiaId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\Kexa
     */
    public function setKexa($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_kexa != $data) {
            $this->_logChange('kexa');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_kexa = $data;

        } else if (!is_null($data)) {
            $this->_kexa = (string) $data;

        } else {
            $this->_kexa = $data;
        }
        return $this;
    }

    /**
     * Gets column kexa
     *
     * @return text
     */
    public function getKexa()
    {
        return $this->_kexa;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Kexa
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
     * @param int $data
     * @return \Klikasi\Model\Raw\Kexa
     */
    public function setKonponduta($data)
    {

        if ($this->_konponduta != $data) {
            $this->_logChange('konponduta');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_konponduta = $data;

        } else if (!is_null($data)) {
            $this->_konponduta = (int) $data;

        } else {
            $this->_konponduta = $data;
        }
        return $this;
    }

    /**
     * Gets column konponduta
     *
     * @return int
     */
    public function getKonponduta()
    {
        return $this->_konponduta;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Kexa
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
     * Sets parent relation Erabiltzailea
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\Kexa
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

        $this->_setLoaded('KexaIbfk1');
        return $this;
    }

    /**
     * Gets parent Erabiltzailea
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KexaIbfk1';

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
     * Sets parent relation Edukia
     *
     * @param \Klikasi\Model\Raw\Edukia $data
     * @return \Klikasi\Model\Raw\Kexa
     */
    public function setEdukia(\Klikasi\Model\Raw\Edukia $data)
    {
        $this->_Edukia = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setEdukiaId($primaryKey);
        }

        $this->_setLoaded('KexaIbfk2');
        return $this;
    }

    /**
     * Gets parent Edukia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function getEdukia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KexaIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Edukia = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Edukia;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Kexa
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Kexa')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Kexa);

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
     * @return null | \Klikasi\Model\Validator\Kexa
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Kexa')) {

                $this->setValidator(new \Klikasi\Validator\Kexa);
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
     * @see \Mapper\Sql\Kexa::delete
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