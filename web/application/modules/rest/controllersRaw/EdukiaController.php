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
        $orderParam = $this->getRequest()->getParam('order', false);
        $searchParams = $this->getRequest()->getParam('search', false);

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
        $where = $this->_prepareWhere($searchParams);

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

        $etag = $this->_cache->getEtagVersions('Edukia');
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

        $mapper = new Mappers\Edukia();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        $this->status->setCode(200);
        $this->addViewData($model->toArray($fields));

        if ($currentEtag !== false) {
            $this->_sendEtag($currentEtag);
        }

    }

    /**
     * @ApiDescription(section="Edukia", description="Create's a new Edukia")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/edukia/")
     * @ApiParams(name="erabiltzaileaId", nullable=true, type="mediumint", sample="", description="")
     * @ApiParams(name="titulua", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="deskribapenLaburra", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="deskribapena", nullable=false, type="mediumtext", sample="", description="")
     * @ApiParams(name="bisitaKopurua", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="urteakNoiztik", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="urteakNoizarte", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="egoera", nullable=false, type="varchar", sample="", description="[enum:onartzeko|onartua|ezOnartua|blokeatuta]")
     * @ApiParams(name="url", nullable=false, type="varchar", sample="", description="[urlIdentifier:titulua]")
     * @ApiParams(name="sortzeData", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="karma", nullable=false, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/edukia/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\Edukia();

        try {
            $model->populateFromArray($params);
            $model->save();

            $this->status->setCode(201);

            $location = $this->location() . '/' . $model->getPrimaryKey();

            $this->getResponse()->setHeader('Location', $location);

        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => $e->getMessage())
            );
            $this->status->setCode(404);
        }

    }

    /**
     * @ApiDescription(section="Edukia", description="Table Edukia")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/edukia/")
     * @ApiParams(name="id", nullable=false, type="mediumint", sample="", description="")
     * @ApiParams(name="erabiltzaileaId", nullable=true, type="mediumint", sample="", description="")
     * @ApiParams(name="titulua", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="deskribapenLaburra", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="deskribapena", nullable=false, type="mediumtext", sample="", description="")
     * @ApiParams(name="bisitaKopurua", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="urteakNoiztik", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="urteakNoizarte", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="egoera", nullable=false, type="varchar", sample="", description="[enum:onartzeko|onartua|ezOnartua|blokeatuta]")
     * @ApiParams(name="url", nullable=false, type="varchar", sample="", description="[urlIdentifier:titulua]")
     * @ApiParams(name="sortzeData", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="karma", nullable=false, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 200")
     * @ApiReturn(type="object", sample="{}")
     */
    public function putAction()
    {

        $primaryKey = $this->getRequest()->getParam('id', false);

        if ($primaryKey === false) {
            $this->status->setCode(400);
            return;
        }

        $params = $this->getRequest()->getParams();

        $mapper = new Mappers\Edukia();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        try {
            $model->populateFromArray($params);
            $model->save();

            $this->addViewData($model->toArray());
            $this->status->setCode(200);
        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => $e->getMessage())
            );
            $this->status->setCode(404);
        }

    }

    /**
     * @ApiDescription(section="Edukia", description="Table Edukia")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/edukia/")
     * @ApiParams(name="id", nullable=false, type="mediumint", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 204")
     * @ApiReturn(type="object", sample="{}")
     */
    public function deleteAction()
    {

        $primaryKey = $this->getRequest()->getParam('id', false);

        if ($primaryKey === false) {
            $this->status->setCode(400);
            return;
        }

        $mapper = new Mappers\Edukia();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        try {
            $model->delete();
            $this->status->setCode(204);
        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => $e->getMessage())
            );
            $this->status->setCode(404);
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

        $this->view->POST = array(
            'description' => '',
            'params' => array(
                'erabiltzaileaId' => array(
                    'type' => 'mediumint',
                    'required' => false,
                    'comment' => '',
                ),
                'titulua' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'deskribapenLaburra' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'deskribapena' => array(
                    'type' => 'mediumtext',
                    'required' => true,
                    'comment' => '',
                ),
                'bisitaKopurua' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
                'urteakNoiztik' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'urteakNoizarte' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'egoera' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[enum:onartzeko|onartua|ezOnartua|blokeatuta]',
                ),
                'url' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[urlIdentifier:titulua]',
                ),
                'sortzeData' => array(
                    'type' => 'timestamp',
                    'required' => true,
                    'comment' => '',
                ),
                'karma' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
            )
        );

        $this->view->PUT = array(
            'description' => '',
            'params' => array(
                'id' => array(
                    'type' => 'mediumint',
                    'required' => true,
                    'comment' => '[pk]',
                ),
                'erabiltzaileaId' => array(
                    'type' => 'mediumint',
                    'required' => false,
                    'comment' => '',
                ),
                'titulua' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'deskribapenLaburra' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'deskribapena' => array(
                    'type' => 'mediumtext',
                    'required' => true,
                    'comment' => '',
                ),
                'bisitaKopurua' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
                'urteakNoiztik' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'urteakNoizarte' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'egoera' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[enum:onartzeko|onartua|ezOnartua|blokeatuta]',
                ),
                'url' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[urlIdentifier:titulua]',
                ),
                'sortzeData' => array(
                    'type' => 'timestamp',
                    'required' => true,
                    'comment' => '',
                ),
                'karma' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
            )
        );
        $this->view->DELETE = array(
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