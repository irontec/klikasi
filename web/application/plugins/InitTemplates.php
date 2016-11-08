<?php

class Klikasi_Plugin_InitTemplates extends Zend_Controller_Plugin_Abstract
{

    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {

        if ($request->getModuleName() == 'klear' || $request->getModuleName() == 'klearMatrix') {
            return;
        }

        $this->_mustache = new \Mustache_Engine();

        $viewsPath = APPLICATION_PATH .'/views/scripts/';

        $controllerName = $request->getControllerName();
        $blackList = array(
            'holder.js',
            'image',
            'multimedia'
        );

        if (array_search($controllerName, $blackList) === false) {

            $pathsTemplates = $viewsPath . $controllerName;

            if (is_dir($pathsTemplates)) {

                $mustacheLoader = new \Mustache_Loader_FilesystemLoader(
                    $pathsTemplates,
                    array(
                        'extension' => '.phtml'
                    )
                );

                $this->_mustacheTemplates = new \Mustache_Engine(
                    array(
                        'template_class_prefix' => '_KlikasiTemplates_',
                        'cache' => APPLICATION_PATH . '/cache',
                        'cache_file_mode' => 0666,
                        'loader' => $mustacheLoader,
                        'partials_loader' => $mustacheLoader
                    )
                );

            }

        }

    }

}