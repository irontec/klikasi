<?php
class Zend_View_Helper_StrongWrap extends Zend_View_Helper_Abstract
{
    public function strongWrap($text, $wrap)
    {
        if ($wrap) {
            $text = '<strong>' . $text . '</strong>';
        }

        return $text;
    }
}