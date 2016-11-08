<?php

use Klikasi\Model as Models;
use Klikasi\Mapper\Sql as Mappers;

use Klikasi\Model\Jakinarazpenak;
use Klikasi\Model\ErabiltzaileaRelIkastegia as RelIkastegiaModel;
use Klikasi\Model\ErabiltzaileaRelIrakaslea as RelIrakasleaModel;
use Klikasi\Model\ErabiltzaileenIrudiak as ErabiltzaileenIrudiakModel;

use Klikasi\Mapper\Sql\Ikastegia as IkastegiaMapper;
use Klikasi\Mapper\Sql\Erabiltzailea as ErabiltzaileaMapper;
use Klikasi\Mapper\Sql\Jakinarazpenak as JakinarazpenakMapper;
use Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia as RelIkastegiaMapper;
use Klikasi\Mapper\Sql\ErabiltzaileaSettings as ErabiltzaileaSettingsMapper;
use Klikasi\Mapper\Sql\ErabiltzaileenIrudiak as ErabiltzaileenIrudiakMapper;
use Klikasi\Mapper\Sql\ErabiltzaileaRelIrakaslea as ErabiltzaileaRelIrakasleaMapper;

class EgileakController extends Zend_Controller_Action
{
    /**
     * @var Klikasi\Model\Erabiltzailea SessionUser
     */
    protected $_currentUser = NULL;
    protected $_avatarTmpPath = false;

    protected $_ikastegiaMapper;
    protected $_relIkastegiaMapper;
    protected $_erabiltzaileaMapper;
    protected $_jakinarazpenakMapper;
    protected $_erabiltzaileaSettingsMapper;
    protected $_erabiltzaileaRelIrakasleaMapper;

    public function init()
    {
        $this->_helper->layout->setLayout(
            'container-principal-title'
        );

        $this->_initLibraries();
        $this->_initMappers();

        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;

        $this->_currentUser = $this->_currentUser();

        $this->view->title = 'Profila';
        $this->view->erabiltzailea = $this->_currentUser;
    }

    protected function _initMappers()
    {
        //$this->_avatarMapper = new ErabiltzaileenIrudiakMapper();

        $this->_ikastegiaMapper = new IkastegiaMapper();
        $this->_relIkastegiaMapper = new RelIkastegiaMapper();
        $this->_erabiltzaileaMapper = new ErabiltzaileaMapper();
        $this->_jakinarazpenakMapper = new JakinarazpenakMapper();
        $this->_erabiltzaileaSettingsMapper = new ErabiltzaileaSettingsMapper();
        $this->_erabiltzaileaRelIrakasleaMapper = new ErabiltzaileaRelIrakasleaMapper();
    }

    protected function _initLibraries()
    {

        $this->view->appendJs = array(
            '/js/klikasi.egileak.js',
            '/bower_components/jquery-cropbox/jquery.cropbox.js'
        );

        $this->_helper->AddLibraries(
            array(),
            array(
                '/bower_components/jquery-cropbox/jquery.cropbox.css',
                '/css/egileak.css'
            )
        );
    }

    public function indexAction()
    {
        $currentUserId = $this->_currentUser->getId();

        /**
         * notificaciones
         */

        $this->view->settings = $this->_erabiltzaileaSettingsMapper->findOneByField(
            'erabiltzaileaId',
            $currentUserId
        );

        if (!$this->view->settings) {
            $this->view->settings = new Klikasi\Model\ErabiltzaileaSettings;
        }

        /**
         * nireEdukiak
         */

        $this->view->nireEdukiak = $this->_currentUser->nireEdukiak(true);

        /**
         * nireIkastegiak
         */

        $relIkastegia = $this->_relIkastegiaMapper->findByField(
            'erabiltzaileaId',
            $currentUserId
        );

        $ikastegiaIds = array();
        if (!empty($relIkastegia)) {
            foreach ($relIkastegia as $rel) {
                $ikastegiaIds[] = $rel->getIkastegiaId();
            }
        }

        if (empty($ikastegiaIds)) {
            $whereListIkastegia = array(
                'aktibatua = ?' => 1
            );
        } else {
            $elements = array(
                'aktibatua = 1',
                'id NOT IN (' . implode(',', $ikastegiaIds) . ')'
            );
            $whereListIkastegia = implode(' AND ', $elements);
        }

        $orderListIkastegia = array(
            'mota',
            'izena'
        );

        $listIkastegia = $this->_ikastegiaMapper->fetchList(
            $whereListIkastegia,
            $orderListIkastegia
        );

        $this->view->nireIkastegiak = $relIkastegia;
        $this->view->listIkastegia = $listIkastegia;

        /**
         * nireIrakasleak
         */
        $ikastegiaIds = $this->_currentUser->nireIkastegiakIds();

        if ($this->_currentUser->getProfila() == 'ikasle') {
            if (!empty($ikastegiaIds)) {

                $this->view->populateIrakasleak = true;

                $where = array(
                    'erabiltzaileaId = ?' => $currentUserId
                );

                $nireIrakasleakRelList = $this->_erabiltzaileaRelIrakasleaMapper->fetchList($where);

                $nireIrakasleakList = array();
                $nireIrakasleakIds = array();

                if (sizeof($nireIrakasleakRelList) > 0) {
                    foreach ($nireIrakasleakRelList as $nireIrakasleakRel) {
                        $nireIrakasleakList[]  = $nireIrakasleakRel;
                        $nireIrakasleakIds[] = $nireIrakasleakRel->getIrakasleaId();
                    }
                }

                $this->view->nireIrakasleakList = $nireIrakasleakList;

                /**
                 * Irakasleak de mis Ikastegiak.
                 */
                $where = array();
                $where[] = 'ikastegiaId in (' . implode(',', $ikastegiaIds) . ')';
                $where[] = 'erabiltzaileaId in (select id from Erabiltzailea where profila = "irakasle" and egoera = "aktibatua")';
                $where[] = 'egoera = "onartua"';

                $ikastegiaIrakasleak = new RelIkastegiaMapper();
                $ikastegiaIrakasleakRelList = $ikastegiaIrakasleak->fetchList(
                    implode(' AND ', $where)
                );

                $irakasleakList = array();
                if (sizeof($ikastegiaIrakasleakRelList) > 0) {
                    foreach ($ikastegiaIrakasleakRelList as $ikastegiaIrakasleakRel) {

                        $ikastegia = $ikastegiaIrakasleakRel->getIkastegia();
                        $irakasleId = $ikastegiaIrakasleakRel->getErabiltzailea()->getId();

                        if (array_search($irakasleId, $nireIrakasleakIds) === false) {
                            $irakasleakList[$ikastegia->getIzena()][$ikastegia->getId()] = $ikastegiaIrakasleakRel;
                        }
                    }
                }

                ksort($irakasleakList);

                $this->view->irakasleakList = $irakasleakList;

            } else {

                $this->view->populateIrakasleak = false;

            }
        }

        /**
         * nireIkasleak
         */

        if ($this->_currentUser->getProfila() == 'irakasle') {
            if (!empty($ikastegiaIds)) {

                $this->view->populateIrakasleak = true;

                $where = array(
                    'irakasleaId = ?' => $currentUserId
                );

                $nireIkasleakRelList = $this->_erabiltzaileaRelIrakasleaMapper->fetchList($where);

                $nireIkasleak = array();
                $nireIkasleakList = array();

                if (!empty($nireIkasleakRelList)) {
                    foreach ($nireIkasleakRelList as $nireIkasleakRel) {

                        if (!array_key_exists($nireIkasleakRel->getIkastegiaId(), $nireIkasleakList)) {
                            $nireIkasleakList[$nireIkasleakRel->getIkastegiaId()] = array(
                                'ikastegia' => $nireIkasleakRel->getIkastegia(),
                                'ikasleak' => array()
                            );
                        }

                        $nireIkasleakList[$nireIkasleakRel->getIkastegiaId()]['ikasleak'][] = array(
                            'erabiltzailea' => $nireIkasleakRel->getErabiltzailea(),
                            'egoera' => $nireIkasleakRel->getEgoera(),
                        );


                        $erabiltzailea = $nireIkasleakRel->getErabiltzailea();
                        $erabiltzailea->getErabiltzaileaRelIrakasleaByErabiltzailea();
                        $nireIkasleak[] = $erabiltzailea;
                    }
                }

                $this->view->nireIkasleakList = $nireIkasleakList;
                $this->view->nireIkasleak = $nireIkasleak;

            } else {

                $this->view->populateIrakasleak = false;
            }
        }
    }

    public function uploadCustomAvatarAction()
    {

        if (isset($_FILES['avatar'])) {
            $avatar = $_FILES['avatar'];
            $tmpName = $avatar['tmp_name'];
            $name = $avatar['name'];

            $extension = strtolower(strrchr($name, '.'));

            switch($extension) {
                case '.jpg':
                case '.jpeg':
                case '.gif':
                case '.png':
                    $img = true;
                    break;
                default:
                    $img = false;
                    break;
            }

            if ($img) {

                $newTmpName = sys_get_temp_dir() . '/' . $this->_currentUser->getErabiltzaileIzena();
                move_uploaded_file(
                    $tmpName,
                    $newTmpName
                );

                $tmpName = $newTmpName;

            }

            $this->_helper->json(
                array(
                    'status' => $img,
                    'tmpName' => $tmpName
                )
            );
            die();

        } else {
            $this->_redirect('/');
        }

    }


    public function erabiltzaileaAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $erabiltzailea = $this->_erabiltzaileaMapper->findOneByField(
                'id',
                $this->_currentUser->getId()
            );

            try {

                if ($postData['changeAvatar'] == 'true') {

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

                        }
                    }
                }

                $isValid = $erabiltzailea->datuPertsonalakIsValid($postData);

                if ($isValid['status']) {

                    $erabiltzailea->datuPertsonalak($postData);
                    $erabiltzailea->save();

                    $result = array(
                        'status' => true,
                        'message' => 'Aldaketak gorde dira, hauek ikusteko orria atzera kargatu'
                    );
                } else {
                    $result = $isValid;
                }

            } catch (Exception $e) {

                $result = array(
                    'status' => false,
                    'error' => $e->getMessage()
                );
            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('/');
        }

    }

    public function jakinarazpenakAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();
            $settings = $this->_erabiltzaileaSettingsMapper->findOneByField(
                'erabiltzaileaId',
                $this->_currentUser->getId()
            );

            if (!$settings) {
                $settings = new Models\ErabiltzaileaSettings;
                $settings->setErabiltzaileaId($this->_currentUser->getId());
            }

            try {

                $settings->postEditEgileak($postData);
                $settings->save();

                $result = array(
                    'status' => true,
                    'message' => $this->view->translate('[es] cambios en las notificiones guardados')
                );

            } catch (Exception $e) {

                $result = array(
                    'status' => false,
                    'error' => $e->getMessage()
                );
            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('/');
        }
    }

    public function addRelIkastegiaAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            if (isset($postData['ikastegia'])) {

                try {

                    $relIkastegia = new RelIkastegiaModel();
                    $relIkastegia->setNewPetition(
                        $this->_currentUser->getId(),
                        $postData['ikastegia']
                    );

                    if (empty($this->_currentUser->nireModeratzaileak())) {
                        $relIkastegia->setEgoera("onartua");
                    }
                    
                    $relIkastegia->save();
                    $ikastegia = $this->_ikastegiaMapper->find($postData['ikastegia']);

                    $izena = $ikastegia->getIzena();
                    $url = $ikastegia->ikastegiaUrl();


                    $result = array(
                        'status' => true,
                        'message' => $this->view->translate('[es] Solicitud enviada.'),
                        'name' => $izena,
                        'url' => $url,
                        'ikastegiaId' => $ikastegia->getId()
                    );

                } catch (Exception $e) {
                    $result = array(
                        'status' => false,
                        'error' => $e->getMessage()
                    );
                }

                $this->_helper->json($result);

            }

        } else {
            $this->_redirect('/');
        }

    }

    public function nireIkastegiakAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            if (isset($postData['ikastegia'])) {

                $whereIkastegia = array(
                    'erabiltzaileaId = ?' => $this->_currentUser->getId(),
                    'ikastegiaId = ?' => $postData['ikastegia']
                );

                $ikastegiaRelList = $this->_relIkastegiaMapper->fetchList(
                    $whereIkastegia
                );

                if (!is_null($ikastegiaRelList)) {
                    foreach ($ikastegiaRelList as $ikastegiaRel) {
                        $ikastegiaRel->delete();
                    }
                }

                $whereJakinarazpenak = array(
                    'thatUserId = ?' => $this->_currentUser->getId(),
                    'idKanpotarra = ?' => $postData['ikastegia'],
                    'motaId = ?' => 2
                );

                $jakinarazpenakDelete = $this->_jakinarazpenakMapper->fetchList(
                    $whereJakinarazpenak
                );

                if (!is_null($jakinarazpenakDelete)) {
                    foreach ($jakinarazpenakDelete as $jakinarazpena) {
                        $jakinarazpena->delete();
                    }
                }

                if ($postData['aukerak'] == 'cancelPetition') {
                    $result = array(
                        'status' => true,
                        'message' => $this->view->translate('[es] Solicitud Cancelada.')
                    );
                } elseif ($postData['aukerak'] == 'leaveIkastegia') {
                    $result = array(
                        'status' => true,
                        'message' => $this->view->translate('[es] Relación eliminada.')
                    );
                }

                $this->_helper->json($result);
                die;

            }

        } else {
            $this->_redirect('/');
        }

    }

    public function nireIrakasleakAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            if ($postData['actionForm'] == 'cancel' || $postData['actionForm'] == 'delete') {

                $relIrakasleak = $this->_erabiltzaileaRelIrakasleaMapper->find(
                    $postData['irakasleaRelId']
                );

                $jakinarazpenakMapper = new JakinarazpenakMapper();
                $relData = $relIrakasleak->toArray();
                $where = array(
                    "idKanpotarra = ?" => $relData['id'],
                    "erabiltzaileaId = ?" => $relData['irakasleaId'],
                    "thatUserId = ?" => $relData['erabiltzaileaId'],
                    "motaId = ?" => 17,
                );

                $jakinarazpena = $jakinarazpenakMapper->fetchOne($where);
                if ($jakinarazpena) {
                    $jakinarazpena->delete();
                }

                $relIrakasleak->delete();

                if ($postData['actionForm'] == 'cancel') {
                    $result = array(
                        'status' => true,
                        'message' => $this->view->translate('[es] Solicitud Cancelada.')
                    );
                } elseif ($postData['actionForm'] == 'delete') {
                    $result = array(
                        'status' => true,
                        'message' => $this->view->translate('[es] Relación eliminada.')
                    );
                }

                $this->_helper->json($result);

            } elseif ($postData['actionForm'] == 'addIrakasleak') {

                $values = explode('_', $postData['newRelIrakaslea']);

                $ikastegia = $this->_ikastegiaMapper->findOneByField(
                    'id',
                    $values[1]
                );

                $newRelIrakaslea = new RelIrakasleaModel();
                $newRelIrakaslea = $newRelIrakaslea->createRelIkasleaIrakaslea(
                    $values[0],
                    $ikastegia->getId()
                );

                $result = array(
                    'status' => true,
                    'message' => $this->view->translate('[es] Eskaera bidalia')
                );

                $this->_helper->json($result);

            }

        } else {
            $this->_redirect('/');
        }

    }

    public function nireIkasleakAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $where = array(
                'erabiltzaileaId = ? ' => $postData['erabiltzaileaId'],
                'irakasleaId = ? ' => $this->_currentUser->getId(),
                'ikastegiaId = ? ' => $postData['ikastegiaId']
            );

            $relIkasleak = $this->_erabiltzaileaRelIrakasleaMapper->fetchList($where);
            $relIkasleak = end($relIkasleak);
            $message = '';

            if ($postData['relAction'] == 'accept') {

                $relIkasleak->setEgoera('onartua');
                $message = $this->view->translate('[es] Ikasle aceptado');

            } elseif ($postData['relAction'] == 'reject') {

                $relIkasleak->setEgoera('ezOnartua');
                $message = $this->view->translate('[es] Ikasle rechazado');

            }

            try {

                $relIkasleak->save();

                $result = array(
                    'status' => true,
                    'message' => $message
                );

            } catch (Exception $e) {

                $result = array(
                    'status' => false,
                    'error' => $e->getMessage()
                );
            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('/');
        }

    }

    public function socialNetworksAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $erabiltzailea = $this->_erabiltzaileaMapper->findOneByField(
                'id',
                $this->_currentUser->getId()
            );

            try {

                $erabiltzailea->setSocialNetworks($postData);
                $erabiltzailea->save();

                $result = array(
                    'status' => true,
                    'message' => 'Aldaketak gorde dira, hauek ikusteko orria atzera kargatu'
                );

            } catch (Exception $e) {

                $result = array(
                    'status' => false,
                    'error' => $e->getMessage()
                );
            }

            $this->_helper->json($result);

        }
    }

    public function deleteErabiltzaileaAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $erabiltzaileak = new Mappers\Erabiltzailea();
            $erabiltzailea = $erabiltzaileak->find($this->_currentUser()->getId());

            if (!empty($erabiltzailea)) {

                try {

                    if (!empty($erabiltzailea->getEdukia())) {
                        foreach ($erabiltzailea->getEdukia() as $edukia) {
                            $edukia->delete();
                        }
                    }

                    $erabiltzailea->delete();

                    $this->_auth = Zend_Auth::getInstance();
                    $this->_auth->clearIdentity();
                    Zend_Session::forgetMe();

                    $this->_helper->flashMessenger(
                        array(
                            'warning' => $this->view->translate('[es] Cuenta, eliminada correctamente')
                        )
                    );

                } catch (\Exception $e) {

                    $this->_helper->flashMessenger(
                        array(
                            'warning' => $e->getMessage()
                        )
                    );

                }

            }

            $result = array(
                'status' => true,
            );

            $this->_helper->json($result);

        } else {
            $this->_redirect('edukiak');
        }

    }

    protected function _currentUser()
    {

        $model = $this->_helper->SessionUser();

        if (!$model) {
            $this->_redirect('sartu');
        }

        return $model;

    }

}