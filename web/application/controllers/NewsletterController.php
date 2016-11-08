<?php

use \Klikasi\Model as Models;
use \Klikasi\Mapper\Sql as Mappers;

class NewsletterController extends Zend_Controller_Action
{

    protected $_templates;

    public function init()
    {

        $this->_helper->layout->setLayout('newsletter');
        $this->view->title = 'Klikasi Newsletter';

    }

    public function indexAction()
    {

        $newsletterId = $this->getRequest()->getParam('newsletter', false);
        if (trim($newsletterId) === false) {
            $this->_redirect('/');
        }

        $newsletter = new Mappers\Newsletter();
        $newsletter = $newsletter->find($newsletterId);

        if (empty($newsletter)) {
            $this->_redirect('/');
        }

        if ($newsletter->getActive() == 1 && $newsletter->getSend() == 0) {
            $this->_redirect('/');
        }

        $options = array();
        $options['charset'] = 'UTF-8';
        $options['escape'] = function($value) {
            return $value;
        };

        $mustache = new \Mustache_Engine($options);
        $template = $this->view->setScriptPath(
            APPLICATION_PATH .
            '/views/scripts'
        )->render('newsletter/newsletter.phtml');

        $baseUrl = $this->view->serverUrl(
            $this->view->baseUrl()
        );

        $edukiakList = $newsletter->getEdukiakSent();

        $ikastegiakList = $newsletter->getIkastegiakSent();

        $edukiak = $this->_prepareEdukiak($edukiakList, $baseUrl);
        $ikastegiak = $this->_prepareIkastegiak($ikastegiakList, $baseUrl);

        $this->view->newsletter= $mustache->render(
            $template,
            array(
                'title' => $newsletter->getTitle(),
                'content' => $newsletter->getContent(),
                'edukiak' => $edukiak,
                'ikastegiak' => $ikastegiak,
                'baseUrl' => $baseUrl,
            )
        );

    }

    protected function _prepareEdukiak($edukiakListIds, $baseUrl)
    {

        $edukiakResult = array();

        if (empty($edukiakListIds)) {
            return $edukiakResult;
        }

        $edukiakList = new Mappers\Edukia();
        $edukiakList = $edukiakList->fetchList(
            'id in (' . $edukiakListIds . ')'
        );

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

    public function hashAction()
    {

        $iden = $this->getRequest()->getParam('iden', false);
        $erabiltzailea = $this->getRequest()->getParam('e', false);

        if ($iden !== false && $erabiltzailea !== false) {

            $whereHash = array(
                'hash = ?' => $iden,
                'erabiltzaileaId = ?' => $erabiltzailea
            );

            $newsletterHash = new Mappers\NewsletterHash();
            $newsletterHash = $newsletterHash->fetchOne($whereHash);

            if (!empty($newsletterHash)) {

                $newsletter = $newsletterHash->getNewsletter();

                $readBy = $newsletter->getReadBy();
                $readBy++;

                $newsletter->setReadBy($readBy);
                $newsletter->save();

                $newsletterHash->delete();

            }
        }

        $this->_helper->json(array());

    }

    protected function _prepareIkastegiak($ikastegiakListIds, $baseUrl)
    {

        $ikastegiakReturn = array();

        if (empty($ikastegiakListIds)) {
            return $ikastegiakReturn;
        }

        $ikastegiakList = new Mappers\Ikastegia();
        $ikastegiakList = $ikastegiakList->fetchList(
            'id in (' . $ikastegiakListIds . ')'
        );

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