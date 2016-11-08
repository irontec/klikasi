<?php

use Klikasi\Model as Model;
use Klikasi\Mapper\Sql as Mapper;

use Klikasi\Model\Ikastegia as IkastegiaModel;

use Klikasi\Mapper\Sql\IkastegiMota as IkastegiMotaMapper;

class IkastegiaBerriaController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->title = 'Ikastegia Berria';
        $this->_helper->layout->setLayout('container-principal-title');
        $this->view->flashmezuak = $this->_helper->FlashMessenger->getMessages();

        $this->view->appendJs =  array(
            '/js/klikasi.ikastegia-berria.js',
            '/bower_components/jquery-cropbox/jquery.cropbox.js'
        );

        $this->_helper->AddLibraries(
            array(),
            array(
                '/bower_components/jquery-cropbox/jquery.cropbox.css',
                '/css/ikastegia.css'
            )
        );
    }

    public function indexAction()
    {
        $erabiltzailea = $this->_helper->SessionUser();

        $ikastegiMota = new IkastegiMotaMapper();
        $this->view->ikastegiMota = $ikastegiMota->fetchList('`default` != 1', 'izena');

        if (!$erabiltzailea) {
            throw new Zend_Exception(
                'Ez daukazu ekintza hau egiteko baimenik.'
            );
        }

        $newIkastegia = new IkastegiaModel();

        if ($this->getRequest()->isXmlHttpRequest()) {

            $postData = $this->getRequest()->getPost();
            $result = $newIkastegia->checkPostIsValid($postData);

            if ($result['status'] === false) {

                $this->_helper->json(
                    array(
                        'status' => $result['status'],
                        'errors' => $result['errors']
                    )
                );
                die();

            } else {

                try {
                    $newIkastegia->saveSuggestion($postData);
                    if (!empty($postData['tmpName'])) {

                        $imagick = new \Klikasi\Custom\Imagick();
                        $tempPath = $imagick->saveThumbImg(
                            $postData,
                            $erabiltzailea->getErabiltzaileIzena()
                        );

                        /**
                         * Sortutako irudia gorde
                         */
                        $newIkastegia->putIrudia($tempPath);
                    }

                    if (!empty($postData['ikastegimota'])) {

                        $ikastegiaRelMota = new Model\IkastegiaRelMota;
                        $ikastegiaRelMota->setIkastegiMotaId($postData['ikastegimota']);

                        $newIkastegia->addIkastegiaRelMota($ikastegiaRelMota);
                    }

                    $erlazioBerria = new Model\ErabiltzaileaRelIkastegia();
                    $erlazioBerria->setErabiltzaileaId($erabiltzailea->getId());


                    $newIkastegia->addErabiltzaileaRelIkastegia($erlazioBerria);
                    if ($erabiltzailea->getSuperErabiltzailea()) {

                        $erlazioBerria->setEgoera('onartua')
                                      ->setJabea(1);
                        $newIkastegia->setAktibatua(1);

                    } else if ($erabiltzailea->getProfila() != "irakasle") {

                        $erlazioBerria->setJabea(1);
                    }

                    $newIkastegia->saveRecursive();

                } catch (\Exception $e) {

                    $this->_helper->json(
                        array(
                            'status' => false,
                            'errors' => array($e->getMessage())
                        )
                    );
                    die();
                }

                // Sortutako irudi denak ezabatu
                array_map(
                    'unlink',
                    glob(
                        '/tmp/' . $erabiltzailea->getErabiltzaileIzena() . '_*'
                    )
                );

                $this->_helper->flashMessenger(
                    array(
                        'success' => $this->view->translate('[es] ikastegia creado.')
                    )
                );

                $this->_helper->json(
                    array(
                        'status' => $result['status'],
                        'url' => $newIkastegia->getUrl()
                    )
                );
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

                $newTmpName = sys_get_temp_dir() . '/' . $this->_helper->SessionUser()->getErabiltzaileIzena();
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
}