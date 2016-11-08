<?php

use Klikasi\Mapper\Sql as Mapper;

use Klikasi\Mapper\Sql\Edukia as EdukiaMapper;
use Klikasi\Mapper\Sql\HomePage as HomePageMapper;
use Klikasi\Mapper\Sql\Orrialdea as OrrialdeaMapper;

class IndexController extends Zend_Controller_Action
{
    protected $_edukiaMapper;
    protected $_homePageMapper;
    protected $_orrialdeaMapper;

    protected $_currentUser;
    protected $_templates;

    protected $_listLimit = 8;
    
    public function init()
    {    	
    	$this->_helper->ironContextSwitch()
    		->addActionContext('edukiak-more', 'json')
    		->initContext();
    	
        $this->view->appendJs =  array(
            '/js/klikasi.izena-eman.js',
        	'/js/klikasi.Edukia.js'
        );
        
        $this->_helper->layout->setLayout('simple');

        $this->_edukiaMapper = new EdukiaMapper();
        $this->_homePageMapper = new HomePageMapper();
        $this->_orrialdeaMapper = new OrrialdeaMapper();        
        
        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;

        $this->_currentUser = $this->_helper->SessionUser();
    }

    public function indexAction()
    {
        $edukiak = array();
        $this->view->title = 'Hasiera';

        $this->view->firstBlock = $this->_templates->
            loadTemplate('first-block')->
            render($this->_homeData());

        $this->view->outlineHome = $this->_templates->
            loadTemplate('outline-home')->
            render($this->_outlineData());

        $this->view->edukiakHome = $this->_templates->
            loadTemplate('edukiak-list-home')->
            render($this->_edukiakData());

        $this->view->secondHome = $this->_templates->
            loadTemplate('second-block')->
            render($this->_secondData());

        $this->view->formIzenaEmanShow = $this->getRequest()->getParam(
            'izena-eman',
            false
        );

        $this->view->kanpainak = $this->_kanpainakData();
        
        $orrialdea = $this->_orrialdeaMapper->findOneByField("titulua", "Hasiera");
        $this->view->metaDescription = $orrialdea->getMetaDescription();
        $this->view->metaTitle = $orrialdea->getMetaTitle();
        $this->view->metaKeywords = $orrialdea->getMetaKeywords();
        $this->view->currentUrl = $this->view->serverUrl($this->view->url());
        $this->view->urlMetaImage = $orrialdea->orrialdeaIrudiaUrl();
        $this->view->metaType = "website";
    }
    
    /**
     * JSON
     * Lista los edukiak segun la pagina. si no hay mas envia un false,
     * que activa un mensaje de no hay mas.
     */
    public function edukiakMoreAction()
    {    	 
    	$this->_helper->layout->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(TRUE);

        if ($this->getRequest()->isPost()) {

            $edukiakList = $this->_getEdukiakList();
            
            if (sizeof($edukiakList) > 0) {
                $edukiakDiv = array();
                foreach ($edukiakList as $edukia) {

                    $edukiakDiv[] = $this->_templates->
                        loadTemplate('edukiakView')->
                        render($edukia->toTemplateListArray());
                }

                $this->view->success = true;
 				$this->view->htmls = $edukiakDiv;
 				$this->view->moreItems = false;
 				
            } else {
 	           $this->view->success = false;
            }

        } else {
            $this->_redirect('/');
        }
    }
    
    protected function _getEdukiakList()
    {
       	$order = 'karma desc';
    	
    	return $this->_edukiaMapper->searchEdukia(
    			$order,
    			$this->_listLimit,
    			$this->_prepareOffset($this->_request->getParam("page"), $this->_listLimit)
    	);
    }

    /**
     * Prepara la paginación.
     */
    protected function _prepareOffset($page, $limit)
    {
    	if (isset($page) && $page > 0) {
    		$offset = ($page - 1) * $limit;
    	} else {
    		$offset = 0;
    	}
    
    	return $offset;
    }
    
    /**
     * @return string
     */
    protected function _kanpainakData()
    {
        //Orriak - Kanpainak
        $where = "egoera = 1 and hasiera <= now() and bukaera >= now() and banerraBaseName is not null";
        $kanpainakMapper = new Mapper\Kanpaina;

        $kanpainak = $kanpainakMapper->fetchList($where, 'rand()', 3);

        if (empty($kanpainak)) {
            return '';
        }

        $kanpainakData = array();
        $position = 0;
        foreach ($kanpainak as $kanpaina) {

            if ($kanpaina->getKanpaina()) {
                $url = 'orriak/kanpainak/orria/' . $kanpaina->getUrl();
            } else {
                $url = 'orriak/dinamikoak/orria/' . $kanpaina->getUrl();
            }

            $kanpainakData[] = array(
                'class' => 'col-sm-4 text-center',
                'position' => $position++,
                'title' => $kanpaina->getIzena(),
                'url' => $url,
                'type-image-text' => '1',
                'image' => 'image/index/id/'. $kanpaina->getId() .'/view/kanpaina/size/featured/banner/1',
                'alt' => $kanpaina->getIzena(),
            );
        }

        $kanpainakData[0]['active-xs'] = 'active';
        $data = array(
            'id'    => 'eventos-relacionados',
            'class' => 'container aire',
            'header' => 'Kanpainak',
            'slides' => array(
                array(
                    'class'     => 'container aire active',
                    'class-xs'  => 'active',
                    'elems'     => $kanpainakData
                ),
            )
        );

        return $this->_templates->loadTemplate('../orriak/widget')->render($data);
    }

    protected function _homeData()
    {

        $modelHome = $this->_dataSection('home');
        $path = 'multimedia/home-page/irudia/' . $modelHome->getId();

        $irudiaHome = $this->view->baseUrl($path);

        $homeData = array(
            'title' => $modelHome->getTitle(),
            'description' => $modelHome->getDescription(),
            'backgroundImagen' => $irudiaHome
        );

        if (!$this->_currentUser) {
            $homeData['button'] = 'Batu';
            $homeData['batu'] = $this->view->baseUrl('sartu');
            $homeData['button-class'] = 'bg-red light js-home-batu';
        }

        return $homeData;

    }

    protected function _outlineData()
    {

        $outlineA = array(
            'alt' => 'Icon Draw',
            'text' => 'Sortu',
            'izena' => $this->view->baseUrl('images/icon_draw.png')
        );

        $outlineB = array(
            'alt' => 'Icon Draw',
            'text' => 'Partekatu',
            'izena' => $this->view->baseUrl('images/icon_comment.png')
        );
        $outlineC = array(
            'alt' => 'Icon Draw',
            'text' => 'Ikasi',
            'izena' => $this->view->baseUrl('images/icon_devices.png')
        );

        $outlineData = array(
            'arrow-1' => $this->view->baseUrl('images/esquema_arrows_1.png'),
            'arrow-2' => $this->view->baseUrl('images/esquema_arrows_2.png'),
            'outline' => array(
                $outlineA,
                $outlineB,
                $outlineC
            )
        );

        return $outlineData;

    }

    protected function _edukiakData()
    {

        $edukiak = array();

        $edukiaList = $this->_edukiaMapper->fetchListToTemplateListArray(
            'homePage',
            'egoera = "onartua"',
            'karma DESC',
            8
        );

        if (sizeof($edukiaList) > 0) {
            foreach ($edukiaList as $edukiaTemplateArray) {
                $edukiak['edukiaList'][] = $edukiaTemplateArray;
            }
        }

        return $edukiak;
    }

    protected function _secondData()
    {

        $secondData = array();

        $secondData['blocks'] = array(
            $this->_dataSection('box-1', true),
            $this->_dataSection('box-2', true),
            $this->_dataSection('box-3', true)
        );

        if (!$this->_currentUser) {
            $secondData['button'] = 'Batu';
            $secondData['batu'] = $this->view->baseUrl('sartu');
            $secondData['button-class'] = 'bg-red light js-home-batu';
        }

        return $secondData;
    }

    protected function _dataSection($identifier, $isArray = false)
    {

        $where = array(
            'identifier = ?' => $identifier
        );

        $data = $this->_homePageMapper->fetchOne($where);
        if ($isArray) {
             return $data->toArray();
        }

        return $data;

    }

}