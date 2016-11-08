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
 * Data Mapper implementation for Klikasi\Model\Kexa
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class Kexa extends Raw\Kexa
{
    protected function _save(\Klikasi\Model\Raw\Kexa $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = false;
        if (!$model->getPrimarykey()) {
            $isNew = true;
        }

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);


        if ($isNew) {

            $erabiltzaileakMapper = new Erabiltzailea;
            $superErabiltzaileak = $erabiltzaileakMapper->fetchList('superErabiltzailea = 1');

            foreach ($superErabiltzaileak as $superErabiltzailea) {

                $jakinarazpenak = new \Klikasi\Model\Jakinarazpenak();
                $jakinarazpenak->setErabiltzaileaId($superErabiltzailea->getId())
                               ->setIdKanpotarra($model->getId())
                               ->setThatUserId($model->getErabiltzaileaId())
                               ->setMotaId(12)
                               ->setEgoera('onartzeko')
                               ->setIkusita(0)
                               //->setSortzeData(new \Zend_Date()->toString('yyyy-MM-dd HH:mm:ss'))
                               ->save();
            }

        }

        return $response;
    }
}
