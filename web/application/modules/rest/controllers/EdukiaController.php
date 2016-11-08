<?php
/**
 * Edukia
 */

use Klikasi\Model as Models;
use Klikasi\Mapper\Sql as Mappers;

class Rest_EdukiaController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="Edukia", description="GET information about all Edukia")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/edukia/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '',
     *     'erabiltzaileaId': '',
     *     'titulua': '',
     *     'deskribapenLaburra': '',
     *     'deskribapena': '',
     *     'bisitaKopurua': '',
     *     'urteakNoiztik': '',
     *     'urteakNoizarte': '',
     *     'egoera': '',
     *     'url': '',
     *     'sortzeData': '',
     *     'karma': ''
     * },{
     *     'id': '',
     *     'erabiltzaileaId': '',
     *     'titulua': '',
     *     'deskribapenLaburra': '',
     *     'deskribapena': '',
     *     'bisitaKopurua': '',
     *     'urteakNoiztik': '',
     *     'urteakNoizarte': '',
     *     'egoera': '',
     *     'url': '',
     *     'sortzeData': '',
     *     'karma': ''
     * }]")
     */
    public function indexAction()
    {

        $currentEtag = false;
        $ifNoneMatch = $this->getRequest()->getHeader('If-None-Match', false);

        $page = $this->getRequest()->getParam('page', 0);
        $orderParam = $this->getRequest()->getParam('order', 'karma DESC');
        $search = $this->getRequest()->getParam('search', false);

        $fields = $this->getRequest()->getParam('fields', array());
        if (!empty($fields)) {
            $fields = explode(',', $fields);
        } else {
            $fields = array(
                'id',
                'erabiltzaileaId',
                'titulua',
                'deskribapenLaburra',
                'deskribapena',
                'bisitaKopurua',
                'urteakNoiztik',
                'urteakNoizarte',
                'egoera',
                'url',
                'sortzeData',
                'karma',
            );
        }

        $order = $this->_prepareOrder($orderParam);
        $where = $this->_customWhere($search);

        $offset = $this->_prepareOffset(
            array(
                'page' => $page,
                'limit' => $this->_limitPage
            )
        );

        $etag = $this->_cache->getEtagVersions('Edukia');

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

        $mapper = new Mappers\Edukia();

        if (empty($where)) {
            $where = 'egoera = "onartua"';
        } else {
            $where .= ' AND egoera = "onartua"';
        }

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
            $data[] = $item->toArrayApiList();
        }

        $this->addViewData($data);
        $this->status->setCode(200);

        if ($currentEtag !== false) {
            $this->_sendEtag($currentEtag);
        }
    }

    /**
     * @ApiDescription(section="Edukia", description="Get information about Edukia")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/edukia/{id}")
     * @ApiParams(name="id", type="mediumint", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '',
     *     'erabiltzaileaId': '',
     *     'titulua': '',
     *     'deskribapenLaburra': '',
     *     'deskribapena': '',
     *     'bisitaKopurua': '',
     *     'urteakNoiztik': '',
     *     'urteakNoizarte': '',
     *     'egoera': '',
     *     'url': '',
     *     'sortzeData': '',
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

        $etag = $this->_cache->getEtagVersions('Edukia');
        $hashEtag = md5('Edukia' . $primaryKey);
        $currentEtag = $etag . $primaryKey . $hashEtag;

        if (!empty($etag)) {
            $ifNoneMatch = $this->getRequest()->getHeader('If-None-Match', false);
            if ($currentEtag === $ifNoneMatch) {
                $this->status->setCode(304);
                return;
            }
        }

        $mapper = new Mappers\Edukia();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        if ($model->getEgoera() !== 'onartua') {
            $this->status->setCode(404);
            return;
        }

        $this->status->setCode(200);
        $this->addViewData($model->toArrayApi());

        if ($currentEtag !== false) {
            $this->_sendEtag($currentEtag);
        }

    }

    public function optionsAction()
    {

        $this->view->GET = array(
            'description' => '',
            'params' => array(
                'id' => array(
                    'type' => 'mediumint',
                    'required' => true,
                    'comment' => '[pk]'
                )
            )
        );

        $this->status->setCode(200);

    }

    protected function _customWhere($search)
    {

        $whereEdukiak = array();

        if ($search === false) {
            return $whereEdukiak;
        }

        $dbAdapter = Zend_Db_Table::getDefaultAdapter();

        $likes = array(
            'titulua',
            'deskribapenLaburra',
            'deskribapena'
        );

        foreach ($likes as $like) {
            $whereEdukiak[] = $dbAdapter->quoteInto(
                $like . ' LIKE ?',
                '%' . $search . '%'
            );
        }

        $whereKategory = $dbAdapter->quoteInto(
            'izena LIKE ?',
            '%' . $search . '%'
        );

        $katMapper = new Mappers\Kategoria();
        $katList = $katMapper->fetchList($whereKategory);
        $kategoriak = array();

        if (!empty($katList)) {
            foreach ($katList as $kategory) {
                $kategoriak[] = $kategory->getId();
            }
        }

        $edukiakIds = array();
        if (!empty($kategoriak)) {
            $where = 'kategoriaId in (' . implode(', ', $kategoriak) . ')';
            $relKatMapper = new Mappers\EdukiaRelKategoria();
            $relKatList = $relKatMapper->fetchList($where);
            foreach ($relKatList as $relKat) {
                $edukiakIds[] = $relKat->getEdukiaId();
            }
        }

        if (!empty($edukiakIds)) {
            $whereEdukiak[] = 'id IN (' . implode(',', $edukiakIds) . ')';
        }

        return implode(' OR ', $whereEdukiak);

    }

}