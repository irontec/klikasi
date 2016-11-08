<?php
/**
 * @author ddniel
 */
class Zend_View_Helper_MetaDatadaSocials extends Zend_View_Helper_Abstract
{

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function metaDatadaSocials($isSocial)
    {

        $head = new Zend_View_Helper_HeadMeta();

        $head->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
        //$head->appendName('keywords', 'klikasi');
        //$head->appendName('description', 'Euskarazko edukiak');

        if ($isSocial) {

            if ($isSocial == 'ikastegia') {

                $ikastegia = $this->view->ikastegia;

                $title = $ikastegia->getIzena();
                $description = $ikastegia->getDeskribapenLaburra();

                $url = $this->_fullUrl(
                    'ikastegiak/ikusi/ikastegia/' . $ikastegia->getUrl()
                );

                $img = $this->_fullUrl(
                    'image/index/id/' . $ikastegia->getId() . '/view/ikastegia/'
                );

            } elseif ($isSocial == 'edukia') {

                $edukia = $this->view->edukia;

                $title = $edukia->getTitulua();
                $description = $edukia->getDeskribapenLaburra();

                $url = $this->_fullUrl(
                    'edukiak/ikusi/edukia/' . $edukia->getUrl()
                );

                $imgs = array();
                if (sizeof($edukia->getIrudia()) > 0) {
                    foreach ($edukia->getIrudia() as $irudia) {
                        if ($irudia->getMota() == 'flickr') {
                            $imgs[] = $irudia->getUrl();
                        }
                    }
                }

                $img = implode(', ', $imgs);

            }

            /**
             * Facebook
             */
            $facebook = array(
                'og:title' => $title,
                'og:description' => $description,
                'og:image' => $img,
                'og:url' => $url,
                'og:type' => 'article',
            );

            /**
             * Twitter
             */
            $twitter = array(
                'twitter:title' => $title,
                'twitter:card' => 'summary',
                'twitter:description' => $description,
                'twitter:image' => $img
            );

            foreach ($facebook as $key => $val) {
                $head->appendProperty($key, $val);
            }

            foreach ($twitter as $key => $val) {
                $head->appendName($key, $val);
            }

        }

        $head->setIndent(4);

        return $head;

    }

    protected function _fullUrl($url)
    {
        return $this->view->serverUrl(
            $this->view->baseUrl(
                $url
            )
        );
    }

}