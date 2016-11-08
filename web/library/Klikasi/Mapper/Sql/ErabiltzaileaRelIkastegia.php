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
 * Data Mapper implementation for Klikasi\Model\ErabiltzaileaRelIkastegia
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class ErabiltzaileaRelIkastegia extends Raw\ErabiltzaileaRelIkastegia
{
    protected function _save(\Klikasi\Model\Raw\ErabiltzaileaRelIkastegia $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = false;
        if (!$model->getPrimarykey()) {
            $isNew = true;
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);
        if ($isNew && $model->getEgoera() == 'onartzeko') {

            $erabiltzailea = $model->getErabiltzailea();
            $moderatzaileak = $erabiltzailea->nireModeratzaileak();

            $motaId = $erabiltzailea->getProfila() == 'irakasle' ? 18 : 2;

            foreach ($moderatzaileak as $moderatzailea) {

                $jakinarazpenak = new \Klikasi\Model\Jakinarazpenak();
                $jakinarazpenak->setErabiltzaileaId($moderatzailea->getId())
                               ->setThatUserId($model->getErabiltzaileaId())
                               ->setIdKanpotarra($model->getIkastegiaId())
                               ->setEgoera('onartzeko')
                               ->setIkusita(0)
                               ->setMotaId($motaId)
                               ->save();
            }
        }

        if ($response && $isNew) {
            $this->_recountIkastegiaIkasleKopurua($model->getIkastegiaId());
        }

        return $response;
    }

    /**
     * Deletes the current model
     *
     * @param Klikasi\Model\Raw\ErabiltzaileaRelIkastegia $model The model to delete
     * @see Klikasi\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\Klikasi\Model\Raw\ModelAbstract $model)
    {
        $response = parent::delete($model);
        $this->_recountIkastegiaIkasleKopurua($model->getIkastegiaId());
        
        $jakinarazpenakMapper = new \Klikasi\Mapper\Sql\Jakinarazpenak();
        
        $where = "motaId = 18 AND thatUserId = " . $model->getErabiltzaileaId() . " AND idKanpotarra = " . $model->getIkastegiaId();
        
        $jakinarazpenak = $jakinarazpenakMapper->fetchList($where);
        
        foreach ($jakinarazpenak as $jakinarazpena) {
            
            $jakinarazpena->delete();
            
        }
        
        return $response;
    }
    
    /**
     * @param int $ikastegiaId
     * @return void 
     */
    protected function _recountIkastegiaIkasleKopurua($ikastegiaId) 
    {
        $dbAdapter = $this->getDbTable()->getAdapter();
        $recountQuery = "select ikastegiaId, count(*) as kont from ErabiltzaileaRelIkastegia where ikastegiaId = ". intval($ikastegiaId) ." group by ikastegiaId";

        $records = $dbAdapter->fetchAll($recountQuery);     
        foreach ($records as $record) {
            
            $ikastegiakMapper = new \Klikasi\Mapper\Sql\Ikastegia;
            $ikastegia = $ikastegiakMapper->find($record['ikastegiaId']);
            
            if ($ikastegia) {
                
                $ikastegia->setIkasleKopurua($record['kont'])
                          ->save();
            }
        }
    }

}
