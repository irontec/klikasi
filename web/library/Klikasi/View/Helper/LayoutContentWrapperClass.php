<?php
/**
* Gets content wrapper div class by section
* @author mmadariaga
*/

class Zend_View_Helper_LayoutContentWrapperClass extends Zend_View_Helper_Abstract
{

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function layoutContentWrapperClass ()
    {
        $front = Zend_Controller_Front::getInstance();
        $request = $front->getRequest();

        $divClass = '';

        switch  ($request->getControllerName()) {

            case 'orriak':

                //$divClass = 'container p-top-3';
                $divClass = 'container principal';
                if ($request->getParam("orria") == 'pribatutasun-politika') {

                    $divClass = 'container p-top-3 p-bottom-3';
                }
                break;
        }

        return $divClass;

    }

}