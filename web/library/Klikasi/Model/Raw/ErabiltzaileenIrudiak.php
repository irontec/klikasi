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
class ErabiltzaileenIrudiak extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_irudiaFso;


    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_id;

    /**
     * [FSO]
     * Database var type int
     *
     * @var int
     */
    protected $_irudiaFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_irudiaMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_irudiaBaseName;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_partekatua;

    /**
     * [urlIdentifier:irudiaBaseName]
     * Database var type varchar
     *
     * @var string
     */
    protected $_iden;



    /**
     * Dependent relation Erabiltzailea_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea[]
     */
    protected $_Erabiltzailea;

    protected $_columnsList = array(
        'id'=>'id',
        'irudiaFileSize'=>'irudiaFileSize',
        'irudiaMimeType'=>'irudiaMimeType',
        'irudiaBaseName'=>'irudiaBaseName',
        'partekatua'=>'partekatua',
        'iden'=>'iden',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'irudiaFileSize'=> array('FSO'),
            'iden'=> array('urlIdentifier:irudiaBaseName'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'ErabiltzaileaIbfk1' => array(
                    'property' => 'Erabiltzailea',
                    'table_name' => 'Erabiltzailea',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'Erabiltzailea_ibfk_1'
        ));


        $this->_defaultValues = array(
            'partekatua' => '0',
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
        $this->_irudiaFso = new \Iron_Model_Fso($this, $this->getIrudiaSpecs());

        return $this;
    }

    public function getFileObjects()
    {

        return array('irudia');
    }

    public function getIrudiaSpecs()
    {
        return array(
            'basePath' => 'irudia',
            'sizeName' => 'irudiaFileSize',
            'mimeName' => 'irudiaMimeType',
            'baseNameName' => 'irudiaBaseName',
        );
    }

    public function putIrudia($filePath = '',$baseName = '')
    {
        $this->_irudiaFso->put($filePath);

        if (!empty($baseName)) {

            $this->_irudiaFso->setBaseName($baseName);
        }
    }

    public function fetchIrudia($autoload = true)
    {
        if ($autoload === true && $this->getirudiaFileSize() > 0) {

            $this->_irudiaFso->fetch();
        }

        return $this->_irudiaFso;
    }

    public function removeIrudia()
    {
        $this->_irudiaFso->remove();
        $this->_irudiaFso = null;

        return true;
    }

    public function getIrudiaUrl($profile)
    {
        $fsoConfig = \Zend_Registry::get('fsoConfig');
        $profileConf = $fsoConfig->$profile;

        if (is_null($profileConf)) {
            throw new \Exception('Profile invalid. not exist in fso.ini');
        }
        $routeMap = isset($profileConf->routeMap) ? $profileConf->routeMap : $fsoConfig->config->routeMap;

        $fsoColumn = $profileConf->fso;
        $fsoSkipColumns = array(
                $fsoColumn."FileSize",
                $fsoColumn."MimeType",
        );
        $fsoBaseNameColum = $fsoColumn."BaseName";

        foreach ($this->_columnsList as $column) {
            if (in_array($column, $fsoSkipColumns)) {
                continue;
            }
            $getter = "get".ucfirst($column);
            $search = "{".$column."}";
            if ($column == $fsoBaseNameColum) {
                $search = "{basename}";
            }
            $routeMap = str_replace($search, $this->$getter(), $routeMap);
        }

        if (!$routeMap) {
            return null;
        }
        $route = array(
            'profile' => $profile,
            'routeMap' => $routeMap
        );

        $view = new \Zend_View();
        $fsoUrl = $view->serverUrl($view->url($route, 'fso'));

        return $fsoUrl;

    }


    /**************************************************************************
    *********************************** /FSO ***********************************
    ***************************************************************************/

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileenIrudiak
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
     * @return \Klikasi\Model\Raw\ErabiltzaileenIrudiak
     */
    public function setIrudiaFileSize($data)
    {

        if ($this->_irudiaFileSize != $data) {
            $this->_logChange('irudiaFileSize');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_irudiaFileSize = $data;

        } else if (!is_null($data)) {
            $this->_irudiaFileSize = (int) $data;

        } else {
            $this->_irudiaFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column irudiaFileSize
     *
     * @return int
     */
    public function getIrudiaFileSize()
    {
        return $this->_irudiaFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\ErabiltzaileenIrudiak
     */
    public function setIrudiaMimeType($data)
    {

        if ($this->_irudiaMimeType != $data) {
            $this->_logChange('irudiaMimeType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_irudiaMimeType = $data;

        } else if (!is_null($data)) {
            $this->_irudiaMimeType = (string) $data;

        } else {
            $this->_irudiaMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column irudiaMimeType
     *
     * @return string
     */
    public function getIrudiaMimeType()
    {
        return $this->_irudiaMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\ErabiltzaileenIrudiak
     */
    public function setIrudiaBaseName($data)
    {

        if ($this->_irudiaBaseName != $data) {
            $this->_logChange('irudiaBaseName');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_irudiaBaseName = $data;

        } else if (!is_null($data)) {
            $this->_irudiaBaseName = (string) $data;

        } else {
            $this->_irudiaBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column irudiaBaseName
     *
     * @return string
     */
    public function getIrudiaBaseName()
    {
        return $this->_irudiaBaseName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\ErabiltzaileenIrudiak
     */
    public function setPartekatua($data)
    {

        if ($this->_partekatua != $data) {
            $this->_logChange('partekatua');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_partekatua = $data;

        } else if (!is_null($data)) {
            $this->_partekatua = (int) $data;

        } else {
            $this->_partekatua = $data;
        }
        return $this;
    }

    /**
     * Gets column partekatua
     *
     * @return int
     */
    public function getPartekatua()
    {
        return $this->_partekatua;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\ErabiltzaileenIrudiak
     */
    public function setIden($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_iden != $data) {
            $this->_logChange('iden');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_iden = $data;

        } else if (!is_null($data)) {
            $this->_iden = (string) $data;

        } else {
            $this->_iden = $data;
        }
        return $this;
    }

    /**
     * Gets column iden
     *
     * @return string
     */
    public function getIden()
    {
        return $this->_iden;
    }

    /**
     * Sets dependent relations Erabiltzailea_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Erabiltzailea
     * @return \Klikasi\Model\Raw\ErabiltzaileenIrudiak
     */
    public function setErabiltzailea(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Erabiltzailea === null) {

                $this->getErabiltzailea();
            }

            $oldRelations = $this->_Erabiltzailea;

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

        $this->_Erabiltzailea = array();

        foreach ($data as $object) {
            $this->addErabiltzailea($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Erabiltzailea_ibfk_1
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\ErabiltzaileenIrudiak
     */
    public function addErabiltzailea(\Klikasi\Model\Raw\Erabiltzailea $data)
    {
        $this->_Erabiltzailea[] = $data;
        $this->_setLoaded('ErabiltzaileaIbfk1');
        return $this;
    }

    /**
     * Gets dependent Erabiltzailea_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ErabiltzaileaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Erabiltzailea = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Erabiltzailea;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\ErabiltzaileenIrudiak
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\ErabiltzaileenIrudiak')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\ErabiltzaileenIrudiak);

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
     * @return null | \Klikasi\Model\Validator\ErabiltzaileenIrudiak
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\ErabiltzaileenIrudiak')) {

                $this->setValidator(new \Klikasi\Validator\ErabiltzaileenIrudiak);
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
     * @see \Mapper\Sql\ErabiltzaileenIrudiak::delete
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