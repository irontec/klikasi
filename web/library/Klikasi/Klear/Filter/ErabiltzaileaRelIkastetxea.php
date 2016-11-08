<?php

namespace Klikasi\Klear\Filter;

class ErabiltzaileaRelIkastegia implements \KlearMatrix_Model_Field_Select_Filter_Interface
{
    protected $_condition;

    public function setRouteDispatcher(\KlearMatrix_Model_RouteDispatcher $routeDispatcher)
    {

        $controller = $routeDispatcher->getActionName();
        $action = $routeDispatcher->getControllerName();

        if ($controller == "index" && $action == "new") {
        } elseif ($controller == "index" && $action == "edit") {
            $relazioMapper = new \Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia();
            $relId = $routeDispatcher->getParam('pk');
            $row = $relazioMapper->find($relId);

            $idak = $this->_erlazionatutakoIdakEkarri($row);
            $this->_condition[] = " (id NOT IN ('" . implode(',', array_keys($idak)) . "') ";
        }

        return true;

    }

    public function getCondition()
    {
        if (count($this->_condition) > 0) {
            return '(' . implode(" AND ", $this->_condition) . ')';
        }
        return;
    }

    protected function _erlazionatutakoIdakEkarri(\Klikasi\Model\Raw\ErabiltzaileaRelIkastegia $row)
    {
        var_dump($row);exit;
    }

}