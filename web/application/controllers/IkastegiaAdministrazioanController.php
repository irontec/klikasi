<?php

use Klikasi\Model as Models;
use Klikasi\Mapper\Sql as Mappers;

class IkastegiaAdministrazioanController extends Zend_Controller_Action
{

    protected $_currentUser;
    protected $_ikastegia;

    public function init()
    {

        $this->view->title = 'Administrazioan';
        $this->_helper->layout->setLayout('ikastegiak-ikusi');

        $this->view->appendJs =  array(
            '/js/klikasi.ikastegi-administrazioan.js',
            '/bower_components/jquery-cropbox/jquery.cropbox.js'
        );

        $this->_helper->AddLibraries(
            array(),
            array(
                '/bower_components/jquery-cropbox/jquery.cropbox.css',
                '/css/ikastegia.css'
            )
        );

        $ikastegia = $this->_startCurrentIkastegia();

        $this->view->ikastegia = $ikastegia;
        $this->_ikastegia = $ikastegia;

    }

    public function indexAction()
    {
        $ikastegiMota = new Mappers\IkastegiMota();
        $this->view->ikastegiMota = $ikastegiMota->fetchList('`default` != 1', 'izena');

        $currentIkastegiMota = $this->_ikastegia->getIkastegiaRelMota();
        $currentIkastegiMota = current($currentIkastegiMota);

        $this->view->currentIkastegiMota = null;
        if ($currentIkastegiMota) {
            $this->view->currentIkastegiMota = $currentIkastegiMota->getIkastegiMotaId();
        }
    }

    public function datuakAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            if ($postData['ikastegiaId'] == $this->_ikastegia->getId()) {
                try {

                    $ikastegia = new Mappers\Ikastegia();
                    $ikastegia = $ikastegia->find(
                        $postData['ikastegiaId']
                    );

                    $errors = array();

                    $checkIzena = $ikastegia->isValidIzena(
                        $postData['izena']
                    );
                    if ($checkIzena !== true) {
                        $errors['izena'] = $checkIzena;
                    }

                    $checkDeskribapenLaburra = $ikastegia->isValidDeskribapenLaburra(
                        $postData['deskribapenLaburra']
                    );
                    if ($checkDeskribapenLaburra !== true) {
                        $errors['deskribapenLaburra'] = $checkDeskribapenLaburra;
                    }

                    $checkkDeskribapena = $ikastegia->isValidDeskribapena(
                        $postData['deskribapena']
                    );
                    if ($checkkDeskribapena !== true) {
                        $errors['deskribapena'] = $checkkDeskribapena;
                    }

                    if (!empty($postData['tmpName'])) {

                        $imagick = new \Klikasi\Custom\Imagick();
                        $tempPath = $imagick->saveThumbImg(
                            $postData,
                            $this->_currentUser->getErabiltzaileIzena()
                        );

                        /**
                         * Sortutako irudia gorde
                         */
                        $ikastegia->putIrudia($tempPath);
                    }

                    if (empty($errors)) {

                        $ikastegia->setIzena($postData['izena']);
                        $ikastegia->setDeskribapenLaburra($postData['deskribapenLaburra']);
                        $ikastegia->setDeskribapena($postData['deskribapena']);
                        $ikastegia->setMota($postData['mota']);

                        $currentIkastegiMota = $ikastegia->getIkastegiaRelMota();
                        $currentIkastegiMota = current($currentIkastegiMota);

                        $ikastegiMota = $this->_request->getParam("ikastegimota");
                        if ($postData['mota'] == "bestelakoa" && is_numeric($ikastegiMota)) {

                            if (!$currentIkastegiMota) {
                                $currentIkastegiMota = new Models\IkastegiaRelMota;
                                $currentIkastegiMota->setIkastegiaId($ikastegia->getId());
                            }

                            $currentIkastegiMota->setIkastegiMotaId($ikastegiMota);
                            $currentIkastegiMota->save();

                        } else if ($currentIkastegiMota) {
                            $currentIkastegiMota->delete();
                        }

                        $ikastegia->setSocialNetworks($postData);

                        $ikastegia->setHerria($postData['herria']);
                        $ikastegia->setProbintzia($postData['probintzia']);
                        $ikastegia->setKokapena($postData['kokapena']);
                        $ikastegia->setKokapenaLat($postData['lat']);
                        $ikastegia->setKokapenaLng($postData['lng']);
                        $ikastegia->save();

                        $result = array(
                            'status' => true,
                            'message' => 'Aldaketak gorde dira, hauek ikusteko orria atzera kargatu'
                        );

                    } else {
                        $result = array(
                            'status' => false,
                            'errors' => $errors
                        );
                    }

                } catch (Exception $e) {

                    $result = array(
                        'status' => false,
                        'errors' => $e->getMessage()
                    );
                }
            } else {

                $result = array(
                    'status' => false,
                    'errors' => $this->view->translate('[es] Error en la autenticación.')
                );

            }

            $this->_helper->json($result);

        } else {

            $this->_redirect('ikastegiak');

        }

    }

    /**
     * Desvincula un Edukia de un Ikastegia.
     */
    public function nireEdukiaAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $result = array(
                'status' => false,
                'message' => $this->view->translate('[es] Error al eliminar la relación')
            );

            if (isset($postData['edukiaId'])) {

                $where = array(
                    'edukiaId' => $postData['edukiaId'],
                    'ikastegiaId' => $this->_ikastegia->getId()
                );
                $relEdukiaRelIkastegia = new Mappers\EdukiaRelIkastegia();
                $relEdukiaRelIkastegia = $relEdukiaRelIkastegia->fetchOne($where);

                if (!empty($relEdukiaRelIkastegia)) {

                    $relEdukiaRelIkastegia->delete();

                    $result = array(
                        'status' => true,
                        'message' => $this->view->translate('[es] Edukiak desvinculado.')
                    );
                }
            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('ikastegiak');
        }

    }

    /**
     * Acepta un Edukia en un Ikastegia
     */
    public function acceptEdukiaAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $result = array(
                'status' => false,
                'message' => $this->view->translate('[es] Error al aceptar el recurso.')
            );

            if (isset($postData['edukiaId'])) {

                $where = array(
                    'edukiaId = ?' => $postData['edukiaId'],
                    'ikastegiaId = ?' => $this->_ikastegia->getId()
                );
                $relEdukiaRelIkastegia = new Mappers\EdukiaRelIkastegia();
                $relEdukiaRelIkastegia = $relEdukiaRelIkastegia->fetchOne($where);

                if (!empty($relEdukiaRelIkastegia)) {

                    $relEdukiaRelIkastegia->setEgoera('onartua');
                    $relEdukiaRelIkastegia->save();

                    $result = array(
                        'status' => true,
                        'message' => $this->view->translate('[es] Edukiak Aceptado.')
                    );
                }

            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('ikastegiak');
        }

    }

    public function moderateIrakasleaAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $result = array(
                'status' => false,
                'message' => $this->view->translate('[es] Error en la moderación.')
            );

            $relation = new Mappers\ErabiltzaileaRelIkastegia();
            $relation = $relation->find($postData['relIrakaslea']);

            if (!empty($relation)) {

                if ($postData['moderation'] == 'acceptIrakaslea') {
                    $relation->setEgoera('onartua');
                } elseif ($postData['moderation'] == 'rejectIrakaslea') {
                    $relation->setEgoera('ezOnartua');
                }
                $relation->save();

                $result = array(
                    'status' => true,
                    'message' => $this->view->translate('[es] Irakasle moderado correctamente.')
                );

            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('ikastegiak');
        }

    }

    public function moderateIkasleaAction()
    {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();

            $result = array(
                'status' => false,
                'message' => $this->view->translate('[es] Error en la moderación.')
            );

            $relation = new Mappers\ErabiltzaileaRelIkastegia();
            $relation = $relation->find($postData['relIkaslea']);

            if (!empty($relation)) {

                if ($postData['moderation'] == 'acceptIkaslea') {
                    $relation->setEgoera('onartua');
                } elseif ($postData['moderation'] == 'rejectIkaslea') {
                    $relation->setEgoera('ezOnartua');
                }
                $relation->save();

                $result = array(
                    'status' => true,
                    'message' => $this->view->translate('[es] Ikasle moderado correctamente.')
                );

            }

            $this->_helper->json($result);

        } else {
            $this->_redirect('ikastegiak');
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

    protected function _startCurrentIkastegia()
    {

        $currentUser = $this->_helper->SessionUser();
        $this->_currentUser = $currentUser;

        if ($currentUser !== false) {

            $ikastegiaUrl = $this->getRequest()->getParam('ikastegia', false);

            if ($ikastegiaUrl !== false) {

                $ikastegia = new Mappers\Ikastegia();
                $ikastegia = $ikastegia->findOneByField(
                    'url',
                    $ikastegiaUrl
                );

                if (!empty($ikastegia)) {

                    $isAdmin = $currentUser->getSuperErabiltzailea();
                    if ($isAdmin === 1) {
                        return $ikastegia;
                    }

                    $where = array();
                    $where[] = 'erabiltzaileaId = "' .  $currentUser->getId() . '"';
                    $where[] = '(jabea = 1 OR administratzailea = 1)';
                    $relErabiltzailea = $ikastegia->getErabiltzaileaRelIkastegia(
                        implode(' AND ', $where)
                    );

                    if (!empty($relErabiltzailea)) {
                        return $ikastegia;
                    }

                }
            }
        }

        $this->_redirect('ikastegiak');

    }

}