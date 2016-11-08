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
class Orrialdea extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_imgFso;

    protected $_publikatuaAcceptedValues = array(
        '0',
        '1',
    );

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
    protected $_titulua;

    /**
     * [html]
     * Database var type text
     *
     * @var text
     */
    protected $_edukia;

    /**
     * [enum:0|1]
     * Database var type varchar
     *
     * @var string
     */
    protected $_publikatua;

    /**
     * [urlIdentifier:titulua]
     * Database var type varchar
     *
     * @var string
     */
    protected $_url;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_sortzeData;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_metaTitle;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_metaDescription;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_metaKeywords;

    /**
     * [FSO]
     * Database var type int
     *
     * @var int
     */
    protected $_imgFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_imgMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_imgBaseName;



    protected $_columnsList = array(
        'id'=>'id',
        'titulua'=>'titulua',
        'edukia'=>'edukia',
        'publikatua'=>'publikatua',
        'url'=>'url',
        'sortzeData'=>'sortzeData',
        'metaTitle'=>'metaTitle',
        'metaDescription'=>'metaDescription',
        'metaKeywords'=>'metaKeywords',
        'imgFileSize'=>'imgFileSize',
        'imgMimeType'=>'imgMimeType',
        'imgBaseName'=>'imgBaseName',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'edukia'=> array('html'),
            'publikatua'=> array('enum:0|1'),
            'url'=> array('urlIdentifier:titulua'),
            'imgFileSize'=> array('FSO'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'publikatua' => '0',
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
        $this->_imgFso = new \Iron_Model_Fso($this, $this->getImgSpecs());

        return $this;
    }

    public function getFileObjects()
    {

        return array('img');
    }

    public function getImgSpecs()
    {
        return array(
            'basePath' => 'img',
            'sizeName' => 'imgFileSize',
            'mimeName' => 'imgMimeType',
            'baseNameName' => 'imgBaseName',
        );
    }

    public function putImg($filePath = '',$baseName = '')
    {
        $this->_imgFso->put($filePath);

        if (!empty($baseName)) {

            $this->_imgFso->setBaseName($baseName);
        }
    }

    public function fetchImg($autoload = true)
    {
        if ($autoload === true && $this->getimgFileSize() > 0) {

            $this->_imgFso->fetch();
        }

        return $this->_imgFso;
    }

    public function removeImg()
    {
        $this->_imgFso->remove();
        $this->_imgFso = null;

        return true;
    }

    public function getImgUrl($profile)
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
     * @return \Klikasi\Model\Raw\Orrialdea
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
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setTitulua($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_titulua != $data) {
            $this->_logChange('titulua');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_titulua = $data;

        } else if (!is_null($data)) {
            $this->_titulua = (string) $data;

        } else {
            $this->_titulua = $data;
        }
        return $this;
    }

    /**
     * Gets column titulua
     *
     * @return string
     */
    public function getTitulua()
    {
        return $this->_titulua;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setEdukia($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_edukia != $data) {
            $this->_logChange('edukia');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_edukia = $data;

        } else if (!is_null($data)) {
            $this->_edukia = (string) $data;

        } else {
            $this->_edukia = $data;
        }
        return $this;
    }

    /**
     * Gets column edukia
     *
     * @return text
     */
    public function getEdukia()
    {
        $pathFixer = new \Iron_Filter_PathFixer;
        return $pathFixer->fix($this->_edukia);
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setPublikatua($data)
    {

        if ($this->_publikatua != $data) {
            $this->_logChange('publikatua');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_publikatua = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_publikatuaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for publikatua'));
            }
            $this->_publikatua = (string) $data;

        } else {
            $this->_publikatua = $data;
        }
        return $this;
    }

    /**
     * Gets column publikatua
     *
     * @return string
     */
    public function getPublikatua()
    {
        return $this->_publikatua;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setUrl($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_url != $data) {
            $this->_logChange('url');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_url = $data;

        } else if (!is_null($data)) {
            $this->_url = (string) $data;

        } else {
            $this->_url = $data;
        }
        return $this;
    }

    /**
     * Gets column url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Orrialdea
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setMetaTitle($data)
    {

        if ($this->_metaTitle != $data) {
            $this->_logChange('metaTitle');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_metaTitle = $data;

        } else if (!is_null($data)) {
            $this->_metaTitle = (string) $data;

        } else {
            $this->_metaTitle = $data;
        }
        return $this;
    }

    /**
     * Gets column metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->_metaTitle;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setMetaDescription($data)
    {

        if ($this->_metaDescription != $data) {
            $this->_logChange('metaDescription');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_metaDescription = $data;

        } else if (!is_null($data)) {
            $this->_metaDescription = (string) $data;

        } else {
            $this->_metaDescription = $data;
        }
        return $this;
    }

    /**
     * Gets column metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->_metaDescription;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setMetaKeywords($data)
    {

        if ($this->_metaKeywords != $data) {
            $this->_logChange('metaKeywords');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_metaKeywords = $data;

        } else if (!is_null($data)) {
            $this->_metaKeywords = (string) $data;

        } else {
            $this->_metaKeywords = $data;
        }
        return $this;
    }

    /**
     * Gets column metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->_metaKeywords;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setImgFileSize($data)
    {

        if ($this->_imgFileSize != $data) {
            $this->_logChange('imgFileSize');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_imgFileSize = $data;

        } else if (!is_null($data)) {
            $this->_imgFileSize = (int) $data;

        } else {
            $this->_imgFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column imgFileSize
     *
     * @return int
     */
    public function getImgFileSize()
    {
        return $this->_imgFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setImgMimeType($data)
    {

        if ($this->_imgMimeType != $data) {
            $this->_logChange('imgMimeType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_imgMimeType = $data;

        } else if (!is_null($data)) {
            $this->_imgMimeType = (string) $data;

        } else {
            $this->_imgMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column imgMimeType
     *
     * @return string
     */
    public function getImgMimeType()
    {
        return $this->_imgMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Orrialdea
     */
    public function setImgBaseName($data)
    {

        if ($this->_imgBaseName != $data) {
            $this->_logChange('imgBaseName');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_imgBaseName = $data;

        } else if (!is_null($data)) {
            $this->_imgBaseName = (string) $data;

        } else {
            $this->_imgBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column imgBaseName
     *
     * @return string
     */
    public function getImgBaseName()
    {
        return $this->_imgBaseName;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Orrialdea
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Orrialdea')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Orrialdea);

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
     * @return null | \Klikasi\Model\Validator\Orrialdea
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Orrialdea')) {

                $this->setValidator(new \Klikasi\Validator\Orrialdea);
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
     * @see \Mapper\Sql\Orrialdea::delete
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