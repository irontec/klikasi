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
 * 
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 */

namespace Klikasi\Model\Raw;
class KanpainaRelKategoria extends ModelAbstract
{


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
    protected $_kanpainaId;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_kategoriaId;


    /**
     * Parent relation KanpainaRelKategoria_ibfk_1
     *
     * @var \Klikasi\Model\Raw\Kanpaina
     */
    protected $_Kanpaina;

    /**
     * Parent relation KanpainaRelKategoria_ibfk_2
     *
     * @var \Klikasi\Model\Raw\Kategoria
     */
    protected $_Kategoria;


    protected $_columnsList = array(
        'id'=>'id',
        'kanpainaId'=>'kanpainaId',
        'kategoriaId'=>'kategoriaId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
            'KanpainaRelKategoriaIbfk1'=> array(
                    'property' => 'Kanpaina',
                    'table_name' => 'Kanpaina',
                ),
            'KanpainaRelKategoriaIbfk2'=> array(
                    'property' => 'Kategoria',
                    'table_name' => 'Kategoria',
                ),
        ));

        $this->setDependentList(array(
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
     * @return \Klikasi\Model\Raw\KanpainaRelKategoria
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
     * @return \Klikasi\Model\Raw\KanpainaRelKategoria
     */
    public function setKanpainaId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_kanpainaId != $data) {
            $this->_logChange('kanpainaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_kanpainaId = $data;

        } else if (!is_null($data)) {
            $this->_kanpainaId = (int) $data;

        } else {
            $this->_kanpainaId = $data;
        }
        return $this;
    }

    /**
     * Gets column kanpainaId
     *
     * @return int
     */
    public function getKanpainaId()
    {
        return $this->_kanpainaId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\KanpainaRelKategoria
     */
    public function setKategoriaId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_kategoriaId != $data) {
            $this->_logChange('kategoriaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_kategoriaId = $data;

        } else if (!is_null($data)) {
            $this->_kategoriaId = (int) $data;

        } else {
            $this->_kategoriaId = $data;
        }
        return $this;
    }

    /**
     * Gets column kategoriaId
     *
     * @return int
     */
    public function getKategoriaId()
    {
        return $this->_kategoriaId;
    }

    /**
     * Sets parent relation Kanpaina
     *
     * @param \Klikasi\Model\Raw\Kanpaina $data
     * @return \Klikasi\Model\Raw\KanpainaRelKategoria
     */
    public function setKanpaina(\Klikasi\Model\Raw\Kanpaina $data)
    {
        $this->_Kanpaina = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setKanpainaId($primaryKey);
        }

        $this->_setLoaded('KanpainaRelKategoriaIbfk1');
        return $this;
    }

    /**
     * Gets parent Kanpaina
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function getKanpaina($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelKategoriaIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Kanpaina = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Kanpaina;
    }

    /**
     * Sets parent relation Kategoria
     *
     * @param \Klikasi\Model\Raw\Kategoria $data
     * @return \Klikasi\Model\Raw\KanpainaRelKategoria
     */
    public function setKategoria(\Klikasi\Model\Raw\Kategoria $data)
    {
        $this->_Kategoria = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setKategoriaId($primaryKey);
        }

        $this->_setLoaded('KanpainaRelKategoriaIbfk2');
        return $this;
    }

    /**
     * Gets parent Kategoria
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Kategoria
     */
    public function getKategoria($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelKategoriaIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Kategoria = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Kategoria;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\KanpainaRelKategoria
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\KanpainaRelKategoria')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\KanpainaRelKategoria);

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
     * @return null | \Klikasi\Model\Validator\KanpainaRelKategoria
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\KanpainaRelKategoria')) {

                $this->setValidator(new \Klikasi\Validator\KanpainaRelKategoria);
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
     * @see \Mapper\Sql\KanpainaRelKategoria::delete
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