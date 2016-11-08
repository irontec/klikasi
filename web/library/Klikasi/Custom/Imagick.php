<?php

namespace Klikasi\Custom;

class Imagick
{
    protected $_imagick;
    protected $_type = 'png';

    public function __construct()
    {
        $this->_imagick = new \Imagick();
    }

    public function setPath($path)
    {
        $this->_imagick->readImage($path);
        return $this;
    }

    public function setData($data)
    {
        $this->_imagick->readImageBlob($data);
        if ($this->_type == jpg) {
            $this->_imagick->setCompressionQuality(75);
            $this->_imagick->setInterlaceScheme(\Imagick::INTERLACE_PLANE);
            $this->_imagick->setImageFormat('jpg');
        } else {
            $this->_imagick->setImageFormat($this->getMimeType());
        }
        return $this;
    }

    public function setType($type)
    {
        $this->_type = $type;
        $this->_imagick->setImageFormat($this->_type);
        return $this;
    }

    public function saveThumbImg($data, $username)
    {

        if (isset($data['tmpName'])) {

            $cropX = $data['cropX'];
            $cropY = $data['cropY'];
            $cropW = $data['cropW'];
            $cropH = $data['cropH'];
            $tmpName = $data['tmpName'];

        } else {

            $cropX = $data['x'];
            $cropY = $data['y'];
            $cropW = $data['w'];
            $cropH = $data['h'];
            $tmpName = $data['imagePath'];

        }

        if (file_exists($tmpName)) {

            $tempPath = tempnam(
                sys_get_temp_dir(),
                $username . '_'
            );

            $this->setPath(
                $tmpName
            );

            $this->crop(
                $cropW,
                $cropH,
                $cropX,
                $cropY
            );

            $this->saveImage($tempPath);
            unlink($tmpName);
            return $tempPath;

        } else {
            throw new \Zend_Exception(
                'Ezinezkoa izan da irudia gordetzea'
            );
        }

    }

    public function getThumbnail($width, $height)
    {
        $size = $this->_imagick->getImageGeometry();
        if ( $size['width'] == $width && $size['height'] == $height ) {
            return;
        } elseif ( $size['width'] > $width && $size['height'] > $height ) {
            $this->_imagick->thumbnailImage($width, $height, true);
        }
        /* Create a canvas with the desired color */
        $canvas = new \Imagick();
        $canvas->newImage($width, $height, new \ImagickPixel('rgba(250,250,250,0)'), 'png');
        $canvas->thresholdImage(-1, \Imagick::CHANNEL_ALPHA);
        /* Get the image geometry */
        $geometry = $this->_imagick->getImageGeometry();
        /* The overlay x and y coordinates */
        $x = ( $width - $geometry['width'] ) / 2;
        $y = ( $height - $geometry['height'] ) / 2;
        /* Composite on the canvas  */
        $canvas->compositeImage($this->_imagick, \Imagick::COMPOSITE_OVER, $x, $y);
        $this->_imagick = $canvas->clone();
        $this->_imagick->setimageformat('png');
    }

    public function resize($width, $height)
    {
        $this->_imagick->resizeImage($width, $height, \Imagick::FILTER_LANCZOS, 1);
    }

    public function crop($width, $height, $x, $y)
    {
        $this->_imagick->cropImage($width, $height, $x, $y);
    }

    public function cropThumbnail($width, $height)
    {
        $this->_imagick->cropThumbnailImage($width, $height);
    }

    public function getImage()
    {
        return $this->_imagick->getImageBlob();
    }

    public function getMimeType()
    {
        return $this->_imagick->getImageMimeType();
    }

    public function saveImage($path)
    {
        return $this->_imagick->writeImage($path);
    }
}
