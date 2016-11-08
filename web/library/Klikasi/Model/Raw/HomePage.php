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
class HomePage extends ModelAbstract
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
     * Database var type varchar
     *
     * @var string
     */
    protected $_identifier;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_title;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_description;

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



    protected $_columnsList = array(
        'id'=>'id',
        'identifier'=>'identifier',
        'title'=>'title',
        'description'=>'description',
        'irudiaFileSize'=>'irudiaFileSize',
        'irudiaMimeType'=>'irudiaMimeType',
        'irudiaBaseName'=>'irudiaBaseName',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'irudiaFileSize'=> array('FSO'),
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
     * @return \Klikasi\Model\Raw\HomePage
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
     * @return \Klikasi\Model\Raw\HomePage
     */
    public function setIdentifier($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_identifier != $data) {
            $this->_logChange('identifier');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_identifier = $data;

        } else if (!is_null($data)) {
            $this->_identifier = (string) $data;

        } else {
            $this->_identifier = $data;
        }
        return $this;
    }

    /**
     * Gets column identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->_identifier;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\HomePage
     */
    public function setTitle($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_title != $data) {
            $this->_logChange('title');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_title = $data;

        } else if (!is_null($data)) {
            $this->_title = (string) $data;

        } else {
            $this->_title = $data;
        }
        return $this;
    }

    /**
     * Gets column title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\HomePage
     */
    public function setDescription($data)
    {

        if ($this->_description != $data) {
            $this->_logChange('description');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_description = $data;

        } else if (!is_null($data)) {
            $this->_description = (string) $data;

        } else {
            $this->_description = $data;
        }
        return $this;
    }

    /**
     * Gets column description
     *
     * @return text
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\HomePage
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
     * @return \Klikasi\Model\Raw\HomePage
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
     * @return \Klikasi\Model\Raw\HomePage
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
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\HomePage
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\HomePage')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\HomePage);

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
     * @return null | \Klikasi\Model\Validator\HomePage
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\HomePage')) {

                $this->setValidator(new \Klikasi\Validator\HomePage);
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
     * @see \Mapper\Sql\HomePage::delete
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