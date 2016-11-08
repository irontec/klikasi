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
 * Data Mapper implementation for Klikasi\Model\AtseginDut
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class AtseginDut extends Raw\AtseginDut
{
    protected function _save(\Klikasi\Model\Raw\AtseginDut $model,
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
                           ->setMotaId(11)
                           ->setEgoera('onartzeko')
                           ->setIkusita(0)
                           //->setSortzeData(new \Zend_Date()->toString('yyyy-MM-dd HH:mm:ss'))
                           ->save();
        }

        return $response;
    }

    public function deleteAtseginDut($edukiaId)
    {

        $currentUser = new \Klikasi_Controller_Action_Helper_SessionUser();
        $currentUser = $currentUser->getSessionUser();

        $where = array();
        $where['edukiaId = ?'] = $edukiaId;
        $where['erabiltzaileaId = ?'] = $currentUser->getId();

        $unLikes = $this->fetchList($where);

        $jakinarazpenakMapper = new \Klikasi\Mapper\Sql\Jakinarazpenak;
        
        foreach ($unLikes as $unLike) {
            $unLike->delete();
            
            $jakinarazpenak = $jakinarazpenakMapper->fetchList("motaId = 11 AND idkanpotarra = " . $unLike->getId());
            
            foreach ($jakinarazpenak as $jakinarazpena) {
                
                $jakinarazpena->delete();       
            }
        }

    }
    
}