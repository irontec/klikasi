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
class EtiketaRelEdukia extends ModelAbstract
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
    protected $_etiketaId;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_edukiaId;


    /**
     * Parent relation EtiketaRelEdukia_ibfk_1
     *
     * @var \Klikasi\Model\Raw\Edukia
     */
    protected $_Edukia;

    /**
     * Parent relation fk_Etiketa_has_Edukia_Etiketa1
     *
     * @var \Klikasi\Model\Raw\Etiketa
     */
    protected $_Etiketa;


    protected $_columnsList = array(
        'id'=>'id',
        'etiketaId'=>'etiketaId',
        'edukiaId'=>'edukiaId',
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
            'EtiketaRelEdukiaIbfk1'=> array(
                    'property' => 'Edukia',
                    'table_name' => 'Edukia',
                ),
            'FkEtiketaHasEdukiaEtiketa1'=> array(
                    'property' => 'Etiketa',
                    'table_name' => 'Etiketa',
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
     * @return \Klikasi\Model\Raw\EtiketaRelEdukia
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
     * @return \Klikasi\Model\Raw\EtiketaRelEdukia
     */
    public function setEtiketaId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_etiketaId != $data) {
            $this->_logChange('etiketaId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_etiketaId = $data;

        } else if (!is_null($data)) {
            $this->_etiketaId = (int) $data;

        } else {
            $this->_etiketaId = $data;
        }
        return $this;
    }

    /**
     * Gets column etiketaId
     *
     * @return int
     */
    public function getEtiketaId()
    {
        return $this->_etiketaId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\EtiketaRelEdukia
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
     * Sets parent relation Edukia
     *
     * @param \Klikasi\Model\Raw\Edukia $data
     * @return \Klikasi\Model\Raw\EtiketaRelEdukia
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

        $this->_setLoaded('EtiketaRelEdukiaIbfk1');
        return $this;
    }

    /**
     * Gets parent Edukia
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Edukia
     */
    public function getEdukia($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'EtiketaRelEdukiaIbfk1';

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
     * Sets parent relation Etiketa
     *
     * @param \Klikasi\Model\Raw\Etiketa $data
     * @return \Klikasi\Model\Raw\EtiketaRelEdukia
     */
    public function setEtiketa(\Klikasi\Model\Raw\Etiketa $data)
    {
        $this->_Etiketa = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setEtiketaId($primaryKey);
        }

        $this->_setLoaded('FkEtiketaHasEdukiaEtiketa1');
        return $this;
    }

    /**
     * Gets parent Etiketa
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Etiketa
     */
    public function getEtiketa($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FkEtiketaHasEdukiaEtiketa1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Etiketa = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Etiketa;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\EtiketaRelEdukia
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\EtiketaRelEdukia')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\EtiketaRelEdukia);

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
     * @return null | \Klikasi\Model\Validator\EtiketaRelEdukia
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\EtiketaRelEdukia')) {

                $this->setValidator(new \Klikasi\Validator\EtiketaRelEdukia);
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
     * @see \Mapper\Sql\EtiketaRelEdukia::delete
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