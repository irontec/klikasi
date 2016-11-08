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
class ErabiltzaileaRelIrakaslea extends ModelAbstract
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
    protected $_irakasleaId;

    /**
     * [enum:onartzeko|onartua|ezOnartua]
     * Database var type varchar
     *
     * @var string
     */
    protected $_egoera;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_ikastegiaId;


    /**
     * Parent relation ErabiltzaileaRelIrakaslea_ikastegiaId
     *
     * @var \Klikasi\Model\Raw\Ikastegia
     */
    protected $_Ikastegia;

    /**
     * Parent relation fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea3
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Erabiltzailea;

    /**
     * Parent relation fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea4
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Irakaslea;


    protected $_columnsList = array(
        'id'=>'id',
        'erabiltzaileaId'=>'erabiltzaileaId',
        'irakasleaId'=>'irakasleaId',
        'egoera'=>'egoera',
        'ikastegiaId'=>'ikastegiaId',
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
            'ErabiltzaileaRelIrakasleaIkastegiaId'=> array(
                    'property' => 'Ikastegia',
                    'table_name' => 'Ikastegia',
                ),
            'FkErabiltzaileaHasErabiltzaileaErabiltzailea3'=> array(
                    'property' => 'Erabiltzailea',
                    'table_name' => 'Erabiltzailea',
                ),
            'FkErabiltzaileaHasErabiltzaileaErabiltzailea4'=> array(
                    'property' => 'Irakaslea',
                    'table_name' => 'Erabiltzailea',
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
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
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
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
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
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
     */
    public function setIrakasleaId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_irakasleaId != $data) {
            $this->_logChange('irakasleaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_irakasleaId = $data;

        } else if (!is_null($data)) {
            $this->_irakasleaId = (int) $data;

        } else {
            $this->_irakasleaId = $data;
        }
        return $this;
    }

    /**
     * Gets column irakasleaId
     *
     * @return int
     */
    public function getIrakasleaId()
    {
        return $this->_irakasleaId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
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
     * Sets parent relation Ikastegia
     *
     * @param \Klikasi\Model\Raw\Ikastegia $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
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

        $this->_setLoaded('ErabiltzaileaRelIrakasleaIkastegiaId');
        return $this;
    }

    /**
     * Gets parent Ikastegia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function getIkastegia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ErabiltzaileaRelIrakasleaIkastegiaId';

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
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
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

        $this->_setLoaded('FkErabiltzaileaHasErabiltzaileaErabiltzailea3');
        return $this;
    }

    /**
     * Gets parent Erabiltzailea
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasErabiltzaileaErabiltzailea3';

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
     * Sets parent relation Irakaslea
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
     */
    public function setIrakaslea(\Klikasi\Model\Raw\Erabiltzailea $data)
    {
        $this->_Irakaslea = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setIrakasleaId($primaryKey);
        }

        $this->_setLoaded('FkErabiltzaileaHasErabiltzaileaErabiltzailea4');
        return $this;
    }

    /**
     * Gets parent Irakaslea
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getIrakaslea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasErabiltzaileaErabiltzailea4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Irakaslea = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Irakaslea;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\ErabiltzaileaRelIrakaslea
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\ErabiltzaileaRelIrakaslea')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\ErabiltzaileaRelIrakaslea);

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
     * @return null | \Klikasi\Model\Validator\ErabiltzaileaRelIrakaslea
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\ErabiltzaileaRelIrakaslea')) {

                $this->setValidator(new \Klikasi\Validator\ErabiltzaileaRelIrakaslea);
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
     * @see \Mapper\Sql\ErabiltzaileaRelIrakaslea::delete
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