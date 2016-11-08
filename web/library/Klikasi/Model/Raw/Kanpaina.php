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
class Kanpaina extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_irudiaFso;
    /*
     * @var \Iron_Model_Fso
     */
    protected $_banerraFso;

    protected $_widgetEdukiakOrdenaAcceptedValues = array(
        'data',
        'karma',
    );
    protected $_widgetIkastegiakOrdenaAcceptedValues = array(
        'edukiKopurua',
        'data',
        'karma',
        'erabiltzaileKopurua',
    );
    protected $_widgetErabiltzaileakOrdenaAcceptedValues = array(
        'edukiKopurua',
        'data',
        'karma',
    );
    protected $_widgetKategoriakOrdenaAcceptedValues = array(
        'edukiKopurua',
        'data',
        'karma',
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
    protected $_izena;

    /**
     * [html]
     * Database var type mediumtext
     *
     * @var text
     */
    protected $_deskribapena;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_kodea;

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
     * [FSO]
     * Database var type int
     *
     * @var int
     */
    protected $_banerraFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_banerraMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_banerraBaseName;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_egoera;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_kanpaina;

    /**
     * Database var type date
     *
     * @var string
     */
    protected $_hasiera;

    /**
     * Database var type date
     *
     * @var string
     */
    protected $_bukaera;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_widgetEdukiak;

    /**
     * [enum:data|karma]
     * Database var type varchar
     *
     * @var string
     */
    protected $_widgetEdukiakOrdena;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_widgetIkastegiak;

    /**
     * [enum:edukiKopurua|data|karma|erabiltzaileKopurua]
     * Database var type varchar
     *
     * @var string
     */
    protected $_widgetIkastegiakOrdena;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_widgetErabiltzaileak;

    /**
     * [enum:edukiKopurua|data|karma]
     * Database var type varchar
     *
     * @var string
     */
    protected $_widgetErabiltzaileakOrdena;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_widgetKategoriak;

    /**
     * [enum:edukiKopurua|data|karma]
     * Database var type varchar
     *
     * @var string
     */
    protected $_widgetKategoriakOrdena;

    /**
     * [urlIdentifier:izena]
     * Database var type varchar
     *
     * @var string
     */
    protected $_url;



    /**
     * Dependent relation fk_Kanpaina_has_Edukia_Kanpaina1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EdukiaRelKanpaina[]
     */
    protected $_EdukiaRelKanpaina;

    /**
     * Dependent relation KanpainaRelEdukiKategoriak_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\KanpainaRelEdukiKategoriak[]
     */
    protected $_KanpainaRelEdukiKategoriak;

    /**
     * Dependent relation KanpainaRelIkastegiMota_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\KanpainaRelIkastegiMota[]
     */
    protected $_KanpainaRelIkastegiMota;

    /**
     * Dependent relation KanpainaRelKategoria_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\KanpainaRelKategoria[]
     */
    protected $_KanpainaRelKategoria;

    protected $_columnsList = array(
        'id'=>'id',
        'izena'=>'izena',
        'deskribapena'=>'deskribapena',
        'kodea'=>'kodea',
        'irudiaFileSize'=>'irudiaFileSize',
        'irudiaMimeType'=>'irudiaMimeType',
        'irudiaBaseName'=>'irudiaBaseName',
        'banerraFileSize'=>'banerraFileSize',
        'banerraMimeType'=>'banerraMimeType',
        'banerraBaseName'=>'banerraBaseName',
        'egoera'=>'egoera',
        'kanpaina'=>'kanpaina',
        'hasiera'=>'hasiera',
        'bukaera'=>'bukaera',
        'widgetEdukiak'=>'widgetEdukiak',
        'widgetEdukiakOrdena'=>'widgetEdukiakOrdena',
        'widgetIkastegiak'=>'widgetIkastegiak',
        'widgetIkastegiakOrdena'=>'widgetIkastegiakOrdena',
        'widgetErabiltzaileak'=>'widgetErabiltzaileak',
        'widgetErabiltzaileakOrdena'=>'widgetErabiltzaileakOrdena',
        'widgetKategoriak'=>'widgetKategoriak',
        'widgetKategoriakOrdena'=>'widgetKategoriakOrdena',
        'url'=>'url',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'deskribapena'=> array('html'),
            'irudiaFileSize'=> array('FSO'),
            'banerraFileSize'=> array('FSO'),
            'widgetEdukiakOrdena'=> array('enum:data|karma'),
            'widgetIkastegiakOrdena'=> array('enum:edukiKopurua|data|karma|erabiltzaileKopurua'),
            'widgetErabiltzaileakOrdena'=> array('enum:edukiKopurua|data|karma'),
            'widgetKategoriakOrdena'=> array('enum:edukiKopurua|data|karma'),
            'url'=> array('urlIdentifier:izena'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'FkKanpainaHasEdukiaKanpaina1' => array(
                    'property' => 'EdukiaRelKanpaina',
                    'table_name' => 'EdukiaRelKanpaina',
                ),
            'KanpainaRelEdukiKategoriakIbfk1' => array(
                    'property' => 'KanpainaRelEdukiKategoriak',
                    'table_name' => 'KanpainaRelEdukiKategoriak',
                ),
            'KanpainaRelIkastegiMotaIbfk1' => array(
                    'property' => 'KanpainaRelIkastegiMota',
                    'table_name' => 'KanpainaRelIkastegiMota',
                ),
            'KanpainaRelKategoriaIbfk1' => array(
                    'property' => 'KanpainaRelKategoria',
                    'table_name' => 'KanpainaRelKategoria',
                ),
        ));




        $this->_defaultValues = array(
            'egoera' => '0',
            'kanpaina' => '0',
            'widgetEdukiak' => '0',
            'widgetIkastegiak' => '0',
            'widgetErabiltzaileak' => '0',
            'widgetKategoriak' => '0',
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
        $this->_banerraFso = new \Iron_Model_Fso($this, $this->getBanerraSpecs());

        return $this;
    }

    public function getFileObjects()
    {

        return array('irudia','banerra');
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

    public function getBanerraSpecs()
    {
        return array(
            'basePath' => 'banerra',
            'sizeName' => 'banerraFileSize',
            'mimeName' => 'banerraMimeType',
            'baseNameName' => 'banerraBaseName',
        );
    }

    public function putBanerra($filePath = '',$baseName = '')
    {
        $this->_banerraFso->put($filePath);

        if (!empty($baseName)) {

            $this->_banerraFso->setBaseName($baseName);
        }
    }

    public function fetchBanerra($autoload = true)
    {
        if ($autoload === true && $this->getbanerraFileSize() > 0) {

            $this->_banerraFso->fetch();
        }

        return $this->_banerraFso;
    }

    public function removeBanerra()
    {
        $this->_banerraFso->remove();
        $this->_banerraFso = null;

        return true;
    }

    public function getBanerraUrl($profile)
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
     * @return \Klikasi\Model\Raw\Kanpaina
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
     * @return \Klikasi\Model\Raw\Kanpaina
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
     * @param text $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setDeskribapena($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_deskribapena != $data) {
            $this->_logChange('deskribapena');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_deskribapena = $data;

        } else if (!is_null($data)) {
            $this->_deskribapena = (string) $data;

        } else {
            $this->_deskribapena = $data;
        }
        return $this;
    }

    /**
     * Gets column deskribapena
     *
     * @return text
     */
    public function getDeskribapena()
    {
        $pathFixer = new \Iron_Filter_PathFixer;
        return $pathFixer->fix($this->_deskribapena);
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setKodea($data)
    {

        if ($this->_kodea != $data) {
            $this->_logChange('kodea');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_kodea = $data;

        } else if (!is_null($data)) {
            $this->_kodea = (string) $data;

        } else {
            $this->_kodea = $data;
        }
        return $this;
    }

    /**
     * Gets column kodea
     *
     * @return string
     */
    public function getKodea()
    {
        return $this->_kodea;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Kanpaina
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
     * @return \Klikasi\Model\Raw\Kanpaina
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
     * @return \Klikasi\Model\Raw\Kanpaina
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
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setBanerraFileSize($data)
    {

        if ($this->_banerraFileSize != $data) {
            $this->_logChange('banerraFileSize');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_banerraFileSize = $data;

        } else if (!is_null($data)) {
            $this->_banerraFileSize = (int) $data;

        } else {
            $this->_banerraFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column banerraFileSize
     *
     * @return int
     */
    public function getBanerraFileSize()
    {
        return $this->_banerraFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setBanerraMimeType($data)
    {

        if ($this->_banerraMimeType != $data) {
            $this->_logChange('banerraMimeType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_banerraMimeType = $data;

        } else if (!is_null($data)) {
            $this->_banerraMimeType = (string) $data;

        } else {
            $this->_banerraMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column banerraMimeType
     *
     * @return string
     */
    public function getBanerraMimeType()
    {
        return $this->_banerraMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setBanerraBaseName($data)
    {

        if ($this->_banerraBaseName != $data) {
            $this->_logChange('banerraBaseName');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_banerraBaseName = $data;

        } else if (!is_null($data)) {
            $this->_banerraBaseName = (string) $data;

        } else {
            $this->_banerraBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column banerraBaseName
     *
     * @return string
     */
    public function getBanerraBaseName()
    {
        return $this->_banerraBaseName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setEgoera($data)
    {

        if ($this->_egoera != $data) {
            $this->_logChange('egoera');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_egoera = $data;

        } else if (!is_null($data)) {
            $this->_egoera = (int) $data;

        } else {
            $this->_egoera = $data;
        }
        return $this;
    }

    /**
     * Gets column egoera
     *
     * @return int
     */
    public function getEgoera()
    {
        return $this->_egoera;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setKanpaina($data)
    {

        if ($this->_kanpaina != $data) {
            $this->_logChange('kanpaina');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_kanpaina = $data;

        } else if (!is_null($data)) {
            $this->_kanpaina = (int) $data;

        } else {
            $this->_kanpaina = $data;
        }
        return $this;
    }

    /**
     * Gets column kanpaina
     *
     * @return int
     */
    public function getKanpaina()
    {
        return $this->_kanpaina;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setHasiera($data)
    {
        if ($data == '0000-00-00') {
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

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_hasiera != $data) {
            $this->_logChange('hasiera');
        }

        $this->_hasiera = $data;
        return $this;
    }

    /**
     * Gets column hasiera
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getHasiera($returnZendDate = false)
    {
        if (is_null($this->_hasiera)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_hasiera->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_hasiera->format('Y-m-d');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setBukaera($data)
    {
        if ($data == '0000-00-00') {
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

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_bukaera != $data) {
            $this->_logChange('bukaera');
        }

        $this->_bukaera = $data;
        return $this;
    }

    /**
     * Gets column bukaera
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getBukaera($returnZendDate = false)
    {
        if (is_null($this->_bukaera)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_bukaera->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_bukaera->format('Y-m-d');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setWidgetEdukiak($data)
    {

        if ($this->_widgetEdukiak != $data) {
            $this->_logChange('widgetEdukiak');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_widgetEdukiak = $data;

        } else if (!is_null($data)) {
            $this->_widgetEdukiak = (int) $data;

        } else {
            $this->_widgetEdukiak = $data;
        }
        return $this;
    }

    /**
     * Gets column widgetEdukiak
     *
     * @return int
     */
    public function getWidgetEdukiak()
    {
        return $this->_widgetEdukiak;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setWidgetEdukiakOrdena($data)
    {

        if ($this->_widgetEdukiakOrdena != $data) {
            $this->_logChange('widgetEdukiakOrdena');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_widgetEdukiakOrdena = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_widgetEdukiakOrdenaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for widgetEdukiakOrdena'));
            }
            $this->_widgetEdukiakOrdena = (string) $data;

        } else {
            $this->_widgetEdukiakOrdena = $data;
        }
        return $this;
    }

    /**
     * Gets column widgetEdukiakOrdena
     *
     * @return string
     */
    public function getWidgetEdukiakOrdena()
    {
        return $this->_widgetEdukiakOrdena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setWidgetIkastegiak($data)
    {

        if ($this->_widgetIkastegiak != $data) {
            $this->_logChange('widgetIkastegiak');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_widgetIkastegiak = $data;

        } else if (!is_null($data)) {
            $this->_widgetIkastegiak = (int) $data;

        } else {
            $this->_widgetIkastegiak = $data;
        }
        return $this;
    }

    /**
     * Gets column widgetIkastegiak
     *
     * @return int
     */
    public function getWidgetIkastegiak()
    {
        return $this->_widgetIkastegiak;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setWidgetIkastegiakOrdena($data)
    {

        if ($this->_widgetIkastegiakOrdena != $data) {
            $this->_logChange('widgetIkastegiakOrdena');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_widgetIkastegiakOrdena = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_widgetIkastegiakOrdenaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for widgetIkastegiakOrdena'));
            }
            $this->_widgetIkastegiakOrdena = (string) $data;

        } else {
            $this->_widgetIkastegiakOrdena = $data;
        }
        return $this;
    }

    /**
     * Gets column widgetIkastegiakOrdena
     *
     * @return string
     */
    public function getWidgetIkastegiakOrdena()
    {
        return $this->_widgetIkastegiakOrdena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setWidgetErabiltzaileak($data)
    {

        if ($this->_widgetErabiltzaileak != $data) {
            $this->_logChange('widgetErabiltzaileak');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_widgetErabiltzaileak = $data;

        } else if (!is_null($data)) {
            $this->_widgetErabiltzaileak = (int) $data;

        } else {
            $this->_widgetErabiltzaileak = $data;
        }
        return $this;
    }

    /**
     * Gets column widgetErabiltzaileak
     *
     * @return int
     */
    public function getWidgetErabiltzaileak()
    {
        return $this->_widgetErabiltzaileak;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setWidgetErabiltzaileakOrdena($data)
    {

        if ($this->_widgetErabiltzaileakOrdena != $data) {
            $this->_logChange('widgetErabiltzaileakOrdena');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_widgetErabiltzaileakOrdena = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_widgetErabiltzaileakOrdenaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for widgetErabiltzaileakOrdena'));
            }
            $this->_widgetErabiltzaileakOrdena = (string) $data;

        } else {
            $this->_widgetErabiltzaileakOrdena = $data;
        }
        return $this;
    }

    /**
     * Gets column widgetErabiltzaileakOrdena
     *
     * @return string
     */
    public function getWidgetErabiltzaileakOrdena()
    {
        return $this->_widgetErabiltzaileakOrdena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setWidgetKategoriak($data)
    {

        if ($this->_widgetKategoriak != $data) {
            $this->_logChange('widgetKategoriak');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_widgetKategoriak = $data;

        } else if (!is_null($data)) {
            $this->_widgetKategoriak = (int) $data;

        } else {
            $this->_widgetKategoriak = $data;
        }
        return $this;
    }

    /**
     * Gets column widgetKategoriak
     *
     * @return int
     */
    public function getWidgetKategoriak()
    {
        return $this->_widgetKategoriak;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setWidgetKategoriakOrdena($data)
    {

        if ($this->_widgetKategoriakOrdena != $data) {
            $this->_logChange('widgetKategoriakOrdena');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_widgetKategoriakOrdena = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_widgetKategoriakOrdenaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for widgetKategoriakOrdena'));
            }
            $this->_widgetKategoriakOrdena = (string) $data;

        } else {
            $this->_widgetKategoriakOrdena = $data;
        }
        return $this;
    }

    /**
     * Gets column widgetKategoriakOrdena
     *
     * @return string
     */
    public function getWidgetKategoriakOrdena()
    {
        return $this->_widgetKategoriakOrdena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Kanpaina
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
     * Sets dependent relations fk_Kanpaina_has_Edukia_Kanpaina1
     *
     * @param array $data An array of \Klikasi\Model\Raw\EdukiaRelKanpaina
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setEdukiaRelKanpaina(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_EdukiaRelKanpaina === null) {

                $this->getEdukiaRelKanpaina();
            }

            $oldRelations = $this->_EdukiaRelKanpaina;

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

        $this->_EdukiaRelKanpaina = array();

        foreach ($data as $object) {
            $this->addEdukiaRelKanpaina($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Kanpaina_has_Edukia_Kanpaina1
     *
     * @param \Klikasi\Model\Raw\EdukiaRelKanpaina $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function addEdukiaRelKanpaina(\Klikasi\Model\Raw\EdukiaRelKanpaina $data)
    {
        $this->_EdukiaRelKanpaina[] = $data;
        $this->_setLoaded('FkKanpainaHasEdukiaKanpaina1');
        return $this;
    }

    /**
     * Gets dependent fk_Kanpaina_has_Edukia_Kanpaina1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EdukiaRelKanpaina
     */
    public function getEdukiaRelKanpaina($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkKanpainaHasEdukiaKanpaina1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_EdukiaRelKanpaina = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_EdukiaRelKanpaina;
    }

    /**
     * Sets dependent relations KanpainaRelEdukiKategoriak_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\KanpainaRelEdukiKategoriak
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setKanpainaRelEdukiKategoriak(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KanpainaRelEdukiKategoriak === null) {

                $this->getKanpainaRelEdukiKategoriak();
            }

            $oldRelations = $this->_KanpainaRelEdukiKategoriak;

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

        $this->_KanpainaRelEdukiKategoriak = array();

        foreach ($data as $object) {
            $this->addKanpainaRelEdukiKategoriak($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations KanpainaRelEdukiKategoriak_ibfk_1
     *
     * @param \Klikasi\Model\Raw\KanpainaRelEdukiKategoriak $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function addKanpainaRelEdukiKategoriak(\Klikasi\Model\Raw\KanpainaRelEdukiKategoriak $data)
    {
        $this->_KanpainaRelEdukiKategoriak[] = $data;
        $this->_setLoaded('KanpainaRelEdukiKategoriakIbfk1');
        return $this;
    }

    /**
     * Gets dependent KanpainaRelEdukiKategoriak_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\KanpainaRelEdukiKategoriak
     */
    public function getKanpainaRelEdukiKategoriak($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelEdukiKategoriakIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KanpainaRelEdukiKategoriak = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KanpainaRelEdukiKategoriak;
    }

    /**
     * Sets dependent relations KanpainaRelIkastegiMota_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\KanpainaRelIkastegiMota
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setKanpainaRelIkastegiMota(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KanpainaRelIkastegiMota === null) {

                $this->getKanpainaRelIkastegiMota();
            }

            $oldRelations = $this->_KanpainaRelIkastegiMota;

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

        $this->_KanpainaRelIkastegiMota = array();

        foreach ($data as $object) {
            $this->addKanpainaRelIkastegiMota($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations KanpainaRelIkastegiMota_ibfk_1
     *
     * @param \Klikasi\Model\Raw\KanpainaRelIkastegiMota $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function addKanpainaRelIkastegiMota(\Klikasi\Model\Raw\KanpainaRelIkastegiMota $data)
    {
        $this->_KanpainaRelIkastegiMota[] = $data;
        $this->_setLoaded('KanpainaRelIkastegiMotaIbfk1');
        return $this;
    }

    /**
     * Gets dependent KanpainaRelIkastegiMota_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\KanpainaRelIkastegiMota
     */
    public function getKanpainaRelIkastegiMota($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelIkastegiMotaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KanpainaRelIkastegiMota = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KanpainaRelIkastegiMota;
    }

    /**
     * Sets dependent relations KanpainaRelKategoria_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\KanpainaRelKategoria
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function setKanpainaRelKategoria(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KanpainaRelKategoria === null) {

                $this->getKanpainaRelKategoria();
            }

            $oldRelations = $this->_KanpainaRelKategoria;

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

        $this->_KanpainaRelKategoria = array();

        foreach ($data as $object) {
            $this->addKanpainaRelKategoria($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations KanpainaRelKategoria_ibfk_1
     *
     * @param \Klikasi\Model\Raw\KanpainaRelKategoria $data
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function addKanpainaRelKategoria(\Klikasi\Model\Raw\KanpainaRelKategoria $data)
    {
        $this->_KanpainaRelKategoria[] = $data;
        $this->_setLoaded('KanpainaRelKategoriaIbfk1');
        return $this;
    }

    /**
     * Gets dependent KanpainaRelKategoria_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\KanpainaRelKategoria
     */
    public function getKanpainaRelKategoria($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelKategoriaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KanpainaRelKategoria = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KanpainaRelKategoria;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Kanpaina
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Kanpaina')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Kanpaina);

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
     * @return null | \Klikasi\Model\Validator\Kanpaina
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Kanpaina')) {

                $this->setValidator(new \Klikasi\Validator\Kanpaina);
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
     * @see \Mapper\Sql\Kanpaina::delete
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