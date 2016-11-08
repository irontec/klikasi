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
class IkastegiaRelGaiak extends ModelAbstract
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
    protected $_ikastegiaId;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_ikastegiGaiaId;


    /**
     * Parent relation IkastegiaRelGaiak_ibfk_1
     *
     * @var \Klikasi\Model\Raw\Ikastegia
     */
    protected $_Ikastegia;

    /**
     * Parent relation IkastegiaRelGaiak_ibfk_2
     *
     * @var \Klikasi\Model\Raw\IkastegiGaiak
     */
    protected $_IkastegiGaia;


    protected $_columnsList = array(
        'id'=>'id',
        'ikastegiaId'=>'ikastegiaId',
        'ikastegiGaiaId'=>'ikastegiGaiaId',
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
            'IkastegiaRelGaiakIbfk1'=> array(
                    'property' => 'Ikastegia',
                    'table_name' => 'Ikastegia',
                ),
            'IkastegiaRelGaiakIbfk2'=> array(
                    'property' => 'IkastegiGaia',
                    'table_name' => 'IkastegiGaiak',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
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
     * @return \Klikasi\Model\Raw\IkastegiaRelGaiak
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
     * @return \Klikasi\Model\Raw\IkastegiaRelGaiak
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
     * @return \Klikasi\Model\Raw\IkastegiaRelGaiak
     */
    public function setIkastegiGaiaId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ikastegiGaiaId != $data) {
            $this->_logChange('ikastegiGaiaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ikastegiGaiaId = $data;

        } else if (!is_null($data)) {
            $this->_ikastegiGaiaId = (int) $data;

        } else {
            $this->_ikastegiGaiaId = $data;
        }
        return $this;
    }

    /**
     * Gets column ikastegiGaiaId
     *
     * @return int
     */
    public function getIkastegiGaiaId()
    {
        return $this->_ikastegiGaiaId;
    }

    /**
     * Sets parent relation Ikastegia
     *
     * @param \Klikasi\Model\Raw\Ikastegia $data
     * @return \Klikasi\Model\Raw\IkastegiaRelGaiak
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

        $this->_setLoaded('IkastegiaRelGaiakIbfk1');
        return $this;
    }

    /**
     * Gets parent Ikastegia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function getIkastegia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IkastegiaRelGaiakIbfk1';

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
     * Sets parent relation IkastegiGaia
     *
     * @param \Klikasi\Model\Raw\IkastegiGaiak $data
     * @return \Klikasi\Model\Raw\IkastegiaRelGaiak
     */
    public function setIkastegiGaia(\Klikasi\Model\Raw\IkastegiGaiak $data)
    {
        $this->_IkastegiGaia = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setIkastegiGaiaId($primaryKey);
        }

        $this->_setLoaded('IkastegiaRelGaiakIbfk2');
        return $this;
    }

    /**
     * Gets parent IkastegiGaia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\IkastegiGaiak
     */
    public function getIkastegiGaia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IkastegiaRelGaiakIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_IkastegiGaia = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_IkastegiGaia;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\IkastegiaRelGaiak
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\IkastegiaRelGaiak')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\IkastegiaRelGaiak);

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
     * @return null | \Klikasi\Model\Validator\IkastegiaRelGaiak
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\IkastegiaRelGaiak')) {

                $this->setValidator(new \Klikasi\Validator\IkastegiaRelGaiak);
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
     * @see \Mapper\Sql\IkastegiaRelGaiak::delete
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