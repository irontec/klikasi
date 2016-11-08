<?php

class Zend_View_Helper_SartuDialog extends Zend_View_Helper_Abstract
{

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function sartuDialog()
    {

        $this->_mustache = new \Mustache_Engine();
        $this->_scriptPath = APPLICATION_PATH . '/views/scripts/templates/';
        $template = 'sartuDialog.phtml';
        $this->_view = new \Zend_View();
        return $this->_view->setScriptPath(
            $this->_scriptPath
        )->render($template);

    }

}