<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initTemplates()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new Klikasi_Plugin_InitTemplates());

        Zend_Registry::set(
            'mustacheTemplates',
            $front->getPlugin('Klikasi_Plugin_InitTemplates')
        );
    }

    public function _literales()
    {
        $locale = new Zend_Locale('eu');
        Zend_Registry::set('Zend_Locale', $locale);

        $translate = Zend_Registry::get('Zend_Translate');
        $translate->setLocale($locale);

    }

    public function _initRest()
    {

        $front = Zend_Controller_Front::getInstance();

        $restRoute = new Zend_Rest_Route(
            $front,
            array(),
            array('rest')
        );

        $front->getRouter()->addRoute('rest', $restRoute);

    }

}