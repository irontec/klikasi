<?php

class Zend_View_Helper_JakinarazpenakSelect extends Zend_View_Helper_Abstract
{

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function jakinarazpenakSelect($title, $name, $value)
    {

        $options = array();
        $options[] = array(
            'value' => 1,
            'literal' => 'Bai'
        );
        $options[] = array(
            'value' => 0,
            'literal' => 'Ez'
        );

         $html = '<label
                    for="' . $name . '"
                    class="col-sm-6 control-label optional"
                    >';
                $html .= $title;
         $html .= '</label>';

         $html .= '<select
                    name="' . $name . '"
                    id="' . $name . '"
                    class="form-control"
                    style="width: 50%;"
                    >';
             foreach ($options as $option) {

                 $selected = '';
                 if ($option['value'] == $value) {
                     $selected = 'selected';
                 }

                 $html .= '<option value="' . $option['value'] . '" ' . $selected .'>';
                     $html .= $option['literal'];
                 $html .= '</option>';
             }
         $html .= '</select>';


         return '<div class="form-group">' . $html . '</div>';

    }

}