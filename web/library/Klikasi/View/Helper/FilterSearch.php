<?php
/**
 * @author ddniel
 */

class Zend_View_Helper_FilterSearch extends Zend_View_Helper_Abstract
{

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function filterSearch()
    {

        $html = '<div class="filtro-buscador col-xs-12">';
            $html .= '<ul>';
                $html .= '<li><strong>Ordenatu:</strong></li>';
                $html .= '<li><a href="javascript:void(0)" data-sort-by="moreLikes">Berrienak</a></li>';
                $html .= '<li><a href="javascript:void(0)" data-sort-by="moreViews">Ikusienak</a></li>';
                $html .= '<li><a href="javascript:void(0)" data-sort-by="moreComments">Arrakastatsuenak</a></li>';
            $html .= '</ul>';
        $html .= '</div>';

        return $html;

    }
}