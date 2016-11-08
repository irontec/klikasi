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
class KanpainaRelIkastegiMota extends ModelAbstract
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
    protected $_ikastegiMotaId;


    /**
     * Parent relation KanpainaRelIkastegiMota_ibfk_1
     *
     * @var \Klikasi\Model\Raw\Kanpaina
     */
    protected $_Kanpaina;

    /**
     * Parent relation KanpainaRelIkastegiMota_ibfk_2
     *
     * @var \Klikasi\Model\Raw\IkastegiMota
     */
    protected $_IkastegiMota;



    protected $_columnsList = array(
        'id'=>'id',
        'kanpainaId'=>'kanpainaId',
        'ikastegiMotaId'=>'ikastegiMotaId',
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
            'KanpainaRelIkastegiMotaIbfk1'=> array(
                    'property' => 'Kanpaina',
                    'table_name' => 'Kanpaina',
                ),
            'KanpainaRelIkastegiMotaIbfk2'=> array(
                    'property' => 'IkastegiMota',
                    'table_name' => 'IkastegiMota',
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
     * @return \Klikasi\Model\Raw\KanpainaRelIkastegiMota
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
     * @param int $data
     * @return \Klikasi\Model\Raw\KanpainaRelIkastegiMota
     */
    public function setKanpainaId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_kanpainaId != $data) {
            $this->_logChange('kanpainaId');
        }

        if (!is_null($data)) {
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
     * @return \Klikasi\Model\Raw\KanpainaRelIkastegiMota
     */
    public function setIkastegiMotaId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ikastegiMotaId != $data) {
            $this->_logChange('ikastegiMotaId');
        }

        if (!is_null($data)) {
            $this->_ikastegiMotaId = (int) $data;
        } else {
            $this->_ikastegiMotaId = $data;
        }
        return $this;
    }

    /**
     * Gets column ikastegiMotaId
     *
     * @return int
     */
    public function getIkastegiMotaId()
    {
            return $this->_ikastegiMotaId;
    }


    /**
     * Sets parent relation Kanpaina
     *
     * @param \Klikasi\Model\Raw\Kanpaina $data
     * @return \Klikasi\Model\Raw\KanpainaRelIkastegiMota
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

        $this->_setLoaded('KanpainaRelIkastegiMotaIbfk1');
        return $this;
    }

    /**
     * Gets parent Kanpaina
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Kanpaina
     */
    public function getKanpaina($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelIkastegiMotaIbfk1';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Kanpaina = array_shift($related);
            $this->_setLoaded($fkName);
        }

        return $this->_Kanpaina;
    }

    /**
     * Sets parent relation IkastegiMota
     *
     * @param \Klikasi\Model\Raw\IkastegiMota $data
     * @return \Klikasi\Model\Raw\KanpainaRelIkastegiMota
     */
    public function setIkastegiMota(\Klikasi\Model\Raw\IkastegiMota $data)
    {
        $this->_IkastegiMota = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setIkastegiMotaId($primaryKey);
        }

        $this->_setLoaded('KanpainaRelIkastegiMotaIbfk2');
        return $this;
    }

    /**
     * Gets parent IkastegiMota
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\IkastegiMota
     */
    public function getIkastegiMota($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KanpainaRelIkastegiMotaIbfk2';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_IkastegiMota = array_shift($related);
            $this->_setLoaded($fkName);
        }

        return $this->_IkastegiMota;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\KanpainaRelIkastegiMota
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\KanpainaRelIkastegiMota')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\KanpainaRelIkastegiMota);

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
     * @return null | \Klikasi\Model\Validator\KanpainaRelIkastegiMota
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\KanpainaRelIkastegiMota')) {

                $this->setValidator(new \Klikasi\Validator\KanpainaRelIkastegiMota);
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
     * @see \Mapper\Sql\KanpainaRelIkastegiMota::delete
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
