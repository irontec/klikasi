<?php

use Klikasi\Custom\Imagick;

use Klikasi\Model\Ikastegia;
use Klikasi\Model\Jakinarazpenak;
use Klikasi\Model\ErabiltzaileaRelIkastegia;

use Klikasi\Mapper\Sql as Mappers; 
use Klikasi\Mapper\Sql\Edukia as EdukiaMapper;
use Klikasi\Mapper\Sql\Ikastegia as IkastegiaMapper;
use Klikasi\Mapper\Sql\IkastegiMota as IkastegiMotaMapper;
use Klikasi\Mapper\Sql\Erabiltzailea as ErabiltzaileaMapper;
use Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia as ErabiltzaileaRelIkastegiaMapper;
use Klikasi\Mapper\Sql\Orrialdea as OrrialdeaMapper;

class IkastegiakController extends Zend_Controller_Action
{
    protected $_temlates;
    protected $_ikastegiMapper;
    protected $_edukiaMapper;
    protected $_orrialdeaMapper;

    protected $_ikastegiakLimit = 8;
    protected $_edukiakLimit = 8;

    protected $_isSearchQuery = false;

    public function init()
    {
        $this->view->flashmezuak = $this->_helper->FlashMessenger->getMessages();

        $actionName = $this->getRequest()->getActionName();
        if ($actionName == 'index') {
            $this->_helper->layout->setLayout('container-principal-title');
        } elseif ($actionName == 'ikusi') {
            $this->_helper->layout->setLayout('ikastegiak-ikusi');
        } else {
            $this->_helper->layout->setLayout('container-principal-title');
        }

        $this->_helper->ironContextSwitch()
            ->addActionContext('ikastegia-more', 'json')
            ->addActionContext('ikastegia-more-edukiak', 'json')
            ->initContext();

        $this->_ikastegiMapper = new IkastegiaMapper();
        $this->_edukiaMapper = new EdukiaMapper();
        $this->_orrialdeaMapper = new OrrialdeaMapper();

        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;

        $this->view->appendJs =  array(
            '/js/klikasi.Ikastegi.js'
        );

        if (array_key_exists('searchvalue', $this->_request->getParams()) && $this->_request->getParam('searchvalue')) {
            $this->_isSearchQuery = true;
        }
    }

    /**
     * Lista todas los ikastegiak
     */
    public function indexAction()
    {
        $this->view->title = 'Ikastegiak';
        $this->view->ikastegiaList = $this->_ikastegiakViewList(
            1,
            $this->_ikastegiakLimit
        );

        $where = 'aktibatua = "1"'; // AND mota = "ikastetxea"';
        if ($this->_isSearchQuery) {
            $where = ' aktibatua = "1" AND izena like "%'. $this->_request->getParam('searchvalue') .'%" ';
        }

        $this->view->ikastegiakCount = $this->_ikastegiMapper->countByQuery(
            $where
        );

        $urlMoreAction = $this->view->url(
            array(
                'controller' => 'ikastegiak',
                'action' => 'ikastegia-more'
            ),
            'default',
            true
        );

        $this->view->isSearchQuery = $this->_isSearchQuery;
        $this->view->urlMoreAction = $urlMoreAction;

        $orrialdea = $this->_orrialdeaMapper->findOneByField("titulua", "Ikastegiak");
        $this->view->metaDescription = $orrialdea->getMetaDescription();
        $this->view->metaTitle = $orrialdea->getMetaTitle();
        $this->view->metaKeywords = $orrialdea->getMetaKeywords();
        $this->view->currentUrl = $this->view->serverUrl($this->view->url());
        $this->view->urlMetaImage = $orrialdea->orrialdeaIrudiaUrl();
        $this->view->metaType = "website";
        
    }

    /**
     * JSON
     * Lista los ikastegiak segun la pagina. si no hay mas envia un false,
     * que activa un mensaje de no hay mas.
     */
    public function ikastegiaMoreAction()
    {
        if ($this->getRequest()->isPost()) {

            $datuak = $this->getRequest()->getPost();
            $ikastegiaList = $this->_ikastegiakViewList($datuak['page']);

            if (sizeof($ikastegiaList) > 0) {
                $this->view->success = true;
                $this->view->htmls = $ikastegiaList;
            } else {
                $this->view->success = false;
            }

        } else {
            $this->_redirect('ikastegiak');
        }
    }

    /**
     * JSON
     * Lista los edukiak segun la pagina. si no hay mas envia un false,
     * que activa un mensaje de no hay mas.
     */
    public function ikastegiaMoreEdukiakAction()
    {

        if ($this->getRequest()->isPost()) {

            $datuak = $this->getRequest()->getPost();

            $ikastegia = $this->_ikastegiMapper->find(
                $datuak['ikastegiaId'],
                $this->_ikastegiakLimit
            );

            if (!$ikastegia) {
                $this->view->success = false;
                return;
            }

            $edukiakList = $this->_edukiakViewList(
                $ikastegia,
                $datuak['page'],
                3
            );

            if (sizeof($edukiakList) > 0) {
                $this->view->success = true;
                $this->view->htmls = $edukiakList;
            } else {
                $this->view->success = false;
            }

        } else {
            $this->_redirect('ikastegiak');
        }

    }

    public function egileakAction()
    {
        $ikastegia = $this->_fetchIkastegia();

        $edukiaRelIkastegiaMapper = new Mappers\EdukiaRelIkastegia;
        $where = array(
            'egoera = "onartua"',
            'ikastegiaId = "' . $ikastegia->getPrimaryKey() . '"',
        );

        $edukiaRelIkastegiak = $edukiaRelIkastegiaMapper->fetchList(implode(" AND ", $where)); 

        $sortzaileak = array();
        foreach ($edukiaRelIkastegiak as $item) {

            $edukia = $item->getEdukia();
            if (!$edukia) {
                continue;
            }
            
            $edukiarenErabiltzaileakMapper = new Mappers\ErabiltzaileaRelEdukia;
            $edukiarenSortzaileak = $edukiarenErabiltzaileakMapper->fetchList("edukiaId = " . $edukia->getPrimaryKey());
            $edukiarenErabiltzaileak = array();
            
            foreach ($edukiarenSortzaileak as $edukiarenSortzailea) {
                $edukiarenErabiltzaileak[] = $edukiarenSortzailea->getErabiltzailea();
            }
            $edukiarenErabiltzaileak[] = $edukia->getErabiltzailea();
            
            foreach ($edukiarenErabiltzaileak as $edukiarenSortzailea) {

                if (!$edukiarenSortzailea) {
                    continue;
                }
                $key = $edukiarenSortzailea->getPrimaryKey();
                $sortzaileak[$key] = array(
                    'erabiltzailea' => $edukiarenSortzailea,
                    'trophy' => $edukiarenSortzailea->getLastTrophy()
                );
            }
        }

        foreach ($sortzaileak as $key => $sortzailea) {

            $erabiltzailea =  $sortzailea['erabiltzailea'];
            $erabiltzaileaRelIkastegia = $erabiltzailea->getErabiltzaileaRelIkastegia('egoera="onartua"', 'jabea');
            if (empty($erabiltzaileaRelIkastegia)) {
                continue;
            }

            $ikastegia = $erabiltzaileaRelIkastegia[0]->getIkastegia();
            if (!$ikastegia) {
                continue;
            }

            $sortzaileak[$key]['ikastegia'] = $ikastegia;
            //$sortzaileak[$key]['erabiltzailea'] = $sortzaileak[$key]['erabiltzailea']->toArray();
            //$sortzaileak[$key]['ikastegia'] = $ikastegia->toArray();
        }
        
        $this->view->title = 'Sortzaileak';
        $this->view->sortzaileak = $sortzaileak;
    }

    public function ikusiAction()
    {
        $ikastegia = $this->_fetchIkastegia();
        $currentUser = $this->_helper->SessionUser();
        $isAdmin = false;

        if ($currentUser) {

            $isAdmin = $currentUser->getSuperErabiltzailea();
            if (!$isAdmin) {

                $where = array();
                $where[] = 'erabiltzaileaId = "' .  $currentUser->getId() . '"';
                $where[] = '(jabea = 1 OR administratzailea = 1)';
                $relErabiltzailea = $ikastegia->getErabiltzaileaRelIkastegia(
                    implode(' AND ', $where)
                );

                if (!empty($relErabiltzailea)) {
                    $isAdmin = true;
                }
            }
        }

        $autoreak = 0;
        $erabiltzaileak = array();

        $this->view->title = $ikastegia->getIzena();
        $this->view->isAdmin = $isAdmin;
        $this->view->ikastegia = $ikastegia;
        $this->view->isSocial = 'ikastegia';
        $this->view->isIkastegia = true;
        $this->view->edukiakCount = $this->_edukiaMapper->countByIkastegia(
            $ikastegia->getId()
        );

        $this->view->trophy = $ikastegia->getLastTrophy();

        $this->view->edukiaList = $this->_edukiakViewList(
            $ikastegia,
            1,
            $this->_edukiakLimit
        );

        $urlMoreAction = $this->view->url(
            array(
                'controller' => 'ikastegiak',
                'action' => 'ikastegia-more-edukiak',
                'order' => $this->_request->getParam("order")
            ),
            'default',
            true
        );

        $this->view->urlMoreAction = $urlMoreAction;

        $this->view->metaDescription = $ikastegia->getDeskribapena();
        $this->view->metaTitle = $ikastegia->getIzena();
        $this->view->urlMetaImage = $ikastegia->ikastegiaIrudiaUrl('ikastegia');
    }

    protected function _fetchIkastegia()
    {
        $url = $this->getRequest()->getParam('ikastegia', false);

        if ($url) {
            $ikastegia = $this->_ikastegiMapper->findOneByField(
                'url',
                $url
            );
        } elseif ($url === false) {
            $this->_redirect('ikastegiak');
        }

        if (!$url || !isset($ikastegia)) {
            throw new Zend_Exception(
                'Ikastegia ez da existitzen'
            );
        }

        return $ikastegia;
    }

    /**
     * Prepara todos los Ikastegias que se van a listar.
     * adjuntandolos al template "ikastegiakList.phtml"
     * @param Int $page Pagina Actual
     * @param Int $limit Limite de Ikastegiak
     * @return IkastegiakViews
     */
    protected function _ikastegiakViewList($page = 1, $limit = null)
    {
        if (is_null($limit) || !is_numeric($limit)) {
            $limit = $this->_ikastegiakLimit;
        }

        $where = ' aktibatua = "1"'; // AND mota = "ikastetxea" ';
        if ($this->_isSearchQuery) {
            $where = ' aktibatua = "1" AND izena like "%'. $this->_request->getParam('searchvalue') .'%" ';
        }

        $order = 'izena';
        $offset = $this->_prepareOffset($page, $limit);

        $ikastegiaListArray = $this->_ikastegiMapper->fetchListToTemplateListArray(
            $where,
            $order,
            $limit,
            $offset
        );

        if ($this->_isSearchQuery && count($ikastegiaListArray) > 0) {
            $ikastegiaListArray[0]['noBorder'] = true;
        }

        $ikastegiakDiv = array();

        if (sizeof($ikastegiaListArray) > 0) {
            foreach ($ikastegiaListArray as $ikastegiaTemplateArray) {
                $tpl = $this->_templates->loadTemplate('ikastegiakList');
                $ikastegiakDiv[] = $tpl->render($ikastegiaTemplateArray);
            }
        }

        return $ikastegiakDiv;
    }

    /**
     * Prepara todos los Edukiak de el Ikastegia actual.
     * adjuntandolos al template "edukia.phtml"
     * @param Model $ikastegia Ikastegia Actual.
     * @param Int $page Pagina Actual
     * @param Int $limit Limite de Ikastegiak
     * @return EdukiakViews
     */
    protected function _edukiakViewList(Klikasi\Model\Ikastegia $ikastegia, $page = 1, $limit = 3)
    {
        $offset = $this->_prepareOffset($page, $this->_edukiakLimit);
        $edukiakList = array();
        if ($this->_request->getParam("order") == 'iruzkinak') {

            $edukiakList = $this->_edukiaMapper->fetchOrderByIruzkinakNumber(
                $this->_edukiakLimit,
                $offset,
                null,
                $ikastegia->getId()
            );

        } else {

            $order = 'titulua asc';
            switch($this->_request->getParam("order")) {
                case 'updated':
                    $order = 'sortzeData desc';
                    break;
                case 'arrakasta':
                    $order = 'karma desc';
                    break;
            }

            $where = 'egoera = "onartua"';
            $filterByIds = $this->_edukiaMapper->fetchEdukiaIdByIdIkastegia($ikastegia->getId());
            if (!empty($filterByIds)) {
                $where .= ' and Edukia.id in ('. implode(',', $filterByIds) .') ';
            }

            $edukiakList = $this->_edukiaMapper->fetchList(
                $where,
                $order,
                $this->_edukiakLimit,
                $offset
            );
        }

        $edukaDiv = array();
        foreach ($edukiakList as $key => $edukia) {
            $tpl = $this->_templates->loadTemplate('edukia');
            $edukaDiv[] = $tpl->render($edukia->toTemplateListArray('list'));
        }

        return $edukaDiv;

        $edukiaIds = array();
        foreach ($ikastegia->edukiakOnartua() as $edukia) {
            $edukiaIds[] = $edukia->getId();
        }

        if (!empty($edukiaIds)) {
            $where = 'id in (' . implode(',', $edukiaIds) . ')';
            $order = 'sortzeData';
            $offset = $this->_prepareOffset($page, $limit);

            $edukiakListArray = $this->_edukiaMapper->fetchListToTemplateListArray(
                'list',
                $where,
                $order,
                $limit,
                $offset
            );

            if (sizeof($edukiakListArray) > 0) {
                foreach ($edukiakListArray as $edukiaTemplateArray) {
                    $tpl = $this->_templates->loadTemplate('edukia');
                    $edukaDiv[] = $tpl->render($edukiaTemplateArray);
                }
            }
        }

        return $edukaDiv;
    }



    protected function _prepareOffset($page, $limit)
    {
        if (isset($page) && $page > 0) {
            $offset = ($page - 1) * $limit;
        } else {
            $offset = 0;
        }

        return $offset;
    }

}
