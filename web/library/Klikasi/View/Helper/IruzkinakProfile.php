<?php

class Zend_View_Helper_IruzkinakProfile extends Zend_View_Helper_Abstract
{

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function iruzkinakProfile($irzkinak)
    {

        $html = '<div class="col-xs-12">';

        if (sizeof($irzkinak) > 0) {
            foreach ($irzkinak as $irzkina) {

                $edukia = $irzkina->getEdukia();

                $html .= '<div class="col-xs-8 col-xs-offset-2">';

                    $html .= '<div class="col-xs-3">';
                        $html .= $this->_figureIrudia($edukia);
                    $html .= '</div>';

                    $html .= '<div class="col-xs-6">';
                        $html .= '<p>' . $irzkina->getIruzkin() . '</p>';
                    $html .= '</div>';

                    $html .= '<div class="col-xs-3">';
                        $html .= '<a
                                    href="' . $edukia->edukiaUrl() . '"
                                    class="btn btn-default"
                                    title="' . $edukia->getTitulua() . '">';
                            $html .= 'Ver';
                        $html .= '</a>';
                    $html .= '</div>';

                $html .= '</div>';

            }
        } else {
            $html .= '<p>Ez dago iruzkinik</p>';
        }

        $html .= '</div>';

        return $html;

    }

    protected function _figureIrudia($edukia)
    {

        $irudias = $edukia->getIrudia();

        if (sizeof($irudias) > 0) {

            $keyIrudia = array_rand($irudias, 1);
            $irudia = $irudias[$keyIrudia];

            $imgUrl = $this->view->baseUrl('image/index/id/' . $irudia->getId() . '/size/homePage/view/irudia');
            $imgName = $irudia->getTitulua();

        } else {
            $imgUrl = 'holder.js/248x120';
            $imgName = '';
        }

        $className = $edukia->kategoriaGlobala()->getClassName();

        $html = '<img src="' . $imgUrl . '" alt="' . $imgName . '"/>';
        $html .= '<figcaption class="">';
            $html .= '<div class="bottom-block ' . $className . '">';
                $html .= '<span class="category">';
                    $html .= '<a href="' . $edukia->edukiaUrl() . '" title="' . $edukia->getTitulua() . '">';
                        $html .= $edukia->getTitulua();
                    $html .= '</a>';
                $html .= '</span>';
            $html .= '</div>';

        $html .= '</figcaption>';

        return $html;

    }

}