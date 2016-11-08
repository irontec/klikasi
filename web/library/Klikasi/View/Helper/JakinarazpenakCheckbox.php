<?php

class Zend_View_Helper_JakinarazpenakCheckbox extends Zend_View_Helper_Abstract
{
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function jakinarazpenakCheckbox($title, $name, $value)
    {

        $html = '<label
                   for="' . $name . '"
                   class="col-sm-8 control-label optional"
                   >';

        $html .= $title;
        $html .= '</label>';

        $checked1 = intval($value) > 0 ? 'checked' : '';
        $active1 = intval($value) > 0 ? 'active' : '';

        $checked2 = intval($value) == 0 ? 'checked' : '';
        $active2 = intval($value) == 0 ? 'active' : '';

        $html .= '<div class="btn-group pull-right" data-toggle="buttons">';
            $html .= '<label class="btn btn-default '. $active1 .'">';
                $html .= '<input type="radio" name="' . $name . '" value="1" '. $checked1 .'> Bai';
            $html .= '</label>';
            $html .= '<label class="btn btn-default '. $active2 .'">';
                $html .= '<input type="radio" name="' . $name . '" value="0"'. $checked2 .'> Ez';
            $html .= '</label>';
        $html .= '</div>';

        return '<div>' . $html . '<div class="clearfix"></div></div>';
    }
}