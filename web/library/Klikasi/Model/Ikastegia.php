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

class Ikastegia extends Raw\Ikastegia
{

    public function saveSuggestion($data)
    {
        $this->setIzena($data['izena'])
            ->setDeskribapenLaburra($data['deskribapenLaburra'])
            ->setDeskribapena($data['deskribapena'])
            ->setMota($data['mota'])
            ->setHerria($data['herria'])
            ->setProbintzia($data['probintzia'])
            ->setKokapena($data['kokapena'])
            ->setKokapenaLat($data['lat'])
            ->setKokapenaLng($data['lng']);

        return $this;
    }

    public function checkPostIsValid($postData)
    {
        $status = true;
        $errors = array();

        $izena = $this->isValidIzena($postData['izena']);
        if ($izena !== true) {
            $errors['izena'] = $izena;
            $status = false;
        }

        $deskribapenLaburra = $this->isValidDeskribapenLaburra($postData['deskribapenLaburra']);
        if ($deskribapenLaburra !== true) {
            $errors['deskribapenLaburra'] = $deskribapenLaburra;
            $status = false;
        }

        $deskribapen = $this->isValidDeskribapena($postData['deskribapena']);
        if ($deskribapen !== true) {
            $errors['deskribapena'] = $deskribapen;
            $status = false;
        }

        $irudia = $this->isValidIrudia($postData);
        if ($irudia !== true) {
            $errors['irudia'] = $irudia;
            $status = false;
        }

        $norZara = $this->isValidNorZara($postData['norZara']);
        if ($norZara !== true) {
            $errors['norZara'] = $norZara;
            $status = false;
        }

        $mota = $this->isValidIkastegiMota($postData);
        if ($mota !== true) {
            $errors['mota'] = $mota;
            $status = false;
        }

        return array(
            'status' => $status,
            'errors' => $errors
        );
    }

    public function isValidMota($mota, $ikastegiMota)
    {
        if (!$mota || ($mota == "Bestelakoa" && !$ikastegiMota)) {
            return 'Mota ezin da hutsik egon.';
        }

        return true;
    }

    /**
     * Comprueba que el nombre no sea empty
     */
    public function isValidIzena($izena)
    {

        $result = true;

        if (trim($izena) == '') {
            $result = 'Izenburua ezin da hutsik egon.';
        }

        return $result;

    }

    /**
     * Comprueba que la descripción corta no sea empty
     * Comprueba que la descripción corta sea mayor de 140 caracteres.
     */
    public function isValidDeskribapenLaburra($deskribapenLaburra)
    {

        $result = true;

        if (trim($deskribapenLaburra) == '') {
            $result = 'Deskribapen laburra ezin da hutsik egon.';
        }

        if (strlen($deskribapenLaburra) > 140) {
            $result = 'Deskribapen laburrak ezin du 140 karaktere baino gehiago eduki.';
        }

        return $result;

    }

    /**
     * Comprueba que la descripción no este empty
     */
    public function isValidDeskribapena($deskribapena)
    {

        $result = true;

        if (trim($deskribapena) == '') {
            $result = 'Baliabidea ezin da hutsik egon.';
        }

        return $result;

    }

    /**
     * Comprueba que irudia no sea empty
     */
    public function isValidIrudia($post)
    {
        $irudia = isset($post['irudia']) ? $post['irudia'] : null;
        $irudia2 = isset($post['tmpName']) ? $post['tmpName'] : null;

        $result = true;

        if (trim($irudia) == '' && trim($irudia2) == '') {
            $result = 'Irudia ezin da hutsik egon';
        }

        return $result;
    }

    /**
     * Comprueba que NorZara no sea empty
     */
    public function isValidNorZara($norZara)
    {
        $result = true;

        if (trim($norZara) == '') {
            $result = 'Eremu hau ezin da hutsik egon';
        }

        return $result;
    }

    /**
     * Comprueba que ikastegiMota no sea empty
     */
    public function isValidIkastegiMota($postData)
    {
        $result = true;
        $mota = isset($postData['mota']) ? $postData['mota'] : '';

        if (trim($mota) == '') {
            $result = 'Eremu hau ezin da hutsik egon';
        }

        return $result;
    }

    /**
     * Ikastegi batek dituen kategoriak bueltatu
     * @return multitype:NULL
     */
    public function fetchKategoriak()
    {
        $kategoriak = array();
        $edukiakRel = $this->getEdukiaRelIkastegia();

        if ($edukiakRel) {
            foreach ($edukiakRel as $eRel) {
                if ($eRel->getEgoera() == 'onartua') {
                    $edukia = $eRel->getEdukia();
                    if ($edukia->getEgoera() == 'onartua') {
                        $kategoriakRel = $edukia->getEdukiaRelKategoria();
                        if ($kategoriakRel) {
                            foreach ($kategoriakRel as $kRel) {
                                $kategoria = $kRel->getKategoria();
                                $kategoriak[$kategoria->getPrimarykey()] = $kategoria;
                            }
                        }
                    }
                }
            }
        }

        return $kategoriak;

    }

    /**
     * @return lista de usuarios aceptados
     */
    public function erabiltzaileakOnartua()
    {
        $erabiltzaileak = array();
        $erabiltzaileaRelList = $this->getErabiltzaileaRelIkastegia();

        if (sizeof($erabiltzaileaRelList) > 0) {
            foreach ($erabiltzaileaRelList as $erabiltzaileaRel) {
                if ($erabiltzaileaRel->getEgoera() == 'onartua') {
                    $erabiltzaileak[] = $erabiltzaileaRel->getErabiltzailea();
                }
            }
        }

        return $erabiltzaileak;
    }

    /**
     * @return lista de recursos aceptados
     */
    public function edukiakOnartua()
    {

        $edukiak = array();
        $edukiaRelList = $this->getEdukiaRelIkastegia();

        if (sizeof($edukiaRelList) > 0) {
            foreach ($edukiaRelList as $edukiaRel) {
                if ($edukiaRel->getEgoera() == 'onartua') {
                    $edukiak[] = $edukiaRel->getEdukia();
                }
            }
        }

        return $edukiak;

    }

    /**
     * @return lista de recursos pendientes
     */
    public function edukiakOnartzeko()
    {

        $edukiak = array();
        $edukiaRelList = $this->getEdukiaRelIkastegia();

        if (sizeof($edukiaRelList) > 0) {
            foreach ($edukiaRelList as $edukiaRel) {
                if ($edukiaRel->getEgoera() == 'onartzeko') {
                    $edukiak[] = $edukiaRel->getEdukia();
                }
            }
        }

        return $edukiak;

    }
    
    public function egileakUrl() {

        $view = new \Zend_View();
        
        $url = $view->url(
                array(
                        'controller' => 'ikastegiak',
                        'action' => 'egileak',
                        'ikastegia' => $this->getUrl()
                ),
                'default',
                true
                );
        
        return $url;
    }

    public function ikastegiaUrl()
    {

        $view = new \Zend_View();

        $url = $view->url(
            array(
                'controller' => 'ikastegiak',
                'action' => 'ikusi',
                'ikastegia' => $this->getUrl()
            ),
            'default',
            true
        );

        return $url;

    }

    public function ikastegiaIrudiaUrl($size)
    {

        $view = new \Zend_View();

        $irudiaUrl = $view->url(
            array(
                'controller' => 'image',
                'action' => 'index',
                'id' => $this->getId(),
                'view' => 'ikastegia',
                'size' => $size,
                ),
            'default',
            true
        );

        return $irudiaUrl;
    }

    public function toTemplateListArray()
    {
        $modelData = array(
            'irudiaUrl' => $this->ikastegiaIrudiaUrl('ikastegiaList'),
            'izena' => $this->getIzena(),
            'ikastegiaUrl' => $this->ikastegiaUrl(),
            'egileakUrl' => sizeof($this->edukiakOnartua()) > 0 ? $this->egileakUrl() : null,
            'autore' => sizeof($this->erabiltzaileakOnartua()),
            'edukiakCount' => sizeof($this->edukiakOnartua()),
            'kategoriak' => $this->_populateKategoriak()
        );

        return $modelData;
    }

    protected function _populateKategoriak()
    {
        $kategoriak = array();
        $kategoriakRelList = $this->fetchKategoriak();

        if (sizeof($kategoriakRelList) > 0) {
            $kategoriakSelected = array_slice($kategoriakRelList, 0, 3);

            foreach ($kategoriakSelected as $kategoria) {

                $firstRel = reset($kategoria->getKategoriakRelKategoriaGlobalak())->getKategoriaGlobala();

                $kategoriak[] = array(
                    'width' => 'col-xs-12 col-sm-4',
                    'class' => 'destacada',
                    'kategoriaIrudia' => $firstRel->kategoriaGlobalaIrudiaUrl('ikastegiaKategoria'),
                    'kategoriaUrl' => $kategoria->kategoriaUrl(),
                    'kategoriaIzena' => $kategoria->getIzena(),
                    'kategoriaEdukiakCount' => sizeof($kategoria->kategoriaEdukiak($this->getId())),
                    'kategoriaGlobalaClassName' => $firstRel->getClassName()
                );
            }

            return $kategoriak;

        } else {
            return $kategoriak;
        }

    }

    /**
     * @return Los Erabiltzailea que son Ikasleak Aceptados.
     */
    public function getIkasleak()
    {

        $where = array();
        $ikasleak = array();

        $where[] = 'ikastegiaId = "' . $this->getId() . '"';
        $where[] = 'egoera = "onartua"';
        $where[] = 'administratzailea = "0"';
        $where[] = 'jabea = "0"';

        $erabiltzaileaRelMapper = new \Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia();
        $erabiltzaileaRelList = $erabiltzaileaRelMapper->fetchList(
            implode(' AND ', $where)
        );

        if (sizeof($erabiltzaileaRelList) > 0) {
            foreach ($erabiltzaileaRelList as $erabiltzaileaRel) {
                $ikasleak[] = $erabiltzaileaRel->getErabiltzailea();
            }
        }

        return $ikasleak;

    }

    /**
     * @return Los Erabiltzailea que son Irakasleak Aceptados
     * como adminsitradores o propietarios.
     */
    public function getIrakasleak()
    {

        $where = array();
        $irakasleak = array();

        $where[] = 'ikastegiaId = "' . $this->getId() . '"';
        $where[] = 'egoera = "onartua"';
        $where[] = '( administratzailea = "1" OR jabea = "1" )';

        $erabiltzaileaRelMapper = new \Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia();
        $erabiltzaileaRelList = $erabiltzaileaRelMapper->fetchList(
            implode(' AND ', $where)
        );

        if (sizeof($erabiltzaileaRelList) > 0) {
            foreach ($erabiltzaileaRelList as $erabiltzaileaRel) {
                $irakasleak[] = $erabiltzaileaRel->getErabiltzailea();
            }
        }

        return $irakasleak;

    }

    public function nireAdmins()
    {

        $admins = array();
        $ikastegiRelIrakasle = $this->getErabiltzaileaRelIkastegia(
            '(administratzailea = 1 or jabea = 1) AND ikastegiaId = ' . intval($this->getId())
        );

        if (!empty($ikastegiRelIrakasle)) {
            foreach ($ikastegiRelIrakasle as $arduraduna) {
                $admins[$arduraduna->getId()] = $arduraduna->getErabiltzailea();
            }
        }

        return $admins;

    }

    public function setSocialNetworks($postData)
    {

        if (isset($postData['twitter'])) {
            if (trim($postData['twitter']) != '') {
                $isValid = \Zend_Uri::check($postData['twitter']);
                if ($isValid) {
                    $this->setTwitter($postData['twitter']);
                }
            }
        }

        if (isset($postData['facebook'])) {
            if (trim($postData['facebook']) != '') {
                $isValid = \Zend_Uri::check($postData['facebook']);
                if ($isValid) {
                    $this->setFacebook($postData['facebook']);
                }
            }
        }

        if (isset($postData['googlePlus'])) {
            if (trim($postData['googlePlus']) != '') {
                $isValid = \Zend_Uri::check($postData['googlePlus']);
                if ($isValid) {
                    $this->setGoogle($postData['googlePlus']);
                }
            }
        }

        if (isset($postData['linkedin'])) {
            if (trim($postData['linkedin']) != '') {
                $isValid = \Zend_Uri::check($postData['linkedin']);
                if ($isValid) {
                    $this->setLinkedin($postData['linkedin']);
                }
            }
        }

        if (isset($postData['pinterest'])) {
            if (trim($postData['pinterest']) != '') {
                $isValid = \Zend_Uri::check($postData['pinterest']);
                if ($isValid) {
                    $this->setPinterest($postData['pinterest']);
                }
            }
        }

        if (isset($postData['flickr'])) {
            if (trim($postData['flickr']) != '') {
                $isValid = \Zend_Uri::check($postData['flickr']);
                if ($isValid) {
                    $this->setFlickr($postData['flickr']);
                }
            }
        }

        if (isset($postData['youtube'])) {
            if (trim($postData['youtube']) != '') {
                $isValid = \Zend_Uri::check($postData['youtube']);
                if ($isValid) {
                    $this->setYoutube($postData['youtube']);
                }
            }
        }

        if (isset($postData['instagram'])) {
            if (trim($postData['instagram']) != '') {
                $isValid = \Zend_Uri::check($postData['instagram']);
                if ($isValid) {
                    $this->setInstagram($postData['instagram']);
                }
            }
        }
    }


    /**
     * Última camapaña ganada por cualquier alumno del centro
     * @return null | array(Klikasi\Model\erabiltzailea, Klikasi\Model\Kanpaina)
     */
    public function getLastTrophy()
    {
        if (!$this->getId()) {
            return null;
        }

        $edukiakIds = array();
        $edukiak = $this->getEdukiaRelIkastegia("egoera = 'onartua'");

        foreach ($edukiak as $edukia) {
            $edukiakIds[] = $edukia->getEdukiaId();
        }

        if (empty($edukiakIds)) {
            return null;
        }

        $edukiaRelKanpainaMapper = new \Klikasi\Mapper\Sql\EdukiaRelKanpaina;
        $irabazlea = $edukiaRelKanpainaMapper->fetchList('edukiaId in ('. implode(',', $edukiakIds) .') and irabazlea = 1', 'id desc', 1);

        if (!$irabazlea) {
            return null;
        }

        $edukia = $irabazlea->getEdukia();
        return array(
            'erabiltzailea' => $edukia->getErabiltzailea(),
            'kanpaina' => $irabazlea->getKanpaina()
        );
    }

}