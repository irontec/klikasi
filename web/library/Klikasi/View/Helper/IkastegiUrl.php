<?php
/**
* Erabiltzailearen irudia erakutsi
* @author arkaitz
*/

class Zend_View_Helper_IkastegiUrl extends Zend_View_Helper_Abstract
{

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function ikastegiUrl(Klikasi\Model\Ikastegia $ikastegia)
    {
        return $this->view->url(
            array(
                'controller' => 'ikastegiak',
                'action' => 'ikusi',
                'ikastegia' => $ikastegia->getUrl()
            )
        );
    }
}