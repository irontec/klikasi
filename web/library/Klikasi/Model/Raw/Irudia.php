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
class Irudia extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_fitxategiaFso;

    protected $_motaAcceptedValues = array(
        'flickr',
        'pinterest',
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
     * Database var type varchar
     *
     * @var string
     */
    protected $_titulua;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_url;

    /**
     * [FSO]
     * Database var type int
     *
     * @var int
     */
    protected $_fitxategiaFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fitxategiaMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fitxategiaBaseName;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_klikKopurua;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_sortzeData;

    /**
     * [enum:flickr|pinterest]
     * Database var type varchar
     *
     * @var string
     */
    protected $_mota;


    /**
     * Parent relation fk_Irudia_Edukia1
     *
     * @var \Klikasi\Model\Raw\Edukia
     */
    protected $_Edukia;


    protected $_columnsList = array(
        'id'=>'id',
        'edukiaId'=>'edukiaId',
        'titulua'=>'titulua',
        'url'=>'url',
        'fitxategiaFileSize'=>'fitxategiaFileSize',
        'fitxategiaMimeType'=>'fitxategiaMimeType',
        'fitxategiaBaseName'=>'fitxategiaBaseName',
        'klikKopurua'=>'klikKopurua',
        'sortzeData'=>'sortzeData',
        'mota'=>'mota',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'fitxategiaFileSize'=> array('FSO'),
            'mota'=> array('enum:flickr|pinterest'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
            'FkIrudiaEdukia1'=> array(
                    'property' => 'Edukia',
                    'table_name' => 'Edukia',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'klikKopurua' => '0',
            'sortzeData' => 'CURRENT_TIMESTAMP',
            'mota' => 'flickr',
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
        $this->_fitxategiaFso = new \Iron_Model_Fso($this, $this->getFitxategiaSpecs());

        return $this;
    }

    public function getFileObjects()
    {

        return array('fitxategia');
    }

    public function getFitxategiaSpecs()
    {
        return array(
            'basePath' => 'fitxategia',
            'sizeName' => 'fitxategiaFileSize',
            'mimeName' => 'fitxategiaMimeType',
            'baseNameName' => 'fitxategiaBaseName',
        );
    }

    public function putFitxategia($filePath = '',$baseName = '')
    {
        $this->_fitxategiaFso->put($filePath);

        if (!empty($baseName)) {

            $this->_fitxategiaFso->setBaseName($baseName);
        }
    }

    public function fetchFitxategia($autoload = true)
    {
        if ($autoload === true && $this->getfitxategiaFileSize() > 0) {

            $this->_fitxategiaFso->fetch();
        }

        return $this->_fitxategiaFso;
    }

    public function removeFitxategia()
    {
        $this->_fitxategiaFso->remove();
        $this->_fitxategiaFso = null;

        return true;
    }

    public function getFitxategiaUrl($profile)
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
     * @return \Klikasi\Model\Raw\Irudia
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
     * @return \Klikasi\Model\Raw\Irudia
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
     * @param string $data
     * @return \Klikasi\Model\Raw\Irudia
     */
    public function setTitulua($data)
    {

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
     * @param string $data
     * @return \Klikasi\Model\Raw\Irudia
     */
    public function setUrl($data)
    {

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
     * @param int $data
     * @return \Klikasi\Model\Raw\Irudia
     */
    public function setFitxategiaFileSize($data)
    {

        if ($this->_fitxategiaFileSize != $data) {
            $this->_logChange('fitxategiaFileSize');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fitxategiaFileSize = $data;

        } else if (!is_null($data)) {
            $this->_fitxategiaFileSize = (int) $data;

        } else {
            $this->_fitxategiaFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column fitxategiaFileSize
     *
     * @return int
     */
    public function getFitxategiaFileSize()
    {
        return $this->_fitxategiaFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Irudia
     */
    public function setFitxategiaMimeType($data)
    {

        if ($this->_fitxategiaMimeType != $data) {
            $this->_logChange('fitxategiaMimeType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fitxategiaMimeType = $data;

        } else if (!is_null($data)) {
            $this->_fitxategiaMimeType = (string) $data;

        } else {
            $this->_fitxategiaMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column fitxategiaMimeType
     *
     * @return string
     */
    public function getFitxategiaMimeType()
    {
        return $this->_fitxategiaMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Irudia
     */
    public function setFitxategiaBaseName($data)
    {

        if ($this->_fitxategiaBaseName != $data) {
            $this->_logChange('fitxategiaBaseName');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fitxategiaBaseName = $data;

        } else if (!is_null($data)) {
            $this->_fitxategiaBaseName = (string) $data;

        } else {
            $this->_fitxategiaBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column fitxategiaBaseName
     *
     * @return string
     */
    public function getFitxategiaBaseName()
    {
        return $this->_fitxategiaBaseName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Irudia
     */
    public function setKlikKopurua($data)
    {

        if ($this->_klikKopurua != $data) {
            $this->_logChange('klikKopurua');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_klikKopurua = $data;

        } else if (!is_null($data)) {
            $this->_klikKopurua = (int) $data;

        } else {
            $this->_klikKopurua = $data;
        }
        return $this;
    }

    /**
     * Gets column klikKopurua
     *
     * @return int
     */
    public function getKlikKopurua()
    {
        return $this->_klikKopurua;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Irudia
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
     * @return \Klikasi\Model\Raw\Irudia
     */
    public function setMota($data)
    {

        if ($this->_mota != $data) {
            $this->_logChange('mota');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mota = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_motaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for mota'));
            }
            $this->_mota = (string) $data;

        } else {
            $this->_mota = $data;
        }
        return $this;
    }

    /**
     * Gets column mota
     *
     * @return string
     */
    public function getMota()
    {
        return $this->_mota;
    }

    /**
     * Sets parent relation Edukia
     *
     * @param \Klikasi\Model\Raw\Edukia $data
     * @return \Klikasi\Model\Raw\Irudia
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

        $this->_setLoaded('FkIrudiaEdukia1');
        return $this;
    }

    /**
     * Gets parent Edukia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function getEdukia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkIrudiaEdukia1';

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
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Irudia
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Irudia')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Irudia);

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
     * @return null | \Klikasi\Model\Validator\Irudia
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Irudia')) {

                $this->setValidator(new \Klikasi\Validator\Irudia);
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
     * @see \Mapper\Sql\Irudia::delete
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