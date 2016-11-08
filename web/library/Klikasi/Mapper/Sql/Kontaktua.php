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
 * Data Mapper implementation for Klikasi\Model\Kontaktua
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class Kontaktua extends Raw\Kontaktua
{
    protected function _save(\Klikasi\Model\Raw\Kontaktua $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = !is_numeric($model->getPrimaryKey());
        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);

        if ($isNew) {

            $klearUsersMapper = new KlearUsers;
            $klearUsers = $klearUsersMapper->fetchAll();

            foreach ($klearUsers as $admin) {

                $mailer = new \Klikasi\Model\Mailer;
                $mailer->setSubject('Klikasi kontaktua: ' . $model->getGaia())
                       ->setBody($model->getMezua())
                       ->addTo($admin->getEmail())
                       ->setReplyTo($model->getPosta(), $model->getIzena())
                       ->send();
            }

        }

        return $response;
    }
}
