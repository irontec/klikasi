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
class IkastegiMota extends ModelAbstract
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
     * [urlIdentifier:izena]
     * Database var type varchar
     *
     * @var string
     */
    protected $_url;



    /**
     * Dependent relation IkastegiaRelMota_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\IkastegiaRelMota[]
     */
    protected $_IkastegiaRelMota;

    /**
     * Dependent relation KanpainaRelIkastegiMota_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\KanpainaRelIkastegiMota[]
     */
    protected $_KanpainaRelIkastegiMota;


    protected $_columnsList = array(
        'id'=>'id',
        'izena'=>'izena',
        'url'=>'url',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'url'=> array('urlIdentifier:izena'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'IkastegiaRelMotaIbfk2' => array(
                    'property' => 'IkastegiaRelMota',
                    'table_name' => 'IkastegiaRelMota',
                ),
            'KanpainaRelIkastegiMotaIbfk2' => array(
                    'property' => 'KanpainaRelIkastegiMota',
                    'table_name' => 'KanpainaRelIkastegiMota',
                ),
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
     * @return \Klikasi\Model\Raw\IkastegiMota
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
     * @return \Klikasi\Model\Raw\IkastegiMota
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
     * @return \Klikasi\Model\Raw\IkastegiMota
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
     * Sets dependent relations IkastegiaRelMota_ibfk_2
     *
     * @param array $data An array of \Klikasi\Model\Raw\IkastegiaRelMota
     * @return \Klikasi\Model\Raw\IkastegiMota
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
     * Sets dependent relations IkastegiaRelMota_ibfk_2
     *
     * @param \Klikasi\Model\Raw\IkastegiaRelMota $data
     * @return \Klikasi\Model\Raw\IkastegiMota
     */
    public function addIkastegiaRelMota(\Klikasi\Model\Raw\IkastegiaRelMota $data)
    {
        $this->_IkastegiaRelMota[] = $data;
        $this->_setLoaded('IkastegiaRelMotaIbfk2');
        return $this;
    }

    /**
     * Gets dependent IkastegiaRelMota_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\IkastegiaRelMota
     */
    public function getIkastegiaRelMota($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'IkastegiaRelMotaIbfk2';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_IkastegiaRelMota = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_IkastegiaRelMota;
    }

    /**
     * Sets dependent relations KanpainaRelIkastegiMota_ibfk_2
     *
     * @param array $data An array of \Klikasi\Model\Raw\KanpainaRelIkastegiMota
     * @return \Klikasi\Model\Raw\IkastegiMota
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

        $this->_KanpainaRelIkastegiMota = array();

        foreach ($data as $object) {
            $this->addKanpainaRelIkastegiMota($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations KanpainaRelIkastegiMota_ibfk_2
     *
     * @param \Klikasi\Model\Raw\KanpainaRelIkastegiMota $data
     * @return \Klikasi\Model\Raw\IkastegiMota
     */
    public function addKanpainaRelIkastegiMota(\Klikasi\Model\Raw\KanpainaRelIkastegiMota $data)
    {
        $this->_KanpainaRelIkastegiMota[] = $data;
        $this->_setLoaded('KanpainaRelIkastegiMotaIbfk2');
        return $this;
    }

    /**
     * Gets dependent KanpainaRelIkastegiMota_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\KanpainaRelIkastegiMota
     */
    public function getKanpainaRelIkastegiMota($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelIkastegiMotaIbfk2';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KanpainaRelIkastegiMota = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KanpainaRelIkastegiMota;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\IkastegiMota
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\IkastegiMota')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\IkastegiMota);

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
     * @return null | \Klikasi\Model\Validator\IkastegiMota
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\IkastegiMota')) {

                $this->setValidator(new \Klikasi\Validator\IkastegiMota);
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
     * @see \Mapper\Sql\IkastegiMota::delete
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
