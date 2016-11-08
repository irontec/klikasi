<?php

use Klikasi\Mapper\Sql\Orrialdea as OrrialdeaMapper;


class KategoriakController extends Zend_Controller_Action
{
    protected $_kategoriMapper;
    protected $_edukiaMapper;
    protected $_kategoriakLimit = 8;
    protected $_edukiakLimit = 9;
    protected $_orrialdeaMapper;

    public function init()
    {
        $this->_helper->ironContextSwitch()
            ->addActionContext('kategoriak-more', 'json')
            ->addActionContext('kategoriak-rest', 'json')
            ->addActionContext('edukiak-more', 'json')
            ->initContext();

        $this->view->appendJs =  array(
            '/js/klikasi.kategoria.js'
        );

        $this->_kategoriaMapper = new Klikasi\Mapper\Sql\Kategoria();
        $this->_edukiaMapper = new Klikasi\Mapper\Sql\Edukia();
        $this->_orrialdeaMapper = new OrrialdeaMapper();

        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;
    }

    public function indexAction()
    {
        $this->_helper->layout->setLayout(
            'container-principal-title'
        );

        $this->view->title = 'Kategoriak';

        $urlMoreAction = $this->view->url(
            array(
                'controller' => 'kategoriak',
                'action' => 'kategoriak-more',
                'order' => $this->_request->getParam('order')
            ),
            'default',
            true
        );

        $this->view->urlMoreAction = $urlMoreAction;

        switch($this->_request->getParam("order", 'arrakasta')) {

            case 'baliabideak':
                $kategoriakList = $this->_kategoriaMapper->fetchOrderByEdukiakNumber(
                    $this->_kategoriakLimit + 3,
                    null
                );
                break;
            case 'bisitak':
                $kategoriakList = $this->_kategoriaMapper->fetchOrderByBisitak(
                    $this->_kategoriakLimit + 3,
                    null
                );
                break;
            case 'update':
                $kategoriakList = $this->_kategoriaMapper->fetchOrderByUpdate(
                    $this->_kategoriakLimit + 3,
                    null
                );
                break;

            case 'izena':
            	$kategoriakList = $this->_kategoriaMapper->fetchList(
            			null,
            			'izena asc',
            			$this->_kategoriakLimit + 3,
            			null
            			);
            	break;
            	
            case 'arrakasta':
            default:
            	
                $kategoriakList = $this->_kategoriaMapper->fetchList(
                    null,
                    'karma desc',
                    $this->_kategoriakLimit + 3,
                    null
                );
                break;
        }

        if (sizeof($kategoriakList) > 0) {

            $boxes = $this->_prepareViewKategoriakList(
                $kategoriakList,
                'simple',
                true
            );

            $this->view->kategoriakLimit = $this->_kategoriakLimit;
            $this->view->kategoriakCount = $this->_kategoriaMapper->countAllRows();
            $this->view->kategoriakDestacados = $boxes['destacados'];
            $this->view->kategoriakSimple = $boxes['list'];

        }

        $orrialdea = $this->_orrialdeaMapper->findOneByField("titulua", "Kategoriak");
        $this->view->metaDescription = $orrialdea->getMetaDescription();
        $this->view->metaTitle = $orrialdea->getMetaTitle();
        $this->view->metaKeywords = $orrialdea->getMetaKeywords();
        $this->view->currentUrl = $this->view->serverUrl($this->view->url());
        $this->view->urlMetaImage = $orrialdea->orrialdeaIrudiaUrl();
        $this->view->metaType = "website";
    }

    /**
     * JSON
     * Paginación de las Categorias.
     */
    public function kategoriakMoreAction()
    {
        if ($this->getRequest()->isPost()) {

            $kategoriakList = $this->_kategoriakList(
                $this->_request->getParam("page")
            );

            if (sizeof($kategoriakList) > 0) {
                $this->view->success = true;
                $this->view->htmls = $this->_prepareViewKategoriakList(
                    $kategoriakList,
                    'simple'
                );
            } else {
                $this->view->success = false;
            }

        } else {

            $this->_redirect('kategoriak');
        }
    }

    public function ikusiAction()
    {
        $this->_helper->layout->setLayout(
            'container-principal'
        );

        $kategoria = $this->_fetchKategoria();
        $this->view->title = $kategoria->getIzena();
        $globala = $kategoria->kategoriaGlobala();

        $this->view->className = $globala->getClassName();
        $this->view->kategoria = $kategoria;

        $edukiakDiv = array();
        $edukiakList = $this->_edukiakList(
            $this->_request->getParam("page", 1)
        );

        if (sizeof($edukiakList) > 0) {
            foreach ($edukiakList as $edukia) {
                $edukiakDiv[] = $this->_templates->
                    loadTemplate('edukiakList')->
                    render($edukia->toTemplateListArray());
            }
        }

        $this->view->edukia = $edukiakDiv;
        $this->view->edukiaCount = $this->_edukiaMapper->countByKategoria(
            $kategoria->getId()
        );

        $this->view->edukiakLimit = $this->_edukiakLimit;
        $this->view->kategoriakLimit = $this->_kategoriakLimit;

        $urlMoreAction = $this->view->url(
            array(
                'controller' => 'kategoriak',
                'action' => 'edukiak-more'
            ),
            'default',
            true
        );

        $this->view->urlMoreAction = $urlMoreAction;
        $this->view->kategorkiaUrl = $kategoria->getUrl();

        $this->view->metaTitle = $kategoria->getId();
        $this->view->metaDescription =  $kategoria->getIzena();

        $this->view->currentUrl = $this->view->serverUrl($this->view->url());
        $this->view->urlMetaImage = $kategoria->kategoriaGlobala()->kategoriaGlobalaIrudiaUrl("simple");
        $this->view->metaType = "website";
    }

    /**
     * JSON Paginación de los recursos de una categoria
     */
    public function edukiakMoreAction()
    {
        if ($this->getRequest()->isPost()) {

            $datuak = $this->getRequest()->getPost();
            $kategoria = $this->_fetchKategoriaJson($datuak['kategoria']);

            $edukiakDiv = array();
            $edukiakList = $this->_edukiakList($datuak['page']);

            if (sizeof($edukiakList) > 0) {
                foreach ($edukiakList as $edukia) {
                    $edukiakDiv[] = $this->_templates->
                        loadTemplate('edukiakList')->
                        render($edukia->toTemplateListArray());
                }
            }

            if (sizeof($edukiakDiv) > 0) {
                $this->view->success = true;
                $this->view->htmls = $edukiakDiv;
            } else {
                $this->view->success = false;
            }

        } else {
            $this->_redirect(
                'kategoriak/ikusi/kategoria/' . $kategoria->getUrl()
            );
        }
    }

    /**
     * Prepara las categorias para la vista con paginación.
     * @param Model's $kategoriakList
     * @param String $type
     * @return Template
     */
    protected function _prepareViewKategoriakList($kategoriakList, $type, $groupDestacados = false)
    {
        $kategoriakListResultDestacados = array();
        $kategoriakListResult = array();
        $kont = 0;
        foreach ($kategoriakList as $kategoria) {

            $kont++;
            $kategoriaGlobala = $kategoria->kategoriaGlobala();

            $kategoriaFirstArray = array(
                'KategoriaGlobalaIrudia' => $kategoriaGlobala->kategoriaGlobalaIrudiaUrl($type),
                'KategoriaGlobalaIzena' => $kategoriaGlobala->getIzena(),
                'KategoriaGlobalaClassName' => $kategoriaGlobala->getClassName(),
                'KategoriaIzena' => $kategoria->getIzena(),
                'KategoriaUrl' => $kategoria->kategoriaUrl(),
                'KategoriaEdukiakCount' => sizeof($kategoria->kategoriaEdukiak()),
                'edukiakBisitaKopuruaSum' => $kategoria->edukiakBisitaKopuruaSum(),
                'edukiakSortzeData' => $kategoria->edukiakSortzeData()
            );

            if ($groupDestacados && $kont < 4) {
                $template = 'kategoriakFirst';
                $kategoriakListResultDestacados[]  = $this->_templates
                                                          ->loadTemplate($template)
                                                          ->render($kategoriaFirstArray);

            } elseif ($type == 'simple') {
                $template = 'kategoriakSimple';
                $kategoriakListResult[] = $this->_templates
                                               ->loadTemplate($template)
                                               ->render($kategoriaFirstArray);
            }
        }

        return array(
            'destacados' =>$kategoriakListResultDestacados,
            'list' => $kategoriakListResult
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
     * Comprueba si existe lo que se esta buscando.
     */
    protected function _fetchKategoria()
    {
        $kategoria = array();

        $url = $this->getRequest()->getParam('kategoria', false);

        if ($url) {
            $kategoria = $this->_kategoriaMapper->findOneByField(
                'url',
                $url
            );
        } elseif ($url === false) {
            $this->_redirect('kategoriak');
        }

        if (!$url || !isset($kategoria)) {
            throw new Zend_Exception(
                'Kategoria ez da existitzen'
            );
        }

        return $kategoria;
    }

    protected function _fetchKategoriaJson($url)
    {
        $kategoria = array();

        if ($url) {
            $kategoria = $this->_kategoriaMapper->findOneByField(
                'url',
                $url
            );
        } elseif ($url === false) {
            $this->_redirect('kategoriak');
        }

        if (!$url || !isset($kategoria)) {
            throw new Zend_Exception(
                'Kategoria ez da existitzen'
            );
        }

        return $kategoria;
    }


    protected function _kategoriakList($page = 1)
    {
       $featuredCount = 3;

       $limit = $this->_kategoriakLimit;
       $offset = $this->_prepareOffset($page, $this->_kategoriakLimit);

       if ($page === 1) {
            $limit += $featuredCount;
       } else {
            $offset += $featuredCount;
       }

       $kategoriakList = array();
       switch($this->_request->getParam("order", '')) {

            case 'bisitak':
                $kategoriakList = $this->_kategoriaMapper->fetchOrderByBisitak(
                    $limit,
                    $offset
                );
                break;

            case 'update':
                $kategoriakList = $this->_kategoriaMapper->fetchOrderByUpdate(
                    $limit,
                    $offset
                );
                break;

            case 'izena':
               	$kategoriakList = $this->_kategoriaMapper->fetchList(
	               	null,
	               	'izena asc',
                    $limit,
                    $offset
               	);
               	break;

            case 'baliabideak':

            	$kategoriakList = $this->_kategoriaMapper->fetchOrderByEdukiakNumber(
               		$limit,
               		$offset
            	);
            	break;

            case 'arrakasta':
            default:
           		$kategoriakList = $this->_kategoriaMapper->fetchList(
            		null,
            		'karma desc',
               		$limit,
               		$offset
           		);
           		break;
       }

       return $kategoriakList;
    }

    /**
     * Paginación de los recursos relacionados la categoria actual.
     * @param Model $kategoria
     * @param Int $page
     */
    protected function _edukiakList($page = 1)
    {
        $kategoria = $this->_fetchKategoriaJson(
            $this->_request->getParam('kategoria')
        );

        $offset = $this->_prepareOffset(
            $page,
            $this->_edukiakLimit
        );

        $edukiakList = array();
        if ($this->_request->getParam("order") == 'iruzkinak') {

            $edukiakList = $this->_edukiaMapper->fetchOrderByIruzkinakNumber(
                $this->_edukiakLimit,
                $offset,
                $kategoria->getId()
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
            $filterByIds = $this->_edukiaMapper->fetchEdukiaIdByIdKategoria(
                $kategoria->getId()
            );

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

        return $edukiakList;
    }
}
