<?php
use Klikasi\Model\Jakinarazpenak;
use Klikasi\Model\ErabiltzaileaRelIkastegia as RelIkastegiaModel;
use Klikasi\Model\ErabiltzaileaRelIrakaslea as RelIrakasleaModel;
use Klikasi\Model\ErabiltzaileenIrudiak as ErabiltzaileenIrudiakModel;

use Klikasi\Mapper\Sql\Ikastegia as IkastegiaMapper;
use Klikasi\Mapper\Sql\Erabiltzailea as ErabiltzaileaMapper;
use Klikasi\Mapper\Sql\Jakinarazpenak as JakinarazpenakMapper;
use Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia as RelIkastegiaMapper;
use Klikasi\Mapper\Sql\ErabiltzaileaRelIrakaslea as RelIrakasleaMapper;
use Klikasi\Mapper\Sql\ErabiltzaileaSettings as ErabiltzaileaSettingsMapper;
use Klikasi\Mapper\Sql\ErabiltzaileenIrudiak as ErabiltzaileenIrudiakMapper;

class ErabiltzaileakController extends Zend_Controller_Action
{
    protected $_auth = NULL;
    protected $_erabiltzaileak = NULL;

    protected $_avatarMapper = NULL;
    protected $_ikastegiaMapper = NULL;
    protected $_relIkastegiaMapper = NULL;
    protected $_erabiltzaileaMapper = NULL;
    protected $_jakinarazpenakMapper = NULL;
    protected $_erabiltzaileaSettingsMapper = NULL;

    public function init()
    {
        $this->_helper->layout->setLayout('container-principal-title');
        $this->_auth = Zend_Auth::getInstance();

        $this->view->appendJs = array(
            '/js/klikasi.erabiltzaileak.js',
            '/bower_components/jquery-cropbox/jquery.cropbox.js',
            '/js/klikasi.izena-eman.js'
        );

        $this->view->headLink()
            ->appendStylesheet($this->view->baseUrl('/bower_components/jquery-cropbox/jquery.cropbox.css'))
            ->appendStylesheet($this->view->baseUrl('/css/egileak.css'));

        $this->view->flashmezuak = $this->_helper->FlashMessenger->getMessages();
        $this->_erabiltzaileak = $this->_helper->SessionUser();

        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;

        $this->_helper->ironContextSwitch()
            ->addActionContext('sartu-dialog', 'json')
            ->initContext();

        $this->_initMappers();
    }

    /**
     * Initialize Mappers required
     */
    protected function _initMappers()
    {
        $this->_ikastegiaMapper = new IkastegiaMapper();
        $this->_relIkastegiaMapper = new RelIkastegiaMapper();
        $this->_erabiltzaileaMapper = new ErabiltzaileaMapper();
        $this->_avatarMapper = new ErabiltzaileenIrudiakMapper();
        $this->_jakinarazpenakMapper = new JakinarazpenakMapper();
        $this->_erabiltzaileaSettingsMapper = new ErabiltzaileaSettingsMapper();
    }

    public function indexAction()
    {
        $where = array(
            'egoera = ?' => 'aktibatua'
        );

        $order = array(
            'izena',
            'abizena',
            'abizena2'
        );

        $erabiltzaileak = $this->_erabiltzaileaMapper->fetchList(
            $where,
            $order
        );

        $this->view->title = 'Erabiltzaileak';
        $this->view->erabiltzaileak = $erabiltzaileak;
    }

    public function ikusiAction()
    {
        $erabiltzailea = $this->_fetchUser();
        $currentUser = $this->_helper->SessionUser();
        $this->view->currentUser = $currentUser;

        if ($currentUser) {
            $isIzenaEman = $this->getRequest()->getParam(
                'izena-eman',
                false
            );
        } else {
            $isIzenaEman = false;
        }

        $this->view->isIzenaEman = $isIzenaEman;

        if ($currentUser) {
            if ($currentUser->getUrl() === $erabiltzailea->getUrl()) {
                $this->view->isProfileJabea = true;
            }
        }

        $this->view->title = 'Egileak';
        $this->view->erabiltzailea = $erabiltzailea;

        //Edukiak
        $nireEdukiak = array();
        $nireEdukiakList = $erabiltzailea->nireEdukiak($this->view->isProfileJabea);

        if (sizeof($nireEdukiakList) > 0) {
            foreach ($nireEdukiakList as $nireEdukia) {
                $nireEdukiak[] = $this->_templates->
                    loadTemplate('edukiakList')->
                    render($nireEdukia->toTemplateListArray());
            }
        }

        //Trophy
        $this->view->trophy = $erabiltzailea->getLastTrophy();

        //Gustokoak
        $nireGustokoak = array();
        $nireGustokoakList = $erabiltzailea->nireGustokoak();
        if (sizeof($nireGustokoakList) > 0) {
            foreach ($nireGustokoakList as $nireGustokoa) {
                $nireGustokoak[] = $this->_templates->
                    loadTemplate('edukiakList')->
                    render($nireGustokoa->toTemplateListArray());
            }
        }

        //Kolaboratzaileak
        $kolaboratzaileak = array();
        $kolaboratzaileakList = $erabiltzailea->kolaboratzailea();
        if (sizeof($kolaboratzaileakList) > 0) {
            foreach ($kolaboratzaileakList as $kolaboratzailea)
                $kolaboratzaileak[] = $this->_templates->
                    loadTemplate('edukiakList')->
                    render($kolaboratzailea->toTemplateListArray());{
            }
        }

        $this->view->nireEdukiak = $nireEdukiak;
        $this->view->gustokoak = $nireGustokoak;
        $this->view->kolaboratzaileak = $kolaboratzaileak;
        $this->view->nireIruzkinak = $erabiltzailea->nireIruzkinak();
    }

    /**
     * Form personal data
     */
    public function datuakAldatuAction()
    {

        $currentUser = $this->_helper->SessionUser();

        if (!$currentUser) {
            $this->_redirect('sartu');
        }

        $this->view->isProfileJabea = true;
        $this->view->erabiltzailea = $currentUser;

        $this->view->headLink()->appendStylesheet(
            '/klikasi/css/jcrop.css'
        );

        $form = new Klikasi_Form_ProfilaAldatu(
            $currentUser
        );

        if ($this->getRequest()->isPost()) {

            $datuak = $this->getRequest()->getPost();

            if ($form->isValid($datuak)) {

                $pasahitzaOndo = false;
                if ($datuak['pasahitza'] === $datuak['pasahitzaBaieztatu']) {
                    $pasahitzaOndo = true;
                }

                if ($pasahitzaOndo) {

                    $avatar = $this->_proccessAvatarFromPost(
                        $datuak
                    );

                    $currentUser->setAvatar(
                        $avatar
                    );

                    $currentUser = $currentUser->addProfileData(
                        $datuak
                    );

                    $this->_helper->flashMessenger(
                        array(
                            'success' => 'Profileko aldaketak gorde dira.'
                        )
                    );

                    $this->_redirectProfile($currentUser);

                } else {

                    $form->postPopulate(
                        $datuak
                    );

                    $this->_sendFormErrorsToView(
                        $form,
                        array(
                            'Pasahitzak berdinak izan behar dute.'
                        )
                    );

                    $this->view->profila = $form;

                }

            } else {

                $form->postPopulate(
                    $datuak
                );

                $this->_sendFormErrorsToView(
                    $form
                );

                $this->view->profila = $form;

            }

        } else {

            $this->view->profila = $form->firstPopulate();

        }

    }

    /**
     * Check exist profile and return UserModel
     * @throws Zend_Exception
     */
    protected function _fetchUser()
    {

        $url = $this->getRequest()->getParam(
            'erabiltzailea',
            false
        );

        if ($url) {
            $erabiltzailea = $this->_erabiltzaileaMapper->findOneByField(
                'url',
                $url
            );
        }

        if (!$url || !isset($erabiltzailea)) {
            throw new Zend_Exception('Erabiltzailea ez da existitzen');
        }

        return $erabiltzailea;

    }

    /**
     * Redirect to profile current user.
     */
    protected function _redirectProfile($currentUser)
    {
        $this->_redirect(
            $currentUser->urlProfile(),
            array(
                'prependBase' => false
            )
        );
    }

    /**
     * add petition to school
     */
    protected function _addIkastegia($ikastegiaId, $currentUser)
    {
        $newRelIkastegia = new RelIkastegiaModel();
        $newRelIkastegia->setErabiltzaileaId($currentUser->getId());
        $newRelIkastegia->setIkastegiaId($ikastegiaId);
        $newRelIkastegia->setEgoera('onartzeko');
        $newRelIkastegia->save();

        $this->_helper->flashMessenger(
            array(
                'success' => 'Eskaera bidalia'
            )
        );

        $this->_redirect('erabiltzaileak/nire-ikastegiak/');
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

                $erabiltzailea = $this->_auth->getIdentity();

                $irudia = $erabiltzailea->getIrudia();

                if (
                    !$irudia
                ||
                    ($irudia && $datuak['imagePath'] != $irudia->getIden())
                ) {

                    // Irudia editatu eta gorde
                    $imagick = new Klikasi\Custom\Imagick();
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