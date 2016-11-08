<?php

class RssController extends Zend_Controller_Action
{

    public function init()
    {

        $this->_helper->layout()->disableLayout();

    }

    public function indexAction()
    {

        $feed = new Zend_Feed_Writer_Feed;

        $url = $this->view->serverUrl(
            $this->view->baseUrl()
        );

        $feed->setTitle('Klikasi');
        $feed->setLink($url);
        $feed->setFeedLink($url . '/rss/', 'rss');

        $feed->addAuthor(
            array(
                'name'  => 'Irontec',
                'email' => 'klikasi@irontec.com',
                'uri'   => 'http://www.irontec.com',
            )
        );

        $feed->setDescription(
            'Euskarazko edukiak'
        );

        $feed->setDateModified(time());

        $where = array();
        $where[] = 'egoera = "onartua"';

        $edukiakMapper = new \Klikasi\Mapper\Sql\Edukia();
        $edukiakList = $edukiakMapper->fetchList(
            implode(' AND ', $where),
            'sortzeData DESC',
            10
        );

        if (sizeof($edukiakList) > 0) {
            foreach ($edukiakList as $edukiak) {

                $author = $edukiak->getErabiltzailea();

                $entry = $feed->createEntry();
                $entry->setTitle($edukiak->getTitulua());
                $entry->setLink($this->_edukiaFullUrl($edukiak->getUrl()));

                $entry->addAuthor(
                    array(
                    'name'  => $author->getCompletName(),
                    'email' => $author->getPosta(),
                    'uri'   => $this->_authorFullUlr($author->getUrl())
                    )
                );
                $rssTime = new \Zend_Date($edukiak->getSortzeData());
                $entry->setDateModified($rssTime->getTimestamp());
                $entry->setDateCreated($rssTime->getTimestamp());
                $entry->setDescription($edukiak->getDeskribapenLaburra());
                $entry->setContent($edukiak->getDeskribapena());
                $feed->addEntry($entry);

            }
        }

        echo $feed->export('rss');

    }

    protected function _edukiaFullUrl($edukiaUrl)
    {

        $currentUrl = $this->view->serverUrl(
            $this->view->url(
                array(
                    'controller' => 'edukiak',
                    'action' => 'ikusi',
                    'edukia' => $edukiaUrl
                ),
                'default',
                true
            )
        );

        return $currentUrl;

    }

    protected function _authorFullUlr($authorUrl)
    {

        $currentUrl = $this->view->serverUrl(
            $this->view->url(
                array(
                    'controller' => 'erabiltzaileak',
                    'action' => 'ikusi',
                    'erabiltzailea' => $authorUrl
                ),
                'default',
                true
            )
        );

        return $currentUrl;

    }

}