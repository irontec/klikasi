<?php
/**
 * Ikastegia
 */

use Klikasi\Model as Models;
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
        $orderParam = $this->getRequest()->getParam('order', false);
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

        $this->status->setCode(200);
        $this->addViewData($model->toArray($fields));

        if ($currentEtag !== false) {
            $this->_sendEtag($currentEtag);
        }

    }

    /**
     * @ApiDescription(section="Ikastegia", description="Create's a new Ikastegia")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/ikastegia/")
     * @ApiParams(name="izena", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="deskribapenLaburra", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="deskribapena", nullable=true, type="text", sample="", description="")
     * @ApiParams(name="herria", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="probintzia", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="kokapena", nullable=false, type="varchar", sample="", description="[map]")
     * @ApiParams(name="kokapenaLat", nullable=false, type="decimal", sample="", description="")
     * @ApiParams(name="kokapenaLng", nullable=false, type="decimal", sample="", description="")
     * @ApiParams(name="mota", nullable=false, type="varchar", sample="", description="[enum:ikastetxea|bestelakoa]")
     * @ApiParams(name="irudia", nullable=true, type="int", sample="", description="[FSO]")
     * @ApiParams(name="linkedin", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="facebook", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="twitter", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="google", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="youtube", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="instagram", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="pinterest", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="aktibatua", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="url", nullable=false, type="varchar", sample="", description="[urlIdentifier:izena]")
     * @ApiParams(name="webSite", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="sortzeData", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="karma", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="flickr", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="ikasleKopurua", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="edukiKopurua", nullable=false, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/ikastegia/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\Ikastegia();

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
     * @ApiDescription(section="Ikastegia", description="Table Ikastegia")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/ikastegia/")
     * @ApiParams(name="id", nullable=false, type="mediumint", sample="", description="")
     * @ApiParams(name="izena", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="deskribapenLaburra", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="deskribapena", nullable=true, type="text", sample="", description="")
     * @ApiParams(name="herria", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="probintzia", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="kokapena", nullable=false, type="varchar", sample="", description="[map]")
     * @ApiParams(name="kokapenaLat", nullable=false, type="decimal", sample="", description="")
     * @ApiParams(name="kokapenaLng", nullable=false, type="decimal", sample="", description="")
     * @ApiParams(name="mota", nullable=false, type="varchar", sample="", description="[enum:ikastetxea|bestelakoa]")
     * @ApiParams(name="irudia", nullable=true, type="int", sample="", description="[FSO]")
     * @ApiParams(name="linkedin", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="facebook", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="twitter", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="google", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="youtube", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="instagram", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="pinterest", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="aktibatua", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="url", nullable=false, type="varchar", sample="", description="[urlIdentifier:izena]")
     * @ApiParams(name="webSite", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="sortzeData", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="karma", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="flickr", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="ikasleKopurua", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="edukiKopurua", nullable=false, type="int", sample="", description="")
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

        $mapper = new Mappers\Ikastegia();
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
     * @ApiDescription(section="Ikastegia", description="Table Ikastegia")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/ikastegia/")
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

        $mapper = new Mappers\Ikastegia();
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
                'deskribapenLaburra' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'deskribapena' => array(
                    'type' => 'text',
                    'required' => false,
                    'comment' => '',
                ),
                'herria' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'probintzia' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'kokapena' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[map]',
                ),
                'kokapenaLat' => array(
                    'type' => 'decimal',
                    'required' => true,
                    'comment' => '',
                ),
                'kokapenaLng' => array(
                    'type' => 'decimal',
                    'required' => true,
                    'comment' => '',
                ),
                'mota' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[enum:ikastetxea|bestelakoa]',
                ),
                'irudia' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '[FSO]',
                ),
                'linkedin' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'facebook' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'twitter' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'google' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'youtube' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'instagram' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'pinterest' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'aktibatua' => array(
                    'type' => 'tinyint',
                    'required' => true,
                    'comment' => '',
                ),
                'url' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[urlIdentifier:izena]',
                ),
                'webSite' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
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
                'flickr' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'ikasleKopurua' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
                'edukiKopurua' => array(
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
                'izena' => array(
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
                    'type' => 'text',
                    'required' => false,
                    'comment' => '',
                ),
                'herria' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'probintzia' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'kokapena' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[map]',
                ),
                'kokapenaLat' => array(
                    'type' => 'decimal',
                    'required' => true,
                    'comment' => '',
                ),
                'kokapenaLng' => array(
                    'type' => 'decimal',
                    'required' => true,
                    'comment' => '',
                ),
                'mota' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[enum:ikastetxea|bestelakoa]',
                ),
                'irudia' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '[FSO]',
                ),
                'linkedin' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'facebook' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'twitter' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'google' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'youtube' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'instagram' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'pinterest' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'aktibatua' => array(
                    'type' => 'tinyint',
                    'required' => true,
                    'comment' => '',
                ),
                'url' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '[urlIdentifier:izena]',
                ),
                'webSite' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
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
                'flickr' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'ikasleKopurua' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
                'edukiKopurua' => array(
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