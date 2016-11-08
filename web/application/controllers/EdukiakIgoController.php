<?php
use Klikasi\Model as Models;
use Klikasi\Mapper\Sql as Mappers;
use Klikasi\Mapper\Sql\Orrialdea as OrrialdeaMapper;

class EdukiakIgoController extends Zend_Controller_Action
{
    protected $_currentUser;

    public function init()
    {
        $this->_helper->layout->setLayout(
            'edukiak-igo'
        );

        $this->view->flashmezuak = $this->_helper->FlashMessenger->getMessages();
        $this->_loadLibraries();

        $this->_currentUser = $this->_checkCurrentUser();
        $this->view->edukiaUrl = $this->view->baseUrl('edukiak');
        
        $this->_orrialdeaMapper = new OrrialdeaMapper;
    }

    protected function _loadLibraries()
    {

        $baseUrl = $this->view->baseUrl();

        $this->view->appendJs = array(
            '/bower/bootstrap-slider/bootstrap-slider.js',
            '/bower/mustache.js/mustache.js',
            '/js/klikasi.edukia-igo.js'
        );

        $this->view->headLink()
            ->appendStylesheet($baseUrl . '/css/slider.css')
            ->appendStylesheet($baseUrl . '/css/edukiak-igo.css');
    }

    public function indexAction()
    {
        $this->view->title = 'Edukiak Igo';
        $this->view->edukiakHeader = true;

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $newModel = new Models\Edukia();
            $result = $newModel->isValidForm(
                $postData,
                $this->_currentUser,
                false
            );

            if ($result['status'] === false) {
                $this->_helper->json($result);
                die();
            } else {

	            $edukia = $this->_saveNewEdukia($postData);
                $currentUrl = $this->view->baseUrl(
                    'edukiak/ikusi/edukia/' . $edukia->getUrl()
                );

                try {

                    $this->_helper->json(
                        array(
                            'status' => true,
                            'newEdukia' => $currentUrl
                        )
                    );

                } catch (\Exception $e) {

                    $this->_helper->json(
                        array(
                            'status' => false,
                            'newEdukia' => $currentUrl,
                            'msg' => $e->getMessage()
                        )
                    );
                }
            }
        }

        $kategoriaGlobalaView = array();
        $kategoriaGlobala = new Mappers\KategoriaGlobala();
        $kategoriaGlobalaList = $kategoriaGlobala->fetchList(null, 'izena');

        if (!empty($kategoriaGlobalaList)) {
            foreach ($kategoriaGlobalaList as $kategoriaGlobala) {
                $kategoriaRel = new Mappers\KategoriakRelKategoriaGlobalak();
                $where = array(
                    'kategoriaGlobalaId = ? ' => $kategoriaGlobala->getId()
                );
                $kategoriaRelList = $kategoriaRel->fetchList($where);
                if (!empty($kategoriaRelList)) {
                    $katsIds = array();
                    foreach ($kategoriaRelList as $kategoriaRel) {
                        $katsIds[] = $kategoriaRel->getKategoriaId();
                    }

                    $kategoriaList = new Mappers\Kategoria();
                    $whereKate = 'id IN (' . implode(',', $katsIds) . ')';
                    $kategoriaList = $kategoriaList->fetchList(
                        $whereKate,
                        'izena'
                    );

                    $kategoriaKey = $kategoriaGlobala->getIzena();
                    $kategoriaGlobalaView[$kategoriaKey] = $kategoriaList;
                }
            }
        }

        $mailak = new Mappers\Maila();
        $eskolak = new Mappers\Ikastegia();
        $whereIkastegia = array(
            'aktibatua = ? ' => 1
        );

        $this->view->kategoriakGlobala = $kategoriaGlobalaView;
        $this->view->mailak = $mailak->fetchList(null, new \Zend_Db_Expr("FIELD(grupo, 'haurHezkuntza', 'LH', 'DBH', 'Batxilergoa', 'bestelakoak'), izena"));

        $relIkastegiaMapper = new Mappers\ErabiltzaileaRelIkastegia;
        $relIkastegiak = $relIkastegiaMapper->fetchList(array("erabiltzaileaId = ?" => $this->_currentUser->getPrimaryKey()));

        if ($this->_currentUser->isSenior()) {

            $order = 'izena asc';
            if (!empty($relIkastegiak)) {

                $orderIds = array();
                foreach ($relIkastegiak as $relation) {
                    $orderIds[] = $relation->getIkastegiaId();
                }

                $order = new \Zend_Db_Expr("FIELD(id, ". implode(',', $orderIds) .") desc, " . $order);
            }

            $this->view->eskolak = $eskolak->fetchList($whereIkastegia, $order);

        } else {

            $this->view->eskolak = array();
            foreach ($relIkastegiak as $relItem) {
                $this->view->eskolak[] = $relItem->getIkastegia();
            }
        }

        $kanpainaKodeak = array();
        $kanpainaMapper = new Mappers\Kanpaina;
        $where = 'bukaera >= now() and hasiera <= now() and egoera = 1 and kodea is not null';
        $kanpainak = $kanpainaMapper->fetchList($where);

        foreach ($kanpainak as $kanpaina) {
            $kanpainaKodeak[$kanpaina->getKodea()] = $kanpaina->getIzena();
        }

        $this->view->kanpainaKodeak = $kanpainaKodeak;
        $this->view->profila = $this->_currentUser->getProfila();
        $this->view->senior = $this->_currentUser->isSenior();
        
        $orrialdea = $this->_orrialdeaMapper->findOneByField("titulua", "Edukiak igo");
        $this->view->metaDescription = $orrialdea->getMetaDescription();
        $this->view->metaTitle = $orrialdea->getMetaTitle();
        $this->view->metaKeywords = $orrialdea->getMetaKeywords();
        $this->view->currentUrl = $this->view->serverUrl($this->view->url());
        $this->view->urlMetaImage = $orrialdea->orrialdeaIrudiaUrl();
        $this->view->metaType = "website";
    }

    public function renderAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(TRUE);

        $embeder = new \Klikasi_Controller_Action_Helper_EmbedExternal();

        $name = $this->_request->getParam("name");
        $type = $this->_request->getParam("type");
        $url = $this->_request->getParam("url");
        $done = false;

        switch ($name) {
            case "bideoa":

                if ('youtube' == $type) {
                    $id = $embeder->youtubeUrlMatch($url);
                    if ($id) {
                        echo json_encode(array("url" => $embeder->youtubeRender($id)));
                        $done = true;
                    }

                } else if ('vimeo' == $type) {
                    $id = $embeder->vimeoUrlMatch($url);
                    if ($id) {
                        echo json_encode(array("url" => $embeder->vimeoRender($id)));
                    }
                    $done = true;
                }
                break;

            case 'aurkezpena':

                if ('slideshare' == $type) {
                    $id = $embeder->slideshareUrlMatch($url);
                    if ($id) {
                        echo json_encode(array("url" => $embeder->slideshareRender($id)));
                        $done = true;
                    }
                } else if ('issuu' == $type) {
                	$id = $embeder->issuuUrlMatch($url);
                	if ($id) {
                		echo json_encode(array('url' => $url,
                        					   'embed' => $embeder->issuuRender($id)));
                		$done = true;
                	}
                }
                break;

            case 'irudia':
                if ('flickr' == $type) {
                    $id = $embeder->flickrUrlMatch($url);

                    if ($id) {
                        echo json_encode($embeder->flickrRender($id));
                    }
                    $done = true;

                } else if ('pinterest' == $type) {

                    $ids = $embeder->pinterestUrlMatch($url);
                    if (!is_null($ids)) {
                        echo json_encode(array("url" => $embeder->pinterestRender($ids)));
                    }
                    $done = true;
                }
                break;

            case 'fitxategia':

                if (!preg_match("(mega|google)", $url)) {
                    return;
                }

            case 'esteka':

                $url = strip_tags($url);

                //Recognizes ftp://, ftps://, http:// and https:// in a case insensitive way.
                if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                    $url = "http://" . $url;
                }

                if (!empty($url)) {
                    echo json_encode(array(
                        'url' => $url,
                        'embed' => "<a class='$type' href='$url'>$url</a>"
                    ));
                }
                break;
        }

        if (!$done) {
            //throw new \Exception("ui ui ui");
        }
    }

    protected function _saveNewEdukia($params)
    {
        $isAdmin = false;
        $edukia = new Models\Edukia();

        $edukia->setPostData(
            $params,
            $this->_currentUser->getId(),
            true
        );

        $egoera = 'onartzeko';

        $edukiaRelIkastegia = null;
        if (isset($params['eskola']) && is_numeric($params['eskola'])) {

           $edukiaRelIkastegia = new Models\EdukiaRelIkastegia();
           $edukiaRelIkastegia
               ->setIkastegiaId($params['eskola'])
               ->setEgoera($egoera);

            $edukia->addEdukiaRelIkastegia($edukiaRelIkastegia);
        }

        $moderatzaileak = $this->_currentUser->getEdukiBatenModeratzaileak(
            $edukia
        );

        if (empty($moderatzaileak)) {
            $egoera = 'onartua';
            $edukia->setEgoera($egoera);

            if (!is_null($edukiaRelIkastegia)) {
                $edukiaRelIkastegia->setEgoera($egoera);
            }
        }

        $edukia->saveRecursive();
        $edukiaId = $edukia->getId();

        if (!empty($params['kategoriak'])) {
            foreach ($params['kategoriak'] as $idKategoria) {

                $kategoria = new Models\EdukiaRelKategoria();
                $kategoria->setEdukiaId($edukia->getId());
                $kategoria->setKategoriaId($idKategoria);
                $kategoria->save();
            }
        }

        if (is_numeric($params['maila'])) {
            $maila = new Models\EdukiaRelMaila();
            $maila->setEdukiaId($edukia->getId());
            $maila->setMailaId($params['maila']);
            $maila->save();
        }

        if (trim($params['etiketak']) != '') {
            $etiketaList = explode(',', $params['etiketak']);
            foreach ($etiketaList as $etiketa) {

                if (is_numeric($etiketa)) {
                    $etiketaRelModel = new Models\EtiketaRelEdukia();
                    $etiketaRelModel->addRel($etiketa, $edukiaId);
                    $etiketaRelModel->save();
                } else {
                    $etiketaRelModel = new Models\EtiketaRelEdukia();
                    $etiketaRelModel->newEtiketaAddRel($etiketa, $edukiaId);
                    $etiketaRelModel->save();
                }
            }
        }

        if (trim($params['beste-egile']) != '') {

            $besteEgileList = explode(',', $params['beste-egile']);
            foreach ($besteEgileList as $besteEgile) {
                $relBesteEgile = new Models\ErabiltzaileaRelEdukia();
                $relBesteEgile->setEdukiaId($edukiaId);
                $relBesteEgile->setErabiltzaileaId($besteEgile);
                $relBesteEgile->setEgoera('onartzeko');
                $relBesteEgile->save();
            }
        }

        if (!$this->_currentUser->isSenior()) {

                if (empty($moderatzaileak)) {
                    throw \Exception("Not alllowed");    
                }

                $relBesteEgile = new Models\ErabiltzaileaRelEdukia();
                $relBesteEgile->setEdukiaId($edukiaId);
                $relBesteEgile->setErabiltzaileaId($this->_currentUser->getId());
                $relBesteEgile->setEgoera('onartua');
                $relBesteEgile->save();

                $edukia->setErabiltzaileaId($moderatzaileak[0]->getId())
                       ->save();
        }

        if (!empty($params['kanpaina'])) {

            $kanpainaMapper = new Mappers\Kanpaina;
            foreach ($params['kanpaina'] as $kodea) {

                $kanpaina = $kanpainaMapper->findOneByField('kodea', $kodea);

                if ($kanpaina) {
                    $edukiaRelKanpaina = new Models\EdukiaRelKanpaina;
                    $edukiaRelKanpaina->setKanpainaId($kanpaina->getId())
                                      ->setEdukiaId($edukia->getId())
                                      ->save();
                }
            }
        }

        $edukiaMapper = new Mappers\Edukia;
        $edukiaMapper->createEdukiaRelAssets($params, $edukia);
        return $edukia;
    }

    protected function _checkCurrentUser()
    {
        $currentUser = $this->_helper->SessionUser();

        if (!$currentUser) {
            $this->_redirect(
                $this->view->baseUrl('sartu'),
                array(
                    'prependBase' => false
                )
            );
        }

        if (!$currentUser->isValidPublicate()) {

            $this->_helper->flashMessenger(
                array(
                    'warning' => 'Ezin duzu baliabiderik sortu oraindik'
                )
            );

            $this->_redirect(
                $this->view->baseUrl('edukiak'),
                array(
                    'prependBase' => false
                )
            );
        }

        return $currentUser;

    }
}