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
 * Table definition for ErabiltzaileaRelIrakaslea
 *
 * @package Klikasi\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Irontec
 */

namespace Klikasi\Mapper\Sql\DbTable;
class ErabiltzaileaRelIrakaslea extends TableAbstract
{
    /**
     * $_name - name of database table
     *
     * @var string
     */
    protected $_name = 'ErabiltzaileaRelIrakaslea';

    /**
     * $_id - this is the primary key name
     *
     * @var int
     */
    protected $_id = 'id';

    protected $_rowClass = 'Klikasi\\Model\\ErabiltzaileaRelIrakaslea';
    protected $_rowMapperClass = 'Klikasi\\Mapper\\Sql\\ErabiltzaileaRelIrakaslea';

    protected $_sequence = true; // int
    protected $_referenceMap = array(
        'ErabiltzaileaRelIrakasleaIkastegiaId' => array(
            'columns' => 'ikastegiaId',
            'refTableClass' => 'Klikasi\\Mapper\\Sql\\DbTable\\Ikastegia',
            'refColumns' => 'id'
        ),
        'FkErabiltzaileaHasErabiltzaileaErabiltzailea3' => array(
            'columns' => 'erabiltzaileaId',
            'refTableClass' => 'Klikasi\\Mapper\\Sql\\DbTable\\Erabiltzailea',
            'refColumns' => 'id'
        ),
        'FkErabiltzaileaHasErabiltzaileaErabiltzailea4' => array(
            'columns' => 'irakasleaId',
            'refTableClass' => 'Klikasi\\Mapper\\Sql\\DbTable\\Erabiltzailea',
            'refColumns' => 'id'
        )
    );
    
    protected $_metadata = array (
	  'id' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ErabiltzaileaRelIrakaslea',
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
	  'erabiltzaileaId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ErabiltzaileaRelIrakaslea',
	    'COLUMN_NAME' => 'erabiltzaileaId',
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
	  'irakasleaId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ErabiltzaileaRelIrakaslea',
	    'COLUMN_NAME' => 'irakasleaId',
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
	  'egoera' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ErabiltzaileaRelIrakaslea',
	    'COLUMN_NAME' => 'egoera',
	    'COLUMN_POSITION' => 4,
	    'DATA_TYPE' => 'varchar',
	    'DEFAULT' => 'onartzeko',
	    'NULLABLE' => false,
	    'LENGTH' => '45',
	    'SCALE' => NULL,
	    'PRECISION' => NULL,
	    'UNSIGNED' => NULL,
	    'PRIMARY' => false,
	    'PRIMARY_POSITION' => NULL,
	    'IDENTITY' => false,
	  ),
	  'ikastegiaId' => 
	  array (
	    'SCHEMA_NAME' => NULL,
	    'TABLE_NAME' => 'ErabiltzaileaRelIrakaslea',
	    'COLUMN_NAME' => 'ikastegiaId',
	    'COLUMN_POSITION' => 5,
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
