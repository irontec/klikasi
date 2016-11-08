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
class Kontaktua extends ModelAbstract
{


    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_izena;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_posta;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_gaia;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_nondik;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_mezua;



    protected $_columnsList = array(
        'id'=>'id',
        'izena'=>'izena',
        'posta'=>'posta',
        'gaia'=>'gaia',
        'nondik'=>'nondik',
        'mezua'=>'mezua',
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
     * @return \Klikasi\Model\Raw\Kontaktua
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
     * @param string $data
     * @return \Klikasi\Model\Raw\Kontaktua
     */
    public function setIzena($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_izena != $data) {
            $this->_logChange('izena');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_izena = $data;

        } else if (!is_null($data)) {
            $this->_izena = (string) $data;

        } else {
            $this->_izena = $data;
        }
        return $this;
    }

    /**
     * Gets column izena
     *
     * @return string
     */
    public function getIzena()
    {
        return $this->_izena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kontaktua
     */
    public function setPosta($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_posta != $data) {
            $this->_logChange('posta');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_posta = $data;

        } else if (!is_null($data)) {
            $this->_posta = (string) $data;

        } else {
            $this->_posta = $data;
        }
        return $this;
    }

    /**
     * Gets column posta
     *
     * @return string
     */
    public function getPosta()
    {
        return $this->_posta;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kontaktua
     */
    public function setGaia($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_gaia != $data) {
            $this->_logChange('gaia');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_gaia = $data;

        } else if (!is_null($data)) {
            $this->_gaia = (string) $data;

        } else {
            $this->_gaia = $data;
        }
        return $this;
    }

    /**
     * Gets column gaia
     *
     * @return string
     */
    public function getGaia()
    {
        return $this->_gaia;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kontaktua
     */
    public function setNondik($data)
    {

        if ($this->_nondik != $data) {
            $this->_logChange('nondik');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nondik = $data;

        } else if (!is_null($data)) {
            $this->_nondik = (string) $data;

        } else {
            $this->_nondik = $data;
        }
        return $this;
    }

    /**
     * Gets column nondik
     *
     * @return string
     */
    public function getNondik()
    {
        return $this->_nondik;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\Kontaktua
     */
    public function setMezua($data)
    {

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
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Kontaktua
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Kontaktua')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Kontaktua);

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
     * @return null | \Klikasi\Model\Validator\Kontaktua
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Kontaktua')) {

                $this->setValidator(new \Klikasi\Validator\Kontaktua);
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
     * @see \Mapper\Sql\Kontaktua::delete
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