<?php

/**
 * Application Model
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 *
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 */

namespace Klikasi\Model;
class KategoriaGlobala extends Raw\KategoriaGlobala
{

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function kategoriaGlobalaIrudiaUrl($size)
    {

        $view = new \Zend_View();

        $irudiaUrl = $view->url(
            array(
                'controller' => 'image',
                'action' => 'index',
                'id' => $this->getId(),
                'view' => 'kategoriaGlobala',
                'size' => $size,
                ),
            'default',
            true
        );

        return $irudiaUrl;

    }
}