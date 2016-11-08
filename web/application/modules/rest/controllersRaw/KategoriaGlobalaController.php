<?php
/**
 * KategoriaGlobala
 */

use Klikasi\Model as Models;
use Klikasi\Mapper\Sql as Mappers;

class Rest_KategoriaGlobalaController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="KategoriaGlobala", description="GET information about all KategoriaGlobala")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kategoria-globala/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'izena': '', 
     *     'url': '', 
     *     'className': '', 
     *     'irudia': ''
     * },{
     *     'id': '', 
     *     'izena': '', 
     *     'url': '', 
     *     'className': '', 
     *     'irudia': ''
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
                'izena',
                'url',
                'className',
                //'irudiaUrl:@profile', Cambia @profile por el profile del fso.ini
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

        $etag = $this->_cache->getEtagVersions('KategoriaGlobala');

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

        $mapper = new Mappers\KategoriaGlobala();

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
     * @ApiDescription(section="KategoriaGlobala", description="Get information about KategoriaGlobala")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kategoria-globala/{id}")
     * @ApiParams(name="id", type="mediumint", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'izena': '', 
     *     'url': '', 
     *     'className': '', 
     *     'irudia': ''
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
                'url',
                'className',
                //'irudiaUrl:@profile', Cambia @profile por el profile del fso.ini
            );
        }

        $etag = $this->_cache->getEtagVersions('KategoriaGlobala');
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

        $mapper = new Mappers\KategoriaGlobala();
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
     * @ApiDescription(section="KategoriaGlobala", description="Create's a new KategoriaGlobala")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/kategoria-globala/")
     * @ApiParams(name="izena", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="url", nullable=false, type="varchar", sample="", description="[urlIdentifier:izena]")
     * @ApiParams(name="className", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="irudia", nullable=true, type="int", sample="", description="[FSO]")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/kategoriaglobala/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\KategoriaGlobala();

        try {
            if (!empty($_FILES['irudia'])) {
                $irudia = $_FILES['irudia'];
                $model->putIrudia($irudia['tmp_name'], $irudia['name']);
            }

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
     * @ApiDescription(section="KategoriaGlobala", description="Table KategoriaGlobala")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/kategoria-globala/")
     * @ApiParams(name="id", nullable=false, type="mediumint", sample="", description="")
     * @ApiParams(name="izena", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="url", nullable=false, type="varchar", sample="", description="[urlIdentifier:izena]")
     * @ApiParams(name="className", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="irudia", nullable=true, type="int", sample="", description="[FSO]")
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

        $mapper = new Mappers\KategoriaGlobala();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        try {
            if (!empty($_FILES['irudia'])) {
                $irudia = $_FILES['irudia'];
                $model->putIrudia($irudia['tmp_name'], $irudia['name']);
            }

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
     * @ApiDescription(section="KategoriaGlobala", description="Table KategoriaGlobala")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/kategoria-globala/")
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

        $mapper = new Mappers\KategoriaGlobala();
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
                'izena' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'url' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[urlIdentifier:izena]',
                ),
                'className' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'irudia' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '[FSO]',
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
                'izena' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'url' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[urlIdentifier:izena]',
                ),
                'className' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'irudia' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '[FSO]',
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