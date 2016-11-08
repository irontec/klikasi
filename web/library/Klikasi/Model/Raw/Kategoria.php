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
class Kategoria extends ModelAbstract
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
     * Database var type int
     *
     * @var int
     */
    protected $_karma;



    /**
     * Dependent relation fk_Edukia_has_Kategoria_Kategoria1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\EdukiaRelKategoria[]
     */
    protected $_EdukiaRelKategoria;

    /**
     * Dependent relation KanpainaRelEdukiKategoriak_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\KanpainaRelEdukiKategoriak[]
     */
    protected $_KanpainaRelEdukiKategoriak;

    /**
     * Dependent relation KanpainaRelKategoria_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\KanpainaRelKategoria[]
     */
    protected $_KanpainaRelKategoria;

    /**
     * Dependent relation KategoriakRelKategoriaGlobalak_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\KategoriakRelKategoriaGlobalak[]
     */
    protected $_KategoriakRelKategoriaGlobalak;

    protected $_columnsList = array(
        'id'=>'id',
        'izena'=>'izena',
        'url'=>'url',
        'karma'=>'karma',
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
            'FkEdukiaHasKategoriaKategoria1' => array(
                    'property' => 'EdukiaRelKategoria',
                    'table_name' => 'EdukiaRelKategoria',
                ),
            'KanpainaRelEdukiKategoriakIbfk2' => array(
                    'property' => 'KanpainaRelEdukiKategoriak',
                    'table_name' => 'KanpainaRelEdukiKategoriak',
                ),
            'KanpainaRelKategoriaIbfk2' => array(
                    'property' => 'KanpainaRelKategoria',
                    'table_name' => 'KanpainaRelKategoria',
                ),
            'KategoriakRelKategoriaGlobalakIbfk1' => array(
                    'property' => 'KategoriakRelKategoriaGlobalak',
                    'table_name' => 'KategoriakRelKategoriaGlobalak',
                ),
        ));




        $this->_defaultValues = array(
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
     * @return \Klikasi\Model\Raw\Kategoria
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
     * @return \Klikasi\Model\Raw\Kategoria
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
     * @return \Klikasi\Model\Raw\Kategoria
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
     * @param int $data
     * @return \Klikasi\Model\Raw\Kategoria
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
     * Sets dependent relations fk_Edukia_has_Kategoria_Kategoria1
     *
     * @param array $data An array of \Klikasi\Model\Raw\EdukiaRelKategoria
     * @return \Klikasi\Model\Raw\Kategoria
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
     * Sets dependent relations fk_Edukia_has_Kategoria_Kategoria1
     *
     * @param \Klikasi\Model\Raw\EdukiaRelKategoria $data
     * @return \Klikasi\Model\Raw\Kategoria
     */
    public function addEdukiaRelKategoria(\Klikasi\Model\Raw\EdukiaRelKategoria $data)
    {
        $this->_EdukiaRelKategoria[] = $data;
        $this->_setLoaded('FkEdukiaHasKategoriaKategoria1');
        return $this;
    }

    /**
     * Gets dependent fk_Edukia_has_Kategoria_Kategoria1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\EdukiaRelKategoria
     */
    public function getEdukiaRelKategoria($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkEdukiaHasKategoriaKategoria1';

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
     * Sets dependent relations KanpainaRelEdukiKategoriak_ibfk_2
     *
     * @param array $data An array of \Klikasi\Model\Raw\KanpainaRelEdukiKategoriak
     * @return \Klikasi\Model\Raw\Kategoria
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
     * Sets dependent relations KanpainaRelEdukiKategoriak_ibfk_2
     *
     * @param \Klikasi\Model\Raw\KanpainaRelEdukiKategoriak $data
     * @return \Klikasi\Model\Raw\Kategoria
     */
    public function addKanpainaRelEdukiKategoriak(\Klikasi\Model\Raw\KanpainaRelEdukiKategoriak $data)
    {
        $this->_KanpainaRelEdukiKategoriak[] = $data;
        $this->_setLoaded('KanpainaRelEdukiKategoriakIbfk2');
        return $this;
    }

    /**
     * Gets dependent KanpainaRelEdukiKategoriak_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\KanpainaRelEdukiKategoriak
     */
    public function getKanpainaRelEdukiKategoriak($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelEdukiKategoriakIbfk2';

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
     * Sets dependent relations KanpainaRelKategoria_ibfk_2
     *
     * @param array $data An array of \Klikasi\Model\Raw\KanpainaRelKategoria
     * @return \Klikasi\Model\Raw\Kategoria
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
     * Sets dependent relations KanpainaRelKategoria_ibfk_2
     *
     * @param \Klikasi\Model\Raw\KanpainaRelKategoria $data
     * @return \Klikasi\Model\Raw\Kategoria
     */
    public function addKanpainaRelKategoria(\Klikasi\Model\Raw\KanpainaRelKategoria $data)
    {
        $this->_KanpainaRelKategoria[] = $data;
        $this->_setLoaded('KanpainaRelKategoriaIbfk2');
        return $this;
    }

    /**
     * Gets dependent KanpainaRelKategoria_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\KanpainaRelKategoria
     */
    public function getKanpainaRelKategoria($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelKategoriaIbfk2';

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
     * Sets dependent relations KategoriakRelKategoriaGlobalak_ibfk_1
     *
     * @param array $data An array of \Klikasi\Model\Raw\KategoriakRelKategoriaGlobalak
     * @return \Klikasi\Model\Raw\Kategoria
     */
    public function setKategoriakRelKategoriaGlobalak(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KategoriakRelKategoriaGlobalak === null) {

                $this->getKategoriakRelKategoriaGlobalak();
            }

            $oldRelations = $this->_KategoriakRelKategoriaGlobalak;

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

        $this->_KategoriakRelKategoriaGlobalak = array();

        foreach ($data as $object) {
            $this->addKategoriakRelKategoriaGlobalak($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations KategoriakRelKategoriaGlobalak_ibfk_1
     *
     * @param \Klikasi\Model\Raw\KategoriakRelKategoriaGlobalak $data
     * @return \Klikasi\Model\Raw\Kategoria
     */
    public function addKategoriakRelKategoriaGlobalak(\Klikasi\Model\Raw\KategoriakRelKategoriaGlobalak $data)
    {
        $this->_KategoriakRelKategoriaGlobalak[] = $data;
        $this->_setLoaded('KategoriakRelKategoriaGlobalakIbfk1');
        return $this;
    }

    /**
     * Gets dependent KategoriakRelKategoriaGlobalak_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\KategoriakRelKategoriaGlobalak
     */
    public function getKategoriakRelKategoriaGlobalak($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KategoriakRelKategoriaGlobalakIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KategoriakRelKategoriaGlobalak = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KategoriakRelKategoriaGlobalak;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Kategoria
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Kategoria')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Kategoria);

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
     * @return null | \Klikasi\Model\Validator\Kategoria
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Kategoria')) {

                $this->setValidator(new \Klikasi\Validator\Kategoria);
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
     * @see \Mapper\Sql\Kategoria::delete
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