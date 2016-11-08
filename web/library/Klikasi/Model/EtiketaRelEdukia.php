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
class EtiketaRelEdukia extends Raw\EtiketaRelEdukia
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function addRel($etiketaId, $edukiaId)
    {

        $this->setEdukiaId($edukiaId);
        $this->setEtiketaId($etiketaId);

    }

    public function newEtiketaAddRel($izena, $edukiaId)
    {

        $newEtiketa = new \Klikasi\Model\Etiketa();
        $newEtiketa->setIzena($izena);
        $newEtiketa->save();

        $this->addRel($newEtiketa->getId(), $edukiaId);

    }

}