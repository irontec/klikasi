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
 * Data Mapper implementation for Klikasi\Model\ErabiltzaileaRelEdukia
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class ErabiltzaileaRelEdukia extends Raw\ErabiltzaileaRelEdukia
{
    protected function _save(\Klikasi\Model\Raw\ErabiltzaileaRelEdukia $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = false;
        if (!$model->getPrimarykey()) {
            $isNew = true;
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);
        if ($isNew && $model->getEgoera() == "onartzeko") {

            $edukia = $model->getEdukia();

            $jakinarazpenak = new \Klikasi\Model\Jakinarazpenak();
            $jakinarazpenak->setErabiltzaileaId($model->getErabiltzaileaId())
                           ->setIdKanpotarra($model->getEdukiaId())
                           ->setThatUserId($edukia->getErabiltzaileaId())
                           ->setMotaId(1)
                           ->setEgoera('onartzeko')
                           ->setIkusita(0)
                           //->setSortzeData(new \Zend_Date()->toString('yyyy-MM-dd HH:mm:ss'))
                           ->save();
        }

        return $response;
    }
}