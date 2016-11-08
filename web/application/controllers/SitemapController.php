<?php
use Klikasi\Model as Models;
use \Klikasi\Mapper\Sql as Mappers;

class SitemapController extends Zend_Controller_Action
{
    public function init()
    {
       /* Initialize action controller here */
        if (isset($_SERVER['REMOTE_ADDR'])) {
            print('Command Line Only!');
            exit(1);
        }

        /* Initialize action controller here */
        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function updateAction()
    {
        $routes = new Zend_Navigation($this->_getSiteMapRoutes());
        $this->view->navigation($routes);

        $response = $this->getResponse();
        $sitemap = $this->view->navigation()->sitemap();

        file_put_contents(APPLICATION_PATH . '/../public/sitemap.xml', $sitemap);
        return;
        $response->setHeader('Content-Type', 'text/xml');
        echo $sitemap;
    }

    protected function _getSiteMapRoutes()
    {
        $response=  array(
            array(
                'label' => 'Home',
                'changefreq' => 'daily',
                'uri' => 'http://www.klikasi.eus/'
            ),
            array(
                'label' => 'kategoriak',
                'changefreq' => 'weekly',
                'uri' => 'http://www.klikasi.eus/kategoriak'
            ),
            array(
                'label' => 'ikastegiak',
                'changefreq' => 'daily',
                'uri' => 'http://www.klikasi.eus/ikastegiak'
            ),
            array(
                'label' => 'sartu',
                'changefreq' => 'monthly',
                'uri' => 'http://www.klikasi.eus/sartu'
            ),
            array(
                'label' => 'pasahitza berreskuratu',
                'changefreq' => 'monthly',
                'uri' => 'http://www.klikasi.eus/pasahitza-berreskuratu'
            ),
            array(
                'label' => 'izena eman',
                'changefreq' => 'monthly',
                'uri' => 'http://www.klikasi.eus/?izena-eman=true'
            ),
            array(
                'label' => 'honi buruz',
                'changefreq' => 'monthly',
                'uri' => 'http://www.klikasi.eus/orriak/honi-buruz'
            ),
            array(
                'label' => 'baldintzak pribatutasun politika',
                'changefreq' => 'weekly',
                'uri' => 'http://www.klikasi.eus/orriak/baldintzak-pribatutasun-politika'
            ),
            array(
                'label' => 'honi buruz',
                'changefreq' => 'monthly',
                'uri' => 'http://www.klikasi.eus/orriak/honi-buruz'
            ),
        );

        $kategoriaMapper = new Mappers\Kategoria;
        $kategoriak = $kategoriaMapper->fetchAll(); 
        foreach ($kategoriak as $kategoria) {
            $response[] = array(
                'label' => $kategoria->getIzena(),
                'changefreq' => 'daily',
                'uri' => 'http://www.klikasi.eus/kategoriak/ikusi/kategoria/' . $kategoria->getUrl()
            );
        }

        $edukiakMapper = new Mappers\Edukia;
        $edukiak = $edukiakMapper->fetchList("egoera = 'onartua'");
        foreach ($edukiak as $edukia) {
            $response[] = array(
                'label' => $edukia->getTitulua(),
                'changefreq' => 'weekly',
                'uri' => 'http://www.klikasi.eus/edukiak/ikusi/edukia/' . $edukia->getUrl()
            );
        }

        $ikastegiakMapper = new Mappers\Ikastegia;
        $ikastegiak = $ikastegiakMapper->fetchList("aktibatua = 1");
        foreach ($ikastegiak as $ikastegia) {
            $response[] = array(
                'label' => $ikastegia->getIzena(),
                'changefreq' => 'weekly',
                'uri' => 'http://www.klikasi.eus/ikastegiak/ikusi/ikastegia/' . $ikastegia->getUrl()
            );
        }

        return $response;
    }
}