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
 * [entity][rest]
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 */

namespace Klikasi\Model\Raw;
class Edukia extends ModelAbstract
{

    protected $_egoeraAcceptedValues = array(
        'onartzeko',
        'onartua',
        'ezOnartua',
        'blokeatuta',
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
    protected $_deskribapenLaburra;

    /**
     * Database var type mediumtext
     *
     * @var text
     */
    protected $_deskribapena;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_bisitaKopurua;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_urteakNoiztik;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_urteakNoizarte;

    /**
     * [enum:onartzeko|onartua|ezOnartua|blokeatuta]
     * Database var type varchar
     *
     * @var string
     */
    protected $_egoera;

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
     * Database var type int
     *
     * @var int
     */
    protected $_karma;


    /**
     * Parent relation fk_Edukia_Erabiltzailea1
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Erabiltzailea;


    /**
     * Dependent relation AtseginDut_edukiaId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\AtseginDut[]
     */
    protected $_AtseginDut;

    /**
     * Dependent relation fk_Aurkezpena_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Aurkezpena[]
     */
    protected $_Aurkezpena;

    /**
     * Dependent relation fk_BIdeoa_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Bideoa[]
     */
    protected $_Bideoa;

    /**
     * Dependent relation EdukiaRelIkastegia_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EdukiaRelIkastegia[]
     */
    protected $_EdukiaRelIkastegia;

    /**
     * Dependent relation fk_Kanpaina_has_Edukia_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EdukiaRelKanpaina[]
     */
    protected $_EdukiaRelKanpaina;

    /**
     * Dependent relation fk_Edukia_has_Kategoria_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EdukiaRelKategoria[]
     */
    protected $_EdukiaRelKategoria;

    /**
     * Dependent relation EdukiaRelMaila_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EdukiaRelMaila[]
     */
    protected $_EdukiaRelMaila;

    /**
     * Dependent relation fk_Erabiltzailea_has_Edukia_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\ErabiltzaileaRelEdukia[]
     */
    protected $_ErabiltzaileaRelEdukia;

    /**
     * Dependent relation fk_Esteka_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Esteka[]
     */
    protected $_Esteka;

    /**
     * Dependent relation EtiketaRelEdukia_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EtiketaRelEdukia[]
     */
    protected $_EtiketaRelEdukia;

    /**
     * Dependent relation fk_Fitxategia_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Fitxategia[]
     */
    protected $_Fitxategia;

    /**
     * Dependent relation fk_Edukia_has_Erabiltzailea_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Gustokoa[]
     */
    protected $_Gustokoa;

    /**
     * Dependent relation Hobekuntzak_edukiaId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Hobekuntzak[]
     */
    protected $_Hobekuntzak;

    /**
     * Dependent relation fk_Irudia_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Irudia[]
     */
    protected $_Irudia;

    /**
     * Dependent relation fk_Iruzkina_Edukia1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Iruzkina[]
     */
    protected $_Iruzkina;

    /**
     * Dependent relation Kexa_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Kexa[]
     */
    protected $_Kexa;

    protected $_columnsList = array(
        'id'=>'id',
        'erabiltzaileaId'=>'erabiltzaileaId',
        'titulua'=>'titulua',
        'deskribapenLaburra'=>'deskribapenLaburra',
        'deskribapena'=>'deskribapena',
        'bisitaKopurua'=>'bisitaKopurua',
        'urteakNoiztik'=>'urteakNoiztik',
        'urteakNoizarte'=>'urteakNoizarte',
        'egoera'=>'egoera',
        'url'=>'url',
        'sortzeData'=>'sortzeData',
        'karma'=>'karma',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'egoera'=> array('enum:onartzeko|onartua|ezOnartua|blokeatuta'),
            'url'=> array('urlIdentifier:titulua'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
            'FkEdukiaErabiltzailea1'=> array(
                    'property' => 'Erabiltzailea',
                    'table_name' => 'Erabiltzailea',
                ),
        ));

        $this->setDependentList(array(
            'AtseginDutEdukiaId' => array(
                    'property' => 'AtseginDut',
                    'table_name' => 'AtseginDut',
                ),
            'FkAurkezpenaEdukia1' => array(
                    'property' => 'Aurkezpena',
                    'table_name' => 'Aurkezpena',
                ),
            'FkBIdeoaEdukia1' => array(
                    'property' => 'Bideoa',
                    'table_name' => 'Bideoa',
                ),
            'EdukiaRelIkastegiaIbfk1' => array(
                    'property' => 'EdukiaRelIkastegia',
                    'table_name' => 'EdukiaRelIkastegia',
                ),
            'FkKanpainaHasEdukiaEdukia1' => array(
                    'property' => 'EdukiaRelKanpaina',
                    'table_name' => 'EdukiaRelKanpaina',
                ),
            'FkEdukiaHasKategoriaEdukia1' => array(
                    'property' => 'EdukiaRelKategoria',
                    'table_name' => 'EdukiaRelKategoria',
                ),
            'EdukiaRelMailaIbfk1' => array(
                    'property' => 'EdukiaRelMaila',
                    'table_name' => 'EdukiaRelMaila',
                ),
            'FkErabiltzaileaHasEdukiaEdukia1' => array(
                    'property' => 'ErabiltzaileaRelEdukia',
                    'table_name' => 'ErabiltzaileaRelEdukia',
                ),
            'FkEstekaEdukia1' => array(
                    'property' => 'Esteka',
                    'table_name' => 'Esteka',
                ),
            'EtiketaRelEdukiaIbfk1' => array(
                    'property' => 'EtiketaRelEdukia',
                    'table_name' => 'EtiketaRelEdukia',
                ),
            'FkFitxategiaEdukia1' => array(
                    'property' => 'Fitxategia',
                    'table_name' => 'Fitxategia',
                ),
            'FkEdukiaHasErabiltzaileaEdukia1' => array(
                    'property' => 'Gustokoa',
                    'table_name' => 'Gustokoa',
                ),
            'HobekuntzakEdukiaId' => array(
                    'property' => 'Hobekuntzak',
                    'table_name' => 'Hobekuntzak',
                ),
            'FkIrudiaEdukia1' => array(
                    'property' => 'Irudia',
                    'table_name' => 'Irudia',
                ),
            'FkIruzkinaEdukia1' => array(
                    'property' => 'Iruzkina',
                    'table_name' => 'Iruzkina',
                ),
            'KexaIbfk2' => array(
                    'property' => 'Kexa',
                    'table_name' => 'Kexa',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'fk_Aurkezpena_Edukia1',
            'fk_BIdeoa_Edukia1'
        ));



        $this->_defaultValues = array(
            'bisitaKopurua' => '0',
            'egoera' => 'onartzeko',
            'sortzeData' => 'CURRENT_TIMESTAMP',
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
     * @return \Klikasi\Model\Raw\Edukia
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
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setErabiltzaileaId($data)
    {

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
     * @param string $data
     * @return \Klikasi\Model\Raw\Edukia
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
     * @param string $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setDeskribapenLaburra($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_deskribapenLaburra != $data) {
            $this->_logChange('deskribapenLaburra');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_deskribapenLaburra = $data;

        } else if (!is_null($data)) {
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
     * @param text $data
     * @return \Klikasi\Model\Raw\Edukia
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
        return $this->_deskribapena;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setBisitaKopurua($data)
    {

        if ($this->_bisitaKopurua != $data) {
            $this->_logChange('bisitaKopurua');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_bisitaKopurua = $data;

        } else if (!is_null($data)) {
            $this->_bisitaKopurua = (int) $data;

        } else {
            $this->_bisitaKopurua = $data;
        }
        return $this;
    }

    /**
     * Gets column bisitaKopurua
     *
     * @return int
     */
    public function getBisitaKopurua()
    {
        return $this->_bisitaKopurua;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setUrteakNoiztik($data)
    {

        if ($this->_urteakNoiztik != $data) {
            $this->_logChange('urteakNoiztik');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_urteakNoiztik = $data;

        } else if (!is_null($data)) {
            $this->_urteakNoiztik = (int) $data;

        } else {
            $this->_urteakNoiztik = $data;
        }
        return $this;
    }

    /**
     * Gets column urteakNoiztik
     *
     * @return int
     */
    public function getUrteakNoiztik()
    {
        return $this->_urteakNoiztik;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setUrteakNoizarte($data)
    {

        if ($this->_urteakNoizarte != $data) {
            $this->_logChange('urteakNoizarte');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_urteakNoizarte = $data;

        } else if (!is_null($data)) {
            $this->_urteakNoizarte = (int) $data;

        } else {
            $this->_urteakNoizarte = $data;
        }
        return $this;
    }

    /**
     * Gets column urteakNoizarte
     *
     * @return int
     */
    public function getUrteakNoizarte()
    {
        return $this->_urteakNoizarte;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Edukia
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
     * @return \Klikasi\Model\Raw\Edukia
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
     * @return \Klikasi\Model\Raw\Edukia
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
     * @param int $data
     * @return \Klikasi\Model\Raw\Edukia
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
     * Sets parent relation Erabiltzailea
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\Edukia
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

        $this->_setLoaded('FkEdukiaErabiltzailea1');
        return $this;
    }

    /**
     * Gets parent Erabiltzailea
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkEdukiaErabiltzailea1';

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
     * Sets dependent relations AtseginDut_edukiaId
     *
     * @param array $data An array of \Klikasi\Model\Raw\AtseginDut
     * @return \Klikasi\Model\Raw\Edukia
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
     * Sets dependent relations AtseginDut_edukiaId
     *
     * @param \Klikasi\Model\Raw\AtseginDut $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addAtseginDut(\Klikasi\Model\Raw\AtseginDut $data)
    {
        $this->_AtseginDut[] = $data;
        $this->_setLoaded('AtseginDutEdukiaId');
        return $this;
    }

    /**
     * Gets dependent AtseginDut_edukiaId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\AtseginDut
     */
    public function getAtseginDut($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AtseginDutEdukiaId';

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
     * Sets dependent relations fk_Aurkezpena_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Aurkezpena
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setAurkezpena(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Aurkezpena === null) {

                $this->getAurkezpena();
            }

            $oldRelations = $this->_Aurkezpena;

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

        $this->_Aurkezpena = array();

        foreach ($data as $object) {
            $this->addAurkezpena($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Aurkezpena_Edukia1
     *
     * @param \Klikasi\Model\Raw\Aurkezpena $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addAurkezpena(\Klikasi\Model\Raw\Aurkezpena $data)
    {
        $this->_Aurkezpena[] = $data;
        $this->_setLoaded('FkAurkezpenaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_Aurkezpena_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Aurkezpena
     */
    public function getAurkezpena($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkAurkezpenaEdukia1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Aurkezpena = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Aurkezpena;
    }

    /**
     * Sets dependent relations fk_BIdeoa_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Bideoa
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setBideoa(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Bideoa === null) {

                $this->getBideoa();
            }

            $oldRelations = $this->_Bideoa;

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

        $this->_Bideoa = array();

        foreach ($data as $object) {
            $this->addBideoa($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_BIdeoa_Edukia1
     *
     * @param \Klikasi\Model\Raw\Bideoa $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addBideoa(\Klikasi\Model\Raw\Bideoa $data)
    {
        $this->_Bideoa[] = $data;
        $this->_setLoaded('FkBIdeoaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_BIdeoa_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Bideoa
     */
    public function getBideoa($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkBIdeoaEdukia1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Bideoa = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Bideoa;
    }

    /**
     * Sets dependent relations EdukiaRelIkastegia_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\EdukiaRelIkastegia
     * @return \Klikasi\Model\Raw\Edukia
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

        $this->_EdukiaRelIkastegia = array();

        foreach ($data as $object) {
            $this->addEdukiaRelIkastegia($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations EdukiaRelIkastegia_ibfk_1
     *
     * @param \Klikasi\Model\Raw\EdukiaRelIkastegia $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addEdukiaRelIkastegia(\Klikasi\Model\Raw\EdukiaRelIkastegia $data)
    {
        $this->_EdukiaRelIkastegia[] = $data;
        $this->_setLoaded('EdukiaRelIkastegiaIbfk1');
        return $this;
    }

    /**
     * Gets dependent EdukiaRelIkastegia_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EdukiaRelIkastegia
     */
    public function getEdukiaRelIkastegia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'EdukiaRelIkastegiaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_EdukiaRelIkastegia = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_EdukiaRelIkastegia;
    }

    /**
     * Sets dependent relations fk_Kanpaina_has_Edukia_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\EdukiaRelKanpaina
     * @return \Klikasi\Model\Raw\Edukia
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
     * Sets dependent relations fk_Kanpaina_has_Edukia_Edukia1
     *
     * @param \Klikasi\Model\Raw\EdukiaRelKanpaina $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addEdukiaRelKanpaina(\Klikasi\Model\Raw\EdukiaRelKanpaina $data)
    {
        $this->_EdukiaRelKanpaina[] = $data;
        $this->_setLoaded('FkKanpainaHasEdukiaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_Kanpaina_has_Edukia_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EdukiaRelKanpaina
     */
    public function getEdukiaRelKanpaina($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkKanpainaHasEdukiaEdukia1';

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
     * Sets dependent relations fk_Edukia_has_Kategoria_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\EdukiaRelKategoria
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setEdukiaRelKategoria(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_EdukiaRelKategoria === null) {

                $this->getEdukiaRelKategoria();
            }

            $oldRelations = $this->_EdukiaRelKategoria;

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

        $this->_EdukiaRelKategoria = array();

        foreach ($data as $object) {
            $this->addEdukiaRelKategoria($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Edukia_has_Kategoria_Edukia1
     *
     * @param \Klikasi\Model\Raw\EdukiaRelKategoria $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addEdukiaRelKategoria(\Klikasi\Model\Raw\EdukiaRelKategoria $data)
    {
        $this->_EdukiaRelKategoria[] = $data;
        $this->_setLoaded('FkEdukiaHasKategoriaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_Edukia_has_Kategoria_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EdukiaRelKategoria
     */
    public function getEdukiaRelKategoria($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkEdukiaHasKategoriaEdukia1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_EdukiaRelKategoria = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_EdukiaRelKategoria;
    }

    /**
     * Sets dependent relations EdukiaRelMaila_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\EdukiaRelMaila
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setEdukiaRelMaila(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_EdukiaRelMaila === null) {

                $this->getEdukiaRelMaila();
            }

            $oldRelations = $this->_EdukiaRelMaila;

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

        $this->_EdukiaRelMaila = array();

        foreach ($data as $object) {
            $this->addEdukiaRelMaila($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations EdukiaRelMaila_ibfk_1
     *
     * @param \Klikasi\Model\Raw\EdukiaRelMaila $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addEdukiaRelMaila(\Klikasi\Model\Raw\EdukiaRelMaila $data)
    {
        $this->_EdukiaRelMaila[] = $data;
        $this->_setLoaded('EdukiaRelMailaIbfk1');
        return $this;
    }

    /**
     * Gets dependent EdukiaRelMaila_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EdukiaRelMaila
     */
    public function getEdukiaRelMaila($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'EdukiaRelMailaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_EdukiaRelMaila = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_EdukiaRelMaila;
    }

    /**
     * Sets dependent relations fk_Erabiltzailea_has_Edukia_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\ErabiltzaileaRelEdukia
     * @return \Klikasi\Model\Raw\Edukia
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
     * Sets dependent relations fk_Erabiltzailea_has_Edukia_Edukia1
     *
     * @param \Klikasi\Model\Raw\ErabiltzaileaRelEdukia $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addErabiltzaileaRelEdukia(\Klikasi\Model\Raw\ErabiltzaileaRelEdukia $data)
    {
        $this->_ErabiltzaileaRelEdukia[] = $data;
        $this->_setLoaded('FkErabiltzaileaHasEdukiaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_Erabiltzailea_has_Edukia_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\ErabiltzaileaRelEdukia
     */
    public function getErabiltzaileaRelEdukia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkErabiltzaileaHasEdukiaEdukia1';

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
     * Sets dependent relations fk_Esteka_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Esteka
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setEsteka(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Esteka === null) {

                $this->getEsteka();
            }

            $oldRelations = $this->_Esteka;

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

        $this->_Esteka = array();

        foreach ($data as $object) {
            $this->addEsteka($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Esteka_Edukia1
     *
     * @param \Klikasi\Model\Raw\Esteka $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addEsteka(\Klikasi\Model\Raw\Esteka $data)
    {
        $this->_Esteka[] = $data;
        $this->_setLoaded('FkEstekaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_Esteka_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Esteka
     */
    public function getEsteka($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkEstekaEdukia1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Esteka = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Esteka;
    }

    /**
     * Sets dependent relations EtiketaRelEdukia_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\EtiketaRelEdukia
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setEtiketaRelEdukia(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_EtiketaRelEdukia === null) {

                $this->getEtiketaRelEdukia();
            }

            $oldRelations = $this->_EtiketaRelEdukia;

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

        $this->_EtiketaRelEdukia = array();

        foreach ($data as $object) {
            $this->addEtiketaRelEdukia($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations EtiketaRelEdukia_ibfk_1
     *
     * @param \Klikasi\Model\Raw\EtiketaRelEdukia $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addEtiketaRelEdukia(\Klikasi\Model\Raw\EtiketaRelEdukia $data)
    {
        $this->_EtiketaRelEdukia[] = $data;
        $this->_setLoaded('EtiketaRelEdukiaIbfk1');
        return $this;
    }

    /**
     * Gets dependent EtiketaRelEdukia_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EtiketaRelEdukia
     */
    public function getEtiketaRelEdukia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'EtiketaRelEdukiaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_EtiketaRelEdukia = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_EtiketaRelEdukia;
    }

    /**
     * Sets dependent relations fk_Fitxategia_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Fitxategia
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setFitxategia(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Fitxategia === null) {

                $this->getFitxategia();
            }

            $oldRelations = $this->_Fitxategia;

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

        $this->_Fitxategia = array();

        foreach ($data as $object) {
            $this->addFitxategia($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Fitxategia_Edukia1
     *
     * @param \Klikasi\Model\Raw\Fitxategia $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addFitxategia(\Klikasi\Model\Raw\Fitxategia $data)
    {
        $this->_Fitxategia[] = $data;
        $this->_setLoaded('FkFitxategiaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_Fitxategia_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Fitxategia
     */
    public function getFitxategia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkFitxategiaEdukia1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Fitxategia = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Fitxategia;
    }

    /**
     * Sets dependent relations fk_Edukia_has_Erabiltzailea_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Gustokoa
     * @return \Klikasi\Model\Raw\Edukia
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
     * Sets dependent relations fk_Edukia_has_Erabiltzailea_Edukia1
     *
     * @param \Klikasi\Model\Raw\Gustokoa $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addGustokoa(\Klikasi\Model\Raw\Gustokoa $data)
    {
        $this->_Gustokoa[] = $data;
        $this->_setLoaded('FkEdukiaHasErabiltzaileaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_Edukia_has_Erabiltzailea_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Gustokoa
     */
    public function getGustokoa($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkEdukiaHasErabiltzaileaEdukia1';

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
     * Sets dependent relations Hobekuntzak_edukiaId
     *
     * @param array $data An array of \Klikasi\Model\Raw\Hobekuntzak
     * @return \Klikasi\Model\Raw\Edukia
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
     * Sets dependent relations Hobekuntzak_edukiaId
     *
     * @param \Klikasi\Model\Raw\Hobekuntzak $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addHobekuntzak(\Klikasi\Model\Raw\Hobekuntzak $data)
    {
        $this->_Hobekuntzak[] = $data;
        $this->_setLoaded('HobekuntzakEdukiaId');
        return $this;
    }

    /**
     * Gets dependent Hobekuntzak_edukiaId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Hobekuntzak
     */
    public function getHobekuntzak($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'HobekuntzakEdukiaId';

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
     * Sets dependent relations fk_Irudia_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Irudia
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function setIrudia(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Irudia === null) {

                $this->getIrudia();
            }

            $oldRelations = $this->_Irudia;

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

        $this->_Irudia = array();

        foreach ($data as $object) {
            $this->addIrudia($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations fk_Irudia_Edukia1
     *
     * @param \Klikasi\Model\Raw\Irudia $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addIrudia(\Klikasi\Model\Raw\Irudia $data)
    {
        $this->_Irudia[] = $data;
        $this->_setLoaded('FkIrudiaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_Irudia_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Irudia
     */
    public function getIrudia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkIrudiaEdukia1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Irudia = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Irudia;
    }

    /**
     * Sets dependent relations fk_Iruzkina_Edukia1
     *
     * @param array $data An array of \Klikasi\Model\Raw\Iruzkina
     * @return \Klikasi\Model\Raw\Edukia
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
     * Sets dependent relations fk_Iruzkina_Edukia1
     *
     * @param \Klikasi\Model\Raw\Iruzkina $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addIruzkina(\Klikasi\Model\Raw\Iruzkina $data)
    {
        $this->_Iruzkina[] = $data;
        $this->_setLoaded('FkIruzkinaEdukia1');
        return $this;
    }

    /**
     * Gets dependent fk_Iruzkina_Edukia1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Iruzkina
     */
    public function getIruzkina($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkIruzkinaEdukia1';

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
     * Sets dependent relations Kexa_ibfk_2
     *
     * @param array $data An array of \Klikasi\Model\Raw\Kexa
     * @return \Klikasi\Model\Raw\Edukia
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
     * Sets dependent relations Kexa_ibfk_2
     *
     * @param \Klikasi\Model\Raw\Kexa $data
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function addKexa(\Klikasi\Model\Raw\Kexa $data)
    {
        $this->_Kexa[] = $data;
        $this->_setLoaded('KexaIbfk2');
        return $this;
    }

    /**
     * Gets dependent Kexa_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Kexa
     */
    public function getKexa($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KexaIbfk2';

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
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Edukia
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Edukia')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Edukia);

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
     * @return null | \Klikasi\Model\Validator\Edukia
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Edukia')) {

                $this->setValidator(new \Klikasi\Validator\Edukia);
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
     * @see \Mapper\Sql\Edukia::delete
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