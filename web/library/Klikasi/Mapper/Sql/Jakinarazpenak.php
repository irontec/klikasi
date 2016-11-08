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
 * Data Mapper implementation for Klikasi\Model\Jakinarazpenak
 *
 * @package Mapper
 * @subpackage Sql
 * @author Irontec
 */
namespace Klikasi\Mapper\Sql;
class Jakinarazpenak extends Raw\Jakinarazpenak
{
    public function deleteJakinarazpenakIruzkina($iruzkinaId)
    {
        $where = array();
        $where['motaId = ?'] = 5;
        $where['idKanpotarra = ?'] = $iruzkinaId;

        $jakinarazpenakList = $this->fetchList($where);

        if (sizeof($jakinarazpenakList) > 0) {
            foreach ($jakinarazpenakList as $jakinarazpenak) {
                $jakinarazpenak->delete();
            }
        }
    }

    protected function _save(\Klikasi\Model\Raw\Jakinarazpenak $model,
        $recursive = false, $useTransaction = true, $transactionTag = null
    )
    {
        $isNew = !$model->getPrimaryKey();
        $model = $this->_sendDirectNotificationEmail($model);

        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag);

        if ($isNew) {
            $this->_sendGroupableNotificationEmail($model);
            
        } else if($model->hasChange('egoera')) {
            
            $where = array();
            $where[] = "idKanpotarra = " . $model->getIdKanpotarra();
            $where[] = "thatUserId = " . $model->getThatUserId();
            $where[] = "motaId = " . $model->getMotaId();
            $where[] = "id != " . $model->getId();
            $where[] = "egoera != '" . $model->getEgoera() . "'";

            $siblingNotifications = $this->fetchList(implode(" AND ", $where));
            
            foreach ($siblingNotifications as $notification) {
                
                $notification->setEgoera($model->getEgoera());
                $notification->save();
                
            }
        }
        return $response;
    }

    /**
     * @return \Klikasi\Model\Raw\Jakinarazpenak
     */
    protected function _sendDirectNotificationEmail(\Klikasi\Model\Raw\Jakinarazpenak $jakinarazpena)
    {
        $isNew = !$jakinarazpena->getPrimaryKey();
        $justApproved = !$isNew && $jakinarazpena->hasChange("egoera") && $jakinarazpena->getEgoera() == 'onartua';

        $user = $jakinarazpena->getErabiltzailea();
        if (!$user) {
            return $jakinarazpena;
        }

        $settingPrivileges = $user->checkNotifikazioConfigPrivileges();
        $settings = $user->getNotifikazioSettings();

        //Direct notifications
        if ($isNew) {
            if (in_array($jakinarazpena->getMotaId(), array(2,4,10,18))) {
                //Moderate
                if (!is_null($settingPrivileges) && $settingPrivileges->getModerazioBerria()) {
                    if (!is_null($settings) && $settings->getModerazioBerria()) {
                        $jakinarazpena->setPostazJakinarazi(1);
                    }
                }

            } else if (in_array($jakinarazpena->getMotaId(), array(6,7))) {
                //Message
                if (!is_null($settingPrivileges) && $settingPrivileges->getIradokizunak()) {
                    if (!is_null($settings) && $settings->getIradokizunBerria()) {
                        $jakinarazpena->setPostazJakinarazi(1);
                    }
                }

            } else if (in_array($jakinarazpena->getMotaId(), array(12))) {
                //Edukiari salaketa
                if (!is_null($settingPrivileges) && $settingPrivileges->getEdukiariSalaketa()) {
                    if (!is_null($settings) && $settings->getEdukiariSalaketa()) {
                        $jakinarazpena->setPostazJakinarazi(1);
                    }
                }
            }
        }

        if ($jakinarazpena->getPostazJakinarazi() === 1) {
            if ($isNew && $jakinarazpena->getEgoera() == 'onartzeko') {
                $this->_moderationNeededNotificationEmail($jakinarazpena);
            } else if ($justApproved) {
                $this->_moderatedNotificationEmail($jakinarazpena);

                //control de duplicados
                $query = "update Jakinarazpenak set egoera = '" . $jakinarazpena->getEgoera() . "' ";
                $where = "where id != '" . $jakinarazpena->getId() . "' and motaId = '". $jakinarazpena->getMotaId() .
                         "' and idKanpotarra = '" . $jakinarazpena->getIdKanpotarra() . "'";

                $dbAdapter = $this->getDbTable()->getAdapter();
                $dbAdapter->query($query . $where);
            }
        }

        return $jakinarazpena;
    }

    /**
     * @return void
     */
    protected function _sendGroupableNotificationEmail(\Klikasi\Model\Raw\Jakinarazpenak $jakinarazpena)
    {
        $user = $jakinarazpena->getErabiltzailea();
        
        if (!$user) {
            return;
        }

        $settings = $user->getNotifikazioSettings();

        //Groupable notifications
        if (in_array($jakinarazpena->getMotaId(), array(1,5,9,11,17))) {

            //Moderate
            $goAhead = false;
            if (!is_null($settings) && $settings->getModerazioBerria()) {

                switch ($jakinarazpena->getMotaId()) {
                    case 1:
                        $goAhead =  (bool) $settings->getKolaborazioEskaera();
                        //'Kolaborazio eskaera',  //  Notificación sobre candidato a colaborar ==> Notificación a creador de contenido
                        break;
                    case 5:
                        $goAhead =  (bool) $settings->getIruzkinBerria();
                        //'Iruzkin berria', //  Notificación creador del contenido o colaboradores (Nuevo método) => Notificación aceptado/rechazado
                        break;
                    case 9:
                        $goAhead =  (bool) $settings->getGustokoBerria();
                        //'Gustoko berria',  //  Notificación al creador
                        break;
                    case 11:
                        $goAhead =  (bool) $settings->getAtseginDut();
                        //'Atsegin dut', //  Notificación al creador
                        break;
                    case 17:
                        $goAhead =  (bool) $settings->getIkasleEskaera();
                        //'Irakasle eskaera', //  Notificación prefosor ==> notificación respuesta
                        break;
                }
            }

            if ($goAhead) {
                $jakinarazpenakGroup = new \Klikasi\Model\JakinarazpenakGroup;
                $jakinarazpenakGroup->setJakinarazpenakId($jakinarazpena->getId())
                                    ->setErabiltzaileaId($jakinarazpena->getErabiltzaileaId())
                                    ->save();

            }
        }

        return;
    }

    protected function _moderationNeededNotificationEmail(\Klikasi\Model\Raw\Jakinarazpenak $jakinarazpena)
    {

        $view = new \Zend_View();
        $notifikazioakTmpMapper = new \Klikasi\Mapper\Sql\Notifikazioa();

        $body = '';
        $subject = '';
        $aHref = '';
        if (in_array($jakinarazpena->getMotaId(), array(2,4,10,18))) {

            /**
             * 2  => 'Ikasle eskaera' => Nuevo vinculo alumno <-> centro educativo creado
             * 4  => 'Eduki berria' => Nuevo contenido
             * 10 => 'Ikastegi Berria' => 'Nuevo centro educativo creado'
             * 18 => 'Irakasle eskaera ikastegia' => Nuevo profesor en un centro
             */

            $subject = 'Klikasi: Moderazio berria';
            $templates = array(
                2 => 'ikasle-eskaera',
                4 => 'eduki-berria',
                10 => 'ikastegi-berria',
                18 => 'irakasle-eskaera-ikastegia'
            );

            $templateName = $templates[$jakinarazpena->getMotaId()];

            $notifikazioakTmp = $notifikazioakTmpMapper->findOneByField(
                'identifikatzailea',
                $templateName
            );

            $subject = $notifikazioakTmp->getTitulua();
            $templateHtml = $notifikazioakTmp->getEdukiaHtml();

            $urlMezuak = $view->serverUrl(
                $view->baseUrl(
                    'jakinarazpenak/index/mota/' . $templateName
                )
            );
            $aHref = '<a href="' . $urlMezuak . '" title="Jakinarazpenak">Jakinarazpenak</a>';

        } else if ($jakinarazpena->getMotaId() == 6) {
            /**
             * 6 => 'Mezu berria' => 'Nuevo mensaje independientemente del tipo'
             */
            $notifikazioakTmp = $notifikazioakTmpMapper->findOneByField(
                'identifikatzailea',
                'mezuak-berria'
            );

            $subject = $notifikazioakTmp->getTitulua();
            $templateHtml = $notifikazioakTmp->getEdukiaHtml();

            $urlMezuak = $view->serverUrl(
                $view->baseUrl(
                    'mezuak'
                )
            );
            $aHref = '<a href="' . $urlMezuak . '" title="Mezuak">Mezuak</a>';

        } else if ($jakinarazpena->getMotaId() == 12) {
            /**
             * 12 => 'Edukiari salaketa' => Denunciar contenido
             */
            $notifikazioakTmp = $notifikazioakTmpMapper->findOneByField(
                'identifikatzailea',
                'edukiari-salaketa'
            );

            $subject = $notifikazioakTmp->getTitulua();
            $templateHtml = $notifikazioakTmp->getEdukiaHtml();

            $urlMezuak = $view->serverUrl(
                $view->baseUrl(
                    'jakinarazpenak/index/mota/edukiari-salaketa'
                )
            );
            $aHref = '<a href="' . $urlMezuak . '" title="Edukiari salaketa">Jakinarazpenak</a>';

        } else if ($jakinarazpena->getMotaId() == 7) {

            $notifikazioakTmp = $notifikazioakTmpMapper->findOneByField(
                'identifikatzailea',
                'iradokizun-berria'
            );

            $subject = $notifikazioakTmp->getTitulua();
            $templateHtml = $notifikazioakTmp->getEdukiaHtml();

            $urlMezuak = $view->serverUrl(
                $view->baseUrl(
                    'jakinarazpenak/index/mota/iradokizun-berria'
                )
            );
            $aHref = '<a href="' . $urlMezuak . '" title="Edukiari salaketa">Jakinarazpenak</a>';

        } else {
            die('jakinarazpenak');
        }

        $template = str_replace(
            '{{jakinarazpenak}}',
            $aHref,
            $templateHtml
        );

        $body = $template;

        $addressee = $jakinarazpena->getErabiltzailea();

        $toEmail = $addressee->getPosta();
        $toName = $addressee->getIzena()  . " " . $addressee->getAbizena();

        return $this->_sendEmail($toEmail, $toName, $subject, $body);

    }

    protected function _moderatedNotificationEmail(\Klikasi\Model\Raw\Jakinarazpenak $jakinarazpena)
    {
        $view = new \Zend_View();
        $notifikazioakTmpMapper = new \Klikasi\Mapper\Sql\Notifikazioa();

        $subject = '';
        $body = '';

        $aHref = null;
        if (in_array($jakinarazpena->getMotaId(), array(2,4,10,17,18))) {

            /**
             * 2 =>  'Ikasle eskaera' == ikasle-eskaera-accepted
             *       Nuevo vinculo alumno <-> centro educativo creado
             * 4 =>  'Eduki berria' == eduki-berria-accepted
             *       Nuevo contenido
             * 10 => 'Ikastegi Berria' == ikastegi-berria-accepted
             *       Nuevo centro educativo creado
             * 17 => 'Irakasle eskaera' == irakasle-eskaera-accepted
             *       Nuevo vinculo profesor <-> alumno
             * 18 => 'Irakasle eskaera ikastegia' == irakasle-eskaera-ikastegia-accepted
             *       Nuevo profesor en un centro
             */
            if ($jakinarazpena->getMotaId() == 4) {

                $edukiakMapper = new \Klikasi\Mapper\Sql\Edukia();
                $edukia = $edukiakMapper->find($jakinarazpena->getIdKanpotarra());

                $notifikazioakTmp = $notifikazioakTmpMapper->findOneByField(
                    'identifikatzailea',
                    'eduki-berria-accepted'
                );

                $subject = $notifikazioakTmp->getTitulua();
                $templateHtml = $notifikazioakTmp->getEdukiaHtml();

                $urlMezuak = $view->serverUrl(
                    $view->baseUrl(
                        'edukiak/ikusi/edukia/' . $edukia->getUrl()
                    )
                );
                $aHref = '<a href="' . $urlMezuak . '" title="Eduki Berria">Edukia ikusi</a>';

            } elseif ($jakinarazpena->getMotaId() == 10) {

                $ikastegiakMapper = new \Klikasi\Mapper\Sql\Ikastegia();
                $ikastegia = $ikastegiakMapper->find($jakinarazpena->getIdKanpotarra());

                $notifikazioakTmp = $notifikazioakTmpMapper->findOneByField(
                    'identifikatzailea',
                    'ikastegi-berria-accepted'
                );

                $subject = $notifikazioakTmp->getTitulua();
                $templateHtml = $notifikazioakTmp->getEdukiaHtml();

                $urlMezuak = $view->serverUrl(
                    $view->baseUrl(
                        'ikastegiak/ikusi/ikastegia/' . $ikastegia->getUrl()
                    )
                );
                $aHref = '<a href="' . $urlMezuak . '" title="Ikastegia Berria">Ikastegira joan</a>';

            } else if ($jakinarazpena->getMotaId() == 18) {
                
                $ikastegiakMapper = new \Klikasi\Mapper\Sql\Ikastegia();
                $ikastegia = $ikastegiakMapper->find($jakinarazpena->getIdKanpotarra());

                $notifikazioakTmp = $notifikazioakTmpMapper->findOneByField(
                    'identifikatzailea',
                    'irakasle-eskaera-ikastegia-accepted'
                );

                $subject = $notifikazioakTmp->getTitulua();
                $templateHtml = $notifikazioakTmp->getEdukiaHtml();

                $urlMezuak = $view->serverUrl(
                    $view->baseUrl(
                        'ikastegiak/ikusi/ikastegia/' . $ikastegia->getUrl()
                    )
                );
                $aHref = '<a href="' . $urlMezuak . '" title="Ikastegia Berria">Ikastegira joan</a>';
                
            }

        } else {
            return true;
        }

        $template = str_replace(
            '{{jakinarazpenak}}',
            $aHref,
            $templateHtml
        );

        $body = $template;

        $addressee = $jakinarazpena->getThatUser();

        $toEmail = $addressee->getPosta();
        $toName = $addressee->getIzena()  . ' ' . $addressee->getAbizena();

        return $this->_sendEmail($toEmail, $toName, $subject, $body);

    }

    /**
     * Prepara la información para enviarla por Email.
     * @param Model $erabiltzailea
     * @param Int $jakinarazpenaId
     * @param Model $model
     * @param String $type
     */
    protected function _sendEmail($toEmail, $toName, $subject, $body)
    {

        $mailer = new \Klikasi\Model\Mailer;
        $mailer->setSubject($subject)
               ->addTo($toEmail, $toName)
               ->setTemplate('default')
               ->setBody($body)
               ->send();

    }
}