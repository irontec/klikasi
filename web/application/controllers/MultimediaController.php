<?php

use Klikasi\Mapper\Sql\ErabiltzaileenIrudiak as ErabiltzaileenIrudiakMapper;
use Klikasi\Mapper\Sql\Erabiltzailea as ErabiltzaileaMapper;
use Klikasi\Mapper\Sql\HomePage as HomePageMapper;

class MultimediaController extends Zend_Controller_Action
{
    protected $_erabiltzaileIrudiMapper = null;
    protected $_erabiltzaileaMapper;
    protected $_sessionNameSpace = 'KlikasiNewUserSession';
    protected $_homePageMapper;

    protected $_slideshareApiKey;
    protected $_slideshareSecret;

    public function init()
    {
        $this->_slideshareApiKey = '26XJg3ZX';
        $this->_slideshareSecret = 'SsTRxxUb';

        $this->_helper->ironContextSwitch()
            ->addActionContext('erabiltzaile-irudien-zerrenda', 'json')
            ->addActionContext('irudia-ikusi', 'json')
            ->addActionContext('avatar-berria', 'json')
            ->initContext();

        $this->_erabiltzaileIrudiMapper = new ErabiltzaileenIrudiakMapper();
        $this->_erabiltzaileaMapper = new ErabiltzaileaMapper();

        $this->_homePageMapper = new HomePageMapper();
    }

    public function indexAction()
    {

    }

    protected function _createDirIfItDoesNotExist($basePath)
    {
        if (!file_exists($basePath)) {
            mkdir($basePath, 0755);
        }
    }


    public function slideshareAction()
    {
        $imgPath = null;
        $id = $this->_request->getParam("id");

        $imgPath = $this->_getSlideshareThumb($id);

        if ($imgPath) {
            $this->_helper->sendFileToClient(
                $imgPath,
                array(
                    'filename' => md5($id),
                    'disposition' => 'inline'
                ),
                false
            );
            return;
        }
    }

    protected function _getSlideshareThumb($id)
    {
        $basePath = APPLICATION_PATH . '/../storage/slideshare/';
        $this->_createDirIfItDoesNotExist($basePath);
        $md5 = md5($id);

        if (file_exists($basePath . $md5)) {
            return $basePath . $md5;
        }

        $apikey = $this->_slideshareApiKey;
        $ts = time();
        $hash = sha1($this->_slideshareSecret . $ts);

        $requestUrl = "https://www.slideshare.net/api/2/get_slideshow";
        $requestUrl .= "?api_key={$apikey}";
        $requestUrl .= "&ts={$ts}";
        $requestUrl .= "&hash={$hash}";
        $requestUrl .= "&slideshow_id={$id}";

        $responseXml = file_get_contents($requestUrl);
        if (false === $responseXml) {
            return null;
        }

        $xml = simplexml_load_string($responseXml);
        $json = json_encode($xml);
        $responseObj = json_decode($json);

        if ($responseObj->Status != 2) {
            return null;
        }

        $imgPath = $responseObj->ThumbnailURL;
        if (substr($imgPath, 0, 2) == "//") {
            $imgPath = "http://" . substr($imgPath, 2);
        }

        $fallBackImgUrl = $imgPath;
        $imgPath = str_replace("thumbnail.jpg", "thumbnail-3.jpg", $imgPath);

        $imgBinary = file_get_contents($imgPath);
        if (false === $imgBinary) {
            $imgBinary = file_get_contents($fallBackImgUrl);
        }

        if (false === $imgBinary) {
            return null;
        }

        $imgPath =  $basePath . $md5;
        file_put_contents($imgPath, $imgBinary);

        return $imgPath;
    }

    public function pinterestAction()
    {
        $imgBinary = null;
        $imgPath = null;

        $id = $this->_request->getParam("id");
        $album = $this->_request->getParam("album");

        if ($album) {
            $imgPath = $this->_getPinAlbum($id, $album);
        } else if (is_numeric($id)) {
            $imgPath = $this->_getPin($id);
        } else if ($id) {
            $imgPath = $this->_getPinUser($id);
        }

        if ($imgPath) {
            $this->_helper->sendFileToClient(
                $imgPath,
                array(
                    'filename' => md5($id),
                    'disposition' => 'inline'
                ),
                false
            );
            return;
        }
    }

    protected function _getPinAlbum($id, $album)
    {
        $route = "http://api.pinterest.com/v3/pidgets/boards/" . $id ."/". $album . "/pins/";
        return $this->_getPinUser($id ."/". $album, $route);
    }

    protected function _getPinUser($id, $apiRoute = null)
    {
        $basePath = APPLICATION_PATH . '/../storage/pinterest/';
        $this->_createDirIfItDoesNotExist($basePath);
        $md5 = md5($id);
        if (file_exists($basePath . $md5)) {
            return $basePath . $md5;
        }

        $route = $apiRoute ? $apiRoute : "http://api.pinterest.com/v3/pidgets/users/" . $id . "/pins/";
        $json = file_get_contents($route);

        if ($json != '') {

            $response = json_decode($json);
            $images = $response->data->pins[0]->images;

            foreach ($images as $key => $values) {
                $imgSrc = $values->url;
                break;
            }

            if ($imgSrc) {

                $imgBinary = file_get_contents($imgSrc);
                $imgPath =  $basePath . md5($id);
                file_put_contents($imgPath, $imgBinary);
                return $imgPath;
            }
        }

        return null;
    }

    protected function _getPin($id)
    {
        $basePath = APPLICATION_PATH . '/../storage/pinterest/';
        $this->_createDirIfItDoesNotExist($basePath);

        $md5 = md5($id);
        if (file_exists($basePath . $md5)) {
            return $basePath . $md5;
        }

        $json = file_get_contents("http://api.pinterest.com/v3/pidgets/pins/info/?pin_ids=" . $id);
        if ($json != '') {

            $response = json_decode($json);
            $images = $response->data[0]->images;

            foreach ($images as $key => $values) {
                $imgSrc = $values->url;
                break;
            }

            if ($imgSrc) {

                $mustResize = false;
                $bigImgSrc = str_replace("/237x/", "/736x/", $imgSrc);
                $imgBinary = file_get_contents($bigImgSrc);

                if (false === $imgBinary) {
                    $imgBinary = file_get_contents($imgSrc);
                } else{
                    $mustResize = true;
                }

                $imgPath =  $basePath . md5($id);
                file_put_contents($imgPath, $imgBinary);

                if ($mustResize) {

                    $ironImage = new \Iron_Images($imgPath);

                    $sizeMultiplier = 0.6;
                    $newImageWidth = $ironImage->getWidth() * $sizeMultiplier;
                    $newImageHeight = $ironImage->getHeight() * $sizeMultiplier;

                    $ironImage->resize($newImageWidth, $newImageHeight);
                    $ironImage->saveImage($imgPath);
                }

                return $imgPath;
            }
        }

        return null;
    }

    public function erabiltzaileIrudienZerrendaAction()
    {
        $list = $this->_erabiltzaileIrudiMapper->fetchList('partekatua = "1"');

        $object = array();
        foreach ($list as $item) {
            $object[] = $item->toArray();
        }

        $this->view->images = $object;
        $this->view->baseUrl = $this->view->serverUrl(
            $this->view->baseUrl('/multimedia/irudia-ikusi/iden/')
        );
    }

    public function erabiltzaileIrudiaAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $iden = $this->getRequest()->getUserParam('irudia', false);

        $irudia = $this->_erabiltzaileIrudiMapper->findOneByField(
            'iden',
            $iden
        );

        if (!$irudia) {
            throw new Zend_Exception("Irudia ez da existitzen.");
        }

        $datuak['filename'] = $irudia->fetchIrudia()->getBaseName();
        $datuak['disposition'] = 'inline';

        $this->_helper->sendFileToClient(
            $irudia->fetchIrudia()->getFilePath(),
            $datuak
        );
    }

    public function erabiltzaileIrudiaViewAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $iden = $this->getRequest()->getUserParam('irudia', false);

        $erabiltzailea = $this->_erabiltzaileaMapper->find($iden);
        if (!$erabiltzailea) {
            throw new Zend_Exception("Erabiltzailea ez da existitzen.");
        }

        $irudia = $this->_erabiltzaileIrudiMapper->find(
            $erabiltzailea->getIrudiaId()
        );

        if (!$irudia) {
            throw new Zend_Exception("Irudia ez da existitzen.");
        }

        $datuak['filename'] = $irudia->fetchIrudia()->getBaseName();
        $datuak['disposition'] = 'inline';

        $this->_helper->sendFileToClient(
            $irudia->fetchIrudia()->getFilePath(),
            $datuak
        );
    }

    public function homePageAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $iden = $this->getRequest()->getUserParam('irudia', false);

        $irudia = $this->_homePageMapper->findOneByField(
            'id',
            $iden
        );

        if (!$irudia) {
            throw new Zend_Exception("Irudia ez da existitzen.");
        }

        $datuak['filename'] = $irudia->fetchIrudia()->getBaseName();
        $datuak['disposition'] = 'inline';

        $this->_helper->sendFileToClient(
            $irudia->fetchIrudia()->getFilePath(),
            $datuak
        );
    }

    public function irudiaIkusiAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();
        $iden = $this->getRequest()->getUserParam('iden', false);

        $irudia = $this->_erabiltzaileIrudiMapper->find($iden);

        if (!$irudia) {
            throw new Zend_Exception("Irudia ez da existitzen.");
        }

        $datuak['filename'] = $irudia->fetchIrudia()->getBaseName();
        $datuak['disposition'] = 'inline';

        $this->_helper->sendFileToClient(
            $irudia->fetchIrudia()->getFilePath(),
            $datuak
        );
    }

    public function avatarBerriaAction()
    {
        try {

            $auth = Zend_Auth::getInstance();

            if ($auth->hasIdentity()) {

                $erabiltzailea = $auth->getIdentity();

            } else {

                $session = new Zend_Session_Namespace($this->_sessionNameSpace);
                $erabiltzailea = $session->erabiltzailea;

            }

            $tempSrc = tempnam(
                sys_get_temp_dir(),
                $erabiltzailea->getErabiltzaileIzena() . '_'
            );

            move_uploaded_file($_FILES['irudia']['tmp_name'], $tempSrc);

            $this->view->irudiaUrl = $tempSrc;
            $this->view->success = true;

        } catch (Exception $e) {

            $this->view->success = false;
            $this->view->errorMessage = $e->getMessages();

        }
    }

    public function avatarPreviewAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();

        $pathTmp = $this->getRequest()->getParam('tmp');

        $filePath = sys_get_temp_dir() . '/' . $pathTmp;

        $datuak['filename'] = $pathTmp;
        $datuak['disposition'] = 'inline';

        $this->_helper->sendFileToClient(
            file_get_contents($filePath),
            $datuak,
            true
        );
    }
}