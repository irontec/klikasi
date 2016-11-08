<?php

use Klikasi\Mapper\Sql\Edukia;

class Klikasi_Controller_Action_Helper_CurrentSessionStatus extends Zend_Controller_Action_Helper_Abstract
{

    public function getCurrentSessionStatus()
    {

        $navigation = new Zend_Session_Namespace("navigation");

        if (is_null($navigation->views)) {
            $navigation->views = array();
            $navigation->views[] = $this->getRequest()->getRequestUri();
            $this->_insertCountPage();
        } else {
            if (!in_array($this->getRequest()->getRequestUri(), $navigation->views, true)) {
                $navigation->views[] = $this->getRequest()->getRequestUri();
                $this->_insertCountPage();
            }
        }

        return true;

    }

    public function direct()
    {
        return $this->getCurrentSessionStatus();
    }

    /**
     * Comprueba a que instancia tiene que hacer el +1
     * * Edukia
     */
    protected function _insertCountPage()
    {
        $request = $this->getRequest();

        if ($this->_isEdukiaIkusi($request)) {
            $this->_countEdukiak($request->getParam('edukia', false));
        }

    }

    /**
     * Comprueba que es un Edukia ~ Ikusi para poder llamar a _countEdukiak
     */
    protected function _isEdukiaIkusi($request)
    {
        if (
            $request->getControllerName() == "edukiak"
        &&
            $request->getActionName() == "ikusi"
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Busca el edukia actual y le da un +1 en las visitas
     */
    protected function _countEdukiak($edukia)
    {

        $edukiaMapper = new Edukia();
        $edukiaModel = $edukiaMapper->findOneByField("url", $edukia);

        if (!is_null($edukiaModel)) {
            $newCount = $edukiaModel->getBisitaKopurua() + 1;
            $edukiaModel->setBisitaKopurua($newCount);
            $edukiaModel->save();
        }
    }

}