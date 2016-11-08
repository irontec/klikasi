<?php
/**
* Erabiltzailearen irudia erakutsi
* @author arkaitz
*/

class Zend_View_Helper_ErabiltzaileIrudia extends Zend_View_Helper_Abstract
{

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function erabiltzaileIrudia(
        Klikasi\Model\Erabiltzailea $erabiltzailea,
        $width = 200,
        $initial = false
    )
    {

        return $erabiltzailea->avatarView($width, $initial);

    }

}