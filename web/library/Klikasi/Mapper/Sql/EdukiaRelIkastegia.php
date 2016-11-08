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
 * Data Mapper implementation for Klikasi\Model\EdukiaRelIkastegia
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class EdukiaRelIkastegia extends Raw\EdukiaRelIkastegia 
{

    protected function _save(\Klikasi\Model\Raw\EdukiaRelIkastegia $model, $recursive = false, $useTransaction = true, $transactionTag = null) 
    {
        $isNew = $model->getId() == null;
        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);

        if ($isNew) {
            $this->_recountIkastegiaEdukiKopurua($model->getIkastegiaId());

            $edukia = $model->getEdukia();
            if ($edukia) {

                $owner = $edukia->getErabiltzailea();

                if ($owner) {
                    $moderadores = $owner->getEdukiBatenModeratzaileak($edukia);

                    foreach ($moderadores as $moderatzailea) {
                        $jakinarazpenak = new \Klikasi\Model\Jakinarazpenak();
                        $jakinarazpenak->setErabiltzaileaId($moderatzailea->getId())
                                       ->setIdKanpotarra($edukia->getId())
                                       ->setThatUserId($owner->getId())
                                       ->setMotaId(4)
                                       ->setEgoera('onartzeko')
                                       ->setIkusita(0)
                                       ->save();            
                    }
                }                    
            }
        }

        return $response;
    }

    /**
     * Deletes the current model
     *
     * @param Klikasi\Model\Raw\EdukiaRelIkastegia $model The model to delete
     * @see Klikasi\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\Klikasi\Model\Raw\ModelAbstract $model) 
    {
        $response = parent::delete($model);
        $this->_recountIkastegiaEdukiKopurua($model->getIkastegiaId ());
        
        $notificationId = $model->getEdukiaId();
        
        $jakinarazpenakMapper = new \Klikasi\Mapper\Sql\Jakinarazpenak();
        
        $jakinarazpenak = $jakinarazpenakMapper->fetchList("idKanpotarra = " . intval($notificationId) . " AND motaId = 4");
        
        foreach ($jakinarazpenak as $jakinarazpena) {
            
            $jakinarazpena->delete();
        
        }
        
        return $response;
    }

    /**
     * @param int $ikastegiaId
     * @return void 
     */
    protected function _recountIkastegiaEdukiKopurua($ikastegiaId) 
    {
        $dbAdapter = $this->getDbTable()->getAdapter();
        $recountQuery = "select ikastegiaId, count(*) as kont from EdukiaRelIkastegia where ikastegiaId = ". intval($ikastegiaId) ." group by ikastegiaId";

        $records = $dbAdapter->fetchAll($recountQuery);     
        foreach ($records as $record) {

            $ikastegiakMapper = new \Klikasi\Mapper\Sql\Ikastegia;
            $ikastegia = $ikastegiakMapper->find($record['ikastegiaId']);

            if ($ikastegia) {

                $ikastegia->setEdukiKopurua($record['kont'])
                          ->save();
            }
        }
    }
}
