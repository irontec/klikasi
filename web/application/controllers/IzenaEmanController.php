<?php

use Klikasi\Model as Models;
use \Klikasi\Mapper\Sql as Mappers;


use Klikasi\Model\Erabiltzailea as ErabiltzaileaModel;
use Klikasi\Model\ErabiltzaileenIrudiak as ErabiltzaileenIrudiakModel;
use Klikasi\Model\ErabiltzaileaSettings as ErabiltzaileaSettingsModel;

use \Klikasi\Mapper\Sql\Erabiltzailea as ErabiltzaileaMapper;
use \Klikasi\Mapper\Sql\ErabiltzaileenIrudiak as ErabiltzaileenIrudiakMapper;

class IzenaEmanController extends Zend_Controller_Action
{
    protected $_auth = NULL;
    protected $_sessionNameSpace = 'KlikasiNewUserSession';
    protected $_sessionExpirationSeconds = 28800;

    protected $_avatarMapper;
    protected $_erabiltzaileaMapper;

    public function init()
    {
        $this->_auth = Zend_Auth::getInstance();

        $this->view->appendJs = array(
            '/js/klikasi.izena-eman.js'
        );

        $this->_helper->ironContextSwitch()
            ->addActionContext('alta', 'json')
            ->initContext();

        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;

        $this->_helper->layout->setLayout('container-principal-title');
        $this->_initMappers();
    }

    protected function _initMappers()
    {
        $this->_avatarMapper = new ErabiltzaileenIrudiakMapper();
        $this->_erabiltzaileaMapper = new ErabiltzaileaMapper();
    }

    public function izenaEmanAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $erabiltzailea = new ErabiltzaileaModel();
            $isValid = $erabiltzailea->registrationIsValid($postData);

            if ($isValid['status']) {

                $erabiltzailea = $this->_erabiltzaileaMapper->altaBerria(
                    $postData
                );

                $settings = new ErabiltzaileaSettingsModel();
                $settings->firstPopulate($erabiltzailea->getId());

                $session = new Zend_Session_Namespace(
                    $this->_sessionNameSpace
                );
                $session->setExpirationSeconds(
                    $this->_sessionExpirationSeconds
                );
                $session->erabiltzailea = $erabiltzailea;

                $this->_helper->json(
                    array(
                        'status' => true,
                        'erabiltzailea' => $erabiltzailea->getId(),
                        'isSenior' => $erabiltzailea->isSenior()
                    )
                );

            } else {

                $this->_helper->json(
                    array(
                        'status' => false,
                        'errors' => $isValid['errors']
                    )
                );

            }

        } else {
            $this->_redirect('/');

        }
    }

    public function izenaEmanIrudiaAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $status = true;
            $errors = array();

            if (trim($postData['erabiltzailea']) == '') {
                $status = false;
                $errors[] = $this->view->translate('[es] Error al crear el usuario');
            }

            if (empty(trim($postData['izena']))) {
                $status = false;
                $errors['izena'] = 'Izena betetzea beharrezkoa da';
            }

            if (empty(trim($postData['abizena']))) {
                $status = false;
                $errors['abizena'] = 'Abizena betetzea beharrezkoa da';
            }

            if (empty(trim($postData['abizena-second']))) {
                $status = false;
                $errors['abizena-second'] = 'Bigarren abizena betetzea beharrezkoa da';
            }

            if (empty(trim($postData['deskribapena']))) {
                $status = false;
                $errors['deskribapena'] = 'Deskribapena betetzea beharrezkoa da';
            }

            if (strlen($postData['deskribapena']) > 140) {
                $status = false;
                $errors['deskribapena'] = $this->view->translate('[es] deskribapena no puede tener mas de 140 caracteres.');
            }

            if (!isset($postData['profila'])) {
                $status = false;
                $errors['profila'] = $this->view->translate('[es] Tienes que seleccionar un perfil.');
            }

            if ($status) {

                $session = new Zend_Session_Namespace($this->_sessionNameSpace);
                $erabiltzailea = $session->erabiltzailea;
                $url = $this->view->url(
                    array(
                        'controller' => 'izena-eman',
                        'action' => 'alta',
                        'nor' => $erabiltzailea->getErabiltzaileIzena(),
                        'kodea' => $erabiltzailea->getHash()
                    )
                );

                $data = array(
                    'altaUrl' => $this->view->serverUrl(
                        $url
                    )
                );

                $erabiltzailea->setIzena($postData['izena']);
                $erabiltzailea->setAbizena($postData['abizena']);
                $erabiltzailea->setAbizena2($postData['abizena-second']);
                $erabiltzailea->setDeskribapena($postData['deskribapena']);
                $erabiltzailea->setProfila($postData['profila']);
                $erabiltzailea->setNewsletter($postData['newsletter']);
                $erabiltzailea->setEgoera('datuakSartuta');
                $erabiltzailea->save();

                $notifikazioa = new \Klikasi\Custom\Notifikazioa(
                    'alta',
                    $erabiltzailea,
                    $data
                );
                $notifikazioa->notifikazioaBidali('Alta berria');

                $this->_helper->json(
                    array(
                        'status' => true,
                    )
                );

            } else {
                $this->_helper->json(
                    array(
                        'status' => false,
                        'errors' => $errors
                    )
                );
            }

        } else {

            $this->_redirect('/');
        }
    }

    public function izenaEmanFinishAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $session = new Zend_Session_Namespace($this->_sessionNameSpace);
            $erabiltzailea = $session->erabiltzailea;
            $profila = $erabiltzailea->getProfila();

            $url = '';

            if ($postData['typeAvatar'] == 'default') {

                $erabiltzailea->setTypeAvatar($postData['typeAvatar']);
                $erabiltzailea->setIrudiaDefault($postData['irudiaDefault']);
                $erabiltzailea->setIrudiaId(NULL);
                $erabiltzailea->save();

            } else {

                if (!empty($postData['tmpName'])) {

                    $imagick = new \Klikasi\Custom\Imagick();
                    $tempPath = $imagick->saveThumbImg(
                        $postData,
                        $erabiltzailea->getErabiltzaileIzena()
                    );

                    /**
                     * Sortutako irudia gorde
                     */
                    $erabiltzaileIrudia = new Models\ErabiltzaileenIrudiak();
                    $erabiltzaileIrudia->putIrudia($tempPath);
                    $erabiltzaileIrudia->save();

                    /**
                     * /tmp karpetan sortutako irudi denak ezabatu
                     */
                    $erabiltzaileIzena = $erabiltzailea->getErabiltzaileIzena();
                    array_map(
                        'unlink',
                        glob(
                            '/tmp/' . $erabiltzaileIzena . '_*'
                        )
                    );

                    $erabiltzailea->setTypeAvatar($postData['typeAvatar']);
                    $erabiltzailea->setIrudiaDefault(NULL);
                    $erabiltzailea->setIrudiaId($erabiltzaileIrudia->getId());
                    $erabiltzailea->save();

                }
            }

            if ($profila == 'otros') {
                //avatar
            } elseif ($profila == 'irakasle') {
                //avatar
                if ($postData['ikastegiak'] == 'new') {
                    $url = 'ikastegia-berria';
                } else {
                    $this->_addErabiltzaileaRelIkastegia(
                        $erabiltzailea,
                        $postData['ikastegiak']
                    );
                }

            } elseif ($profila == 'ikasle') {
                //avatar

                if ($postData['ikastegiak'] == 'new') {
                    $url = 'ikastegia-berria';
                } else {

                    $this->_addErabiltzaileaRelIkastegia(
                        $erabiltzailea,
                        $postData['ikastegiak']
                    );

                    if ($postData['irakasle'] != 'empty' ) {

                        $this->_addErabiltzaileaRelIrakaslea(
                            $erabiltzailea,
                            $postData['irakasle'],
                            $postData['ikastegiak']
                        );
                    }
                }
            }

            if (empty($url)) {
                $url = 'erabiltzaileak/ikusi/erabiltzailea/' . $erabiltzailea->getUrl();
            }

            $this->_helper->json(
                array(
                    'status' => true,
                    'url' => $url
                )
            );

        } else {

            $this->_redirect('/');
        }

    }

    /**
     * Revisar
     */
    public function altaAction()
    {
        $session = new Zend_Session_Namespace($this->_sessionNameSpace);
        $erabiltzailea = $session->erabiltzailea;

        $nor = $this->getRequest()->getParam('nor', false);
        $kodea = $this->getRequest()->getParam('kodea', false);
        $where = array(
            'hash = ? ' =>  $kodea,
            'erabiltzaileIzena = ? ' =>  $nor
        );

        if (!$erabiltzailea || $erabiltzailea->getErabiltzaileIzena() != $nor) {

            $erabiltzailea = $this->_erabiltzaileaMapper->fetchOne($where);
            if (!$erabiltzailea) {
                $this->_redirect('sartu');
            }

        } else {
            $erabiltzailea = $this->_erabiltzaileaMapper->fetchOne(
                $where
            );
        }

        if ($erabiltzailea->getEgoera() == 'aktibatua') {
            $this->_redirect('sartu');
        }

        $orain = Zend_Date::now();
        $iraungiData = $erabiltzailea->getHashIraungiData(true);

        $erabiltzailea->setEgoera('aktibatua');
        $erabiltzailea->setAltaData(
            $orain->toString('yyy-MM-dd')
        );
        $erabiltzailea->setHashIraungiData(
            $orain->subHour(2)->toString('yyy-MM-dd H:m:s')
        );

        $erabiltzailea->save();

        $this->_helper->flashMessenger(
            array(
                'success' => 'Zure posta helbidea baieztatu dugu iada.'
            )
        );

        /**
         * Erabiltzaileari login egin hurrengo pantailetarako
         */
        $session->erabiltzailea = $erabiltzailea;
        $authStorage = $this->_auth->getStorage()->write($erabiltzailea);
        $this->_redirect(
            '/erabiltzaileak/ikusi/erabiltzailea/' . $erabiltzailea->getUrl() . '/izena-eman/true'
        );

    }

    /**
     * Crea la relación Erabiltzailea <-> Ikastegia
     */
    protected function _addErabiltzaileaRelIkastegia($erabiltzailea, $ikastegiakId)
    {

        $newRelIkastegia = new Models\ErabiltzaileaRelIkastegia();
        $newRelIkastegia->setErabiltzaileaId($erabiltzailea->getId());
        $newRelIkastegia->setIkastegiaId($ikastegiakId);
        $newRelIkastegia->setEgoera('onartzeko');
        $newRelIkastegia->save();

    }

    /**
     * Crea la relación Erabiltzailea <-> Irakaslea -- Ikastegia
     */
    protected function _addErabiltzaileaRelIrakaslea($erabiltzailea, $irakasleaId, $ikastegiaId)
    {

        $newRelIrakaslea = new Models\ErabiltzaileaRelIrakaslea();
        $newRelIrakaslea->setErabiltzaileaId($erabiltzailea->getId());
        $newRelIrakaslea->setIrakasleaId($irakasleaId);
        $newRelIrakaslea->setEgoera('onartzeko');
        $newRelIrakaslea->setIkastegiaId($ikastegiaId);
        $newRelIrakaslea->save();

    }

    /**
     * Comprueba que el nombre de usaurio, no este en uso por otro Erabiltzailea.
     */
    public function erabiltzaileIzenaExistAction()
    {

        $error = array('status' => false);

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            if (isset($postData['userName'])) {
                $userName = $postData['userName'];

                if (strlen($userName) >= 5) {


                    $erabiltzailea = $this->_erabiltzaileaMapper->findByField(
                        'erabiltzaileIzena',
                        $userName
                    );

                    if (!empty($erabiltzailea)) {
                        $this->_helper->json(
                            array(
                                'status' => true,
                                'message' => $this->view->translate('[es] ya existe el nombre de usuario.')
                            )
                        );
                        die();
                    }
                }
            }
        }

        $this->_helper->json($error);

    }

    /**
     * Kill
     */
    public function datuakAldatuAction()
    {

        $this->view->title =  'Datuak Aldatu';

        $session = new Zend_Session_Namespace($this->_sessionNameSpace);
        $erabiltzailea = $session->erabiltzailea;

        if (!$erabiltzailea) {
            $this->_redirect('sartu');
        } else {
            $erabiltzailea = $this->_erabiltzaileaMapper->find(
                $erabiltzailea->getId()
            );
        }

        if (!$erabiltzailea) {
            throw new Zend_Exception(
                'Saioa hasi behar duzu profileko datuak aldatu ahal izateko.'
            );
        }

        if ($erabiltzailea->getEgoera() == 'aktibatua') {
            $this->_redirect('/sartu/');
        }

        if ($erabiltzailea->getEgoera() == 'datuakSartuta') {
            $this->_redirect('/izena-eman/nire-ikastegia');
        }

        $form = new Klikasi_Form_IzenaEmanBi($erabiltzailea);

        if ($this->getRequest()->isPost()) {

            $datuak = $this->getRequest()->getPost();

            if ($form->isValid($datuak)) {

                $avatar = $this->_proccessAvatarFromPost(
                    $datuak
                );

                $erabiltzailea->setAvatar(
                    $avatar
                );

                $erabiltzailea = $erabiltzailea->addProfileData(
                    $datuak
                );

                $url = $this->view->url(
                    array(
                        'controller' => 'izena-eman',
                        'action' => 'alta',
                        'nor' => $erabiltzailea->getErabiltzaileIzena(),
                        'kodea' => $erabiltzailea->getHash()
                    )
                );

                $data = array(
                    'altaUrl' => $this->view->serverUrl(
                        $url
                    )
                );

                $erabiltzailea->setEgoera('datuakSartuta');
                $erabiltzailea->save();

                $notifikazioa = new Klikasi\Custom\Notifikazioa(
                    'alta',
                    $erabiltzailea,
                    $data
                );
                $notifikazioa->notifikazioaBidali('Alta berria');

                $this->_helper->flashMessenger(
                    array(
                        'success' => 'Posta bidalia'
                    )
                );

                $this->_redirect('izena-eman/nire-ikastegia/');

            } else {
                $form->postPopulate($datuak);
                $this->_sendFormErrorsToView($form);
                $this->view->izenaEman = $form;
            }

        } else {

            $this->view->izenaEman = $form->firstPopulate();

        }

    }

    protected function _proccessAvatarFromPost($datuak)
    {

        try {

            if ($datuak['irudiaSelector'] === 'avatar') {

                $avatar = $this->_avatarMapper->find($datuak['avatarId']);

                if (!$avatar) {
                    throw new Exception(
                        'Arazoren bat egon da irudia prosezatzerakoan'
                    );
                }

                return $avatar;

            } elseif ($datuak['irudiaSelector'] === 'image') {

                $session = new Zend_Session_Namespace($this->_sessionNameSpace);
                $erabiltzailea = $session->erabiltzailea;

                $irudia = $erabiltzailea->getIrudia();

                if (
                    !$irudia
                ||
                    ($irudia && $datuak['imagePath'] != $irudia->getIden())
                ) {

                    /**
                     * Irudia editatu eta gorde
                     */
                    $imagick = new \Klikasi\Custom\Imagick();
                    $tempPath = $imagick->saveThumbImg(
                        $datuak,
                        $erabiltzailea->getErabiltzaileIzena()
                    );

                    /**
                     * Sortutako irudia gorde
                     */
                    $erabiltzaileIrudia = new ErabiltzaileenIrudiakModel();
                    $erabiltzaileIrudia->putIrudia($tempPath);
                    $erabiltzaileIrudia->save();

                    /**
                     * /tmp karpetan sortutako irudi denak ezabatu
                     */
                    $erabiltzaileIzena = $erabiltzailea->getErabiltzaileIzena();
                    array_map(
                        'unlink',
                        glob(
                            '/tmp/' . $erabiltzaileIzena . '_*'
                        )
                    );

                    return $erabiltzaileIrudia;

                }

                return $irudia;

            }

        } catch (Exception $e) {

            throw new Zend_Exception($e->getMessage());

        }
    }

}