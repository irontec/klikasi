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
 * Table definition for JakinarazpenakGroup
 *
 * @package Klikasi\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Irontec
 */

namespace Klikasi\Mapper\Sql\DbTable;
class JakinarazpenakGroup extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'JakinarazpenakGroup';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'Klikasi\\Model\\JakinarazpenakGroup';
    protected $_rowMapperClass = 'Klikasi\\Mapper\\Sql\\JakinarazpenakGroup';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'JakinarazpenakGroupErabiltzaileaId' => array(
            'columns' => 'erabiltzaileaId',
            'refTableClass' => 'Klikasi\\Mapper\\Sql\\DbTable\\Erabiltzailea',
            'refColumns' => 'id'
        ),
        'JakinarazpenakGroupJakinarazpenakId' => array(
            'columns' => 'jakinarazpenakId',
            'refTableClass' => 'Klikasi\\Mapper\\Sql\\DbTable\\Jakinarazpenak',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'JakinarazpenakGroup',
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
	  'jakinarazpenakId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'JakinarazpenakGroup',
	    'COLUMN_NAME' => 'jakinarazpenakId',
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
	  'erabiltzaileaId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'JakinarazpenakGroup',
	    'COLUMN_NAME' => 'erabiltzaileaId',
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
	  'sortzeData' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'JakinarazpenakGroup',
	    'COLUMN_NAME' => 'sortzeData',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'timestamp',
	    'DEFAULT' => 'CURRENT_TIMESTAMP',
	    'NULLABLE' => false,
	    'LENGTH' => NULL,
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	);




}
