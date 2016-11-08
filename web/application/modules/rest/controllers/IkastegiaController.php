<?php
/**
 * Ikastegia
 */

use Klikasi\Mapper\Sql as Mappers;

class Rest_IkastegiaController extends Iron_Controller_Rest_BaseController
{

    protected $_cache;
    protected $_limitPage = 10;

    public function init()
    {

        parent::init();

        $front = array();
        $back = array();
        $this->_cache = new Iron\Cache\Backend\Mapper($front, $back);

    }

    /**
     * @ApiDescription(section="Ikastegia", description="GET information about all Ikastegia")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ikastegia/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '',
     *     'izena': '',
     *     'deskribapenLaburra': '',
     *     'deskribapena': '',
     *     'herria': '',
     *     'probintzia': '',
     *     'kokapena': '',
     *     'kokapenaLat': '',
     *     'kokapenaLng': '',
     *     'mota': '',
     *     'irudia': '',
     *     'linkedin': '',
     *     'facebook': '',
     *     'twitter': '',
     *     'google': '',
     *     'youtube': '',
     *     'instagram': '',
     *     'pinterest': '',
     *     'aktibatua': '',
     *     'url': '',
     *     'webSite': '',
     *     'sortzeData': '',
     *     'karma': '',
     *     'flickr': '',
     *     'ikasleKopurua': '',
     *     'edukiKopurua': ''
     * },{
     *     'id': '',
     *     'izena': '',
     *     'deskribapenLaburra': '',
     *     'deskribapena': '',
     *     'herria': '',
     *     'probintzia': '',
     *     'kokapena': '',
     *     'kokapenaLat': '',
     *     'kokapenaLng': '',
     *     'mota': '',
     *     'irudia': '',
     *     'linkedin': '',
     *     'facebook': '',
     *     'twitter': '',
     *     'google': '',
     *     'youtube': '',
     *     'instagram': '',
     *     'pinterest': '',
     *     'aktibatua': '',
     *     'url': '',
     *     'webSite': '',
     *     'sortzeData': '',
     *     'karma': '',
     *     'flickr': '',
     *     'ikasleKopurua': '',
     *     'edukiKopurua': ''
     * }]")
     */
    public function indexAction()
    {

        $currentEtag = false;
        $ifNoneMatch = $this->getRequest()->getHeader('If-None-Match', false);

        $page = $this->getRequest()->getParam('page', 0);
        $orderParam = $this->getRequest()->getParam('order', 'izena ASC');
        $searchParams = $this->getRequest()->getParam('search', false);

        $fields = $this->getRequest()->getParam('fields', array());
        if (!empty($fields)) {
            $fields = explode(',', $fields);
        } else {
            $fields = array(
                'id',
                'izena',
                'deskribapenLaburra',
                'deskribapena',
                'herria',
                'probintzia',
                'kokapena',
                'kokapenaLat',
                'kokapenaLng',
                'mota',
                //'irudiaUrl:@profile', Cambia @profile por el profile del fso.ini
                'linkedin',
                'facebook',
                'twitter',
                'google',
                'youtube',
                'instagram',
                'pinterest',
                'aktibatua',
                'url',
                'webSite',
                'sortzeData',
                'karma',
                'flickr',
                'ikasleKopurua',
                'edukiKopurua',
            );
        }

        $order = $this->_prepareOrder($orderParam);
        $where = $this->_prepareWhere($searchParams);

        $offset = $this->_prepareOffset(
            array(
                'page' => $page,
                'limit' => $this->_limitPage
            )
        );

        $etag = $this->_cache->getEtagVersions('Ikastegia');

        $hashEtag = md5(
            serialize(
                array($fields, $where, $order, $this->_limitPage, $offset)
            )
        );
        $currentEtag = $etag . $hashEtag;

        if ($etag !== false) {
            if ($currentEtag === $ifNoneMatch) {
                $this->status->setCode(304);
                return;
            }
        }

        $mapper = new Mappers\Ikastegia();

        $items = $mapper->fetchList(
            $where,
            $order,
            $this->_limitPage,
            $offset
        );

        $countItems = $mapper->countByQuery($where);

        $this->getResponse()->setHeader('totalItems', $countItems);

        if (empty($items)) {
            $this->status->setCode(204);
            return;
        }

        $data = array();

        foreach ($items as $item) {
            $data[] = $item->toArray($fields);
        }

        $this->addViewData($data);
        $this->status->setCode(200);

        if ($currentEtag !== false) {
            $this->_sendEtag($currentEtag);
        }
    }

    /**
     * @ApiDescription(section="Ikastegia", description="Get information about Ikastegia")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ikastegia/{id}")
     * @ApiParams(name="id", type="mediumint", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '',
     *     'izena': '',
     *     'deskribapenLaburra': '',
     *     'deskribapena': '',
     *     'herria': '',
     *     'probintzia': '',
     *     'kokapena': '',
     *     'kokapenaLat': '',
     *     'kokapenaLng': '',
     *     'mota': '',
     *     'irudia': '',
     *     'linkedin': '',
     *     'facebook': '',
     *     'twitter': '',
     *     'google': '',
     *     'youtube': '',
     *     'instagram': '',
     *     'pinterest': '',
     *     'aktibatua': '',
     *     'url': '',
     *     'webSite': '',
     *     'sortzeData': '',
     *     'karma': '',
     *     'flickr': '',
     *     'ikasleKopurua': '',
     *     'edukiKopurua': ''
     * }")
     */
    public function getAction()
    {
        $currentEtag = false;
        $primaryKey = $this->getRequest()->getParam('id', false);
        if ($primaryKey === false) {
            $this->status->setCode(404);
            return;
        }

        $fields = $this->getRequest()->getParam('fields', array());
        if (!empty($fields)) {
            $fields = explode(',', $fields);
        } else {
            $fields = array(
                'id',
                'izena',
                'deskribapenLaburra',
                'deskribapena',
                'herria',
                'probintzia',
                'kokapena',
                'kokapenaLat',
                'kokapenaLng',
                'mota',
                //'irudiaUrl:@profile', Cambia @profile por el profile del fso.ini
                'linkedin',
                'facebook',
                'twitter',
                'google',
                'youtube',
                'instagram',
                'pinterest',
                'aktibatua',
                'url',
                'webSite',
                'sortzeData',
                'karma',
                'flickr',
                'ikasleKopurua',
                'edukiKopurua',
            );
        }

        $etag = $this->_cache->getEtagVersions('Ikastegia');
        $hashEtag = md5(
            serialize(
                array($fields)
            )
        );
        $currentEtag = $etag . $primaryKey . $hashEtag;

        if (!empty($etag)) {
            $ifNoneMatch = $this->getRequest()->getHeader('If-None-Match', false);
            if ($currentEtag === $ifNoneMatch) {
                $this->status->setCode(304);
                return;
            }
        }

        $mapper = new Mappers\Ikastegia();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        $edukiak = array();

        $whereRel = array(
            'egoera = ?' => 'onartua',
            'ikastegiaId = ?' => $model->getId()
        );
        $relMapper = new Mappers\EdukiaRelIkastegia();
        $relList = $relMapper->fetchList($whereRel);
        if (!empty($relList)) {
            foreach ($relList as $relItem) {
                $edukia = $relItem->getEdukia();
                if ($edukia->getEgoera() == 'onartua') {
                    $edukiak[] = $edukia->toArrayApiList();
                }
            }
        }

        $ikastegia = $model->toArray($fields);
        $ikastegia['edukiak'] = $edukiak;

        $this->status->setCode(200);
        $this->addViewData($ikastegia);

        if ($currentEtag !== false) {
            $this->_sendEtag($currentEtag);
        }

    }

    public function optionsAction()
    {

        $this->view->INDEX = array(
            'description' => '',
            'params' => array()
        );

        $this->view->GET = array(
            'description' => '',
            'params' => array(
                'id' => array(
                    'type' => 'mediumint',
                    'required' => true
                )
            )
        );

        $this->status->setCode(200);

    }
}