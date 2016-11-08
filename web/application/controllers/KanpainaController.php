<?php
use Klikasi\Mapper\Sql as Mapper;

class KanpainaController extends Zend_Controller_Action
{
    protected $_templates;

    public function init()
    {
        $this->_helper->layout->setLayout('simple');
        $this->_templates = Zend_Registry::get(
            'mustacheTemplates'
        )->_mustacheTemplates;
    }

    public function historikoaAction()
    {
        $kanpainaMapper = new Mapper\Kanpaina;

        $where = "kanpaina = 1 and egoera = 1 and bukaera < now()";
        $kanpainak = $kanpainaMapper->fetchList($where, 'hasiera desc');

        $kanpainakData = array();
        $position = 0;
        foreach ($kanpainak as $kanpaina) {

            $url = 'orriak/kanpainak/orria/' . $kanpaina->getUrl();

            $banner = '';
            if ($kanpaina->getBanerraFileSize()) {
                $banner = 'image/index/id/'. $kanpaina->getId() .'/view/kanpaina/size/featured/banner/1';
            } else if ($kanpaina->getIrudiaFileSize()) {
                $banner = 'image/index/id/'. $kanpaina->getId() .'/view/kanpaina/size/featured/banner/1';
            }

            $kanpainakData[] = array(
                'class' => 'col-sm-4 text-center',
                'title' => $kanpaina->getIzena(),
                'url' => $url,
                'type-image-text' => '1',
                'image' => $banner,
                'alt' => $kanpaina->getIzena(),
            );
        }

        $this->view->kanpainak = $kanpainakData;
    }
}