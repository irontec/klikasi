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
class Newsletter extends ModelAbstract
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
    protected $_title;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_content;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_active;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_send;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_sent;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_readBy;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_dateToSend;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_shippingDate;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_isEdukia;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_isIkastegia;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_edukiakSent;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ikastegiakSent;



    /**
     * Dependent relation NewsletterHash_newsletterId
     * Type: One-to-Many relationship
     *
     * @var \Klikasi\Model\Raw\NewsletterHash[]
     */
    protected $_NewsletterHash;

    protected $_columnsList = array(
        'id'=>'id',
        'title'=>'title',
        'content'=>'content',
        'active'=>'active',
        'send'=>'send',
        'sent'=>'sent',
        'readBy'=>'readBy',
        'dateToSend'=>'dateToSend',
        'shippingDate'=>'shippingDate',
        'isEdukia'=>'isEdukia',
        'isIkastegia'=>'isIkastegia',
        'edukiakSent'=>'edukiakSent',
        'ikastegiakSent'=>'ikastegiakSent',
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
        ));

        $this->setDependentList(array(
            'NewsletterHashNewsletterId' => array(
                    'property' => 'NewsletterHash',
                    'table_name' => 'NewsletterHash',
                ),
        ));




        $this->_defaultValues = array(
            'active' => '0',
            'send' => '0',
            'sent' => '0',
            'readBy' => '0',
            'dateToSend' => 'CURRENT_TIMESTAMP',
            'shippingDate' => '0000-00-00 00:00:00',
            'isEdukia' => '0',
            'isIkastegia' => '0',
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
     * @return \Klikasi\Model\Raw\Newsletter
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
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setTitle($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_title != $data) {
            $this->_logChange('title');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_title = $data;

        } else if (!is_null($data)) {
            $this->_title = (string) $data;

        } else {
            $this->_title = $data;
        }
        return $this;
    }

    /**
     * Gets column title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setContent($data)
    {

        if ($this->_content != $data) {
            $this->_logChange('content');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_content = $data;

        } else if (!is_null($data)) {
            $this->_content = (string) $data;

        } else {
            $this->_content = $data;
        }
        return $this;
    }

    /**
     * Gets column content
     *
     * @return text
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setActive($data)
    {

        if ($this->_active != $data) {
            $this->_logChange('active');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_active = $data;

        } else if (!is_null($data)) {
            $this->_active = (int) $data;

        } else {
            $this->_active = $data;
        }
        return $this;
    }

    /**
     * Gets column active
     *
     * @return int
     */
    public function getActive()
    {
        return $this->_active;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setSend($data)
    {

        if ($this->_send != $data) {
            $this->_logChange('send');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_send = $data;

        } else if (!is_null($data)) {
            $this->_send = (int) $data;

        } else {
            $this->_send = $data;
        }
        return $this;
    }

    /**
     * Gets column send
     *
     * @return int
     */
    public function getSend()
    {
        return $this->_send;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setSent($data)
    {

        if ($this->_sent != $data) {
            $this->_logChange('sent');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sent = $data;

        } else if (!is_null($data)) {
            $this->_sent = (int) $data;

        } else {
            $this->_sent = $data;
        }
        return $this;
    }

    /**
     * Gets column sent
     *
     * @return int
     */
    public function getSent()
    {
        return $this->_sent;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setReadBy($data)
    {

        if ($this->_readBy != $data) {
            $this->_logChange('readBy');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_readBy = $data;

        } else if (!is_null($data)) {
            $this->_readBy = (int) $data;

        } else {
            $this->_readBy = $data;
        }
        return $this;
    }

    /**
     * Gets column readBy
     *
     * @return int
     */
    public function getReadBy()
    {
        return $this->_readBy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setDateToSend($data)
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

        if ($this->_dateToSend != $data) {
            $this->_logChange('dateToSend');
        }

        $this->_dateToSend = $data;
        return $this;
    }

    /**
     * Gets column dateToSend
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getDateToSend($returnZendDate = false)
    {
        if (is_null($this->_dateToSend)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_dateToSend->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_dateToSend->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setShippingDate($data)
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

        if ($this->_shippingDate != $data) {
            $this->_logChange('shippingDate');
        }

        $this->_shippingDate = $data;
        return $this;
    }

    /**
     * Gets column shippingDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getShippingDate($returnZendDate = false)
    {
        if (is_null($this->_shippingDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_shippingDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_shippingDate->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setIsEdukia($data)
    {

        if ($this->_isEdukia != $data) {
            $this->_logChange('isEdukia');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_isEdukia = $data;

        } else if (!is_null($data)) {
            $this->_isEdukia = (int) $data;

        } else {
            $this->_isEdukia = $data;
        }
        return $this;
    }

    /**
     * Gets column isEdukia
     *
     * @return int
     */
    public function getIsEdukia()
    {
        return $this->_isEdukia;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setIsIkastegia($data)
    {

        if ($this->_isIkastegia != $data) {
            $this->_logChange('isIkastegia');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_isIkastegia = $data;

        } else if (!is_null($data)) {
            $this->_isIkastegia = (int) $data;

        } else {
            $this->_isIkastegia = $data;
        }
        return $this;
    }

    /**
     * Gets column isIkastegia
     *
     * @return int
     */
    public function getIsIkastegia()
    {
        return $this->_isIkastegia;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setEdukiakSent($data)
    {

        if ($this->_edukiakSent != $data) {
            $this->_logChange('edukiakSent');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_edukiakSent = $data;

        } else if (!is_null($data)) {
            $this->_edukiakSent = (string) $data;

        } else {
            $this->_edukiakSent = $data;
        }
        return $this;
    }

    /**
     * Gets column edukiakSent
     *
     * @return string
     */
    public function getEdukiakSent()
    {
        return $this->_edukiakSent;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setIkastegiakSent($data)
    {

        if ($this->_ikastegiakSent != $data) {
            $this->_logChange('ikastegiakSent');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ikastegiakSent = $data;

        } else if (!is_null($data)) {
            $this->_ikastegiakSent = (string) $data;

        } else {
            $this->_ikastegiakSent = $data;
        }
        return $this;
    }

    /**
     * Gets column ikastegiakSent
     *
     * @return string
     */
    public function getIkastegiakSent()
    {
        return $this->_ikastegiakSent;
    }

    /**
     * Sets dependent relations NewsletterHash_newsletterId
     *
     * @param array $data An array of \Klikasi\Model\Raw\NewsletterHash
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function setNewsletterHash(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_NewsletterHash === null) {

                $this->getNewsletterHash();
            }

            $oldRelations = $this->_NewsletterHash;

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

        $this->_NewsletterHash = array();

        foreach ($data as $object) {
            $this->addNewsletterHash($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations NewsletterHash_newsletterId
     *
     * @param \Klikasi\Model\Raw\NewsletterHash $data
     * @return \Klikasi\Model\Raw\Newsletter
     */
    public function addNewsletterHash(\Klikasi\Model\Raw\NewsletterHash $data)
    {
        $this->_NewsletterHash[] = $data;
        $this->_setLoaded('NewsletterHashNewsletterId');
        return $this;
    }

    /**
     * Gets dependent NewsletterHash_newsletterId
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Klikasi\Model\Raw\NewsletterHash
     */
    public function getNewsletterHash($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'NewsletterHashNewsletterId';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_NewsletterHash = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_NewsletterHash;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Newsletter
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Newsletter')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Newsletter);

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
     * @return null | \Klikasi\Model\Validator\Newsletter
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Newsletter')) {

                $this->setValidator(new \Klikasi\Validator\Newsletter);
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
     * @see \Mapper\Sql\Newsletter::delete
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