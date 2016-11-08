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
class Ikastegia extends ModelAbstract
{
    /*
     * @var \KlearMatrix_Model_Fso
     */
    protected $_irudiaFso;

    protected $_motaAcceptedValues = array(
        'ikastegia',
        'bestelakoa',
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
     * Database var type varchar
     *
     * @var string
     */
    protected $_deskribapenLaburra;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_deskribapena;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_herria;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_probintzia;

    /**
     * [map]
     * Database var type varchar
     *
     * @var string
     */
    protected $_kokapena;

    /**
     * Database var type decimal
     *
     * @var float
     */
    protected $_kokapenaLat;

    /**
     * Database var type decimal
     *
     * @var float
     */
    protected $_kokapenaLng;

    /**
     * [enum:ikastegia|bestelakoa]
     * Database var type varchar
     *
     * @var string
     */
    protected $_mota;

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
     * Database var type varchar
     *
     * @var string
     */
    protected $_linkedin;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_facebook;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_twitter;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_google;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_youtube;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_instagram;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pinterest;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_aktibatua;

    /**
     * [urlIdentifier:izena]
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
     * Dependent relation fk_Edukia_has_Ikastegia_Ikastegia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EdukiaRelIkastegia[]
     */
    protected $_EdukiaRelIkastegia;

    /**
     * Dependent relation fk_Erabiltzailea_has_Ikastegia_Ikastegia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia[]
     */
    protected $_ErabiltzaileaRelIkastegia;

    /**
     * Dependent relation IkastegiaRelGaiak_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\IkastegiaRelGaiak[]
     */
    protected $_IkastegiaRelGaiak;

    /**
     * Dependent relation IkastegiaRelMota_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\IkastegiaRelMota[]
     */
    protected $_IkastegiaRelMota;


    protected $_columnsList = array(
        'id'=>'id',
        'izena'=>'izena',
        'deskribapenLaburra'=>'deskribapenLaburra',
        'deskribapena'=>'deskribapena',
        'herria'=>'herria',
        'probintzia'=>'probintzia',
        'kokapena'=>'kokapena',
        'kokapenaLat'=>'kokapenaLat',
        'kokapenaLng'=>'kokapenaLng',
        'mota'=>'mota',
        'irudiaFileSize'=>'irudiaFileSize',
        'irudiaMimeType'=>'irudiaMimeType',
        'irudiaBaseName'=>'irudiaBaseName',
        'linkedin'=>'linkedin',
        'facebook'=>'facebook',
        'twitter'=>'twitter',
        'google'=>'google',
        'youtube'=>'youtube',
        'instagram'=>'instagram',
        'pinterest'=>'pinterest',
        'aktibatua'=>'aktibatua',
        'url'=>'url',
        'sortzeData'=>'sortzeData',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'kokapena'=> array('map'),
            'mota'=> array('enum:ikastegia|bestelakoa'),
            'irudiaFileSize'=> array('FSO'),
            'url'=> array('urlIdentifier:izena'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'FkEdukiaHasIkastegiaIkastegia1' => array(
                    'property' => 'EdukiaRelIkastegia',
                    'table_name' => 'EdukiaRelIkastegia',
                ),
            'FkErabiltzaileaHasIkastegiaIkastegia1' => array(
                    'property' => 'ErabiltzaileaRelIkastegia',
                    'table_name' => 'ErabiltzaileaRelIkastegia',
                ),
            'IkastegiaRelGaiakIbfk1' => array(
                    'property' => 'IkastegiaRelGaiak',
                    'table_name' => 'IkastegiaRelGaiak',
                ),
            'IkastegiaRelMotaIbfk1' => array(
                    'property' => 'IkastegiaRelMota',
                    'table_name' => 'IkastegiaRelMota',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'fk_Edukia_has_Ikastegia_Ikastegia1',
            'fk_Erabiltzailea_has_Ikastegia_Ikastegia1'
        ));



        $this->_defaultValues = array(
            'mota' => 'ikastegia',
            'aktibatua' => '0',
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
        $this->_irudiaFso = new \KlearMatrix_Model_Fso($this, $this->getIrudiaSpecs());

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



    /**************************************************************************
    *********************************** /FSO ***********************************
    ***************************************************************************/

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setIzena($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_izena != $data) {
            $this->_logChange('izena');
        }

        if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setDeskribapenLaburra($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_deskribapenLaburra != $data) {
            $this->_logChange('deskribapenLaburra');
        }

        if (!is_null($data)) {
            $this->_deskribapenLaburra = (string) $data;
        } else {
            $this->_deskribapenLaburra = $data;
        }
        return $this;
    }

    /**
     * Gets column deskribapenLaburra
     *
     * @return string
     */
    public function getDeskribapenLaburra()
    {
            return $this->_deskribapenLaburra;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setDeskribapena($data)
    {

        if ($this->_deskribapena != $data) {
            $this->_logChange('deskribapena');
        }

        if (!is_null($data)) {
            $this->_deskribapena = (string) $data;
        } else {
            $this->_deskribapena = $data;
        }
        return $this;
    }

    /**
     * Gets column deskribapena
     *
     * @return string
     */
    public function getDeskribapena()
    {
            return $this->_deskribapena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setHerria($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_herria != $data) {
            $this->_logChange('herria');
        }

        if (!is_null($data)) {
            $this->_herria = (string) $data;
        } else {
            $this->_herria = $data;
        }
        return $this;
    }

    /**
     * Gets column herria
     *
     * @return string
     */
    public function getHerria()
    {
            return $this->_herria;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setProbintzia($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_probintzia != $data) {
            $this->_logChange('probintzia');
        }

        if (!is_null($data)) {
            $this->_probintzia = (string) $data;
        } else {
            $this->_probintzia = $data;
        }
        return $this;
    }

    /**
     * Gets column probintzia
     *
     * @return string
     */
    public function getProbintzia()
    {
            return $this->_probintzia;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setKokapena($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_kokapena != $data) {
            $this->_logChange('kokapena');
        }

        if (!is_null($data)) {
            $this->_kokapena = (string) $data;
        } else {
            $this->_kokapena = $data;
        }
        return $this;
    }

    /**
     * Gets column kokapena
     *
     * @return string
     */
    public function getKokapena()
    {
            return $this->_kokapena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setKokapenaLat($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_kokapenaLat != $data) {
            $this->_logChange('kokapenaLat');
        }

        if (!is_null($data)) {
            $this->_kokapenaLat = (float) $data;
        } else {
            $this->_kokapenaLat = $data;
        }
        return $this;
    }

    /**
     * Gets column kokapenaLat
     *
     * @return float
     */
    public function getKokapenaLat()
    {
            return $this->_kokapenaLat;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setKokapenaLng($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_kokapenaLng != $data) {
            $this->_logChange('kokapenaLng');
        }

        if (!is_null($data)) {
            $this->_kokapenaLng = (float) $data;
        } else {
            $this->_kokapenaLng = $data;
        }
        return $this;
    }

    /**
     * Gets column kokapenaLng
     *
     * @return float
     */
    public function getKokapenaLng()
    {
            return $this->_kokapenaLng;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setMota($data)
    {

        if ($this->_mota != $data) {
            $this->_logChange('mota');
        }

        if (!is_null($data)) {
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setIrudiaFileSize($data)
    {

        if ($this->_irudiaFileSize != $data) {
            $this->_logChange('irudiaFileSize');
        }

        if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setIrudiaMimeType($data)
    {

        if ($this->_irudiaMimeType != $data) {
            $this->_logChange('irudiaMimeType');
        }

        if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setIrudiaBaseName($data)
    {

        if ($this->_irudiaBaseName != $data) {
            $this->_logChange('irudiaBaseName');
        }

        if (!is_null($data)) {
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
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setLinkedin($data)
    {

        if ($this->_linkedin != $data) {
            $this->_logChange('linkedin');
        }

        if (!is_null($data)) {
            $this->_linkedin = (string) $data;
        } else {
            $this->_linkedin = $data;
        }
        return $this;
    }

    /**
     * Gets column linkedin
     *
     * @return string
     */
    public function getLinkedin()
    {
            return $this->_linkedin;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setFacebook($data)
    {

        if ($this->_facebook != $data) {
            $this->_logChange('facebook');
        }

        if (!is_null($data)) {
            $this->_facebook = (string) $data;
        } else {
            $this->_facebook = $data;
        }
        return $this;
    }

    /**
     * Gets column facebook
     *
     * @return string
     */
    public function getFacebook()
    {
            return $this->_facebook;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setTwitter($data)
    {

        if ($this->_twitter != $data) {
            $this->_logChange('twitter');
        }

        if (!is_null($data)) {
            $this->_twitter = (string) $data;
        } else {
            $this->_twitter = $data;
        }
        return $this;
    }

    /**
     * Gets column twitter
     *
     * @return string
     */
    public function getTwitter()
    {
            return $this->_twitter;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setGoogle($data)
    {

        if ($this->_google != $data) {
            $this->_logChange('google');
        }

        if (!is_null($data)) {
            $this->_google = (string) $data;
        } else {
            $this->_google = $data;
        }
        return $this;
    }

    /**
     * Gets column google
     *
     * @return string
     */
    public function getGoogle()
    {
            return $this->_google;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setYoutube($data)
    {

        if ($this->_youtube != $data) {
            $this->_logChange('youtube');
        }

        if (!is_null($data)) {
            $this->_youtube = (string) $data;
        } else {
            $this->_youtube = $data;
        }
        return $this;
    }

    /**
     * Gets column youtube
     *
     * @return string
     */
    public function getYoutube()
    {
            return $this->_youtube;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setInstagram($data)
    {

        if ($this->_instagram != $data) {
            $this->_logChange('instagram');
        }

        if (!is_null($data)) {
            $this->_instagram = (string) $data;
        } else {
            $this->_instagram = $data;
        }
        return $this;
    }

    /**
     * Gets column instagram
     *
     * @return string
     */
    public function getInstagram()
    {
            return $this->_instagram;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setPinterest($data)
    {

        if ($this->_pinterest != $data) {
            $this->_logChange('pinterest');
        }

        if (!is_null($data)) {
            $this->_pinterest = (string) $data;
        } else {
            $this->_pinterest = $data;
        }
        return $this;
    }

    /**
     * Gets column pinterest
     *
     * @return string
     */
    public function getPinterest()
    {
            return $this->_pinterest;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setAktibatua($data)
    {

        if ($this->_aktibatua != $data) {
            $this->_logChange('aktibatua');
        }

        if (!is_null($data)) {
            $this->_aktibatua = (int) $data;
        } else {
            $this->_aktibatua = $data;
        }
        return $this;
    }

    /**
     * Gets column aktibatua
     *
     * @return int
     */
    public function getAktibatua()
    {
            return $this->_aktibatua;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setUrl($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_url != $data) {
            $this->_logChange('url');
        }

        if (!is_null($data)) {
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
     * @param string|Zend_Date $date
     * @return \Klikasi\Model\Raw\Ikastegia
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
     * Sets dependent relations fk_Edukia_has_Ikastegia_Ikastegia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\EdukiaRelIkastegia
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setEdukiaRelIkastegia(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_EdukiaRelIkastegia === null) {

                $this->getEdukiaRelIkastegia();
            }

            $oldRelations = $this->_EdukiaRelIkastegia;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    if (is_numeric($pk = $newItem->getPrimaryKey())) {

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

        $this->_EdukiaRelIkastegia = array();

        foreach ($data as $object) {
            $this->addEdukiaRelIkastegia($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Edukia_has_Ikastegia_Ikastegia1
     *
     * @param \Klikasi\Model\Raw\EdukiaRelIkastegia $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function addEdukiaRelIkastegia(\Klikasi\Model\Raw\EdukiaRelIkastegia $data)
    {
        $this->_EdukiaRelIkastegia[] = $data;
        $this->_setLoaded('FkEdukiaHasIkastegiaIkastegia1');
        return $this;
    }

    /**
     * Gets dependent fk_Edukia_has_Ikastegia_Ikastegia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EdukiaRelIkastegia
     */
    public function getEdukiaRelIkastegia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkEdukiaHasIkastegiaIkastegia1';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_EdukiaRelIkastegia = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_EdukiaRelIkastegia;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Ikastegia_Ikastegia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setErabiltzaileaRelIkastegia(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ErabiltzaileaRelIkastegia === null) {

                $this->getErabiltzaileaRelIkastegia();
            }

            $oldRelations = $this->_ErabiltzaileaRelIkastegia;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    if (is_numeric($pk = $newItem->getPrimaryKey())) {

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

        $this->_ErabiltzaileaRelIkastegia = array();

        foreach ($data as $object) {
            $this->addErabiltzaileaRelIkastegia($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Ikastegia_Ikastegia1
     *
     * @param \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function addErabiltzaileaRelIkastegia(\Klikasi\Model\Raw\ErabiltzaileaRelIkastegia $data)
    {
        $this->_ErabiltzaileaRelIkastegia[] = $data;
        $this->_setLoaded('FkErabiltzaileaHasIkastegiaIkastegia1');
        return $this;
    }

    /**
     * Gets dependent fk_Erabiltzailea_has_Ikastegia_Ikastegia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
     */
    public function getErabiltzaileaRelIkastegia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasIkastegiaIkastegia1';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ErabiltzaileaRelIkastegia = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ErabiltzaileaRelIkastegia;
    }

    /**
     * Sets dependent relations IkastegiaRelGaiak_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\IkastegiaRelGaiak
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setIkastegiaRelGaiak(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_IkastegiaRelGaiak === null) {

                $this->getIkastegiaRelGaiak();
            }

            $oldRelations = $this->_IkastegiaRelGaiak;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    if (is_numeric($pk = $newItem->getPrimaryKey())) {

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

        $this->_IkastegiaRelGaiak = array();

        foreach ($data as $object) {
            $this->addIkastegiaRelGaiak($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations IkastegiaRelGaiak_ibfk_1
     *
     * @param \Klikasi\Model\Raw\IkastegiaRelGaiak $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function addIkastegiaRelGaiak(\Klikasi\Model\Raw\IkastegiaRelGaiak $data)
    {
        $this->_IkastegiaRelGaiak[] = $data;
        $this->_setLoaded('IkastegiaRelGaiakIbfk1');
        return $this;
    }

    /**
     * Gets dependent IkastegiaRelGaiak_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\IkastegiaRelGaiak
     */
    public function getIkastegiaRelGaiak($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IkastegiaRelGaiakIbfk1';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IkastegiaRelGaiak = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IkastegiaRelGaiak;
    }

    /**
     * Sets dependent relations IkastegiaRelMota_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\IkastegiaRelMota
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function setIkastegiaRelMota(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_IkastegiaRelMota === null) {

                $this->getIkastegiaRelMota();
            }

            $oldRelations = $this->_IkastegiaRelMota;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    if (is_numeric($pk = $newItem->getPrimaryKey())) {

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

        $this->_IkastegiaRelMota = array();

        foreach ($data as $object) {
            $this->addIkastegiaRelMota($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations IkastegiaRelMota_ibfk_1
     *
     * @param \Klikasi\Model\Raw\IkastegiaRelMota $data
     * @return \Klikasi\Model\Raw\Ikastegia
     */
    public function addIkastegiaRelMota(\Klikasi\Model\Raw\IkastegiaRelMota $data)
    {
        $this->_IkastegiaRelMota[] = $data;
        $this->_setLoaded('IkastegiaRelMotaIbfk1');
        return $this;
    }

    /**
     * Gets dependent IkastegiaRelMota_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\IkastegiaRelMota
     */
    public function getIkastegiaRelMota($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IkastegiaRelMotaIbfk1';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IkastegiaRelMota = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IkastegiaRelMota;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Ikastegia
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Ikastegia')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Ikastegia);

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
     * @return null | \Klikasi\Model\Validator\Ikastegia
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Ikastegia')) {

                $this->setValidator(new \Klikasi\Validator\Ikastegia);
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
     * @see \Mapper\Sql\Ikastegia::delete
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
}
