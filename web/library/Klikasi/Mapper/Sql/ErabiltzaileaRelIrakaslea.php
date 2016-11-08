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
 * Data Mapper implementation for Klikasi\Model\ErabiltzaileaRelIrakaslea
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class ErabiltzaileaRelIrakaslea extends Raw\ErabiltzaileaRelIrakaslea
{
    protected function _save(\Klikasi\Model\Raw\ErabiltzaileaRelIrakaslea $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = false;
        if (!$model->getPrimarykey()) {
            $isNew = true;
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);
        if ($isNew && $model->getEgoera() == 'onartzeko') {

            $jakinarazpenak = new \Klikasi\Model\Jakinarazpenak();
            $jakinarazpenak->setErabiltzaileaId($model->getIrakasleaId())
                           ->setIdKanpotarra($model->getId())
                           ->setThatUserId($model->getErabiltzaileaId())
                           ->setMotaId(17)
                           ->setEgoera('onartzeko')
                           ->setIkusita(0)
                           //->setSortzeData(new \Zend_Date()->toString('yyyy-MM-dd HH:mm:ss'))
                           ->save();
        }

        return $response;
    }
}
