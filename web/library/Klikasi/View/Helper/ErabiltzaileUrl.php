<?php
/**
* Erabiltzailearen irudia erakutsi
* @author arkaitz
*/

class Zend_View_Helper_ErabiltzaileUrl extends Zend_View_Helper_Abstract
{

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function erabiltzaileUrl(Klikasi\Model\Erabiltzailea $erabiltzailea)
    {
        return $this->view->url(
            array(
                'controller' => 'erabiltzaileak',
                'action' => 'ikusi',
                'erabiltzailea' => $erabiltzailea->getUrl()
            )
        );
    }
}