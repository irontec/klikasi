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
class JakinarazpenakMota extends ModelAbstract
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
     * Database var type varchar
     *
     * @var string
     */
    protected $_deskripzioa;



    /**
     * Dependent relation Jakinarazpenak_motaId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\Jakinarazpenak[]
     */
    protected $_Jakinarazpenak;

    protected $_columnsList = array(
        'id'=>'id',
        'izena'=>'izena',
        'url'=>'url',
        'deskripzioa'=>'deskripzioa',
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
            'JakinarazpenakMotaId' => array(
                    'property' => 'Jakinarazpenak',
                    'table_name' => 'Jakinarazpenak',
                ),
        ));




        $this->_defaultValues = array(
            'deskripzioa' => '',
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
     * @return \Klikasi\Model\Raw\JakinarazpenakMota
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
     * @return \Klikasi\Model\Raw\JakinarazpenakMota
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
     * @param string $data
     * @return \Klikasi\Model\Raw\JakinarazpenakMota
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
     * @param string $data
     * @return \Klikasi\Model\Raw\JakinarazpenakMota
     */
    public function setDeskripzioa($data)
    {

        if ($this->_deskripzioa != $data) {
            $this->_logChange('deskripzioa');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_deskripzioa = $data;

        } else if (!is_null($data)) {
            $this->_deskripzioa = (string) $data;

        } else {
            $this->_deskripzioa = $data;
        }
        return $this;
    }

    /**
     * Gets column deskripzioa
     *
     * @return string
     */
    public function getDeskripzioa()
    {
        return $this->_deskripzioa;
    }

    /**
     * Sets dependent relations Jakinarazpenak_motaId
     *
     * @param array $data An array of \Klikasi\Model\Raw\Jakinarazpenak
     * @return \Klikasi\Model\Raw\JakinarazpenakMota
     */
    public function setJakinarazpenak(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Jakinarazpenak === null) {

                $this->getJakinarazpenak();
            }

            $oldRelations = $this->_Jakinarazpenak;

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

        $this->_Jakinarazpenak = array();

        foreach ($data as $object) {
            $this->addJakinarazpenak($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Jakinarazpenak_motaId
     *
     * @param \Klikasi\Model\Raw\Jakinarazpenak $data
     * @return \Klikasi\Model\Raw\JakinarazpenakMota
     */
    public function addJakinarazpenak(\Klikasi\Model\Raw\Jakinarazpenak $data)
    {
        $this->_Jakinarazpenak[] = $data;
        $this->_setLoaded('JakinarazpenakMotaId');
        return $this;
    }

    /**
     * Gets dependent Jakinarazpenak_motaId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\Jakinarazpenak
     */
    public function getJakinarazpenak($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'JakinarazpenakMotaId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Jakinarazpenak = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Jakinarazpenak;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\JakinarazpenakMota
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\JakinarazpenakMota')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\JakinarazpenakMota);

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
     * @return null | \Klikasi\Model\Validator\JakinarazpenakMota
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\JakinarazpenakMota')) {

                $this->setValidator(new \Klikasi\Validator\JakinarazpenakMota);
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
     * @see \Mapper\Sql\JakinarazpenakMota::delete
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