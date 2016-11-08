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
class Lagunak extends ModelAbstract
{

    protected $_egoeraAcceptedValues = array(
        'eskaera',
        'onartua',
        'ukatua',
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
    protected $_erabiltzaileaId1;

    /**
     * [enum:eskaera|onartua|ukatua]
     * Database var type varchar
     *
     * @var string
     */
    protected $_egoera;


    /**
     * Parent relation fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea1
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Erabiltzailea;

    /**
     * Parent relation fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea2
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_ErabiltzaileaByErabiltzaileaId1;


    protected $_columnsList = array(
        'id'=>'id',
        'erabiltzaileaId'=>'erabiltzaileaId',
        'erabiltzaileaId1'=>'erabiltzaileaId1',
        'egoera'=>'egoera',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'egoera'=> array('enum:eskaera|onartua|ukatua'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
            'FkErabiltzaileaHasErabiltzaileaErabiltzailea1'=> array(
                    'property' => 'Erabiltzailea',
                    'table_name' => 'Erabiltzailea',
                ),
            'FkErabiltzaileaHasErabiltzaileaErabiltzailea2'=> array(
                    'property' => 'ErabiltzaileaByErabiltzaileaId1',
                    'table_name' => 'Erabiltzailea',
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
     * @return \Klikasi\Model\Raw\Lagunak
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
     * @return \Klikasi\Model\Raw\Lagunak
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
     * @return \Klikasi\Model\Raw\Lagunak
     */
    public function setErabiltzaileaId1($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_erabiltzaileaId1 != $data) {
            $this->_logChange('erabiltzaileaId1');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_erabiltzaileaId1 = $data;

        } else if (!is_null($data)) {
            $this->_erabiltzaileaId1 = (int) $data;

        } else {
            $this->_erabiltzaileaId1 = $data;
        }
        return $this;
    }

    /**
     * Gets column erabiltzaileaId1
     *
     * @return int
     */
    public function getErabiltzaileaId1()
    {
        return $this->_erabiltzaileaId1;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Lagunak
     */
    public function setEgoera($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \Klikasi\Model\Raw\Lagunak
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

        $this->_setLoaded('FkErabiltzaileaHasErabiltzaileaErabiltzailea1');
        return $this;
    }

    /**
     * Gets parent Erabiltzailea
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasErabiltzaileaErabiltzailea1';

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
     * Sets parent relation ErabiltzaileaId1
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\Lagunak
     */
    public function setErabiltzaileaByErabiltzaileaId1(\Klikasi\Model\Raw\Erabiltzailea $data)
    {
        $this->_ErabiltzaileaByErabiltzaileaId1 = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setErabiltzaileaId1($primaryKey);
        }

        $this->_setLoaded('FkErabiltzaileaHasErabiltzaileaErabiltzailea2');
        return $this;
    }

    /**
     * Gets parent ErabiltzaileaId1
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzaileaByErabiltzaileaId1($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasErabiltzaileaErabiltzailea2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ErabiltzaileaByErabiltzaileaId1 = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ErabiltzaileaByErabiltzaileaId1;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Lagunak
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Lagunak')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Lagunak);

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
     * @return null | \Klikasi\Model\Validator\Lagunak
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Lagunak')) {

                $this->setValidator(new \Klikasi\Validator\Lagunak);
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
     * @see \Mapper\Sql\Lagunak::delete
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