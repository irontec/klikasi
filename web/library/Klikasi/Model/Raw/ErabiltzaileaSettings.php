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
class ErabiltzaileaSettings extends ModelAbstract
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
     * Database var type tinyint
     *
     * @var int
     */
    protected $_moderazioBerria;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_ikastegiakBerria;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_ikasleEskaera;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_kolaborazioEskaera;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_edukiBerria;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_iruzkinBerria;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_iradokizunBerria;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_gustokoBerria;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_atseginDut;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_edukiariSalaketa;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_mezuBerria;


    /**
     * Parent relation ErabiltzaileaSettings_erabiltzaileaId
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Erabiltzailea;


    protected $_columnsList = array(
        'id'=>'id',
        'erabiltzaileaId'=>'erabiltzaileaId',
        'moderazioBerria'=>'moderazioBerria',
        'ikastegiakBerria'=>'ikastegiakBerria',
        'ikasleEskaera'=>'ikasleEskaera',
        'kolaborazioEskaera'=>'kolaborazioEskaera',
        'edukiBerria'=>'edukiBerria',
        'iruzkinBerria'=>'iruzkinBerria',
        'iradokizunBerria'=>'iradokizunBerria',
        'gustokoBerria'=>'gustokoBerria',
        'atseginDut'=>'atseginDut',
        'edukiariSalaketa'=>'edukiariSalaketa',
        'mezuBerria'=>'mezuBerria',
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
            'ErabiltzaileaSettingsErabiltzaileaId'=> array(
                    'property' => 'Erabiltzailea',
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
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
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
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
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
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setModerazioBerria($data)
    {

        if ($this->_moderazioBerria != $data) {
            $this->_logChange('moderazioBerria');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_moderazioBerria = $data;

        } else if (!is_null($data)) {
            $this->_moderazioBerria = (int) $data;

        } else {
            $this->_moderazioBerria = $data;
        }
        return $this;
    }

    /**
     * Gets column moderazioBerria
     *
     * @return int
     */
    public function getModerazioBerria()
    {
        return $this->_moderazioBerria;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setIkastegiakBerria($data)
    {

        if ($this->_ikastegiakBerria != $data) {
            $this->_logChange('ikastegiakBerria');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ikastegiakBerria = $data;

        } else if (!is_null($data)) {
            $this->_ikastegiakBerria = (int) $data;

        } else {
            $this->_ikastegiakBerria = $data;
        }
        return $this;
    }

    /**
     * Gets column ikastegiakBerria
     *
     * @return int
     */
    public function getIkastegiakBerria()
    {
        return $this->_ikastegiakBerria;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setIkasleEskaera($data)
    {

        if ($this->_ikasleEskaera != $data) {
            $this->_logChange('ikasleEskaera');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ikasleEskaera = $data;

        } else if (!is_null($data)) {
            $this->_ikasleEskaera = (int) $data;

        } else {
            $this->_ikasleEskaera = $data;
        }
        return $this;
    }

    /**
     * Gets column ikasleEskaera
     *
     * @return int
     */
    public function getIkasleEskaera()
    {
        return $this->_ikasleEskaera;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setKolaborazioEskaera($data)
    {

        if ($this->_kolaborazioEskaera != $data) {
            $this->_logChange('kolaborazioEskaera');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_kolaborazioEskaera = $data;

        } else if (!is_null($data)) {
            $this->_kolaborazioEskaera = (int) $data;

        } else {
            $this->_kolaborazioEskaera = $data;
        }
        return $this;
    }

    /**
     * Gets column kolaborazioEskaera
     *
     * @return int
     */
    public function getKolaborazioEskaera()
    {
        return $this->_kolaborazioEskaera;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setEdukiBerria($data)
    {

        if ($this->_edukiBerria != $data) {
            $this->_logChange('edukiBerria');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_edukiBerria = $data;

        } else if (!is_null($data)) {
            $this->_edukiBerria = (int) $data;

        } else {
            $this->_edukiBerria = $data;
        }
        return $this;
    }

    /**
     * Gets column edukiBerria
     *
     * @return int
     */
    public function getEdukiBerria()
    {
        return $this->_edukiBerria;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setIruzkinBerria($data)
    {

        if ($this->_iruzkinBerria != $data) {
            $this->_logChange('iruzkinBerria');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_iruzkinBerria = $data;

        } else if (!is_null($data)) {
            $this->_iruzkinBerria = (int) $data;

        } else {
            $this->_iruzkinBerria = $data;
        }
        return $this;
    }

    /**
     * Gets column iruzkinBerria
     *
     * @return int
     */
    public function getIruzkinBerria()
    {
        return $this->_iruzkinBerria;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setIradokizunBerria($data)
    {

        if ($this->_iradokizunBerria != $data) {
            $this->_logChange('iradokizunBerria');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_iradokizunBerria = $data;

        } else if (!is_null($data)) {
            $this->_iradokizunBerria = (int) $data;

        } else {
            $this->_iradokizunBerria = $data;
        }
        return $this;
    }

    /**
     * Gets column iradokizunBerria
     *
     * @return int
     */
    public function getIradokizunBerria()
    {
        return $this->_iradokizunBerria;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setGustokoBerria($data)
    {

        if ($this->_gustokoBerria != $data) {
            $this->_logChange('gustokoBerria');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_gustokoBerria = $data;

        } else if (!is_null($data)) {
            $this->_gustokoBerria = (int) $data;

        } else {
            $this->_gustokoBerria = $data;
        }
        return $this;
    }

    /**
     * Gets column gustokoBerria
     *
     * @return int
     */
    public function getGustokoBerria()
    {
        return $this->_gustokoBerria;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setAtseginDut($data)
    {

        if ($this->_atseginDut != $data) {
            $this->_logChange('atseginDut');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_atseginDut = $data;

        } else if (!is_null($data)) {
            $this->_atseginDut = (int) $data;

        } else {
            $this->_atseginDut = $data;
        }
        return $this;
    }

    /**
     * Gets column atseginDut
     *
     * @return int
     */
    public function getAtseginDut()
    {
        return $this->_atseginDut;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setEdukiariSalaketa($data)
    {

        if ($this->_edukiariSalaketa != $data) {
            $this->_logChange('edukiariSalaketa');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_edukiariSalaketa = $data;

        } else if (!is_null($data)) {
            $this->_edukiariSalaketa = (int) $data;

        } else {
            $this->_edukiariSalaketa = $data;
        }
        return $this;
    }

    /**
     * Gets column edukiariSalaketa
     *
     * @return int
     */
    public function getEdukiariSalaketa()
    {
        return $this->_edukiariSalaketa;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function setMezuBerria($data)
    {

        if ($this->_mezuBerria != $data) {
            $this->_logChange('mezuBerria');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mezuBerria = $data;

        } else if (!is_null($data)) {
            $this->_mezuBerria = (int) $data;

        } else {
            $this->_mezuBerria = $data;
        }
        return $this;
    }

    /**
     * Gets column mezuBerria
     *
     * @return int
     */
    public function getMezuBerria()
    {
        return $this->_mezuBerria;
    }

    /**
     * Sets parent relation Erabiltzailea
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings
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

        $this->_setLoaded('ErabiltzaileaSettingsErabiltzaileaId');
        return $this;
    }

    /**
     * Gets parent Erabiltzailea
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ErabiltzaileaSettingsErabiltzaileaId';

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
     * @return Klikasi\Mapper\Sql\ErabiltzaileaSettings
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\ErabiltzaileaSettings')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\ErabiltzaileaSettings);

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
     * @return null | \Klikasi\Model\Validator\ErabiltzaileaSettings
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\ErabiltzaileaSettings')) {

                $this->setValidator(new \Klikasi\Validator\ErabiltzaileaSettings);
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
     * @see \Mapper\Sql\ErabiltzaileaSettings::delete
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