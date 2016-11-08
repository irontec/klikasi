<?php

use Klikasi\Mapper\Sql as Mapper;
use Klikasi\Mapper\Sql\Orrialdea as OrrialdeaMapper;

class OrriakController extends Zend_Controller_Action
{
    protected $_orrialdeaMapper;
    protected $_templates;

    public function init()
    {
        $this->_orrialdeaMapper = new OrrialdeaMapper;

        $this->_helper->layout->setLayout('simple');

        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;
    }

    public function indexAction()
    {
        /**
         * Si estan en este array se visualiza directamente.
         * Si no esta se compruba el que el campo 'publikatua'
         * sea igual a 1 y se redirecciona a otro Action.
         */
        $orriakTrue = array(
            'honi-buruz',
            //'pribatutasun-politika',
            'baldintzak-pribatutasun-politika',
            //'gida',
            //'harremanetan',
            //'zerbitzu-baldintzak',
            //'lizentzia'
        );

        $url = $this->getRequest()->getParam('orria', false);
        if (empty($url)) {
            $this->_redirect('/');
        }

        $orria = $this->_orrialdeaMapper->findOneByField(
            'url',
            $url
        );

        switch ($url) {
    	case 'honi-buruz':
    		$orrialdea = $this->_orrialdeaMapper->findOneByField("titulua", "Honi buruz");
    		$this->view->metaDescription = $orrialdea->getMetaDescription();
    		$this->view->metaTitle = $orrialdea->getMetaTitle();
    		$this->view->metaKeywords = $orrialdea->getMetaKeywords();
    		$this->view->currentUrl = $this->view->serverUrl($this->view->url());
    		$this->view->urlMetaImage = $orrialdea->orrialdeaIrudiaUrl();
    		$this->view->metaType = "website";
    		break;
    	case 'baldintzak-pribatutasun-politika':
    		$orrialdea = $this->_orrialdeaMapper->findOneByField("titulua", "Baldintzak eta pribatutasun politika");
    		$this->view->metaDescription = $orrialdea->getMetaDescription();
    		$this->view->metaTitle = $orrialdea->getMetaTitle();
    		$this->view->metaKeywords = $orrialdea->getMetaKeywords();
    		$this->view->currentUrl = $this->view->serverUrl($this->view->url());
    		$this->view->urlMetaImage = $orrialdea->orrialdeaIrudiaUrl();
    		$this->view->metaType = "website";
    		break;
    	} 
    	
        if (empty(array_keys($orriakTrue, $url)) || empty($orria)) {

            /*$kanpainakMapper = new Mapper\Kanpaina;
            $orria = $kanpainakMapper->findOneByField(
                'url',
                $url
            );
            var_dump($orria);
            die();

            if (empty($orria)) {

            }
            */
            $this->_redirect('/');
            die; //WTF???
            throw new Zend_Exception(
                'Pendiente !!!'
            );

        } else {

            $this->view->orria = $orria;
            $this->view->title = $orria->getTitulua();
        }
    }

    public function dinamikoakAction()
    {
        $this->_fetchOrria();
    }

    public function kanpainakAction()
    {
        $this->_fetchOrria();
    }

    protected function _throwException($text)
    {
        throw new Zend_Exception(
            $text
        );
    }

    protected function _fetchOrria()
    {
        $kanpainaMapper = new \Klikasi\Mapper\Sql\Kanpaina();
        $url = $this->getRequest()->getParam('orria', false);

        if ($url) {
            $orria = $kanpainaMapper->findOneByField(
                'url',
                $url
            );

        } else {
            $this->_throwException('Orria ez da existitzen');
        }

        if (empty($orria)) {
            $this->_throwException('Orria ez da existitzen');
        }

        if ($orria->getEgoera() != 1) {
            $this->_throwException('Orria ez da existitzen');
        }

        if ($orria->getKanpaina() == 1) {

            if ($this->getRequest()->getActionName() != 'kanpainak') {
                $this->_throwException('Orria ez da existitzen');
            }

            $today = new \Zend_Date();
            $today = $today->toString('YYYY-MM-dd');

            $todayStr = strtotime($today);
            $hasieraStr = strtotime($orria->getHasiera());
            $bukaeraStr = strtotime($orria->getBukaera());

            if ($hasieraStr > $todayStr && $bukaeraStr < $todayStr) {
                $this->_throwException('Orria ez da existitzen');
            }

        } else {

            if ($this->getRequest()->getActionName() != 'dinamikoak') {
                $this->_throwException('Orria ez da existitzen');
            }
        }

        $slidesWidgets = array();
        $first = false;

        /**
         * Winner
         */
         if ($orria->getKanpaina()) {
            if (strtotime($orria->getBukaera()) < time()) {

                $edukiaRelKanpainaMapper = new Mapper\EdukiaRelKanpaina;    
                $where = "kanpainaId = ". intval($orria->getId()) ." and irabazlea = 1";

                $theWinnerIs = $edukiaRelKanpainaMapper->fetchList($where);
                foreach ($theWinnerIs as $key => $winner) {
                    $theWinnerIs[$key] = $winner->getEdukia();
                }
                if (!empty($theWinnerIs)) {

                    $winner = $this->_prepareWidgetEdukia(
                        $theWinnerIs,
                        $first
                    );

                    $winnerData =  array(
                        'id' => 'eventos-relacionados',
                        'class' => 'container aire',
                        'header' => 'Kanpaina irabazlea',
                        'title' => $theWinnerIs[0]->getTitulua(),
                        'url' => $this->view->baseUrl('/edukiak/ikusi/edukia/' . $theWinnerIs[0]->getUrl()),
                        'desc' => $theWinnerIs[0]->getDeskribapenLaburra(),
                        'slides' => array (
                            array (
                                'class' => 'container aire active',
                                'class-xs' => 'active',
                                'elems' => $winner
                            )
                        )
                    );

                    $this->view->theWinner = $this->_templates->loadTemplate('winnerWidget')
                                                   ->render($winnerData);
                }
            }
        }

        /**
         * Widget Edukiak
         */

        if ($orria->getWidgetEdukiak() === 1) {
            $elements = $this->_prepareWidgetEdukia(
                $orria->listEdukiakWidget(),
                $first
            );

            if (sizeof($elements) > 0) {
                if ($first === false) {
                    $first = true;
                    $slidesWidgets[] = array(
                        'class' => 'active',
                        'class-xs' => 'active',
                        'elems' => $elements
                    );
                } else {
                    $slidesWidgets[] = array(
                        'elems' => $elements
                    );
                }
            }
        }

        /**
         * Widget Ikastegiak
         */
        if ($orria->getWidgetIkastegiak() === 1) {
            $elements = $this->_prepareWidgetIkastegia(
                $orria->listIkastegiakWidget(),
                $first
            );

            if (sizeof($elements) > 0) {
                if ($first === false) {
                    $first = true;
                    $slidesWidgets[] = array(
                        'class' => 'active',
                        'class-xs' => 'active',
                        'elems' => $elements
                    );
                } else {
                    $slidesWidgets[] = array(
                        'elems' => $elements
                    );
                }
            }
        }

        /**
         * Widget Erabiltzaileak
         */
        if ($orria->getWidgetErabiltzaileak() === 1) {
            $elements = $this->_prepareWidgetErabiltzailea(
                $orria->listErabiltzaileaWidget(),
                $first
            );

            if (sizeof($elements) > 0) {
                if ($first === false) {
                    $first = true;
                    $slidesWidgets[] = array(
                        'class' => 'active',
                        'class-xs' => 'active',
                        'elems' => $elements
                    );
                } else {
                    $slidesWidgets[] = array(
                        'elems' => $elements
                    );
                }
            }
        }

        /**
         * Widget Kategoriak
         */
        if ($orria->getWidgetKategoriak() === 1) {
            $elements = $this->_prepareWidgetKategoria(
                $orria->listKategoriaWidget(),
                $first
            );

            if (sizeof($elements) > 0) {
                if ($first === false) {
                    $first = true;
                    $slidesWidgets[] = array(
                        'class' => 'active',
                        'class-xs' => 'active',
                        'elems' => $elements
                    );
                } else {
                    $slidesWidgets[] = array(
                        'elems' => $elements
                    );
                }
            }
        }

        if (sizeof($slidesWidgets) > 0) {

            if (isset($slidesWidgets[0])) {
                $slidesWidgets[0]['class'] = 'container aire active';
            }

            $widgetData = array(
                'id' => 'eventos-relacionados',
                'class' => 'container aire',
                'slides' => $slidesWidgets
            );

            $widgetsTmp = $this->_templates->
                        loadTemplate('widget')->
                        render($widgetData);

            $this->view->widgetsTmp = $widgetsTmp;
        }

        $this->view->title = $orria->getIzena();
        $this->view->orria = $orria;

    }

    /**
     * Prepara la información de los Erabiltzaileak para el template de widget
     * @param Lista de Erabiltzaileak $listErabiltzailea
     */
    protected function _prepareWidgetErabiltzailea($listErabiltzailea, $first)
    {

        $elements = array();

        if (sizeof($listErabiltzailea) > 0) {

            $i = 0;
            foreach ($listErabiltzailea as $erabiltzailea) {

                $data = array(
                    'class' => 'col-sm-4 text-center',
                    'position' => $i++,
                    'title' => $erabiltzailea->getCompletName(),
                    'description' => $erabiltzailea->getDeskribapena(),
                    'url' => 'erabiltzaileak/ikusi/erabiltzailea/' . $erabiltzailea->getErabiltzaileIzena(),
                );

                if (!empty($erabiltzailea->getIrudia())) {
                    $data['type-image-text'] = 1;
                    $data['image'] = 'multimedia/erabiltzaile-irudia/irudia/' . $erabiltzailea->getIrudia()->getIden();
                    $data['alt'] = $erabiltzailea->getCompletName();
                } else {
                    $data['type-text'] = 1;
                }

                if ($first === false) {
                    if ($i == 1) {
                        $data['active-xs'] = 'active';
                    }
                }

                $elements[] = $data;

            }
        }

        return $elements;

    }

    /**
     * Prepara la información de las Kategoriak para el template de widget
     * @param Lista de Kategoriak $listKategoriak
     */
    protected function _prepareWidgetKategoria($listKategoriak, $first)
    {

        $elements = array();

        if (sizeof($listKategoriak) > 0) {

            $i = 0;
            foreach ($listKategoriak as $kategoriak) {

                $data = array(
                    'class' => 'col-sm-4 text-center',
                    'position' => $i++,
                    'title' => $kategoriak->getIzena(),
                    'url' => 'kategoriak/ikusi/kategoria/' . $kategoriak->getUrl(),
                    'description' => $kategoriak->kategoriaGlobala()->getIzena(),
                    'fondo' => $kategoriak->kategoriaGlobala()->getClassName(),
                    'type-text' => 1
                );


                if ($first === false) {
                    if ($i == 1) {
                        $data['active-xs'] = 'active';
                    }
                }

                $elements[] = $data;

            }

        }

        return $elements;

    }

    /**
     * Prepara la información de los edukiak para el template de widget
     * @param Lista de Edukiak $listEdukiak
     */
    protected function _prepareWidgetEdukia($listEdukiak, $first)
    {
        $elements = array();
        if (sizeof($listEdukiak) > 0) {

            $i = 0;
            foreach ($listEdukiak as $edukia) {

                $data = array(
                    'class' => 'col-sm-4 text-center',
                    'position' => $i++,
                    'title' => $edukia->getTitulua(),
                    'description' => $edukia->getDeskribapenLaburra(),
                    'url' => 'edukiak/ikusi/edukia/' . $edukia->getUrl(),
                    'image' => $edukia->irudiaRand('list'),
                    'alt' => $edukia->getTitulua(),
                    'type-image-text' => 1
                );

                if ($first === false) {
                    if ($i == 1) {
                        $data['active-xs'] = 'active';
                    }
                }

                $elements[] = $data;
            }
        }

        return $elements;
    }

    /**
     * Prepara la información de los ikastegiak para el template de widget
     * @param Lista de Ikastegiak $listIkastegiak
     */
    protected function _prepareWidgetIkastegia($listIkastegiak, $first)
    {
        $elements = array();
        if (sizeof($listIkastegiak) > 0) {

            $i = 0;
            foreach ($listIkastegiak as $ikastegia) {

                $data = array(
                    'class' => 'col-sm-4 text-center',
                    'position' => $i++,
                    'title' => $ikastegia->getIzena(),
                    'description' => $ikastegia->getDeskribapenLaburra(),
                    'url' => 'ikastegiak/ikusi/ikastegia/' . $ikastegia->getUrl(),
                    'type-image-text' => 1,
                    'image' => 'image/index/id/' . $ikastegia->getId() . '/view/ikastegia/size/featured',
                    'alt' => $ikastegia->getIzena(),
                );

                if ($first === false) {
                    if ($i == 1) {
                        $data['active-xs'] = 'active';
                    }
                }

                $elements[] = $data;
            }
        }

        return $elements;
    }
}