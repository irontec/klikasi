<?php

/**
 * Application Model
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package Klikasi\Model
 * @subpackage Model
 * @author Irontec
 */

namespace Klikasi\Model;
class Kategoria extends Raw\Kategoria
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function kategoriaUrl()
    {

        $view = new \Zend_View();

        $kategoriaUrl = $view->url(
            array(
                'controller' => 'kategoriak',
                'action' => 'ikusi',
                'kategoria' => $this->getUrl()
                ),
            'default',
            true
        );

        return $kategoriaUrl;

    }

    public function kategoriaEdukiak($idIkastegiaFilter = null)
    {

        $edukiak = array();
        $edukiakRelList = $this->getEdukiaRelKategoria();

        if (sizeof($edukiakRelList) > 0) {
            foreach ($edukiakRelList as $edukiaRel) {
                if ($edukiaRel->getEdukia()->getEgoera() == 'onartua') {
                    $edukia = $edukiaRel->getEdukia();

                    if ($idIkastegiaFilter) {
                        $related = $edukia->getEdukiaRelIkastegia(
                            array(
                                'ikastegiaId' => intval($idIkastegiaFilter),
                                'egoera' => 'onartua'
                            )
                        );
                        if (!$related) {
                            continue;
                        }
                    }

                    $edukiak[] = $edukia;
                }
            }
        }

        return $edukiak;

    }

    public function kategoriaGlobala()
    {

        $kategoriaGlobala = array();

        $kategoriakRelList = $this->getKategoriakRelKategoriaGlobalak();
        if (sizeof($kategoriakRelList) > 0) {
            $kategoriaGlobala = $kategoriakRelList[0]->getKategoriaGlobala();
        }

        return $kategoriaGlobala;

    }

    public function edukiakBisitaKopuruaSum()
    {

        $bisitaKopurua = 0;

        if (sizeof($this->getEdukiaRelKategoria()) > 0) {
            foreach ($this->kategoriaEdukiak() as $edukia) {
                $bisitaKopurua = $bisitaKopurua +$edukia->getBisitaKopurua();
            }
        }

        return $bisitaKopurua;

    }

    public function edukiakSortzeData()
    {

        $sortzeData = '';

        if (sizeof($this->getEdukiaRelKategoria()) > 0) {
            foreach ($this->kategoriaEdukiak(null, 'sortzeData') as $edukia) {
                $sortzeData = $edukia->getSortzeData();
                break;
            }
        }

        return $sortzeData;

    }

}