<?php

class ImageController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_irudiaMapper = new Klikasi\Mapper\Sql\Irudia();
        $this->_ikastegiaMapper = new Klikasi\Mapper\Sql\Ikastegia();
        $this->_edukia = new Klikasi\Mapper\Sql\Edukia();
        $this->_kategoriaGlobala = new Klikasi\Mapper\Sql\KategoriaGlobala();
        $this->_kanpaina = new Klikasi\Mapper\Sql\Kanpaina();
        $this->_orrialdeaMapper = new Klikasi\Mapper\Sql\Orrialdea();
    }

    public function indexAction()
    {

        $id   = $this->getRequest()->getParam("id", false);
        $size = $this->getRequest()->getParam("size", false);
        $view = $this->getRequest()->getParam("view", false);
        $tipo = $this->getRequest()->getParam("tipo", false);

        $sizes = $this->_size($size);

        switch ($view) {
            case "irudia":
                $model = $this->_irudiaMapper->find($id);
                $filePath = $model->fetchFitxategia()->getFilePath();
                $mimeType = $model->getFitxategiaMimeType();
                $title = $model->getTitulua();
                break;
            case "ikastegia":
                $model = $this->_ikastegiaMapper->find($id);
                $filePath = $model->fetchIrudia()->getFilePath();
                $mimeType = $model->getIrudiaMimeType();
                $title = $model->getIzena();
                break;
            case "kategoriaGlobala":
                $model = $this->_kategoriaGlobala->find($id);
                $filePath = $model->fetchIrudia()->getFilePath();
                $mimeType = $model->getIrudiaMimeType();
                $title = $model->getIzena();
                break;
            case "orrialdea":
                $model = $this->_orrialdeaMapper->find($id);
                $filePath = $model->fetchImg()->getFilePath();
                $mimeType = $model->getImgMimeType();
                $title = $model->getTitulua();
                break;
            case 'kanpaina':
                $model = $this->_kanpaina->find($id);

                if ($this->_request->getParam("banner")) {
                    $filePath = $model->fetchBanerra()->getFilePath();
                } else {
                    $filePath = $model->fetchIrudia()->getFilePath();
                }

                $mimeType = $model->getIrudiaMimeType();
                $title = $model->getIzena();
                break;
        }

        $this->_irudia(
            $filePath,
            $mimeType,
            $title,
            $sizes
        );
        die();

    }

    protected function _irudia($filePath, $mimeType, $title, $size)
    {

        $image = new Imagick($filePath);
        if ($size["width"] != "auto" && $size["height"] != "auto") {
            $image->resizeImage(
                $size["width"],
                $size["height"],
                imagick::FILTER_LANCZOS,
                1
            );
        }

        $this->getResponse()->setHeader(
            "Content-type",
            $mimeType
        );

        $this->getResponse()->sendHeaders();

        $this->_helper->sendFileToClient(
            $image->getImagesBlob(),
            array(
                "filename" => $title,
                "disposition" => "inline"
            ),
            true
        );

    }

    protected function _size($type)
    {

        switch ( $type ) {

            case "small":
                $width = "350";
                $height = "200";
                break;

            case "profile":
                $width = "150";
                $height = "150";
                break;

            case "laburpen":
                $width = "340";
                $height = "165";
                break;

            case "list":
                $width = "350";
                $height = "170";
                break;

            case "jakinarazpenak":
                $width = "40";
                $height = "40";
                break;

            case "featured":
                $width = "360";
                $height = "261";
                break;

            case "simple":
                $width = "263";
                $height = "191";
                break;

            case "ikastegiaList":
                $width = "120";
                $height = "120";
                break;

            case "ikastegiaKategoria":
                $width = "220";
                $height = "160";
                break;

            case 'homePage':
                $width = "248";
                $height = "120";
                break;

            default:
                $width = "auto";
                $height = "auto";
                break;
        }

        return array(
            "width" => $width,
            "height" =>  $height
        );

    }

}
