<?php
/**
 * Kategoria
 */

use Klikasi\Mapper\Sql as Mappers;

class Rest_KategoriaController extends Iron_Controller_Rest_BaseController
{

    protected $_cache;
    protected $_limitPage = 100;

    public function init()
    {

        parent::init();

        $front = array();
        $back = array();
        $this->_cache = new Iron\Cache\Backend\Mapper($front, $back);

    }

    /**
     * @ApiDescription(section="Kategoria", description="GET information about all Kategoria")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kategoria/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '',
     *     'izena': '',
     *     'url': '',
     *     'karma': ''
     * },{
     *     'id': '',
     *     'izena': '',
     *     'url': '',
     *     'karma': ''
     * }]")
     */
    public function indexAction()
    {

        $currentEtag = false;
        $ifNoneMatch = $this->getRequest()->getHeader('If-None-Match', false);

        $page = $this->getRequest()->getParam('page', 0);
        $orderParam = $this->getRequest()->getParam('order', 'karma DESC');
        $searchParams = $this->getRequest()->getParam('search', false);

        $fields = $this->getRequest()->getParam('fields', array());
        if (!empty($fields)) {
            $fields = explode(',', $fields);
        } else {
            $fields = array(
                'id',
                'izena',
                'url',
                'karma',
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

        $etag = $this->_cache->getEtagVersions('Kategoria');

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

        $mapper = new Mappers\Kategoria();

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
            $itemData = $item->toArray($fields);
            $itemData['class'] = '';
            $catGlobalak = $item->getKategoriakRelKategoriaGlobalak();
            $catGlobalaId = 0;
            if (!empty($catGlobalak)) {
                $katGlobala = reset($catGlobalak);
                $katGlobala = $katGlobala->getKategoriaGlobala();
                $catGlobalaId = $katGlobala->getId();
                $itemData['class'] = $katGlobala->getClassName();
            }

            $itemData['edukiakCount'] = count($item->getEdukiaRelKategoria());
            $itemData['katGlobalaId'] = $catGlobalaId;
            $data[] = $itemData;
        }

        $this->addViewData($data);
        $this->status->setCode(200);

        if ($currentEtag !== false) {
            $this->_sendEtag($currentEtag);
        }
    }

    /**
     * @ApiDescription(section="Kategoria", description="Get information about Kategoria")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kategoria/{id}")
     * @ApiParams(name="id", type="mediumint", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '',
     *     'izena': '',
     *     'url': '',
     *     'karma': ''
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

        $mapper = new Mappers\Kategoria();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        $edukiak = array();
        $katEdukiak = $model->kategoriaEdukiak();
        if (!empty($katEdukiak)) {
            foreach ($katEdukiak as $edukia) {
                $edukiak[] = $edukia->toArrayApiList();
            }
        }

        $result = $model->toArray();
        $kategoriaRelGlobalak = $model->getKategoriakRelKategoriaGlobalak();
        $kategoriaClass = '';
        if (!empty($kategoriaRelGlobalak)) {
            $kategoriaRelGlobala = reset($kategoriaRelGlobalak);
            $kategoriaGlobala = $kategoriaRelGlobala->getKategoriaGlobala();
            if (!empty($kategoriaGlobala)) {
                $kategoriaClass = $kategoriaGlobala->getClassName();
            }
        }

        $result['class'] = $kategoriaClass;
        $result['edukiak'] = $edukiak;

        $this->status->setCode(200);
        $this->addViewData($result);

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
