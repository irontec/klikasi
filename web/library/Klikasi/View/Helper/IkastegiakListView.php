<?php
/**
 * @author ddniel
 */

class Zend_View_Helper_IkastegiakListView extends Zend_View_Helper_Abstract
{

    protected $_view;
    protected $_mustache;
    protected $_templateIkastegiak;
    protected $_kategoriakView;

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    /**
     * @param $ikastegiak array() / array de modelos
     * @return string
     */
    public function ikastegiakListView($ikastegiak, $view)
    {

        die('Not Found');
        $this->_view = new \Zend_View();
        $this->_mustache = new \Mustache_Engine();
        $this->_kategoriakView = $view;

        $this->_templateIkastegiak = $this->_view->setScriptPath(
            APPLICATION_PATH .
            '/views/scripts'
        )->render('templates/ikastegiak/ikastegiakList.phtml');

        if (sizeof($ikastegiak) > 0) {

            $html = '';

            foreach ($ikastegiak as $ikastegia) {

                $html .= $this->_mustache->render(
                    $this->_templateIkastegiak,
                    $this->_populateIkastegi($ikastegia)
                );

            }

        } else {
            return 'empty';
        }

        return $html;

    }

    protected function _populateIkastegi($ikastegi)
    {

        $ikastegiData = array(
            'irudiaUrl' => $ikastegi->ikastegiaIrudiaUrl('ikastegiaList'),
            'izena' => $ikastegi->getIzena(),
            'ikastegiaUrl' => $ikastegi->ikastegiaUrl(),
            'autore' => sizeof($ikastegi->erabiltzaileakOnartua()),
            'edukiakCount' => sizeof($ikastegi->edukiakOnartua()),
            'kategoriak' => $this->_populateKategoriak($ikastegi)
        );

        return $ikastegiData;

    }

    protected function _populateKategoriak($ikastegi)
    {

        $kategoriak = array();
        $kategoriakRelList = $ikastegi->fetchKategoriak();

        if (sizeof($kategoriakRelList) > 0) {
            $kategoriakSelected = array_slice($kategoriakRelList, 0, 3);

            if ($this->_kategoriakView == 'ikastegiaList') {
                $width = 'col-xs-12 col-sm-4';
                $class = 'destacada';
            } else {
                $width = '';
                $class = '';
            }

            foreach ($kategoriakSelected as $kategoria) {

                $firstRel = reset($kategoria->getKategoriakRelKategoriaGlobalak())->getKategoriaGlobala();

                $kategoriak[] = array(
                    'width' => $width,
                    'class' => $class,
                    'kategoriaIrudia' => $firstRel->kategoriaGlobalaIrudiaUrl('ikastegiaKategoria'),
                    'kategoriaUrl' => $kategoria->kategoriaUrl(),
                    'kategoriaIzena' => $kategoria->getIzena(),
                    'kategoriaEdukiakCount' => sizeof($kategoria->kategoriaEdukiak()),
                    'kategoriaGlobalaClassName' => $firstRel->getClassName()
                );

            }

            return $kategoriak;

        } else {
            return $kategoriak;
        }

    }

}