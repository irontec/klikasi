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
 * 
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 */

namespace Klikasi\Model\Raw;
class ErabiltzaileaRelIkastegia extends ModelAbstract
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
    protected $_ikastegiaId;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_administratzailea;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_jabea;

    /**
     * [enum:onartzeko|onartua|ezOnartua]
     * Database var type varchar
     *
     * @var string
     */
    protected $_egoera;


    /**
     * Parent relation ErabiltzaileaRelIkastegia_ibfk_1
     *
     * @var \Klikasi\Model\Raw\Ikastegia
     */
    protected $_Ikastegia;

    /**
     * Parent relation fk_Erabiltzailea_has_Ikastetxea_Erabiltzailea1
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Erabiltzailea;


    protected $_columnsList = array(
        'id'=>'id',
        'erabiltzaileaId'=>'erabiltzaileaId',
        'ikastegiaId'=>'ikastegiaId',
        'administratzailea'=>'administratzailea',
        'jabea'=>'jabea',
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
            'ErabiltzaileaRelIkastegiaIbfk1'=> array(
                    'property' => 'Ikastegia',
                    'table_name' => 'Ikastegia',
                ),
            'FkErabiltzaileaHasIkastetxeaErabiltzailea1'=> array(
                    'property' => 'Erabiltzailea',
                    'table_name' => 'Erabiltzailea',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'administratzailea' => '0',
            'jabea' => '0',
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
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
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
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
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
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
     */
    public function setIkastegiaId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ikastegiaId != $data) {
            $this->_logChange('ikastegiaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ikastegiaId = $data;

        } else if (!is_null($data)) {
            $this->_ikastegiaId = (int) $data;

        } else {
            $this->_ikastegiaId = $data;
        }
        return $this;
    }

    /**
     * Gets column ikastegiaId
     *
     * @return int
     */
    public function getIkastegiaId()
    {
        return $this->_ikastegiaId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
     */
    public function setAdministratzailea($data)
    {

        if ($this->_administratzailea != $data) {
            $this->_logChange('administratzailea');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_administratzailea = $data;

        } else if (!is_null($data)) {
            $this->_administratzailea = (int) $data;

        } else {
            $this->_administratzailea = $data;
        }
        return $this;
    }

    /**
     * Gets column administratzailea
     *
     * @return int
     */
    public function getAdministratzailea()
    {
        return $this->_administratzailea;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
     */
    public function setJabea($data)
    {

        if ($this->_jabea != $data) {
            $this->_logChange('jabea');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_jabea = $data;

        } else if (!is_null($data)) {
            $this->_jabea = (int) $data;

        } else {
            $this->_jabea = $data;
        }
        return $this;
    }

    /**
     * Gets column jabea
     *
     * @return int
     */
    public function getJabea()
    {
        return $this->_jabea;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
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
     * Sets parent relation Ikastegia
     *
     * @param \Klikasi\Model\Raw\Ikastegia $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
     */
    public function setIkastegia(\Klikasi\Model\Raw\Ikastegia $data)
    {
        $this->_Ikastegia = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setIkastegiaId($primaryKey);
        }

        $this->_setLoaded('ErabiltzaileaRelIkastegiaIbfk1');
        return $this;
    }

    /**
     * Gets parent Ikastegia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function getIkastegia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ErabiltzaileaRelIkastegiaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Ikastegia = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Ikastegia;
    }

    /**
     * Sets parent relation Erabiltzailea
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
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

        $this->_setLoaded('FkErabiltzaileaHasIkastetxeaErabiltzailea1');
        return $this;
    }

    /**
     * Gets parent Erabiltzailea
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasIkastetxeaErabiltzailea1';

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
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia);

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
     * @return null | \Klikasi\Model\Validator\ErabiltzaileaRelIkastegia
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\ErabiltzaileaRelIkastegia')) {

                $this->setValidator(new \Klikasi\Validator\ErabiltzaileaRelIkastegia);
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
     * @see \Mapper\Sql\ErabiltzaileaRelIkastegia::delete
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