<?php

/**
 *
 * @package Klikasi\Model
 * @subpackage Paginator
 * @author Irontec
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Paginator class that extends Zend_Paginator_Adapter_DbSelect to return an
 * object instead of an array.
 *
 * @package Klikasi\Model
 * @subpackage Paginator
 * @author Irontec
 */
namespace Klikasi\Model;
class Paginator extends \Zend_Paginator_Adapter_DbSelect
{
    /**
     * Object mapper
     *
     * @var Klikasi\Mapper\Sql\Raw\MapperAbstract
     */
    protected $_mapper = null;

    /**
     * Constructor.
     *
     * @param Zend_Db_Select $select The select query
     * @param Klikasi\Mapper\Sql\Raw\MapperAbstract $mapper The mapper associated with the object type
     */
    public function __construct(\Zend_Db_Select $select, \Klikasi\Mapper\Sql\Raw\MapperAbstract $mapper)
    {
        $this->_mapper = $mapper;
        parent::__construct($select);
    }

    /**
     * Returns an array of items as objects for a page.
     *
     * @param  integer $offset Page offset
     * @param  integer $itemCountPerPage Number of items per page
     * @return array An array of Klikasi\\Raw\ModelAbstract objects
     */
    public function getItems($offset, $itemCountPerPage)
    {
        $items = parent::getItems($offset, $itemCountPerPage);
        $objects = array();

        foreach ($items as $item) {
            $objects[] = $this->_mapper->loadModel($item, null);
        }

        return $objects;
    }
}
