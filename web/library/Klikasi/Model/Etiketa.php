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
class Etiketa extends Raw\Etiketa
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function toArrayEdukiak()
    {

        $result = array(
            'id' => $this->getId(),
            'text' => $this->getIzena(),
        );

        return $result;

    }

}