<?php
/**
 * Ikastegien kategorien select-a marrazteko
* @author arkaitz
*/

class Klikasi_View_Helper_IkastegienKategoriakSelect extends \Zend_View_Helper_Abstract
{

    public function setView(\Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function ikastegienKategoriakSelect()
    {

        $html = '';
        $url = $this->view->serverUrl(
            $this->view->url(
                array(
                    'controller' => 'ikastegiak'
                ), '', true
            )
        );

        $aktibatutakoa = $this->view->kategoriaFiltroa;

        if ($kategoriak = $this->view->kategoriak) {

            $html .= '<select id="ikastegiKatSelect">';
            $html .= '<option value="'.$url.'" ';

            if (!$aktibatutakoa) {
                $html .= ' selected=selected';
            }

            $html .= '>Denak</option>';

            foreach ($kategoriak as $kategoria) {
                $html .= '<option value="';
                $html .= $this->view->queryUrl(
                    array('mota' =>  $kategoria->getUrl()),
                    true,
                    $url
                ) . '"';

                if ($aktibatutakoa && $aktibatutakoa == $kategoria->getUrl()) {
                    $html .= ' selected=selected';
                }

                $html .= '>' . $kategoria->getIzena() . '</option>';

            }

            $html .= '</select>';

        }

        return $html;

    }

}