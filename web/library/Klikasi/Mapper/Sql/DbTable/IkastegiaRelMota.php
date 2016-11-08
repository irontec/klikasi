<?php

/**
 * Application Model DbTables
 *
 * @package Klikasi\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Irontec
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Table definition for IkastegiaRelMota
 *
 * @package Klikasi\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Irontec
 */

namespace Klikasi\Mapper\Sql\DbTable;
class IkastegiaRelMota extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'IkastegiaRelMota';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'Klikasi\\Model\\IkastegiaRelMota';
    protected $_rowMapperClass = 'Klikasi\\Mapper\\Sql\\IkastegiaRelMota';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'IkastegiaRelMotaIbfk1' => array(
            'columns' => 'ikastegiaId',
            'refTableClass' => 'Klikasi\\Mapper\\Sql\\DbTable\\Ikastegia',
            'refColumns' => 'id'
        ),
        'IkastegiaRelMotaIbfk2' => array(
            'columns' => 'ikastegiMotaId',
            'refTableClass' => 'Klikasi\\Mapper\\Sql\\DbTable\\IkastegiMota',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'IkastegiaRelMota',
	    'COLUMN_NAME' => 'id',
	    'COLUMN_POSITION' => 1,
	    'DATA_TYPE' => 'mediumint',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => true,
	    'PRIMARY_POSITION' => 1,
	    'IDENTITY' => true,
	  ),
	  'ikastegiaId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'IkastegiaRelMota',
	    'COLUMN_NAME' => 'ikastegiaId',
	    'COLUMN_POSITION' => 2,
	    'DATA_TYPE' => 'mediumint',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'ikastegiMotaId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'IkastegiaRelMota',
	    'COLUMN_NAME' => 'ikastegiMotaId',
	    'COLUMN_POSITION' => 3,
	    'DATA_TYPE' => 'mediumint',
	    'DEFAULT' => NULL,
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => true,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	);




}
