<?php

use Klikasi\Mapper\Sql as Mapper;
use Klikasi\Mapper\Sql\Orrialdea as OrrialdeaMapper;

class LizentziakController extends Zend_Controller_Action
{
	protected $_orrialdeaMapper;
	
    public function init()
    {
        $this->view->title = 'Irudien Kredituak';
        $this->_helper->layout->setLayout('simple');
        
        $this->_orrialdeaMapper = new OrrialdeaMapper;
    }

    public function indexAction()
    {
        $lizentziakMapper = new Mapper\Orrialdea;
        $lizentzia = $lizentziakMapper->findOneByField("url", "lizentzia");

        $this->view->lizentzia = empty($lizentzia) ? '' : $lizentzia->getEdukia();

        $orrialdea = $this->_orrialdeaMapper->findOneByField("titulua", "Lizentzia");
        $this->view->metaDescription = $orrialdea->getMetaDescription();
        $this->view->metaTitle = $orrialdea->getMetaTitle();
        $this->view->metaKeywords = $orrialdea->getMetaKeywords();
        $this->view->currentUrl = $this->view->serverUrl($this->view->url());
        $this->view->urlMetaImage = $orrialdea->orrialdeaIrudiaUrl();
        $this->view->metaType = "website";
    }
}