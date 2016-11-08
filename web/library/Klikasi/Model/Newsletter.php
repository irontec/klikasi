<?php

/**
 * Application Model
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 */

namespace Klikasi\Model;
class Newsletter extends Raw\Newsletter
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function sendNewsletter()
    {

        $applicationConfigPath = APPLICATION_PATH . '/configs/application.ini';
        $applicationConfig = new \Zend_Config_Ini($applicationConfigPath);
        $config = $applicationConfig->toArray();
        $production = $config['production'];
        $baseUrl = $production['baseUrlKlikasi'];

        $subject = $this->getTitle();
        $body = $this->getContent();

        $whereEdukia = array(
            'egoera = ?' => 'onartua'
        );

        $edukiak = new \Klikasi\Mapper\Sql\Edukia();
        $edukiakList = $edukiak->fetchList(
            $whereEdukia,
            'karma DESC',
            6
        );

        if (sizeof($edukiakList) == 6) {

            $whereErabiltzailea = array(
                'newsletter = ?' => 1,
                'egoera = ?' => 'aktibatua'
            );

            $erabiltzaileak = new \Klikasi\Mapper\Sql\Erabiltzailea();
            $erabiltzaileakList = $erabiltzaileak->fetchList(
                $whereErabiltzailea
            );

            $whereIkastegia = array(
                'aktibatua = ?' => 1
            );
            $ikastegiak = new \Klikasi\Mapper\Sql\Ikastegia();
            $ikastegiakList = $ikastegiak->fetchList(
                $whereIkastegia,
                'sortzeData DESC',
                6
            );

            $sendCount = 0;
            if (!empty($erabiltzaileakList)) {

                $options = array();
                $options['charset'] = 'UTF-8';
                $options['escape'] = function($value) {
                    return $value;
                };

                $mustache = new \Mustache_Engine($options);
                $view = new \Zend_View();

                $bodyTemplate = $view->setScriptPath(
                    APPLICATION_PATH .
                    '/views/scripts'
                )->render('templates/newsletter.phtml');

                foreach ($erabiltzaileakList as $erabiltzailea) {
                    $mailer = new \Klikasi\Model\Mailer;
                    $sendCount++;

                    $hash = md5(uniqid(rand(), true));

                    $newsletterHash = new \Klikasi\Model\NewsletterHash();
                    $newsletterHash->setNewsletterId($this->getId());
                    $newsletterHash->setErabiltzaileaId($erabiltzailea->getId());
                    $newsletterHash->setHash($hash);
                    $newsletterHash->save();

                    $bodyFinal = $mustache->render(
                        $bodyTemplate,
                        array(
                            'content' => $body,
                            'edukiak' => $this->_prepareEdukiak($edukiakList, $baseUrl),
                            'ikastegiak' => $this->_prepareIkastegiak($ikastegiakList, $baseUrl),
                            'baseUrl' => $baseUrl,
                            'urlNewsletter' => $baseUrl . '/newsletter/' . $this->getId(),
                            'erabiltzailea' => $erabiltzailea->getCompletName(),
                            'erabiltzaileaId' => $erabiltzailea->getId(),
                            'hash' => $hash
                        )
                    );

                    $mailer->setSubject($subject);
                    $mailer->addTo(
                        $erabiltzailea->getPosta(),
                        $erabiltzailea->getCompletName()
                    );
                    $mailer->setTemplate(false);
                    $mailer->setBody($bodyFinal);
                    $mailer->send();

                }
            }

        }

        if ($sendCount > 0) {
            $now = new \Zend_Date();
            $now->setTimezone("Europe/Madrid");
            $nowString = $now->toString('yyyy-MM-dd HH:mm:ss');

            $this->setIkastegiakSent(
                $this->_ikastegiakIds(
                    $ikastegiakList
                )
            );

            $this->setEdukiakSent(
                $this->_edukiakIds(
                    $edukiakList
                )
            );

            $this->setSend(1);
            $this->setActive(0);
            $this->setSent($sendCount);

            $this->setShippingDate($nowString);
            $this->save();

        }

    }

    protected function _ikastegiakIds($ikastegiakList)
    {

        $ikastegiakIds = NULL;

        if (!empty($ikastegiakList)) {
            $ikastegiask = array();
            foreach ($ikastegiakList as $ikastegia) {
                $ikastegiask[] = $ikastegia->getId();
            }

            $ikastegiakIds = implode(',', $ikastegiask);

        }

        return $ikastegiakIds;

    }

    protected function _edukiakIds($edukiakList)
    {

        $edukiakIds = NULL;

        if (!empty($edukiakList)) {
            $edukiak = array();
            foreach ($edukiakList as $edukia) {
                $edukiak[] = $edukia->getId();
            }

            $edukiakIds = implode(',', $edukiak);

        }

        return $edukiakIds;
    }

    protected function _prepareEdukiak($edukiakList, $baseUrl)
    {

        $edukiakResult = array();

        if (!empty($edukiakList)) {
            foreach ($edukiakList as $edukia) {

                $url = $baseUrl . '/edukiak/ikusi/edukia/' . $edukia->getUrl();

                $categoryColor = '';
                switch ($edukia->kategoriaGlobala()->getClassName()) {
                    case 'bg-green':
                        $categoryColor = '#55BC75';
                        break;

                    case 'bg-yellow':
                        $categoryColor = '#FFB400';
                        break;

                    case 'bg-blue':
                        $categoryColor = '#14B9D6';
                        break;

                    case 'bg-brown':
                        $categoryColor = '#AB5728';
                        break;

                    case 'bg-orange':
                        $categoryColor = '#E6663A';
                        break;

                    case 'bg-grey':
                        $categoryColor = '#78979B';
                        break;

                    case 'bg-pink':
                        $categoryColor = '#C20551';
                        break;
                }

                $edukiakResult[] = array(
                    'baseUrl' => $baseUrl,
                    'name' => $edukia->getTitulua(),
                    'summary' => $edukia->getDeskribapenLaburra(),
                    'categoryColor' => $categoryColor,
                    'url' => $url,
                    'views' => $edukia->getBisitaKopurua(),
                    'comments' => $edukia->iruzkinaCount(),
                    'likes' => sizeof($edukia->getAtseginDut())
                );

            }
        }

        return $edukiakResult;
    }

    protected function _prepareIkastegiak($ikastegiakList, $baseUrl)
    {

        $ikastegiakReturn = array();

        if (!empty($ikastegiakList)) {
            foreach ($ikastegiakList as $ikastegia) {

                $imgUrl = $baseUrl . '/image/index/id/' . $ikastegia->getId() . '/view/ikastegia/size/ikastegiaList';
                $url = $baseUrl . '/ikastegiak/ikusi/ikastegia/' . $ikastegia->getUrl();

                $ikastegiakReturn[] = array(
                    'name' => $ikastegia->getIzena(),
                    'summary' => $ikastegia->getDeskribapenLaburra(),
                    'url' => $url,
                    'img' => $imgUrl
                );

            }

        }

        return $ikastegiakReturn;

    }

}