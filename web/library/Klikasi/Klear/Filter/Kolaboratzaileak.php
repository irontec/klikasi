<?php

namespace Klikasi\Klear\Filter;

class Kolaboratzaileak implements \KlearMatrix_Model_Field_Multiselect_Filter_Interface
{
    protected $_condition;

    public function setRouteDispatcher(\KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {

        $edukiaMapper = new \Klikasi\Mapper\Sql\Edukia();
        $edukiaId = $routeDispatcher->getParam('pk');
        $row = $edukiaMapper->find($edukiaId);

        $this->_condition[] = " (id <> '".$row->getErabiltzaileaId()."') ";

        return true;

    }

    public function getCondition()
    {

        if (count($this->_condition) > 0) {
            return '(' . implode(" AND ", $this->_condition) . ')';
        }

        return;
    }

}