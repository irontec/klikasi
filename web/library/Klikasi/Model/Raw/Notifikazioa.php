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
class Notifikazioa extends ModelAbstract
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
    protected $_titulua;

    /**
     * [html]
     * Database var type mediumtext
     *
     * @var text
     */
    protected $_edukiaHtml;

    /**
     * Database var type mediumtext
     *
     * @var text
     */
    protected $_edukiaText;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_identifikatzailea;



    protected $_columnsList = array(
        'id'=>'id',
        'titulua'=>'titulua',
        'edukiaHtml'=>'edukiaHtml',
        'edukiaText'=>'edukiaText',
        'identifikatzailea'=>'identifikatzailea',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'edukiaHtml'=> array('html'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('eu'));

        $this->setParentList(array(
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
     * @return \Klikasi\Model\Raw\Notifikazioa
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
     * @return \Klikasi\Model\Raw\Notifikazioa
     */
    public function setTitulua($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_titulua != $data) {
            $this->_logChange('titulua');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_titulua = $data;

        } else if (!is_null($data)) {
            $this->_titulua = (string) $data;

        } else {
            $this->_titulua = $data;
        }
        return $this;
    }

    /**
     * Gets column titulua
     *
     * @return string
     */
    public function getTitulua()
    {
        return $this->_titulua;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\Notifikazioa
     */
    public function setEdukiaHtml($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_edukiaHtml != $data) {
            $this->_logChange('edukiaHtml');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_edukiaHtml = $data;

        } else if (!is_null($data)) {
            $this->_edukiaHtml = (string) $data;

        } else {
            $this->_edukiaHtml = $data;
        }
        return $this;
    }

    /**
     * Gets column edukiaHtml
     *
     * @return text
     */
    public function getEdukiaHtml()
    {
        $pathFixer = new \Iron_Filter_PathFixer;
        return $pathFixer->fix($this->_edukiaHtml);
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \Klikasi\Model\Raw\Notifikazioa
     */
    public function setEdukiaText($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_edukiaText != $data) {
            $this->_logChange('edukiaText');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_edukiaText = $data;

        } else if (!is_null($data)) {
            $this->_edukiaText = (string) $data;

        } else {
            $this->_edukiaText = $data;
        }
        return $this;
    }

    /**
     * Gets column edukiaText
     *
     * @return text
     */
    public function getEdukiaText()
    {
        return $this->_edukiaText;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Klikasi\Model\Raw\Notifikazioa
     */
    public function setIdentifikatzailea($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_identifikatzailea != $data) {
            $this->_logChange('identifikatzailea');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_identifikatzailea = $data;

        } else if (!is_null($data)) {
            $this->_identifikatzailea = (string) $data;

        } else {
            $this->_identifikatzailea = $data;
        }
        return $this;
    }

    /**
     * Gets column identifikatzailea
     *
     * @return string
     */
    public function getIdentifikatzailea()
    {
        return $this->_identifikatzailea;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Klikasi\Mapper\Sql\Notifikazioa
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Klikasi\Mapper\Sql\Notifikazioa')) {

                $this->setMapper(new \Klikasi\Mapper\Sql\Notifikazioa);

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
     * @return null | \Klikasi\Model\Validator\Notifikazioa
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Klikasi\\Validator\Notifikazioa')) {

                $this->setValidator(new \Klikasi\Validator\Notifikazioa);
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
     * @see \Mapper\Sql\Notifikazioa::delete
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