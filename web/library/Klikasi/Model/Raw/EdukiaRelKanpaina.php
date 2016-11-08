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
class EdukiaRelKanpaina extends ModelAbstract
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
    protected $_edukiaId;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_irabazlea;


    /**
     * Parent relation fk_Kanpaina_has_Edukia_Edukia1
     *
     * @var \Klikasi\Model\Raw\Edukia
     */
    protected $_Edukia;

    /**
     * Parent relation fk_Kanpaina_has_Edukia_Kanpaina1
     *
     * @var \Klikasi\Model\Raw\Kanpaina
     */
    protected $_Kanpaina;


    protected $_columnsList = array(
        'id'=>'id',
        'kanpainaId'=>'kanpainaId',
        'edukiaId'=>'edukiaId',
        'irabazlea'=>'irabazlea',
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
            'FkKanpainaHasEdukiaEdukia1'=> array(
                    'property' => 'Edukia',
                    'table_name' => 'Edukia',
                ),
            'FkKanpainaHasEdukiaKanpaina1'=> array(
                    'property' => 'Kanpaina',
                    'table_name' => 'Kanpaina',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'irabazlea' => '0',
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
     * @return \Klikasi\Model\Raw\EdukiaRelKanpaina
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
     * @return \Klikasi\Model\Raw\EdukiaRelKanpaina
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
     * @return \Klikasi\Model\Raw\EdukiaRelKanpaina
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
     * @param int $data
     * @return \Klikasi\Model\Raw\EdukiaRelKanpaina
     */
    public function setIrabazlea($data)
    {

        if ($this->_irabazlea != $data) {
            $this->_logChange('irabazlea');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_irabazlea = $data;

        } else if (!is_null($data)) {
            $this->_irabazlea = (int) $data;

        } else {
            $this->_irabazlea = $data;
        }
        return $this;
    }

    /**
     * Gets column irabazlea
     *
     * @return int
     */
    public function getIrabazlea()
    {
        return $this->_irabazlea;
    }

    /**
     * Sets parent relation Edukia
     *
     * @param \Klikasi\Model\Raw\Edukia $data
     * @return \Klikasi\Model\Raw\EdukiaRelKanpaina
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

        $this->_setLoaded('FkKanpainaHasEdukiaEdukia1');
        return $this;
    }

    /**
     * Gets parent Edukia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function getEdukia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkKanpainaHasEdukiaEdukia1';

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
     * Sets parent relation Kanpaina
     *
     * @param \Klikasi\Model\Raw\Kanpaina $data
     * @return \Klikasi\Model\Raw\EdukiaRelKanpaina
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

        $this->_setLoaded('FkKanpainaHasEdukiaKanpaina1');
        return $this;
    }

    /**
     * Gets parent Kanpaina
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function getKanpaina($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkKanpainaHasEdukiaKanpaina1';

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
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\EdukiaRelKanpaina
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\EdukiaRelKanpaina')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\EdukiaRelKanpaina);

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
     * @return null | \Klikasi\Model\Validator\EdukiaRelKanpaina
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\EdukiaRelKanpaina')) {

                $this->setValidator(new \Klikasi\Validator\EdukiaRelKanpaina);
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
     * @see \Mapper\Sql\EdukiaRelKanpaina::delete
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