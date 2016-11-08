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
class Maila extends ModelAbstract
{

    protected $_grupoAcceptedValues = array(
        'bestelakoak',
        'haurHezkuntza',
        'LH',
        'DBH',
        'Batxilergoa',
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
     * [urlIdentifier:izena]
     * Database var type varchar
     *
     * @var string
     */
    protected $_url;

    /**
     * [enum:bestelakoak|haurHezkuntza|LH|DBH|Batxilergoa]
     * Database var type varchar
     *
     * @var string
     */
    protected $_grupo;



    /**
     * Dependent relation EdukiaRelMaila_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EdukiaRelMaila[]
     */
    protected $_EdukiaRelMaila;

    protected $_columnsList = array(
        'id'=>'id',
        'izena'=>'izena',
        'url'=>'url',
        'grupo'=>'grupo',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'url'=> array('urlIdentifier:izena'),
            'grupo'=> array('enum:bestelakoak|haurHezkuntza|LH|DBH|Batxilergoa'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'EdukiaRelMailaIbfk2' => array(
                    'property' => 'EdukiaRelMaila',
                    'table_name' => 'EdukiaRelMaila',
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
     * @return \Klikasi\Model\Raw\Maila
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
     * @return \Klikasi\Model\Raw\Maila
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
     * @return \Klikasi\Model\Raw\Maila
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
     * @return \Klikasi\Model\Raw\Maila
     */
    public function setGrupo($data)
    {

        if ($this->_grupo != $data) {
            $this->_logChange('grupo');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_grupo = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_grupoAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for grupo'));
            }
            $this->_grupo = (string) $data;

        } else {
            $this->_grupo = $data;
        }
        return $this;
    }

    /**
     * Gets column grupo
     *
     * @return string
     */
    public function getGrupo()
    {
        return $this->_grupo;
    }

    /**
     * Sets dependent relations EdukiaRelMaila_ibfk_2
     *
     * @param array $data An array of \Klikasi\Model\Raw\EdukiaRelMaila
     * @return \Klikasi\Model\Raw\Maila
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
     * Sets dependent relations EdukiaRelMaila_ibfk_2
     *
     * @param \Klikasi\Model\Raw\EdukiaRelMaila $data
     * @return \Klikasi\Model\Raw\Maila
     */
    public function addEdukiaRelMaila(\Klikasi\Model\Raw\EdukiaRelMaila $data)
    {
        $this->_EdukiaRelMaila[] = $data;
        $this->_setLoaded('EdukiaRelMailaIbfk2');
        return $this;
    }

    /**
     * Gets dependent EdukiaRelMaila_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EdukiaRelMaila
     */
    public function getEdukiaRelMaila($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'EdukiaRelMailaIbfk2';

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
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Maila
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Maila')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Maila);

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
     * @return null | \Klikasi\Model\Validator\Maila
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Maila')) {

                $this->setValidator(new \Klikasi\Validator\Maila);
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
     * @see \Mapper\Sql\Maila::delete
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