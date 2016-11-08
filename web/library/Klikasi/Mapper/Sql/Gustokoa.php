<?php

/**
 * Application Model Mapper
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for Klikasi\Model\Gustokoa
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class Gustokoa extends Raw\Gustokoa
{
    protected function _save(\Klikasi\Model\Raw\Gustokoa $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = false;
        if (!$model->getPrimarykey()) {
            $isNew = true;
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);
        if ($isNew) {

            $edukia = $model->getEdukia();
            $jakinarazpenak = new \Klikasi\Model\Jakinarazpenak();
            $jakinarazpenak->setErabiltzaileaId($edukia->getErabiltzaileaId())
                           ->setIdKanpotarra($model->getId())
                           ->setThatUserId($model->getErabiltzaileaId())
                           ->setMotaId(9)
                           ->setEgoera('onartzeko')
                           ->setIkusita(0)
                           //->setSortzeData(new \Zend_Date()->toString('yyyy-MM-dd HH:mm:ss'))
                           ->save();
        }

        return $response;
    }



    public function deleteGustokoa($edukiaId)
    {

        $currentUser = new \Klikasi_Controller_Action_Helper_SessionUser();
        $currentUser = $currentUser->getSessionUser();

        $where = array();
        $where['edukiaId = ?'] = $edukiaId;
        $where['erabiltzaileaId = ?'] = $currentUser->getId();

        $ezGogokoak = $this->fetchList($where);

        $jakinarazpenakMapper = new \Klikasi\Mapper\Sql\Jakinarazpenak;

        foreach ($ezGogokoak as $ezGogoko) {
            $ezGogoko->delete();
            
            $jakinarazpenak = $jakinarazpenakMapper->fetchList("motaId = 9 AND idkanpotarra = " . $ezGogoko->getId());
            
            foreach ($jakinarazpenak as $jakinarazpena) {
                
                $jakinarazpena->delete();       
            }
        }

    }

}