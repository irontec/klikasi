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
 * [entity]
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 */
 
namespace Klikasi\Model;
class Orrialdea extends Raw\Orrialdea
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }
    
    public function orrialdeaIrudiaUrl()
    {
    
    	$view = new \Zend_View();
    
    	$irudiaUrl = $view->url(
    			array(
    					'controller' => 'image',
    					'action' => 'index',
    					'id' => $this->getId(),
    					'view' => 'orrialdea',
    			),
    			'default',
    			true
    	);
    
    	return $irudiaUrl;
    
    }
}
