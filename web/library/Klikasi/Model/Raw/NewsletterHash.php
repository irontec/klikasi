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
class NewsletterHash extends ModelAbstract
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
    protected $_newsletterId;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_erabiltzaileaId;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_hash;


    /**
     * Parent relation NewsletterHash_erabiltzaileaId
     *
     * @var \Klikasi\Model\Raw\Erabiltzailea
     */
    protected $_Erabiltzailea;

    /**
     * Parent relation NewsletterHash_newsletterId
     *
     * @var \Klikasi\Model\Raw\Newsletter
     */
    protected $_Newsletter;


    protected $_columnsList = array(
        'id'=>'id',
        'newsletterId'=>'newsletterId',
        'erabiltzaileaId'=>'erabiltzaileaId',
        'hash'=>'hash',
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
            'NewsletterHashErabiltzaileaId'=> array(
                    'property' => 'Erabiltzailea',
                    'table_name' => 'Erabiltzailea',
                ),
            'NewsletterHashNewsletterId'=> array(
                    'property' => 'Newsletter',
                    'table_name' => 'Newsletter',
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
     * @return \Klikasi\Model\Raw\NewsletterHash
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
     * @return \Klikasi\Model\Raw\NewsletterHash
     */
    public function setNewsletterId($data)
    {

        if ($this->_newsletterId != $data) {
            $this->_logChange('newsletterId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_newsletterId = $data;

        } else if (!is_null($data)) {
            $this->_newsletterId = (int) $data;

        } else {
            $this->_newsletterId = $data;
        }
        return $this;
    }

    /**
     * Gets column newsletterId
     *
     * @return int
     */
    public function getNewsletterId()
    {
        return $this->_newsletterId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\NewsletterHash
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
     * @param text $data
     * @return \Klikasi\Model\Raw\NewsletterHash
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
     * @return text
     */
    public function getHash()
    {
        return $this->_hash;
    }

    /**
     * Sets parent relation Erabiltzailea
     *
     * @param \Klikasi\Model\Raw\Erabiltzailea $data
     * @return \Klikasi\Model\Raw\NewsletterHash
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

        $this->_setLoaded('NewsletterHashErabiltzaileaId');
        return $this;
    }

    /**
     * Gets parent Erabiltzailea
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Erabiltzailea
     */
    public function getErabiltzailea($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'NewsletterHashErabiltzaileaId';

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
     * Sets parent relation Newsletter
     *
     * @param \Klikasi\Model\Raw\Newsletter $data
     * @return \Klikasi\Model\Raw\NewsletterHash
     */
    public function setNewsletter(\Klikasi\Model\Raw\Newsletter $data)
    {
        $this->_Newsletter = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setNewsletterId($primaryKey);
        }

        $this->_setLoaded('NewsletterHashNewsletterId');
        return $this;
    }

    /**
     * Gets parent Newsletter
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function getNewsletter($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'NewsletterHashNewsletterId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Newsletter = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Newsletter;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\NewsletterHash
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\NewsletterHash')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\NewsletterHash);

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
     * @return null | \Klikasi\Model\Validator\NewsletterHash
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\NewsletterHash')) {

                $this->setValidator(new \Klikasi\Validator\NewsletterHash);
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
     * @see \Mapper\Sql\NewsletterHash::delete
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