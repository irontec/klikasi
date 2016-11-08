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
 * Data Mapper implementation for Klikasi\Model\Mezuak
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class Mezuak extends Raw\Mezuak
{
    protected function _save(\Klikasi\Model\Raw\Mezuak $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = false;
        if (!$model->getPrimarykey()) {
            $isNew = true;
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);
        if ($isNew) {

            $whoId  = $model->getNorkId();
            $whomId = $model->getNoriId();

            $jakinarazpenak = new \Klikasi\Model\Jakinarazpenak();
            $jakinarazpenak->setErabiltzaileaId($whomId)
                           ->setIdKanpotarra($model->getId())
                           ->setThatUserId($whoId)
                           ->setMotaId(6)
                           ->setEgoera('onartzeko')
                           ->setIkusita(0)
                           //->setSortzeData(new \Zend_Date()->toString('yyyy-MM-dd HH:mm:ss'))
                           ->save();
        }

        return $response;
    }

}
