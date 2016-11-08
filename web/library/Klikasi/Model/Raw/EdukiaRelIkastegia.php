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
class EdukiaRelIkastegia extends ModelAbstract
{

    protected $_egoeraAcceptedValues = array(
        'onartzeko',
        'onartua',
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
    protected $_edukiaId;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_ikastegiaId;

    /**
     * [enum:onartzeko|onartua]
     * Database var type varchar
     *
     * @var string
     */
    protected $_egoera;


    /**
     * Parent relation EdukiaRelIkastegia_ibfk_1
     *
     * @var \Klikasi\Model\Raw\Edukia
     */
    protected $_Edukia;

    /**
     * Parent relation EdukiaRelIkastegia_ibfk_2
     *
     * @var \Klikasi\Model\Raw\Ikastegia
     */
    protected $_Ikastegia;


    protected $_columnsList = array(
        'id'=>'id',
        'edukiaId'=>'edukiaId',
        'ikastegiaId'=>'ikastegiaId',
        'egoera'=>'egoera',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'egoera'=> array('enum:onartzeko|onartua'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
            'EdukiaRelIkastegiaIbfk1'=> array(
                    'property' => 'Edukia',
                    'table_name' => 'Edukia',
                ),
            'EdukiaRelIkastegiaIbfk2'=> array(
                    'property' => 'Ikastegia',
                    'table_name' => 'Ikastegia',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
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
     * @return \Klikasi\Model\Raw\EdukiaRelIkastegia
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
     * @return \Klikasi\Model\Raw\EdukiaRelIkastegia
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
     * @param int $data
     * @return \Klikasi\Model\Raw\EdukiaRelIkastegia
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
     * @param string $data
     * @return \Klikasi\Model\Raw\EdukiaRelIkastegia
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
     * Sets parent relation Edukia
     *
     * @param \Klikasi\Model\Raw\Edukia $data
     * @return \Klikasi\Model\Raw\EdukiaRelIkastegia
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

        $this->_setLoaded('EdukiaRelIkastegiaIbfk1');
        return $this;
    }

    /**
     * Gets parent Edukia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function getEdukia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'EdukiaRelIkastegiaIbfk1';

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
     * Sets parent relation Ikastegia
     *
     * @param \Klikasi\Model\Raw\Ikastegia $data
     * @return \Klikasi\Model\Raw\EdukiaRelIkastegia
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

        $this->_setLoaded('EdukiaRelIkastegiaIbfk2');
        return $this;
    }

    /**
     * Gets parent Ikastegia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function getIkastegia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'EdukiaRelIkastegiaIbfk2';

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
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\EdukiaRelIkastegia
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\EdukiaRelIkastegia')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\EdukiaRelIkastegia);

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
     * @return null | \Klikasi\Model\Validator\EdukiaRelIkastegia
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\EdukiaRelIkastegia')) {

                $this->setValidator(new \Klikasi\Validator\EdukiaRelIkastegia);
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
     * @see \Mapper\Sql\EdukiaRelIkastegia::delete
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