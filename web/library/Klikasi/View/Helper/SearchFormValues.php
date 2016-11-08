<?php
use Klikasi\Mapper\Sql as Mapper;
use Klikasi\Model as Model;

class Zend_View_Helper_SearchFormValues extends Zend_View_Helper_Abstract
{
    public function searchFormValues()
    {
        $response = array();

        $kategoriaMapper = new Mapper\Kategoria;
        $response['kategoria'] = $kategoriaMapper->fetchList(null, 'izena');

        $ikastegiaMapper = new Mapper\Ikastegia;
        $response['ikastegia'] = $ikastegiaMapper->fetchList("aktibatua = 1", 'izena');

        $mailaMapper = new Mapper\Maila;
        $response['maila'] = $mailaMapper->fetchList("url != 'guztiak'", new \Zend_Db_Expr("FIELD(grupo, 'haurHezkuntza', 'LH', 'DBH', 'Batxilergoa', 'bestelakoak'), izena"));

        return $response;
    }
}