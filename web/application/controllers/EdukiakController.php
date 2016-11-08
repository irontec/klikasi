<?php

use Klikasi\Model as Model;
use Klikasi\Model\Kexa as KexaModel;
use Klikasi\Model\Mezuak as MezuakModel;
use Klikasi\Model\Gustokoa as GustokoaModel;
use Klikasi\Model\Iruzkina as IruzkinaModel;
use Klikasi\Model\AtseginDut as AtseginDutModel;
use Klikasi\Model\Hobekuntzak as HobekuntzakModel;
use Klikasi\Model\Jakinarazpenak as JakinarazpenakModel;

use Klikasi\Mapper\Sql as Mapper;
use Klikasi\Mapper\Sql\Edukia as EdukiaMapper;
use Klikasi\Mapper\Sql\Gustokoa as GustokoaMapper;
use Klikasi\Mapper\Sql\Iruzkina as IruzkinaMapper;
use Klikasi\Mapper\Sql\AtseginDut as AtseginDutMapper;
use Klikasi\Mapper\Sql\Erabiltzailea as ErabiltzaileaMapper;
use Klikasi\Mapper\Sql\Jakinarazpenak as JakinarazpenakMapper;

class EdukiakController extends Zend_Controller_Action
{
    protected $_embedExternal;

    protected $_edukiaMapper;
    protected $_gustokoaMapper;
    protected $_iruzkinaMapper;
    protected $_atseginDutMapper;
    protected $_erabiltzaileaMapper;
    protected $_jakinarazpenakMapper;

    protected $_moderator = array();
    protected $_isModerator = false;

    protected $_listLimit = 6;

    public function init()
    {
        $actionName = $this->getRequest()->getActionName();
        if ($actionName == 'index') {
            $this->_helper->layout->setLayout(
                'container-principal-title'
            );
        } elseif ($actionName == 'ikusi') {
            $this->_helper->layout->setLayout(
                'container-principal'
            );
        }

        $this->_helper->ironContextSwitch()
                      ->addActionContext('atsegin-dut', 'json')
                      ->addActionContext('moderate', 'json')
                      ->addActionContext('gogokoenetara-gehitu', 'json')
                      ->addActionContext('iruzkinak-moderate', 'json')
                      ->addActionContext('dialogs-content', 'json')
                      ->addActionContext('edukiak-more', 'json')
                      ->addActionContext('send-message-laguntzaileak', 'json')
                      ->initContext();

        $this->view->flashmezuak = $this->_helper->FlashMessenger->getMessages();
        $this->_embedExternal = new \Klikasi_Controller_Action_Helper_EmbedExternal();

        $this->_initMappers();
        $this->_initLibraries();

        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;

        $this->_currentUser = $this->_helper->SessionUser();
    }

    protected function _initMappers()
    {
        $this->_edukiaMapper = new EdukiaMapper();
        $this->_gustokoaMapper = new GustokoaMapper();
        $this->_iruzkinaMapper = new IruzkinaMapper();
        $this->_atseginDutMapper = new AtseginDutMapper();
        $this->_erabiltzaileaMapper = new ErabiltzaileaMapper();
        $this->_jakinarazpenakMapper = new JakinarazpenakMapper();
    }

    protected function _initLibraries()
    {
        $this->view->appendJs = array(
            '/js/klikasi.Edukia.js'
        );
    }

    public function indexAction()
    {
        $this->view->title = 'Edukiak';
        $this->view->listLimit = $this->_listLimit;

        $edukiakList = array();
        $edukiakDiv = array();
        $where = 'egoera = "onartua"';

        $edukiakList = $this->_getEdukiakList();

        if (sizeof($edukiakList) > 0) {
            foreach ($edukiakList as $edukia) {
                $edukiakDiv[] = $this->_templates->
                    loadTemplate('edukiakList')->
                    render($edukia->toTemplateListArray());
            }
        }

        if (count($edukiakList) < 1) {
            $this->view->alertWarning = array("Bilaketa horrek ez du emaitzarik");
        }

        $this->view->edukiaList = $edukiakDiv;

        $searchFilter = $this->_edukiaMapper->getSearchBoxFilteredIds();
        $searchFilter[] = $where;

        $this->view->edukiakCount = $this->_edukiaMapper->countByQuery(
            implode(" AND ", $searchFilter)
        );

        $urlMoreAction = $this->view->url(
            array(
                'controller' => 'edukiak',
                'action' => 'edukiak-more'
            )
        );

        $this->view->isSearchQuery = array_key_exists('searchvalue', $this->_request->getParams());
        $this->view->urlMoreAction = $urlMoreAction;
    }

    /**
     * JSON
     * Lista los edukiak segun la pagina. si no hay mas envia un false,
     * que activa un mensaje de no hay mas.
     */
    public function edukiakMoreAction()
    {
        if ($this->getRequest()->isPost()) {

            $edukiakList = $edukiakList = $this->_getEdukiakList();

            if (sizeof($edukiakList) > 0) {
                $edukiakDiv = array();
                foreach ($edukiakList as $edukia) {
                    $edukiakDiv[] = $this->_templates->
                        loadTemplate('edukiakList')->
                        render($edukia->toTemplateListArray());
                }

                $this->view->success = true;
                $this->view->htmls = $edukiakDiv;
            } else {
                $this->view->success = false;
            }

        } else {
            $this->_redirect('ikastegiak');
        }
    }

    protected function _getEdukiakList()
    {
        if ($this->_request->getParam("order") == 'iruzkinak') {

            return $this->_edukiaMapper->fetchOrderByIruzkinakNumber(
                $this->_listLimit,
                $this->_prepareOffset($this->_request->getParam("page"), $this->_listLimit)
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

            return $this->_edukiaMapper->searchEdukia(
                $order,
                $this->_listLimit,
                $this->_prepareOffset($this->_request->getParam("page"), $this->_listLimit)
            );
        }
    }

    public function ikusiAction()
    {
        /**
         * Contador de visitas por sesión
         */
        $currentSessionStatus = new \Klikasi_Controller_Action_Helper_CurrentSessionStatus();
        $currentSessionStatus->getCurrentSessionStatus();

        $edukia = $this->_fetchEdukia();
        $this->_edukiaEgoera($edukia);

        $datuak = $this->getRequest()->getPost();
        if ($datuak) {
            $this->_addComment(
                $datuak,
                $this->_currentUser,
                $edukia
            );
        }

        $this->view->edukiakRelated = $this->_edukiakRelatedViews($edukia);

        $this->view->title = $edukia->getTitulua();
        $this->view->edukia = $edukia;
        $this->view->isSocial = 'edukia';
        $this->view->sessionUser = $this->_currentUser;
        $this->view->isEdukia = true;

        /**
         * templates vista
         */
        $this->view->sidebarCaracteristicas = $this->_sidebarCaracteristicas(
            $edukia,
            $this->_currentUser
        );

        $this->view->sidebarAutor = $this->_sidebarAutor(
            $edukia
        );

        $this->view->sidebarSocial = $this->_sidebarSocial(
            $edukia,
            $this->_currentUser
        );

        $this->view->iruzkinakListView = $this->_iruzkinaList(
            $edukia,
            $this->_currentUser
        );

        if ($this->_currentUser) {

            $addComentData = array(
                'completName' => $this->_currentUser->getCompletName(),
                'actionUrl' => $edukia->edukiaUrl(),
                'edukiaId' => $edukia->getId()
            );

            $type = $this->_currentUser->getTypeAvatar();
            if ($type == 'default') {

                $avatarIrudia = false;
                $color = $this->_currentUser->getIrudiaDefault();

                switch ($this->_currentUser->getProfila()) {
                    case 'irakasle':
                        $classProfila = 'perfil-irakasle';
                        break;
                    case 'ikasle':
                        $classProfila = 'perfil-ikasle';
                        break;
                    case 'otros':
                        $classProfila = 'perfil-ikastegi';
                        break;
                }

                $addComentData['color'] = $color;
                $addComentData['classProfila'] = $classProfila;

            } else {
                $avatarIrudia = true;
                $addComentData['irudiaUrl'] = $this->_currentUser->urlIrudia();
            }

            $addComentData['avatarIrudia'] = $avatarIrudia;
            $erabiltzaileaIds = $edukia->erabiltzaileakRelIds();
            if (array_search($this->_currentUser->getId(), $erabiltzaileaIds) !== false) {
                $addComentData['isAuthor'] = true;
                $this->view->isAdmin = true;
            }

            $this->view->addIruzkina = $this->_templates
                ->loadTemplate('addIruzkina')
                ->render($addComentData);
        }

        /**
         * Directo en la vista
         */
        $this->view->fitxategiaView = $this->_fitxategia($edukia);
        $this->view->irudiasView = $this->_irudiak($edukia);

        $this->view->bideoasView = $this->_bideoak($edukia);//YouTube-Vimeo
        $this->view->aurkezpenaView = $this->_aurkezpena($edukia);//SlideShare-issuu
        $this->view->estekasView = $this->_estekak($edukia);

        /**
         * Dialogs
         */
        $this->view->hobekuntzak = $this->_contentDialog(
            'hobekuntzak',
            $edukia
        );
        $this->view->salatu = $this->_contentDialog(
            'salatu',
            $edukia
        );
    }

    /**
     * JSON
     * Sistema para Aceptar/Rechazar los comentarios de la aplicación.
     */
    function iruzkinakModerateAction()
    {
        $erabiltzailea = $this->_helper->SessionUser();
        $params = $this->getRequest()->getParams();

        if ($erabiltzailea && $params) {

            $iruzkina = $this->_iruzkinaMapper->find($params['iruzkinaId']);

            if ($params['button'] == 'accept' && $iruzkina) {

                $iruzkina->setEgoera('onartua');
                $iruzkina->save();

                $this->view->iruzkinaId = $iruzkina->getId();
                $this->view->success = true;
                $this->view->message = 'Iruzkin onartua';

            } elseif ($params['button'] == 'reject' && !is_null($iruzkina)) {

                $iruzkina->setEgoera('ezOnartua');
                $iruzkina->save();

                $this->_jakinarazpenakMapper->deleteJakinarazpenakIruzkina($params['iruzkinaId']);

                $this->view->iruzkinaId = $params['iruzkinaId'];
                $this->view->success = true;
                $this->view->message = 'Iruzkin ukatua';
            }
        }
    }

    /**
     * Json para Proponer mejora o Informar sobre un contenido
     */
    public function dialogsContentAction()
    {

        $params = $this->getRequest()->getParams();
        $currentUser = $this->_helper->SessionUser();

        if (isset($params['instance']) && $currentUser) {

            $now = new Zend_Date();
            $now = $now->toString('yyyy-MM-dd HH:mm:ss');

            $edukia = $this->_edukiaMapper->find($params['edukiaId']);

            if ($params['instance'] == 'hobekuntzak') {

                if (isset($params['hobekuntzak'])) {
                    $hobekuntzak = new HobekuntzakModel();
                    $hobekuntzak->createHobekuntzak($params);

                    $jakinarazpenak = new JakinarazpenakModel();
                    $jakinarazpenak->createHobekuntzak(
                        $edukia,
                        $hobekuntzak
                    );

                    $this->view->success = true;
                    $this->view->message = 'Proposamena bidali da';
                } else {

                    $this->view->success = false;
                    $this->view->message = '';

                }

            } elseif ($params['instance'] == 'salatu') {

                $salatu = new KexaModel();
                $salatu->createKexa($params);

                $this->view->success = true;
                $this->view->message = 'Txostena bidali da';
            }
        }
    }

   public function moderateAction()
   {
       $egoera = $this->_request->getParam("egoera");
       $edukia = $this->_fetchEdukia();
       $isModerator = false;

       if ($edukia) {
            $this->_moderator = $this->_currentUser->getEdukiBatenModeratzaileak($edukia, true);
            $isModerator = $this->_isModerator($this->_moderator);
       }

       $this->view->success = false;
       $this->view->isModerator = $isModerator;

       if ($edukia && $isModerator) {

           $edukia->setEgoera($egoera)->save();
           $this->view->id = $edukia->getId();
           $this->view->egoera = $edukia->getEgoera();
           $this->view->success = true;
       }
   }

    /**
     * JSON
     * Sistema de Me Gusta/Ya no Me Gusta en los recursos
     */
    public function atseginDutAction()
    {

        $erabiltzailea = $this->_helper->SessionUser();
        if ($erabiltzailea) {

            $params = $this->getRequest()->getParams();

            if ($params['instance'] == 'like') {

                $edukia = $this->_edukiaMapper->find($params['edukiaId']);

                if (!$edukia) {
                    $this->view->success = false;
                    return;
                }

                $jakinarazpenak = new JakinarazpenakModel();
                $existitzen = $jakinarazpenak->jakinarazpenExistitzen(
                    $edukia,
                    11
                );

                if (!$existitzen) {
                    $jakinarazpenak->createAtseginDut(
                        $edukia
                    );
                }

                $newLike = new AtseginDutModel();
                $newLike->createAtseginDut($edukia->getId());

                $likeUrl = $this->view->url(
                    array(
                                    'controller' => 'edukiak',
                                    'action' => 'atsegin-dut',
                                    'instance' => 'unlike',
                                    'edukiaId' => $params['edukiaId']
                    ),
                    'default',
                    true
                );

                $iconClass = 'fa fa-heart';
                $classButton = 'class="button-icon bg-grey"';

            } elseif ($params['instance'] == 'unlike') {

                $this->_atseginDutMapper->deleteAtseginDut($params['edukiaId']);

                $likeUrl = $this->view->url(
                    array(
                        'controller' => 'edukiak',
                        'action' => 'atsegin-dut',
                        'instance' => 'like',
                        'edukiaId' => $params['edukiaId']
                    ),
                    'default',
                    true
                );

                $iconClass = 'fa fa-heart-o';
                $classButton = 'class="button-icon bg-red"';

            }

            $buttonText = "Atsegin dut";
            if ($params['instance'] == 'like') {
                $buttonText = "Ez dut atsegin";
            }

            $dataUrlButton = 'data-url="' . $likeUrl . '?format=json"';

            $button = '<button ' . $classButton . ' id="atseginDut" ' . $dataUrlButton . '>';
            $button .= '<span class="' . $iconClass . '"> </span>' . $buttonText;
            $button .= '</button>';

            $this->view->button = $button;

            $this->view->success = true;

        }

    }

    /**
     * JSON
     * Sistema de Favorito/Ya no es mi Favorito en los recursos
     */
    public function gogokoenetaraGehituAction()
    {

        $erabiltzailea = $this->_helper->SessionUser();

        if ($erabiltzailea) {

            $params = $this->getRequest()->getParams();

            if ($params['instance'] == 'gogoko') {

                $edukia = $this->_edukiaMapper->find($params['edukiaId']);

                if (!$edukia) {
                    $this->view->success = false;
                    return;
                }

                $jakinarazpenak = new JakinarazpenakModel();
                $existitzen = $jakinarazpenak->jakinarazpenExistitzen(
                    $edukia,
                    9
                );

                if (!$existitzen) {
                    $jakinarazpenak->createGogokoenetaraGehitu(
                        $edukia
                    );
                }

                $newGogoko = new GustokoaModel();
                $newGogoko->createGustokoa($edukia->getId());

                $gustokoUrl = $this->view->url(
                    array(
                        'controller' => 'edukiak',
                        'action' => 'gogokoenetara-gehitu',
                        'instance' => 'ezGogoko',
                        'edukiaId' => $edukia->getId()
                    ),
                    'default',
                    true
                );

                $iconClass = 'fa fa-star';
                $classButton = 'class="button-icon bg-grey"';

            } elseif ($params['instance'] == 'ezGogoko') {

                $this->_gustokoaMapper->deleteGustokoa($params['edukiaId']);

                $gustokoUrl = $this->view->url(
                    array(
                        'controller' => 'edukiak',
                        'action' => 'gogokoenetara-gehitu',
                        'instance' => 'gogoko',
                        'edukiaId' => $params['edukiaId']
                    ),
                    'default',
                    true
                );

                $iconClass = 'fa fa-star-o';
                $classButton = 'class="button-icon bg-red"';

            }

            $buttonText = "Gogokoenetatik kendu";
            if ($params['instance'] == 'ezGogoko') {
                $buttonText = "Gogokoenetara gehitu";
            }

            $dataUrlButton = 'data-url="' . $gustokoUrl . '?format=json"';

            $button = '<button ' . $classButton . ' id="gogokoenetaraGehitu" ' . $dataUrlButton . '>';
            $button .= '<span class="' . $iconClass . '"> </span>' . $buttonText;
            $button .= '</button>';

            $this->view->button = $button;
            $this->view->success = true;
        }
    }

    protected function _irudiak($edukia)
    {
        $irudiasReturn = array();
        $irudias = $edukia->getIrudia();

        if (sizeof($irudias) > 0) {
            foreach ($irudias as $irudia) {

                $irudiasReturn[] = array(
                    'id' => $irudia->getId(),
                    'titulua' => $irudia->getTitulua(),
                    'url' => $irudia->getUrl(),
                    'type' => $irudia->getMota()
                );
            }
        }

        return $irudiasReturn;

    }

    protected function _bideoak($edukia)
    {

        $bideoasReturn = array();
        $bideoas = $edukia->getBideoa();

        $external = $this->_embedExternal;

        if (sizeof($bideoas) > 0) {

            $size = array(
                "width" => "auto",
                "height" => "auto"
            );

            foreach ($bideoas as $bideoa) {
                $bideoasReturn[] = array(
                    "titulua" => $bideoa->getTitulua(),
                    "iframe" => $bideoa->getUrl()
                );
            }
        }

        return $bideoasReturn;
    }

    protected function _aurkezpena($edukia)
    {
        $aurkezpenaReturn = array();
        $aurkezpena = $edukia->getAurkezpena();
        if (sizeof($aurkezpena) > 0) {

            $size = array(
                            "width" => "auto",
                            "height" => "auto"
            );
            foreach ($aurkezpena as $slide) {

            	if ($slide->getMota() === "issuu") {
	                $aurkezpenaReturn[] = $this->_embedExternal->issuuRender($slide->getUrl());
            	} else {
            		$aurkezpenaReturn[] = $slide->getUrl();
	            }
            }
        }

        return $aurkezpenaReturn;
    }

    protected function _estekak($edukia)
    {
        $estekasReturn = array();
        $estekas = $edukia->getEsteka();

        if (sizeof($estekas) > 0) {
            foreach ($estekas as $esteka) {
                $estekasReturn[] = array(
                                "title" => $esteka->getUrl(),
                                "url" => $esteka->getUrl(),
                                "mota" => $esteka->getMota()
                );
            }
        }

        return $estekasReturn;
    }

    protected function _fitxategia($edukia)
    {
        $fitxategiasReturn = array();
        $fitxategias = $edukia->getFitxategia();

        if (sizeof($fitxategias) > 0) {
            foreach ($fitxategias as $fitxategia) {
                $fitxategiasReturn[] = $fitxategia;
            }
        }

        return $fitxategiasReturn;
    }

    protected function _addComment($datuak, $currentUser, $edukia)
    {

        if (!$currentUser) {
            $this->_redirect("/edukiak/ikusi/edukia/" . $edukia->getUrl());
        }

        if (trim($datuak["comment"]) == "") {

            $this->_helper->flashMessenger(
                array(
                    "warning" => "Iruzkina ezin da hutsik egon"
                )
            );

            $this->_redirect(
                '/edukiak/ikusi/edukia/' . $edukia->getUrl()
            );

        }

        if (isset($datuak["isAthor"])) {
            $egoera = "onartua";
            $literal = "Iruzkina ondo gauzatu da.";
        } else {
            $egoera = "onartzeko";
            $literal = "Iruzkina ondo gauzatu da. Moderatzeko zain dago.";
        }

        $iruzkina = new IruzkinaModel();
        $iruzkina->createIruzkina($datuak, $egoera);

        $jakinarazpenak = new JakinarazpenakModel();
        $jakinarazpenak->createIruzkinak(
            $edukia,
            $iruzkina->getId()
        );

        $this->_helper->flashMessenger(
            array(
                            "success" => $literal
            )
        );

        $this->_redirect("/edukiak/ikusi/edukia/" . $edukia->getUrl());
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
    protected function _fetchEdukia()
    {
        $edukia = array();

        $url = $this->getRequest()->getParam('edukia', false);

        if ($url) {
            $edukia = $this->_edukiaMapper->findOneByField(
                'url',
                $url
            );
        }

        if ($url === false || empty($edukia)) {
            throw new Zend_Exception('Edukia ez da existitzen');
        }

        return $edukia;

    }

    /**
     * Prepara todos los Edukiak Activos.
     * adjuntandolos al template "edukiakList.phtml"
     * @param Int $page Pagina Actual
     * @param Int $limit Limite de Ikastegiak
     * @return EdukiakViews
     */
    protected function _edukiakViewList($page = 1, $where)
    {
        $order = 'sortzeData DESC';
        $offset = $this->_prepareOffset($page, $this->_listLimit);

        $edukiaListArray = $this->_edukiaMapper->fetchListToTemplateListArray(
            'list',
            $where,
            $order,
            $this->_listLimit,
            $offset
        );

        $edukiakDiv = array();

        if (sizeof($edukiaListArray) > 0) {
            foreach ($edukiaListArray as $edukiaTemplateArray) {
                $edukiakDiv[] = $this->_templates->
                loadTemplate('edukiakList')->
                render($edukiaTemplateArray);
            }
        }

        return $edukiakDiv;
    }

    /**
     * Prepara las vistas de los Edukiak relacionados.
     * @param Model $etiketaRelEdukia
     * @param Model $edukiaRelKategoria
     * @return Vistas De las fichas de los Edukiak relacionados.
     */
    protected function _edukiakRelatedViews($edukia)
    {
        $relatedIds = array();
        $edukiakRelatedView = array();

        $relatedIds = $edukia->relatedEdukiak();

        if (!empty($relatedIds)) {

            $where = 'id in (' . implode(',', $relatedIds) . ')';
            if (is_numeric($edukia->getId())) {
               $where .= ' and id != "'. $edukia->getId() .'"';
            }

            $edukiakRelated = $this->_edukiaMapper->fetchListToTemplateListArray(
                'relatedArticles',
                $where
            );

            foreach ($edukiakRelated as $edukiak) {
                $edukiakRelatedView[] = $this->_templates->
                loadTemplate('edukiakList')->
                render($edukiak);
            }
        }
        return $edukiakRelatedView;
    }

    /**
     * Crea los Dialogs de Denuncia y Proponer Mejora en un Edukia
     * @param String $type
     * @param Model $edukia
     * @return View Dialog
     */
    protected function _contentDialog($type, $edukia)
    {
        $dialog = '';

        if ($type == 'salatu') {

            $title = 'Salatu';
            $description = 'Ekintzaren deskribapena:';

        } elseif ($type == 'hobekuntzak') {

            $title = 'Hobekuntzak Proposatu';
            $description = 'Ekintzaren deskribapena:';

        }

        $urlAction = $likeUrl = $this->view->url(
            array(
                'controller' => 'edukiak',
                'action' => 'dialogs-content',
                'instance' => $type,
                'edukiaId' => $edukia->getId()
            ),
            'default',
            true
        );

        $dataDialog = array(
            'type' => $type,
            'title' => $title,
            'description' => $description,
            'urlAction' => $urlAction
        );

        $dialog = $this->_templates
            ->loadTemplate('dialogActions')
            ->render($dataDialog);

        return $dialog;
    }

    /**
     * Comprueba el estado del Edukia, si no esta activo comprueba
     * si el usuario actual es el propietario, de se así muestra un mensaje
     * 'Pendiente de moderación', En caso Contrario no lo deja ver
     * y sale otro mensaje de error.
     * @param Model $edukia
     */
    protected function _edukiaEgoera($edukia)
    {
        if ($edukia->getEgoera() != 'onartua') {

            switch ($edukia->getEgoera()) {

                case 'blokeatuta':
                case 'onartzeko':
                    $message = 'Moderatzeko zain';
                    break;
                case 'ezOnartua':
                    $message = 'Edukia hau ez da onartu';
                    break;
            }

            if (
                $this->_currentUser ||
                ($this->_currentUser && $this->_currentUser->getId() == $edukia->getErabiltzaileaId())
            ) {

                $this->_moderator = $this->_currentUser->getEdukiBatenModeratzaileak($edukia, true);

                if (empty($this->_moderator)) {
                    $this->_messageError($message, true);
                } else {

                    $this->_isModerator = $this->_isModerator($this->_moderator);

                    if (
                        $edukia->getErabiltzaileaId() == $this->_currentUser->getId() ||
                        $this->_isModerator
                    ) {
                        $this->_messageError($message, false);
                    } else {
                        $this->_messageError($message, true);
                    }
                }

            } else {
                $this->_messageError($message, true);
            }
        }

        $this->view->isAdmin = $this->_isModerator;
    }

    protected function _isModerator($moderators)
    {
        foreach ($moderators as $moderator) {
            if ($moderator->getId() == $this->_currentUser->getId()) {
                return true;
            }
        }

        return false;
    }

    protected function _messageError($message, $throw = false)
    {
        if ($throw) {
            throw new Zend_Exception(
                $message
            );
        } else {
            $this->view->erroreMezuak = array($message);
        }
    }

    /**
     * Prepara la vista de info_ficha.hbs
     */
    protected function _infoEdukiaView($edukia)
    {
        $data['infoEdukia'] = array(
            'moreViews' => $edukia->getBisitaKopurua(),
            'moreLikes' => sizeof($edukia->getAtseginDut()),
            'countComments' => $edukia->iruzkinaCount()
        );

        $infoEdukia = $this->_templates->
        loadTemplate('infoEdukia')->
        render($data);

        return $infoEdukia;
    }

    /**
     * Prepara la vista del sidebar con las caracteristicas del Edukia.
     * @param Model $edukia
     * @param Session $currentUser
     * @return View
     */
    protected function _sidebarCaracteristicas($edukia, $currentUser)
    {
        $globalaClassName = $edukia->kategoriaGlobala()->getClassName();

        $data = array();

        $data['icon-list'] = $edukia->iconsList();
        $data['kategoriaGlobalaClassName'] = $globalaClassName;
        $data['categoria'] = $edukia->kategoriaFirst()->getIzena();
        $data['edukiaUrteakNoizarte'] = $edukia->getUrteakNoizarte();
        $data['edukiaUrteakNoiztik'] = $edukia->getUrteakNoiztik();
        $data['edukiaUrl'] = $edukia->edukiaUrl();

        if (trim($edukia->mailaFirst()) != '') {
            $data['mailaIzena'] = $edukia->mailaFirst();
        }

        if (sizeof($edukia->getEtiketaRelEdukia()) > 0) {
            foreach ($edukia->getEtiketaRelEdukia() as $etiketaRel) {
                $data['tags'][]['tagIzena'] = $etiketaRel->getEtiketa()->getIzena();
            }
        }

        /**
         * Segun el $attrId se muestra el Dialog de:
         * - Iniciar Sessión
         * - Proponer Mejoras
         */
        if (!$currentUser) {
            $attrId = 'sartuDialogHobekuntzak';
        } else {
            $attrId = 'hobekuntzak';
        }

        $data['attributeActionId'] = $attrId;

        $view = $this->_templates->
        loadTemplate('sidebarCaracteristicas')->
        render($data);

        return $view;
    }

    /**
     * Prepara la vista del sidebar con la información del Propietario.
     * @param Model $edukia
     * @return View
     */
    protected function _sidebarAutor($edukia)
    {

        $erabiltzailea = $edukia->getErabiltzailea();

        $data = array();

        $type = $erabiltzailea->getTypeAvatar();
        if ($type == 'default') {

            $avatarIrudia = false;
            $color = $erabiltzailea->getIrudiaDefault();

            switch ($erabiltzailea->getProfila()) {
                case 'irakasle':
                    $classProfila = 'perfil-irakasle';
                    break;
                case 'ikasle':
                    $classProfila = 'perfil-ikasle';
                    break;
                case 'otros':
                    $classProfila = 'perfil-ikastegi';
                    break;
            }

            $data['color'] = $color;
            $data['classProfila'] = $classProfila;
        } else {
            $avatarIrudia = true;
            $data['autorIrudiaUrl'] = $erabiltzailea->urlIrudia();
        }

        $data['avatarIrudia'] = $avatarIrudia;
        $data['autorIzena'] = $erabiltzailea->getCompletName();


        $imNotTheOwner = $this->_currentUser && ($this->_currentUser->getId() != $erabiltzailea->getId());
        if ($imNotTheOwner) {
            $data['autorProfila'] = $erabiltzailea->getUrl();
        }

        $data['autorUrl'] = $erabiltzailea->urlProfile();
        $data['kolaboratzaileak'] = $this->_kolaboratzaileak($edukia);
        $data['ikastegiak'] = $this->_ikastegiak($edukia);

        $view = $this->_templates->
        loadTemplate('sidebarAutor')->
        render($data);

        return $view;
    }

    protected function _kolaboratzaileak($edukia)
    {
        $kolaboratzaileak = array();

        $where = array();
        $where[] = 'edukiaId = "' . $edukia->getId() . '"';
        $where[] = 'egoera = "onartua"';
        $kolaboratzaileakMapper = new \Klikasi\Mapper\Sql\ErabiltzaileaRelEdukia();
        $kolaboratzaileakListRel = $kolaboratzaileakMapper->fetchList(
            implode(' AND ', $where),
            null,
            3
        );

        if (sizeof($kolaboratzaileakListRel) > 0) {
            foreach ($kolaboratzaileakListRel as $kolaboratzaileakList) {
                $erabiltzailea = $kolaboratzaileakList->getErabiltzailea();
                $kolaboratzaileak[] = array(
                                'kolaboratzaileakIzena' => $erabiltzailea->getCompletName(),
                                'kolaboratzaileakUrl' => $erabiltzailea->urlProfile()
                );
            }
        }

        return $kolaboratzaileak;
    }

    protected function _ikastegiak($edukia)
    {
        $ikastegiak = array();

        $where = array();
        $where[] = 'edukiaId = "' . $edukia->getId() . '"';
        $where[] = 'egoera ="onartua"';
        $order = '';
        $relIkastegiaMapper = new \Klikasi\Mapper\Sql\EdukiaRelIkastegia();
        $relIkastegiaListRel = $relIkastegiaMapper->fetchList(
                        implode(' AND ', $where),
                        $order,
                        3
        );

        if (sizeof($relIkastegiaListRel) > 0) {
            foreach ($relIkastegiaListRel as $relIkastegiaList) {
                $ikastegia = $relIkastegiaList->getIkastegia();
                $ikastegiak[] = array(
                                'ikastegiaUrl' => $ikastegia->ikastegiaUrl(),
                                'ikastegiaIzena' => $ikastegia->getIzena()
                );
            }
        }

        return $ikastegiak;
    }

    /**
     * Prepara la vista del sidebar con las redes sociales, para compartir.
     * @param Model $edukia
     * @param Session $currentUser
     * @return View
     */
    protected function _sidebarSocial($edukia, $currentUser)
    {
        $erabiltzailea = $edukia->getErabiltzailea();

        $data = array();
        $data['socialList'] = $this->_socialList($edukia, $currentUser);

        $atseginDut = $this->_atseginDutSocial($edukia, $currentUser);
        $data['atseginDutText'] = $atseginDut['text'];
        $data['atseginDutUrl'] = $atseginDut['url'];
        $data['atseginDutClass'] = $atseginDut['class'];
        $data['atseginDutIcon'] = $atseginDut['icon'];
        $data['atseginDutId'] = $atseginDut['atseginDutId'];

        $gogokoenetara = $this->_gogokoenetaraSocial($edukia, $currentUser);

        $data['gogokoenetaraClass'] = $gogokoenetara['class'];
        $data['gogokoenetaraText'] = $gogokoenetara['text'];
        $data['gogokoenetaraUrl'] = $gogokoenetara['url'];
        $data['gogokoenetaraClass'] = $gogokoenetara['class'];
        $data['gogokoenetaraIcon'] = $gogokoenetara['icon'];
        $data['gogokoenetaraId'] = $gogokoenetara['gogokoenetaraId'];

        if (!$currentUser) {
            $data['salatuId'] = '';
            $data['salatuClass'] = 'sartuDialog';
        } else {
            $data['salatuId'] = 'salatu';
            $data['salatuClass'] = '';
        }

        $view = $this->_templates->
        loadTemplate('sidebarSocial')->
        render($data);

        return $view;
    }

    protected function _atseginDutSocial($edukia, $currentUser)
    {
        if ($currentUser) {

            $erabiltzailea = new Klikasi\Mapper\Sql\Erabiltzailea();
            $erabiltzailea = $erabiltzailea->find($currentUser->getId());
            $atseginDutArray = $erabiltzailea->atseginDutArray();

            $like = array_search($edukia->getId(), $atseginDutArray);

            if ($like === false) {

                $likeUrl = $this->view->url(
                    array(
                        'controller' => 'edukiak',
                        'action' => 'atsegin-dut',
                        'instance' => 'like',
                        'edukiaId' => $edukia->getId()
                    ),
                    'default',
                    true
                );

                $icon = 'fa-heart-o';
                $class = 'bg-red';

            } else {

                $likeUrl = $this->view->url(
                    array(
                        'controller' => 'edukiak',
                        'action' => 'atsegin-dut',
                        'instance' => 'unlike',
                        'edukiaId' => $edukia->getId()
                    ),
                    'default',
                    true
                );

                $icon = 'fa-heart';
                $class = 'bg-grey';

            }

            $atseginDut = array(
                            'text' => $like === false ? "Atsegin dut" : "Ez dut atsegin",
                            'url' => $likeUrl,
                            'class' => $class,
                            'icon' => $icon,
                            'atseginDutId' => 'atseginDut'
            );

        } else {

            $atseginDut = array(
                            'text' => "Atsegin dut",
                            'url' => '',
                            'class' => 'bg-red sartuDialog',
                            'icon' => 'fa-heart-o',
                            'atseginDutId' => ''
            );

        }

        return $atseginDut;
    }

    protected function _gogokoenetaraSocial($edukia, $currentUser)
    {
        if ($currentUser) {

            $erabiltzailea = new Klikasi\Mapper\Sql\Erabiltzailea();
            $erabiltzailea = $erabiltzailea->find($currentUser->getId());
            $gustokoArray = $erabiltzailea->gustokoArray();

            $gustoko = array_search($edukia->getId(), $gustokoArray);


            if ($gustoko === false) {

                $gustokoUrl = $this->view->url(
                    array(
                        'controller' => 'edukiak',
                        'action' => 'gogokoenetara-gehitu',
                        'instance' => 'gogoko',
                        'edukiaId' => $edukia->getId()
                    ),
                    'default',
                    true
                );

                $icon = 'fa-star-o';
                $class = 'bg-red';

            } else {

                $gustokoUrl = $this->view->url(
                    array(
                        'controller' => 'edukiak',
                        'action' => 'gogokoenetara-gehitu',
                        'instance' => 'ezGogoko',
                        'edukiaId' => $edukia->getId()
                    ),
                    'default',
                    true
                );

                $icon = 'fa-star';
                $class = 'bg-grey';

            }

            $gogokoenetara = array(
                            'text' => $gustoko === false ? "Gogokoenetara gehitu" : "Gogokoenetatik kendu",
                            'url' => $gustokoUrl,
                            'class' => $class,
                            'icon' => $icon,
                            'gogokoenetaraId' => 'gogokoenetaraGehitu'
            );

        } else {

            $gogokoenetara = array(
                            'text' => "Gogokoenetara gehitu",
                            'url' => '',
                            'class' => 'bg-red sartuDialog',
                            'icon' => 'fa-star-o',
                            'gogokoenetaraId' => ''
            );

        }

        return $gogokoenetara;
    }

    protected function _socialList($edukia, $currentUser)
    {
        $currentUrl = $this->view->serverUrl($this->view->url());
        $titulua = $edukia->getTitulua();
        $socialData = array();

        $socialData[] = array(
                        'socialUrl' => 'http://twitter.com/home?status=' . $currentUrl,
                        'socialClass' => 'fa-twitter',
                        'socialName' => 'Twitter'
        );

        $socialData[] = array(
                        'socialUrl' => 'http://www.facebook.com/sharer.php?u='  . $currentUrl . '&t=' . $titulua,
                        'socialClass' => 'fa-facebook',
                        'socialName' => 'Facebook'
        );

        $socialData[] = array(
                        'socialUrl' => 'http://pinterest.com/pin/create/button/?url='  . $currentUrl,
                        'socialClass' => 'fa-pinterest',
                        'socialName' => 'Pinterest'
        );

        $socialData[] = array(
                        'socialUrl' => 'https://plus.google.com/share?url=' . $currentUrl,
                        'socialClass' => 'fa-google-plus',
                        'socialName' => 'Google +'
        );

        $socialData[] = array(
                        'socialUrl' => 'https://www.linkedin.com/cws/share?url=' . $currentUrl,
                        'socialClass' => 'fa-linkedin',
                        'socialName' => 'Linkedin'
        );

        if ($currentUser) {

            $erabiltzailea = new Klikasi\Mapper\Sql\Erabiltzailea();
            $erabiltzailea = $erabiltzailea->find($currentUser->getId());

            $link = "<a
            href='" . $currentUrl . "'
            title='" . $titulua . "'
            >" . $titulua . "</a>";

            $subject = 'Klikasi - ' . $titulua;
            $body = "%0A" . $edukia->getDeskribapenLaburra() . "%0A%0A" . $currentUrl;

            $mailto = 'mailto:' . $erabiltzailea->getPosta() . '?subject=' . $subject . '&body=' . $body;

            $socialData[] = array(
                            'socialUrl' => $mailto,
                            'socialClass' => 'fa-envelope',
                            'socialName' => 'Email'
            );
        }

        return $socialData;
    }

    /**
     * Saca una lista con los id's de los colaboradores y del autor,
     * para poder moderar los comentarios pendientes.
     * @param Model-Session $currentUser
     * @param Model $edukia
     * @return boolean
     */
    protected function _isModerate($currentUser, $edukia)
    {
        $isModerate = false;

        if ($currentUser) {

            $authos = array();
            $authos[] = $edukia->getErabiltzailea()->getId();
            $coAuthorsList = $edukia->getErabiltzaileaRelEdukia(
                'egoera = "onartua"'
            );

            if (sizeof($coAuthorsList) > 0) {
                foreach ($coAuthorsList as $coAuthor) {
                    $authos[] = $coAuthor->getErabiltzailea()->getId();
                }
            }

            $isModerate = in_array($currentUser->getId(), $authos);

        }

        return $isModerate;
    }

    /**
     * Prepara los comentarios para ser listados en la Vista.
     * Listando siempre los aceptados, si el usuarios action es el propietario o
     * un colaborador, se incuiran los comentarios que estan pendientes
     * de moderación, con los botones de Aceptar/Rechazar
     * @param Model $edukia
     * @param Model-Session $currentUser
     * @return array() || Template
     */
    protected function _iruzkinaList($edukia, $currentUser)
    {
        $iruzkinakList = array();

        $canModerate = $this->_isModerate(
            $currentUser,
            $edukia
        );


        $alreadyDrawnIds = array();
        if (sizeof($edukia->iruzkinakList()) > 0) {
            foreach ($edukia->iruzkinakList() as $iruzkina) {

                if (in_array($iruzkina->getId(), $alreadyDrawnIds)) {
                    continue;
                }

                $alreadyDrawnIds[] = $iruzkina->getId();

                $needModeration = false;
                $erabiltzailea = $iruzkina->getErabiltzailea();
                $avatar = $erabiltzailea->avatarData();

                if ($iruzkina->getEgoera() == 'onartua' && is_null($iruzkina->getIruzkinaId())) {

                    $iruzkinaTemplateArray = array(
                        'authorUrl' => $erabiltzailea->urlProfile(),
                        'authorName' => $erabiltzailea->getCompletName(),
                        'iruzkinaDate' => $iruzkina->dateComment(),
                        'iruzkinaIruzkin' => $iruzkina->getIruzkin(),
                        'iruzkinaId' => $iruzkina->getId(),
                        'iruzkinaSon' => $iruzkina->iruzkinaSonArray($canModerate),
                        'viewRespondComment' => true,
                    );

                    foreach ($iruzkinaTemplateArray['iruzkinaSon'] as $iruzkinaItem) {
                        $alreadyDrawnIds[] = $iruzkinaItem['iruzkinaId'];
                    }

                    if ($avatar['type'] == 'default') {
                        $iruzkinaTemplateArray['avatarIrudia'] = false;
                        $iruzkinaTemplateArray['color'] = $avatar['color'];
                        $iruzkinaTemplateArray['classProfila'] = $avatar['classProfila'];
                    } else {
                        $iruzkinaTemplateArray['avatarIrudia'] = true;
                        $iruzkinaTemplateArray['autorIrudiaUrl'] = $avatar['irudiaUrl'];
                    }

                    $iruzkinakList[] = $this->_templates->
                    loadTemplate('iruzkina')->
                    render($iruzkinaTemplateArray);

                } elseif ($iruzkina->getEgoera() == 'onartzeko' && $canModerate === true) {

                    $needModeration = true;

                    $moderationUrl = $this->view->url(
                        array(
                            'controller' => 'edukiak',
                            'action' => 'iruzkinak-moderate',
                            'iruzkinaId' => $iruzkina->getId()
                        ),
                        'default',
                        true
                    );

                    $iruzkinaTemplateArray = array(
                        'authorName' => $erabiltzailea->getCompletName(),
                        'authorImg' => $erabiltzailea->urlIrudia(),
                        'iruzkinaDate' => $iruzkina->dateComment(),
                        'iruzkinaIruzkin' => $iruzkina->getIruzkin(),
                        'iruzkinaId' => $iruzkina->getId(),
                        'needModeration' => $needModeration,
                        'moderationUrl' => $moderationUrl,
                        'iruzkinaSon' => $iruzkina->iruzkinaSonArray($canModerate)
                    );

                    foreach ($iruzkinaTemplateArray['iruzkinaSon'] as $iruzkinaItem) {
                        $alreadyDrawnIds[] = $iruzkinaItem['iruzkinaId'];
                    }

                    if ($avatar['type'] == 'default') {
                        $iruzkinaTemplateArray['avatarIrudia'] = false;
                        $iruzkinaTemplateArray['color'] = $avatar['color'];
                        $iruzkinaTemplateArray['classProfila'] = $avatar['classProfila'];
                    } else {
                        $iruzkinaTemplateArray['avatarIrudia'] = true;
                        $iruzkinaTemplateArray['autorIrudiaUrl'] = $avatar['irudiaUrl'];
                    }

                    $iruzkinakList[] = $this->_templates->
                    loadTemplate('iruzkina')->
                    render($iruzkinaTemplateArray);

                }
            }
        }

        return $iruzkinakList;
    }
}
