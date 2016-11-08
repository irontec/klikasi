<?php

class Zend_View_Helper_AlertMessage extends Zend_View_Helper_Abstract
{
    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function alertMessage($erroreMezuak, $flashmezuak, $alertSuccess)
    {

         if ($erroreMezuak) {
             echo '<div class="alert alert-danger">';
                 echo '<ul>';
                     foreach ($erroreMezuak as $errorea) {
                         echo '<li>' . $errorea . '</li>';
                     }
                 echo '</ul>';
             echo '</div>';
         }

        if ($flashmezuak) {
             foreach ($flashmezuak as $mezua) {
                 echo '<div class="alert alert-' . key($mezua) . '">';
                     echo '<ul>';
                         echo '<li>' . current($mezua) . '</li>';
                     echo '</ul>';
                 echo '</div>';
             }
        }

        if (!empty($alertSuccess)) {
             echo '<div class="alert alert-success">';
                 echo '<ul>';
                     foreach ($alertSuccess as $alert) {
                         echo '<li>';
                             echo $alert;
                         echo '</li>';
                     }
                 echo '</ul>';
             echo '</div>';
        }

    }

}