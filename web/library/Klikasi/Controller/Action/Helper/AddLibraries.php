<?php

/**
 * Carga los .js  y .css que se pasen en array.
 */
class Klikasi_Controller_Action_Helper_AddLibraries extends Zend_Controller_Action_Helper_Abstract
{

    public function setAddLibraries($librariesJs, $librariesCss)
    {

        $view = new \Zend_View();

        if (!empty($librariesJs)) {
            foreach ($librariesJs as $js) {
                $view->headScript()
                    ->appendFile(
                        $view->baseUrl(
                            $js
                        )
                    );
            }
        }

        if (!empty($librariesCss)) {
            foreach ($librariesCss as $css) {
                $view->headLink()
                    ->appendStylesheet(
                        $view->baseUrl(
                            $css
                        )
                    );
            }
        }

    }

    public function direct($librariesJs = array(), $librariesCss = array())
    {
        return $this->setAddLibraries($librariesJs, $librariesCss);
    }

}