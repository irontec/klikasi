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
class Erabiltzailea extends ModelAbstract
{

    protected $_egoeraAcceptedValues = array(
        'sortua',
        'datuakSartuta',
        'aktibatua',
    );
    protected $_profilaAcceptedValues = array(
        'irakasle',
        'otros',
        'ikasle',
    );
    protected $_typeAvatarAcceptedValues = array(
        'default',
        'irudia',
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
    protected $_abizena;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_abizena2;

    /**
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
    protected $_erabiltzaileIzena;

    /**
     * [password]
     * Database var type varchar
     *
     * @var string
     */
    protected $_pasahitza;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_posta;

    /**
     * [enum:sortua|datuakSartuta|aktibatua]
     * Database var type varchar
     *
     * @var string
     */
    protected $_egoera;

    /**
     * [urlIdentifier:erabiltzaileIzena]
     * Database var type varchar
     *
     * @var string
     */
    protected $_url;

    /**
     * Database var type date
     *
     * @var string
     */
    protected $_jaiotzeData;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_sortzeData;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_altaData;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_superErabiltzailea;

    /**
     * [enum:irakasle|otros|ikasle]
     * Database var type varchar
     *
     * @var string
     */
    protected $_profila;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_hash;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_hashIraungiData;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_irudiaId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_irudiaDefault;

    /**
     * [enum:default|irudia]
     * Database var type varchar
     *
     * @var string
     */
    protected $_typeAvatar;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_newsletter;

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
    protected $_facebook;

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
    protected $_linkedin;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pinterest;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_flickr;

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
     * Database var type int
     *
     * @var int
     */
    protected $_karma;


    /**
     * Parent relation Erabiltzailea_ibfk_1
     *
     * @var \Klikasi\Model\Raw\ErabiltzaileenIrudiak
     */
    protected $_Irudia;


    /**
     * Dependent relation AtseginDut_erabiltzaileaId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\AtseginDut[]
     */
    protected $_AtseginDut;

    /**
     * Dependent relation fk_Edukia_Erabiltzailea1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Edukia[]
     */
    protected $_Edukia;

    /**
     * Dependent relation EmailHistory_erabiltzaileaId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EmailHistory[]
     */
    protected $_EmailHistory;

    /**
     * Dependent relation fk_Erabiltzailea_has_Edukia_Erabiltzailea1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\ErabiltzaileaRelEdukia[]
     */
    protected $_ErabiltzaileaRelEdukia;

    /**
     * Dependent relation fk_Erabiltzailea_has_Ikastetxea_Erabiltzailea1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia[]
     */
    protected $_ErabiltzaileaRelIkastegia;

    /**
     * Dependent relation fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea3
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea[]
     */
    protected $_ErabiltzaileaRelIrakasleaByErabiltzailea;

    /**
     * Dependent relation fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea4
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea[]
     */
    protected $_ErabiltzaileaRelIrakasleaByIrakaslea;

    /**
     * Dependent relation ErabiltzaileaSettings_erabiltzaileaId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\ErabiltzaileaSettings[]
     */
    protected $_ErabiltzaileaSettings;

    /**
     * Dependent relation fk_Edukia_has_Erabiltzailea_Erabiltzailea1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Gustokoa[]
     */
    protected $_Gustokoa;

    /**
     * Dependent relation Hobekuntzak_erabiltzaileaId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Hobekuntzak[]
     */
    protected $_Hobekuntzak;

    /**
     * Dependent relation fk_Iruzkina_Erabiltzailea1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Iruzkina[]
     */
    protected $_Iruzkina;

    /**
     * Dependent relation fk_Jakinarazpenak_Erabiltzailea1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Jakinarazpenak[]
     */
    protected $_JakinarazpenakByErabiltzailea;

    /**
     * Dependent relation Jakinarazpenak_thatUserId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Jakinarazpenak[]
     */
    protected $_JakinarazpenakByThatUser;

    /**
     * Dependent relation JakinarazpenakGroup_erabiltzaileaId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\JakinarazpenakGroup[]
     */
    protected $_JakinarazpenakGroup;

    /**
     * Dependent relation Kexa_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Kexa[]
     */
    protected $_Kexa;

    /**
     * Dependent relation fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Lagunak[]
     */
    protected $_LagunakByErabiltzailea;

    /**
     * Dependent relation fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea2
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Lagunak[]
     */
    protected $_LagunakByErabiltzaileaId1;

    /**
     * Dependent relation fk_Mezuak_Erabiltzailea1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Mezuak[]
     */
    protected $_MezuakByNork;

    /**
     * Dependent relation fk_Mezuak_Erabiltzailea2
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Mezuak[]
     */
    protected $_MezuakByNori;

    /**
     * Dependent relation NewsletterHash_erabiltzaileaId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\NewsletterHash[]
     */
    protected $_NewsletterHash;

    protected $_columnsList = array(
        'id'=>'id',
        'izena'=>'izena',
        'abizena'=>'abizena',
        'abizena2'=>'abizena2',
        'deskribapena'=>'deskribapena',
        'erabiltzaileIzena'=>'erabiltzaileIzena',
        'pasahitza'=>'pasahitza',
        'posta'=>'posta',
        'egoera'=>'egoera',
        'url'=>'url',
        'jaiotzeData'=>'jaiotzeData',
        'sortzeData'=>'sortzeData',
        'altaData'=>'altaData',
        'superErabiltzailea'=>'superErabiltzailea',
        'profila'=>'profila',
        'hash'=>'hash',
        'hashIraungiData'=>'hashIraungiData',
        'irudiaId'=>'irudiaId',
        'irudiaDefault'=>'irudiaDefault',
        'typeAvatar'=>'typeAvatar',
        'newsletter'=>'newsletter',
        'twitter'=>'twitter',
        'facebook'=>'facebook',
        'google'=>'google',
        'linkedin'=>'linkedin',
        'pinterest'=>'pinterest',
        'flickr'=>'flickr',
        'youtube'=>'youtube',
        'instagram'=>'instagram',
        'karma'=>'karma',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'pasahitza'=> array('password'),
            'egoera'=> array('enum:sortua|datuakSartuta|aktibatua'),
            'url'=> array('urlIdentifier:erabiltzaileIzena'),
            'profila'=> array('enum:irakasle|otros|ikasle'),
            'typeAvatar'=> array('enum:default|irudia'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
            'ErabiltzaileaIbfk1'=> array(
                    'property' => 'Irudia',
                    'table_name' => 'ErabiltzaileenIrudiak',
                ),
        ));

        $this->setDependentList(array(
            'AtseginDutErabiltzaileaId' => array(
                    'property' => 'AtseginDut',
                    'table_name' => 'AtseginDut',
                ),
            'FkEdukiaErabiltzailea1' => array(
                    'property' => 'Edukia',
                    'table_name' => 'Edukia',
                ),
            'EmailHistoryErabiltzaileaId' => array(
                    'property' => 'EmailHistory',
                    'table_name' => 'EmailHistory',
                ),
            'FkErabiltzaileaHasEdukiaErabiltzailea1' => array(
                    'property' => 'ErabiltzaileaRelEdukia',
                    'table_name' => 'ErabiltzaileaRelEdukia',
                ),
            'FkErabiltzaileaHasIkastetxeaErabiltzailea1' => array(
                    'property' => 'ErabiltzaileaRelIkastegia',
                    'table_name' => 'ErabiltzaileaRelIkastegia',
                ),
            'FkErabiltzaileaHasErabiltzaileaErabiltzailea3' => array(
                    'property' => 'ErabiltzaileaRelIrakasleaByErabiltzailea',
                    'table_name' => 'ErabiltzaileaRelIrakaslea',
                ),
            'FkErabiltzaileaHasErabiltzaileaErabiltzailea4' => array(
                    'property' => 'ErabiltzaileaRelIrakasleaByIrakaslea',
                    'table_name' => 'ErabiltzaileaRelIrakaslea',
                ),
            'ErabiltzaileaSettingsErabiltzaileaId' => array(
                    'property' => 'ErabiltzaileaSettings',
                    'table_name' => 'ErabiltzaileaSettings',
                ),
            'FkEdukiaHasErabiltzaileaErabiltzailea1' => array(
                    'property' => 'Gustokoa',
                    'table_name' => 'Gustokoa',
                ),
            'HobekuntzakErabiltzaileaId' => array(
                    'property' => 'Hobekuntzak',
                    'table_name' => 'Hobekuntzak',
                ),
            'FkIruzkinaErabiltzailea1' => array(
                    'property' => 'Iruzkina',
                    'table_name' => 'Iruzkina',
                ),
            'FkJakinarazpenakErabiltzailea1' => array(
                    'property' => 'JakinarazpenakByErabiltzailea',
                    'table_name' => 'Jakinarazpenak',
                ),
            'JakinarazpenakThatUserId' => array(
                    'property' => 'JakinarazpenakByThatUser',
                    'table_name' => 'Jakinarazpenak',
                ),
            'JakinarazpenakGroupErabiltzaileaId' => array(
                    'property' => 'JakinarazpenakGroup',
                    'table_name' => 'JakinarazpenakGroup',
                ),
            'KexaIbfk1' => array(
                    'property' => 'Kexa',
                    'table_name' => 'Kexa',
                ),
            'FkErabiltzaileaHasErabiltzaileaErabiltzailea1' => array(
                    'property' => 'LagunakByErabiltzailea',
                    'table_name' => 'Lagunak',
                ),
            'FkErabiltzaileaHasErabiltzaileaErabiltzailea2' => array(
                    'property' => 'LagunakByErabiltzaileaId1',
                    'table_name' => 'Lagunak',
                ),
            'FkMezuakErabiltzailea1' => array(
                    'property' => 'MezuakByNork',
                    'table_name' => 'Mezuak',
                ),
            'FkMezuakErabiltzailea2' => array(
                    'property' => 'MezuakByNori',
                    'table_name' => 'Mezuak',
                ),
            'NewsletterHashErabiltzaileaId' => array(
                    'property' => 'NewsletterHash',
                    'table_name' => 'NewsletterHash',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'EmailHistory_erabiltzaileaId'
        ));

        $this->setOnDeleteSetNullRelationships(array(
            'fk_Edukia_Erabiltzailea1'
        ));


        $this->_defaultValues = array(
            'egoera' => 'sortua',
            'sortzeData' => 'CURRENT_TIMESTAMP',
            'superErabiltzailea' => '0',
            'profila' => 'otros',
            'typeAvatar' => 'default',
            'newsletter' => '0',
            'karma' => '0',
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
     * @return \Klikasi\Model\Raw\Erabiltzailea
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
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setIzena($data)
    {

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
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setAbizena($data)
    {

        if ($this->_abizena != $data) {
            $this->_logChange('abizena');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_abizena = $data;

        } else if (!is_null($data)) {
            $this->_abizena = (string) $data;

        } else {
            $this->_abizena = $data;
        }
        return $this;
    }

    /**
     * Gets column abizena
     *
     * @return string
     */
    public function getAbizena()
    {
        return $this->_abizena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setAbizena2($data)
    {

        if ($this->_abizena2 != $data) {
            $this->_logChange('abizena2');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_abizena2 = $data;

        } else if (!is_null($data)) {
            $this->_abizena2 = (string) $data;

        } else {
            $this->_abizena2 = $data;
        }
        return $this;
    }

    /**
     * Gets column abizena2
     *
     * @return string
     */
    public function getAbizena2()
    {
        return $this->_abizena2;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setDeskribapena($data)
    {

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
        return $this->_deskribapena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setErabiltzaileIzena($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_erabiltzaileIzena != $data) {
            $this->_logChange('erabiltzaileIzena');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_erabiltzaileIzena = $data;

        } else if (!is_null($data)) {
            $this->_erabiltzaileIzena = (string) $data;

        } else {
            $this->_erabiltzaileIzena = $data;
        }
        return $this;
    }

    /**
     * Gets column erabiltzaileIzena
     *
     * @return string
     */
    public function getErabiltzaileIzena()
    {
        return $this->_erabiltzaileIzena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setPasahitza($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_pasahitza != $data) {
            $this->_logChange('pasahitza');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pasahitza = $data;

        } else if (!is_null($data)) {
            $this->_pasahitza = (string) $data;

        } else {
            $this->_pasahitza = $data;
        }
        return $this;
    }

    /**
     * Gets column pasahitza
     *
     * @return string
     */
    public function getPasahitza()
    {
        return $this->_pasahitza;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
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
     * @return \Klikasi\Model\Raw\Erabiltzailea
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
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
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
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setJaiotzeData($data)
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
        if ($this->_jaiotzeData != $data) {
            $this->_logChange('jaiotzeData');
        }

        $this->_jaiotzeData = $data;
        return $this;
    }

    /**
     * Gets column jaiotzeData
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getJaiotzeData($returnZendDate = false)
    {
        if (is_null($this->_jaiotzeData)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_jaiotzeData->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_jaiotzeData->format('Y-m-d');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Erabiltzailea
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
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setAltaData($data)
    {
        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }
        if ($data === 'CURRENT_TIMESTAMP') {
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

        if ($this->_altaData != $data) {
            $this->_logChange('altaData');
        }

        $this->_altaData = $data;
        return $this;
    }

    /**
     * Gets column altaData
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getAltaData($returnZendDate = false)
    {
        if (is_null($this->_altaData)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_altaData->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_altaData->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setSuperErabiltzailea($data)
    {

        if ($this->_superErabiltzailea != $data) {
            $this->_logChange('superErabiltzailea');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_superErabiltzailea = $data;

        } else if (!is_null($data)) {
            $this->_superErabiltzailea = (int) $data;

        } else {
            $this->_superErabiltzailea = $data;
        }
        return $this;
    }

    /**
     * Gets column superErabiltzailea
     *
     * @return int
     */
    public function getSuperErabiltzailea()
    {
        return $this->_superErabiltzailea;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setProfila($data)
    {

        if ($this->_profila != $data) {
            $this->_logChange('profila');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_profila = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_profilaAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for profila'));
            }
            $this->_profila = (string) $data;

        } else {
            $this->_profila = $data;
        }
        return $this;
    }

    /**
     * Gets column profila
     *
     * @return string
     */
    public function getProfila()
    {
        return $this->_profila;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setHash($data)
    {

        if ($this->_hash != $data) {
            $this->_logChange('hash');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_hash = $data;

        } else if (!is_null($data)) {
            $this->_hash = (string) $data;

        } else {
            $this->_hash = $data;
        }
        return $this;
    }

    /**
     * Gets column hash
     *
     * @return string
     */
    public function getHash()
    {
        return $this->_hash;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setHashIraungiData($data)
    {
        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }
        if ($data === 'CURRENT_TIMESTAMP') {
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

        if ($this->_hashIraungiData != $data) {
            $this->_logChange('hashIraungiData');
        }

        $this->_hashIraungiData = $data;
        return $this;
    }

    /**
     * Gets column hashIraungiData
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getHashIraungiData($returnZendDate = false)
    {
        if (is_null($this->_hashIraungiData)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_hashIraungiData->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_hashIraungiData->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setIrudiaId($data)
    {

        if ($this->_irudiaId != $data) {
            $this->_logChange('irudiaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_irudiaId = $data;

        } else if (!is_null($data)) {
            $this->_irudiaId = (int) $data;

        } else {
            $this->_irudiaId = $data;
        }
        return $this;
    }

    /**
     * Gets column irudiaId
     *
     * @return int
     */
    public function getIrudiaId()
    {
        return $this->_irudiaId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setIrudiaDefault($data)
    {

        if ($this->_irudiaDefault != $data) {
            $this->_logChange('irudiaDefault');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_irudiaDefault = $data;

        } else if (!is_null($data)) {
            $this->_irudiaDefault = (string) $data;

        } else {
            $this->_irudiaDefault = $data;
        }
        return $this;
    }

    /**
     * Gets column irudiaDefault
     *
     * @return string
     */
    public function getIrudiaDefault()
    {
        return $this->_irudiaDefault;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setTypeAvatar($data)
    {

        if ($this->_typeAvatar != $data) {
            $this->_logChange('typeAvatar');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_typeAvatar = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_typeAvatarAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for typeAvatar'));
            }
            $this->_typeAvatar = (string) $data;

        } else {
            $this->_typeAvatar = $data;
        }
        return $this;
    }

    /**
     * Gets column typeAvatar
     *
     * @return string
     */
    public function getTypeAvatar()
    {
        return $this->_typeAvatar;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setNewsletter($data)
    {

        if ($this->_newsletter != $data) {
            $this->_logChange('newsletter');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_newsletter = $data;

        } else if (!is_null($data)) {
            $this->_newsletter = (int) $data;

        } else {
            $this->_newsletter = $data;
        }
        return $this;
    }

    /**
     * Gets column newsletter
     *
     * @return int
     */
    public function getNewsletter()
    {
        return $this->_newsletter;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setTwitter($data)
    {

        if ($this->_twitter != $data) {
            $this->_logChange('twitter');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_twitter = $data;

        } else if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setFacebook($data)
    {

        if ($this->_facebook != $data) {
            $this->_logChange('facebook');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_facebook = $data;

        } else if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setGoogle($data)
    {

        if ($this->_google != $data) {
            $this->_logChange('google');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_google = $data;

        } else if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setLinkedin($data)
    {

        if ($this->_linkedin != $data) {
            $this->_logChange('linkedin');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_linkedin = $data;

        } else if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setPinterest($data)
    {

        if ($this->_pinterest != $data) {
            $this->_logChange('pinterest');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pinterest = $data;

        } else if (!is_null($data)) {
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
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setFlickr($data)
    {

        if ($this->_flickr != $data) {
            $this->_logChange('flickr');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_flickr = $data;

        } else if (!is_null($data)) {
            $this->_flickr = (string) $data;

        } else {
            $this->_flickr = $data;
        }
        return $this;
    }

    /**
     * Gets column flickr
     *
     * @return string
     */
    public function getFlickr()
    {
        return $this->_flickr;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setYoutube($data)
    {

        if ($this->_youtube != $data) {
            $this->_logChange('youtube');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_youtube = $data;

        } else if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setInstagram($data)
    {

        if ($this->_instagram != $data) {
            $this->_logChange('instagram');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_instagram = $data;

        } else if (!is_null($data)) {
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
     * @param int $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setKarma($data)
    {

        if ($this->_karma != $data) {
            $this->_logChange('karma');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_karma = $data;

        } else if (!is_null($data)) {
            $this->_karma = (int) $data;

        } else {
            $this->_karma = $data;
        }
        return $this;
    }

    /**
     * Gets column karma
     *
     * @return int
     */
    public function getKarma()
    {
        return $this->_karma;
    }

    /**
     * Sets parent relation Irudia
     *
     * @param \Klikasi\Model\Raw\ErabiltzaileenIrudiak $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setIrudia(\Klikasi\Model\Raw\ErabiltzaileenIrudiak $data)
    {
        $this->_Irudia = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setIrudiaId($primaryKey);
        }

        $this->_setLoaded('ErabiltzaileaIbfk1');
        return $this;
    }

    /**
     * Gets parent Irudia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\ErabiltzaileenIrudiak
     */
    public function getIrudia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ErabiltzaileaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Irudia = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Irudia;
    }

    /**
     * Sets dependent relations AtseginDut_erabiltzaileaId
     *
     * @param array $data An array of \Klikasi\Model\Raw\AtseginDut
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setAtseginDut(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_AtseginDut === null) {

                $this->getAtseginDut();
            }

            $oldRelations = $this->_AtseginDut;

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

        $this->_AtseginDut = array();

        foreach ($data as $object) {
            $this->addAtseginDut($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations AtseginDut_erabiltzaileaId
     *
     * @param \Klikasi\Model\Raw\AtseginDut $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addAtseginDut(\Klikasi\Model\Raw\AtseginDut $data)
    {
        $this->_AtseginDut[] = $data;
        $this->_setLoaded('AtseginDutErabiltzaileaId');
        return $this;
    }

    /**
     * Gets dependent AtseginDut_erabiltzaileaId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\AtseginDut
     */
    public function getAtseginDut($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AtseginDutErabiltzaileaId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_AtseginDut = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_AtseginDut;
    }

    /**
     * Sets dependent relations fk_Edukia_Erabiltzailea1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Edukia
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setEdukia(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Edukia === null) {

                $this->getEdukia();
            }

            $oldRelations = $this->_Edukia;

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

        $this->_Edukia = array();

        foreach ($data as $object) {
            $this->addEdukia($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Edukia_Erabiltzailea1
     *
     * @param \Klikasi\Model\Raw\Edukia $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addEdukia(\Klikasi\Model\Raw\Edukia $data)
    {
        $this->_Edukia[] = $data;
        $this->_setLoaded('FkEdukiaErabiltzailea1');
        return $this;
    }

    /**
     * Gets dependent fk_Edukia_Erabiltzailea1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Edukia
     */
    public function getEdukia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkEdukiaErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Edukia = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Edukia;
    }

    /**
     * Sets dependent relations EmailHistory_erabiltzaileaId
     *
     * @param array $data An array of \Klikasi\Model\Raw\EmailHistory
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setEmailHistory(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_EmailHistory === null) {

                $this->getEmailHistory();
            }

            $oldRelations = $this->_EmailHistory;

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

        $this->_EmailHistory = array();

        foreach ($data as $object) {
            $this->addEmailHistory($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations EmailHistory_erabiltzaileaId
     *
     * @param \Klikasi\Model\Raw\EmailHistory $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addEmailHistory(\Klikasi\Model\Raw\EmailHistory $data)
    {
        $this->_EmailHistory[] = $data;
        $this->_setLoaded('EmailHistoryErabiltzaileaId');
        return $this;
    }

    /**
     * Gets dependent EmailHistory_erabiltzaileaId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EmailHistory
     */
    public function getEmailHistory($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'EmailHistoryErabiltzaileaId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_EmailHistory = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_EmailHistory;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Edukia_Erabiltzailea1
     *
     * @param array $data An array of \Klikasi\Model\Raw\ErabiltzaileaRelEdukia
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setErabiltzaileaRelEdukia(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ErabiltzaileaRelEdukia === null) {

                $this->getErabiltzaileaRelEdukia();
            }

            $oldRelations = $this->_ErabiltzaileaRelEdukia;

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

        $this->_ErabiltzaileaRelEdukia = array();

        foreach ($data as $object) {
            $this->addErabiltzaileaRelEdukia($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Edukia_Erabiltzailea1
     *
     * @param \Klikasi\Model\Raw\ErabiltzaileaRelEdukia $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addErabiltzaileaRelEdukia(\Klikasi\Model\Raw\ErabiltzaileaRelEdukia $data)
    {
        $this->_ErabiltzaileaRelEdukia[] = $data;
        $this->_setLoaded('FkErabiltzaileaHasEdukiaErabiltzailea1');
        return $this;
    }

    /**
     * Gets dependent fk_Erabiltzailea_has_Edukia_Erabiltzailea1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\ErabiltzaileaRelEdukia
     */
    public function getErabiltzaileaRelEdukia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasEdukiaErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ErabiltzaileaRelEdukia = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ErabiltzaileaRelEdukia;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Ikastetxea_Erabiltzailea1
     *
     * @param array $data An array of \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
     * @return \Klikasi\Model\Raw\Erabiltzailea
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

        $this->_ErabiltzaileaRelIkastegia = array();

        foreach ($data as $object) {
            $this->addErabiltzaileaRelIkastegia($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Ikastetxea_Erabiltzailea1
     *
     * @param \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addErabiltzaileaRelIkastegia(\Klikasi\Model\Raw\ErabiltzaileaRelIkastegia $data)
    {
        $this->_ErabiltzaileaRelIkastegia[] = $data;
        $this->_setLoaded('FkErabiltzaileaHasIkastetxeaErabiltzailea1');
        return $this;
    }

    /**
     * Gets dependent fk_Erabiltzailea_has_Ikastetxea_Erabiltzailea1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\ErabiltzaileaRelIkastegia
     */
    public function getErabiltzaileaRelIkastegia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasIkastetxeaErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ErabiltzaileaRelIkastegia = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ErabiltzaileaRelIkastegia;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea3
     *
     * @param array $data An array of \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setErabiltzaileaRelIrakasleaByErabiltzailea(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ErabiltzaileaRelIrakasleaByErabiltzailea === null) {

                $this->getErabiltzaileaRelIrakasleaByErabiltzailea();
            }

            $oldRelations = $this->_ErabiltzaileaRelIrakasleaByErabiltzailea;

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

        $this->_ErabiltzaileaRelIrakasleaByErabiltzailea = array();

        foreach ($data as $object) {
            $this->addErabiltzaileaRelIrakasleaByErabiltzailea($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea3
     *
     * @param \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addErabiltzaileaRelIrakasleaByErabiltzailea(\Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea $data)
    {
        $this->_ErabiltzaileaRelIrakasleaByErabiltzailea[] = $data;
        $this->_setLoaded('FkErabiltzaileaHasErabiltzaileaErabiltzailea3');
        return $this;
    }

    /**
     * Gets dependent fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
     */
    public function getErabiltzaileaRelIrakasleaByErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasErabiltzaileaErabiltzailea3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ErabiltzaileaRelIrakasleaByErabiltzailea = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ErabiltzaileaRelIrakasleaByErabiltzailea;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea4
     *
     * @param array $data An array of \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setErabiltzaileaRelIrakasleaByIrakaslea(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ErabiltzaileaRelIrakasleaByIrakaslea === null) {

                $this->getErabiltzaileaRelIrakasleaByIrakaslea();
            }

            $oldRelations = $this->_ErabiltzaileaRelIrakasleaByIrakaslea;

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

        $this->_ErabiltzaileaRelIrakasleaByIrakaslea = array();

        foreach ($data as $object) {
            $this->addErabiltzaileaRelIrakasleaByIrakaslea($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea4
     *
     * @param \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addErabiltzaileaRelIrakasleaByIrakaslea(\Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea $data)
    {
        $this->_ErabiltzaileaRelIrakasleaByIrakaslea[] = $data;
        $this->_setLoaded('FkErabiltzaileaHasErabiltzaileaErabiltzailea4');
        return $this;
    }

    /**
     * Gets dependent fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea4
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea
     */
    public function getErabiltzaileaRelIrakasleaByIrakaslea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasErabiltzaileaErabiltzailea4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ErabiltzaileaRelIrakasleaByIrakaslea = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ErabiltzaileaRelIrakasleaByIrakaslea;
    }

    /**
     * Sets dependent relations ErabiltzaileaSettings_erabiltzaileaId
     *
     * @param array $data An array of \Klikasi\Model\Raw\ErabiltzaileaSettings
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setErabiltzaileaSettings(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ErabiltzaileaSettings === null) {

                $this->getErabiltzaileaSettings();
            }

            $oldRelations = $this->_ErabiltzaileaSettings;

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

        $this->_ErabiltzaileaSettings = array();

        foreach ($data as $object) {
            $this->addErabiltzaileaSettings($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ErabiltzaileaSettings_erabiltzaileaId
     *
     * @param \Klikasi\Model\Raw\ErabiltzaileaSettings $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addErabiltzaileaSettings(\Klikasi\Model\Raw\ErabiltzaileaSettings $data)
    {
        $this->_ErabiltzaileaSettings[] = $data;
        $this->_setLoaded('ErabiltzaileaSettingsErabiltzaileaId');
        return $this;
    }

    /**
     * Gets dependent ErabiltzaileaSettings_erabiltzaileaId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\ErabiltzaileaSettings
     */
    public function getErabiltzaileaSettings($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ErabiltzaileaSettingsErabiltzaileaId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ErabiltzaileaSettings = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ErabiltzaileaSettings;
    }

    /**
     * Sets dependent relations fk_Edukia_has_Erabiltzailea_Erabiltzailea1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Gustokoa
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setGustokoa(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Gustokoa === null) {

                $this->getGustokoa();
            }

            $oldRelations = $this->_Gustokoa;

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

        $this->_Gustokoa = array();

        foreach ($data as $object) {
            $this->addGustokoa($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Edukia_has_Erabiltzailea_Erabiltzailea1
     *
     * @param \Klikasi\Model\Raw\Gustokoa $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addGustokoa(\Klikasi\Model\Raw\Gustokoa $data)
    {
        $this->_Gustokoa[] = $data;
        $this->_setLoaded('FkEdukiaHasErabiltzaileaErabiltzailea1');
        return $this;
    }

    /**
     * Gets dependent fk_Edukia_has_Erabiltzailea_Erabiltzailea1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Gustokoa
     */
    public function getGustokoa($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkEdukiaHasErabiltzaileaErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Gustokoa = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Gustokoa;
    }

    /**
     * Sets dependent relations Hobekuntzak_erabiltzaileaId
     *
     * @param array $data An array of \Klikasi\Model\Raw\Hobekuntzak
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setHobekuntzak(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Hobekuntzak === null) {

                $this->getHobekuntzak();
            }

            $oldRelations = $this->_Hobekuntzak;

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

        $this->_Hobekuntzak = array();

        foreach ($data as $object) {
            $this->addHobekuntzak($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Hobekuntzak_erabiltzaileaId
     *
     * @param \Klikasi\Model\Raw\Hobekuntzak $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addHobekuntzak(\Klikasi\Model\Raw\Hobekuntzak $data)
    {
        $this->_Hobekuntzak[] = $data;
        $this->_setLoaded('HobekuntzakErabiltzaileaId');
        return $this;
    }

    /**
     * Gets dependent Hobekuntzak_erabiltzaileaId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Hobekuntzak
     */
    public function getHobekuntzak($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HobekuntzakErabiltzaileaId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Hobekuntzak = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Hobekuntzak;
    }

    /**
     * Sets dependent relations fk_Iruzkina_Erabiltzailea1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Iruzkina
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setIruzkina(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Iruzkina === null) {

                $this->getIruzkina();
            }

            $oldRelations = $this->_Iruzkina;

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

        $this->_Iruzkina = array();

        foreach ($data as $object) {
            $this->addIruzkina($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Iruzkina_Erabiltzailea1
     *
     * @param \Klikasi\Model\Raw\Iruzkina $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addIruzkina(\Klikasi\Model\Raw\Iruzkina $data)
    {
        $this->_Iruzkina[] = $data;
        $this->_setLoaded('FkIruzkinaErabiltzailea1');
        return $this;
    }

    /**
     * Gets dependent fk_Iruzkina_Erabiltzailea1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Iruzkina
     */
    public function getIruzkina($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkIruzkinaErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Iruzkina = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Iruzkina;
    }

    /**
     * Sets dependent relations fk_Jakinarazpenak_Erabiltzailea1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Jakinarazpenak
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setJakinarazpenakByErabiltzailea(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_JakinarazpenakByErabiltzailea === null) {

                $this->getJakinarazpenakByErabiltzailea();
            }

            $oldRelations = $this->_JakinarazpenakByErabiltzailea;

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

        $this->_JakinarazpenakByErabiltzailea = array();

        foreach ($data as $object) {
            $this->addJakinarazpenakByErabiltzailea($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Jakinarazpenak_Erabiltzailea1
     *
     * @param \Klikasi\Model\Raw\Jakinarazpenak $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addJakinarazpenakByErabiltzailea(\Klikasi\Model\Raw\Jakinarazpenak $data)
    {
        $this->_JakinarazpenakByErabiltzailea[] = $data;
        $this->_setLoaded('FkJakinarazpenakErabiltzailea1');
        return $this;
    }

    /**
     * Gets dependent fk_Jakinarazpenak_Erabiltzailea1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function getJakinarazpenakByErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkJakinarazpenakErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_JakinarazpenakByErabiltzailea = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_JakinarazpenakByErabiltzailea;
    }

    /**
     * Sets dependent relations Jakinarazpenak_thatUserId
     *
     * @param array $data An array of \Klikasi\Model\Raw\Jakinarazpenak
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setJakinarazpenakByThatUser(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_JakinarazpenakByThatUser === null) {

                $this->getJakinarazpenakByThatUser();
            }

            $oldRelations = $this->_JakinarazpenakByThatUser;

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

        $this->_JakinarazpenakByThatUser = array();

        foreach ($data as $object) {
            $this->addJakinarazpenakByThatUser($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Jakinarazpenak_thatUserId
     *
     * @param \Klikasi\Model\Raw\Jakinarazpenak $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addJakinarazpenakByThatUser(\Klikasi\Model\Raw\Jakinarazpenak $data)
    {
        $this->_JakinarazpenakByThatUser[] = $data;
        $this->_setLoaded('JakinarazpenakThatUserId');
        return $this;
    }

    /**
     * Gets dependent Jakinarazpenak_thatUserId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function getJakinarazpenakByThatUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'JakinarazpenakThatUserId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_JakinarazpenakByThatUser = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_JakinarazpenakByThatUser;
    }

    /**
     * Sets dependent relations JakinarazpenakGroup_erabiltzaileaId
     *
     * @param array $data An array of \Klikasi\Model\Raw\JakinarazpenakGroup
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setJakinarazpenakGroup(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_JakinarazpenakGroup === null) {

                $this->getJakinarazpenakGroup();
            }

            $oldRelations = $this->_JakinarazpenakGroup;

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

        $this->_JakinarazpenakGroup = array();

        foreach ($data as $object) {
            $this->addJakinarazpenakGroup($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations JakinarazpenakGroup_erabiltzaileaId
     *
     * @param \Klikasi\Model\Raw\JakinarazpenakGroup $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addJakinarazpenakGroup(\Klikasi\Model\Raw\JakinarazpenakGroup $data)
    {
        $this->_JakinarazpenakGroup[] = $data;
        $this->_setLoaded('JakinarazpenakGroupErabiltzaileaId');
        return $this;
    }

    /**
     * Gets dependent JakinarazpenakGroup_erabiltzaileaId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\JakinarazpenakGroup
     */
    public function getJakinarazpenakGroup($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'JakinarazpenakGroupErabiltzaileaId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_JakinarazpenakGroup = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_JakinarazpenakGroup;
    }

    /**
     * Sets dependent relations Kexa_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Kexa
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setKexa(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Kexa === null) {

                $this->getKexa();
            }

            $oldRelations = $this->_Kexa;

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

        $this->_Kexa = array();

        foreach ($data as $object) {
            $this->addKexa($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Kexa_ibfk_1
     *
     * @param \Klikasi\Model\Raw\Kexa $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addKexa(\Klikasi\Model\Raw\Kexa $data)
    {
        $this->_Kexa[] = $data;
        $this->_setLoaded('KexaIbfk1');
        return $this;
    }

    /**
     * Gets dependent Kexa_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Kexa
     */
    public function getKexa($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KexaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Kexa = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Kexa;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Lagunak
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setLagunakByErabiltzailea(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_LagunakByErabiltzailea === null) {

                $this->getLagunakByErabiltzailea();
            }

            $oldRelations = $this->_LagunakByErabiltzailea;

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

        $this->_LagunakByErabiltzailea = array();

        foreach ($data as $object) {
            $this->addLagunakByErabiltzailea($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea1
     *
     * @param \Klikasi\Model\Raw\Lagunak $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addLagunakByErabiltzailea(\Klikasi\Model\Raw\Lagunak $data)
    {
        $this->_LagunakByErabiltzailea[] = $data;
        $this->_setLoaded('FkErabiltzaileaHasErabiltzaileaErabiltzailea1');
        return $this;
    }

    /**
     * Gets dependent fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Lagunak
     */
    public function getLagunakByErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasErabiltzaileaErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_LagunakByErabiltzailea = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_LagunakByErabiltzailea;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea2
     *
     * @param array $data An array of \Klikasi\Model\Raw\Lagunak
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setLagunakByErabiltzaileaId1(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_LagunakByErabiltzaileaId1 === null) {

                $this->getLagunakByErabiltzaileaId1();
            }

            $oldRelations = $this->_LagunakByErabiltzaileaId1;

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

        $this->_LagunakByErabiltzaileaId1 = array();

        foreach ($data as $object) {
            $this->addLagunakByErabiltzaileaId1($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea2
     *
     * @param \Klikasi\Model\Raw\Lagunak $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addLagunakByErabiltzaileaId1(\Klikasi\Model\Raw\Lagunak $data)
    {
        $this->_LagunakByErabiltzaileaId1[] = $data;
        $this->_setLoaded('FkErabiltzaileaHasErabiltzaileaErabiltzailea2');
        return $this;
    }

    /**
     * Gets dependent fk_Erabiltzailea_has_Erabiltzailea_Erabiltzailea2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Lagunak
     */
    public function getLagunakByErabiltzaileaId1($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasErabiltzaileaErabiltzailea2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_LagunakByErabiltzaileaId1 = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_LagunakByErabiltzaileaId1;
    }

    /**
     * Sets dependent relations fk_Mezuak_Erabiltzailea1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Mezuak
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setMezuakByNork(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_MezuakByNork === null) {

                $this->getMezuakByNork();
            }

            $oldRelations = $this->_MezuakByNork;

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

        $this->_MezuakByNork = array();

        foreach ($data as $object) {
            $this->addMezuakByNork($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Mezuak_Erabiltzailea1
     *
     * @param \Klikasi\Model\Raw\Mezuak $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addMezuakByNork(\Klikasi\Model\Raw\Mezuak $data)
    {
        $this->_MezuakByNork[] = $data;
        $this->_setLoaded('FkMezuakErabiltzailea1');
        return $this;
    }

    /**
     * Gets dependent fk_Mezuak_Erabiltzailea1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Mezuak
     */
    public function getMezuakByNork($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkMezuakErabiltzailea1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_MezuakByNork = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_MezuakByNork;
    }

    /**
     * Sets dependent relations fk_Mezuak_Erabiltzailea2
     *
     * @param array $data An array of \Klikasi\Model\Raw\Mezuak
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setMezuakByNori(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_MezuakByNori === null) {

                $this->getMezuakByNori();
            }

            $oldRelations = $this->_MezuakByNori;

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

        $this->_MezuakByNori = array();

        foreach ($data as $object) {
            $this->addMezuakByNori($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Mezuak_Erabiltzailea2
     *
     * @param \Klikasi\Model\Raw\Mezuak $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addMezuakByNori(\Klikasi\Model\Raw\Mezuak $data)
    {
        $this->_MezuakByNori[] = $data;
        $this->_setLoaded('FkMezuakErabiltzailea2');
        return $this;
    }

    /**
     * Gets dependent fk_Mezuak_Erabiltzailea2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Mezuak
     */
    public function getMezuakByNori($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkMezuakErabiltzailea2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_MezuakByNori = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_MezuakByNori;
    }

    /**
     * Sets dependent relations NewsletterHash_erabiltzaileaId
     *
     * @param array $data An array of \Klikasi\Model\Raw\NewsletterHash
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function setNewsletterHash(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_NewsletterHash === null) {

                $this->getNewsletterHash();
            }

            $oldRelations = $this->_NewsletterHash;

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

        $this->_NewsletterHash = array();

        foreach ($data as $object) {
            $this->addNewsletterHash($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations NewsletterHash_erabiltzaileaId
     *
     * @param \Klikasi\Model\Raw\NewsletterHash $data
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function addNewsletterHash(\Klikasi\Model\Raw\NewsletterHash $data)
    {
        $this->_NewsletterHash[] = $data;
        $this->_setLoaded('NewsletterHashErabiltzaileaId');
        return $this;
    }

    /**
     * Gets dependent NewsletterHash_erabiltzaileaId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\NewsletterHash
     */
    public function getNewsletterHash($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'NewsletterHashErabiltzaileaId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_NewsletterHash = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_NewsletterHash;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Erabiltzailea
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Erabiltzailea')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Erabiltzailea);

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
     * @return null | \Klikasi\Model\Validator\Erabiltzailea
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Erabiltzailea')) {

                $this->setValidator(new \Klikasi\Validator\Erabiltzailea);
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
     * @see \Mapper\Sql\Erabiltzailea::delete
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