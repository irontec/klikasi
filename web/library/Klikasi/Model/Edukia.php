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
class Edukia extends Raw\Edukia
{

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function kategoriak()
    {
        $kategoriak = array();
        $kategoriakRelList = $this->getEdukiaRelKategoria();

        if (sizeof($kategoriakRelList) > 0) {
            foreach ($kategoriakRelList as $kategoriakRel) {
                $kategoriak[] = $kategoriakRel->getKategoria();
            }
        }

        return $kategoriak;
    }

    public function kategoriaGlobala()
    {
        $kategoriak = array();
        $globalReturn = array();
        $kategoriakRelList = $this->getEdukiaRelKategoria();

        if (sizeof($kategoriakRelList) > 0) {
            $global = reset($kategoriakRelList)->getKategoria();
            $globalFirst = reset($global->getKategoriakRelKategoriaGlobalak());
            if (sizeof($globalFirst) > 0) {
                $globalReturn = $globalFirst->getKategoriaGlobala();
            }
        }

        return $globalReturn;
    }

    public function edukiaUrl()
    {
        $view = new \Zend_View();

        $url = $view->url(
            array(
                'controller' => 'edukiak',
                'action' => 'ikusi',
                'edukia' => $this->getUrl()
            ),
            'default',
            true
        );

        return $url;
    }

    public function toTemplateListArray($size = 'list')
    {
        $kategoria = $this->kategoriaFirst();
        $ikastegia = $this->ikastegiaOnartuaFirst();

        $infoEdukia = array(
            'moreViews' => $this->getBisitaKopurua(),
            'moreLikes' => sizeof($this->getAtseginDut()),
            'countComments' => $this->iruzkinaCount(),
            'sortzeData' => $this->getSortzeData()
        );

        if (!$kategoria) {
            return null;
        }

        $irudia = $this->irudiaRand($size);
        $modelData = array(
            'edukiaIrudiaUrl' => $irudia,
            'fullImageWidth' => true, //strpos($irudia, 'pinterest') > -1 ? true : false,
            'edukiaIzena' => $this->getTitulua(),
            'edukiaUrl' => $this->edukiaUrl(),
            'kategoriaGlobalaClassName' => $this->kategoriaGlobala() ? $this->kategoriaGlobala()->getClassName() : '',
            'kategoriaUrl' => $kategoria->kategoriaUrl(),
            'kategoriaIzena' => $kategoria->getIzena(),
            'edukiaDeskribapenLaburra' => $this->getDeskribapenLaburra(),
            'edukiaUrteakNoizarte' => $this->getUrteakNoizarte(),
            'edukiaUrteakNoiztik' => $this->getUrteakNoiztik(),
            'edukiaErabiltzaileaIzena' =>  $this->getErabiltzailea() ? $this->getErabiltzailea()->getCompletName() : '',
            'edukiaErabiltzaileaUrl' => $this->getErabiltzailea() ? $this->getErabiltzailea()->urlProfile() : '',
            'mailaIzena' => $this->mailaFirst(),
            'icon-list' => $this->iconsList(),
            'infoEdukia' => $infoEdukia
        );

        if (!empty($ikastegia)) {
            $modelData['ikastegiaIzena'] = $ikastegia->getIzena();
            $modelData['ikastegiaUrl'] = $ikastegia->ikastegiaUrl();
        }

        return $modelData;
    }

    public function ikastegiaOnartuaFirst()
    {
        $ikastegia = array();
        $ikastegiakRelList = $this->getEdukiaRelIkastegia();

        if (sizeof($ikastegiakRelList) > 0) {
            foreach ($ikastegiakRelList as $ikastegiakRel) {
                if ($ikastegiakRel->getEgoera() == 'onartua') {
                    $ikastegia = $ikastegiakRel->getIkastegia();
                    return $ikastegia;
                }
            }
        }

        return $ikastegia;
    }

    public function mailaFirst()
    {
        $maila = '';
        $mailaRelList = $this->getEdukiaRelMaila();

        if (sizeof($mailaRelList) > 0) {
            foreach ($mailaRelList as $mailaRel) {
                $maila = $mailaRel->getMaila()->getIzena();
                return $maila;
            }
        }

        return $maila;
    }

    public function kategoriaFirst()
    {
        $kategoria = array();
        $kategoriaRelList = $this->getEdukiaRelKategoria();

        if (sizeof($kategoriaRelList) > 0) {
            foreach ($kategoriaRelList as $kategoriaRel) {
                $kategoria = $kategoriaRel->getKategoria();
                return $kategoria;
            }
        }

        return $kategoria;
    }

    public function iconsList()
    {
        $iconsList = array();

        if (sizeof($this->getFitxategia()) > 0) {
            $iconsList[] = array(
                'iconIzena' => 'fitxategia',
                'icon' => 'fa-file-o'
            );
        }

        if (sizeof($this->getIrudia()) > 0) {
            $iconsList[] = array(
                'iconIzena' => 'irudia',
                'icon' => 'fa-camera-retro'
            );
        }

        if (sizeof($this->getBideoa()) > 0) {
            $iconsList[] = array(
                'iconIzena' => 'bideoa',
                'icon' => 'fa-film'
            );
        }

        if (sizeof($this->getAurkezpena()) > 0) {
            $iconsList[] = array(
                'iconIzena' => 'aurkezpena',
                'icon' => 'fa-desktop'
            );
        }

        if (sizeof($this->getEsteka()) > 0) {
            $iconsList[] = array(
                'iconIzena' => 'esteka',
                'icon' => 'fa-external-link'
            );
        }

        return $iconsList;
    }

    public function irudiaRand($size)
    {
        $view = new \Zend_View();

        $irudiaUrl = $this->_parseIrudiakAndGetThumbnail(
            $this->getIrudia(null, 'FIELD(mota, "flickr") desc')
        );

        if (is_null($irudiaUrl)) {
        	$irudiaUrl = $this->_parseAurkezpenakAndGetThumbnail(
        		$this->getAurkezpena()
        	);
        }

        if (is_null($irudiaUrl)) {
            //youtube
             $irudiaUrl = $this->_parseBideoakAndGetThumbnail(
                $this->getBideoa()
            );
        }

        if (empty($irudiaUrl)) {

            if ($size == 'relatedArticles') {
                $irudiaUrl = "defaults/default-360x175.png";
            } elseif ($size == 'homePage') {
                $irudiaUrl = "defaults/default-263x128.png";
            } elseif ($size == 'list') {
                $irudiaUrl = "defaults/default-350x234.png";
            }
        }

        return $irudiaUrl;
    }

    protected function _parseBideoakAndGetThumbnail(array $bideoak)
    {
        if (empty($bideoak)) {
            return null;
        }

        $randomBideoaKey = array_rand($bideoak, 1);
        $bideoa = $bideoak[$randomBideoaKey];
        $mota = $bideoa->getMota();

        $embedHelper = new \Klikasi_Controller_Action_Helper_EmbedExternal;

        if ($mota === "youtube") {

        	$videoId = $embedHelper->youtubeUrlMatch($bideoa->geturl());

        	return "http://img.youtube.com/vi/{$videoId}/mqdefault.jpg";

        } else {

        	return $embedHelper->getVimeoThumbnail($bideoa->geturl());
        }

    }

    /**
     * @return string or null if empty
     */
    protected function _parseAurkezpenakAndGetThumbnail(array $aurkezpenak)
    {
        if (empty($aurkezpenak)) {
            return null;
        }

        $randomAurkezpenaKey = array_rand($aurkezpenak, 1);
        $aurkezpena = $aurkezpenak[$randomAurkezpenaKey];
        $url = $aurkezpena->getUrl();

        if (empty($url)) {
            null;
        }

        $mota = $aurkezpena->getMota();
        if ($mota === "slideshare") {

        	preg_match_all('/src=".*slideshare.*[^"]+\/([0-9]+)[^0-9|^"]*"/', $url, $match);

        	if (count($match) > 1 && isset($match[1][0])) {
        		return 'multimedia/slideshare/id/' . $match[1][0];
        	}

        } else {

        	$pattern  = '#^(?:https?://|//)?';
        	$pattern .= '(?:www\.)?';
        	$pattern .= '(issuu\.com/)';
        	$pattern .= '(.*)/docs/(.*)#i';

        	preg_match_all($pattern, $url, $match);

        	if (count($match) > 1 && isset($match[1][0])) {

        		$embedHelper = new \Klikasi_Controller_Action_Helper_EmbedExternal;

        		return $embedHelper->getIssuuThumbnail($url);
        	}
        }

        return null;
    }

    /**
     * @return string or null if empty
     */
    protected function _parseIrudiakAndGetThumbnail(array $irudiak)
    {
        $irudiaUrl = null;
        $pinterest = array();

        foreach ($irudiak as $key => $val) {
            if ($val->getMota() == "pinterest") {
                $pinterest[$key] = $irudiak[$key];
                unset($irudiak[$key]);
            }
        }

        if (sizeof($irudiak) > 0) {
            $keyIrudia = array_rand($irudiak, 1);
            $irudia = $irudiak[$keyIrudia];
            $irudiaUrl = $irudia->getUrl();

        } else if (sizeof($pinterest) > 0) {

            $keyIrudia = array_rand($pinterest, 1);
            $url = $pinterest[$keyIrudia]->getUrl();

            if (!empty($url)) {

                preg_match_all('/data-ref="([^"]*)"/', $url, $match);

                if (count($match) > 1 && isset($match[1][0])) {
                    @list($iden, $album) = explode("/", $match[1][0]);

                    if (!empty($album)) {
                        $irudiaUrl = 'multimedia/pinterest/id/' . $iden . "/album/" . $album;
                    } else {
                        $irudiaUrl = 'multimedia/pinterest/id/' . $iden;
                    }
                }
            }
        }

        return $irudiaUrl;
    }

    public function iruzkinaCount()
    {
        $iruzkinaCount = 0;
        $iruzkinak = $this->getIruzkina();

        if (sizeof($iruzkinak) > 0) {
            foreach ($iruzkinak as $iruzkina) {
                if ($iruzkina->getEgoera() == "onartua") {
                    $iruzkinaCount++;
                }
            }
        }

        return $iruzkinaCount;
    }

    /**
     * Lista los comentarios que esten 'Aceptados' o 'Pendientes'
     */
    public function iruzkinakList()
    {
        $iruzkinak = new \Klikasi\Mapper\Sql\Iruzkina();

        $whereList = array();
        $whereList[] = 'edukiaId="' . $this->getId() .  '"';
        $whereList[] = 'egoera != "ezOnartua"';
        $iruzkinaList = $iruzkinak->fetchList(
            implode(' AND ', $whereList)
        );

        return $iruzkinaList;
    }

    /**
     * Id's de los erabiltzailea relacionados con este recurso y aceptados.
     * (propietario y colaboradores)
     */
    public function erabiltzaileakRelIds()
    {
        $erabiltzaileaIds = array();
        $erabiltzaileaIds[] = $this->getErabiltzailea()->getId();
        $erabiltzaileaRelList = $this->getErabiltzaileaRelEdukia();

        if (sizeof($erabiltzaileaRelList) > 0) {
            foreach ($erabiltzaileaRelList as $erabiltzaileaRel) {
                if ($erabiltzaileaRel->getEgoera() == 'onartua') {
                    $erabiltzaileaIds[] = $erabiltzaileaRel->getErabiltzailea()->getId();
                }
            }
        }

        return $erabiltzaileaIds;
    }

    /**
     * Lista las relaciones de los colaboradores de este recurso.
     * $all | TRUE => Lista todas las relaciones de colaboradores
     * $all | FALSE => Lista las relaciones de colaboradores acepatados.
     * @param Boolean $all
     * @return Array Models|Empty
     */
    public function laguntzaileak($all = false)
    {
        $relMapper = new \Klikasi\Mapper\Sql\ErabiltzaileaRelEdukia();

        $where = array(
            'edukiaId = ? ' => $this->getId()
        );

        if (!$all) {
            $where['egoera = ? '] = 'baieztatua';
        }

        $relEdukiaList = $relMapper->fetchList($where);

        if (sizeof($relEdukiaList) > 0) {
            return $relEdukiaList;
        } else {
            return array();
        }
    }

    /**
     * Comprueba que el titlulo no sea empty
     */
    public function isValidTitulua($titulua)
    {
        $result = true;

        if (trim($titulua) == '') {
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
     * Con los params de un formulario, comprueba que todo este correcto.
     */
    public function isValidForm($params, $currentUser)
    {
        $status = true;
        $errorMessages = array();

        $titulua = $this->isValidTitulua(
            $params['titulua']
        );
        if ($titulua !== true) {
            $status = false;
            $errorMessages['titulua'] = $titulua;
        }

        $deskribapenLaburra = $this->isValidDeskribapenLaburra(
            $params['deskribapenLaburra']
        );
        if ($deskribapenLaburra !== true) {
            $status = false;
            $errorMessages['deskribapenLaburra'] = $deskribapenLaburra;
        }

        $deskribapen = $this->isValidDeskribapena(
            $params['deskribapena']
        );
        if ($deskribapen !== true) {
            $status = false;
            $errorMessages['deskribapena'] = $deskribapen;
        }

        if (!isset($params['kategoriak'])) {
            $status = false;
            $errorMessages['kategoriak'] = 'Kategoria ezin da hutsik egon.';
        }

        if (!$currentUser->isSenior() || !$currentUser->isValidPublicate()) {
            if (!isset($params['eskola']) || empty($params['eskola'])) {

                $status = false;
                $errorMessages['eskola'] = "Eskola ezin da hutsik egon";

            } else {

                $erabiltzaileaRelIkastegiaMapper = new \Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia;
                $query = array(
                    "egoera = 'onartua' and erabiltzaileaId = ?" => $currentUser->getPrimaryKey(),
                    "ikastegiaId = ? " => $params['eskola']
                );

                $erabiltzaileaRelIkastegia = $erabiltzaileaRelIkastegiaMapper->countByQuery($query);
                if (empty($erabiltzaileaRelIkastegia)) {
                    $status = false;
                }
            }
        }

        return array(
            'status' => $status,
            'errors' => $errorMessages
        );
    }

    /**
     * Comprueba si es la categoria que llega es la misma que ya tiene, de ser asi hace un return.
     * de lo contratio, elimina las relaciones existentes y crea una con la nueva kategoria.
     * @param String|Int $kategoriak
     */
    public function saveKategoriaRel($kategoriak)
    {
        $kategoriaRelList = $this->getEdukiaRelKategoria();
        $matched = array();
        foreach ($kategoriaRelList as $key => $katRel) {

            if (in_array($katRel->getId(), $kategoriak)) {
                $matched[] = $katRel->getId();
                unset($kategoriaRelList[$key]);
            } else {
                $matched[] = $katRel->getId();
                $kategoriaRelList[$key]->delete();
            }
        }

        foreach ($kategoriak as $kategoria) {

            if (!in_array($kategoria, $matched)) {
                $model = new \Klikasi\Model\EdukiaRelKategoria;
                $model->setEdukiaId($this->getId())
                      ->setKategoriaId($kategoria)
                      ->save();
            }
        }

        /*
        if ($kategoriak == $currentKatId) {
            return;
        }

        foreach ($kategoriaRelList as $kategoriaRel) {
            $kategoriaRel->delete();
        }

        $newRelKategoria = new \Klikasi\Model\EdukiaRelKategoria();
        $newRelKategoria->setEdukiaId($this->getId());
        $newRelKategoria->setKategoriaId($kategoriak);
        $newRelKategoria->save();
        */
    }

    /**
     * Comprueba si "Maila" que llega es la misma que ya tiene, de ser asi hace un return.
     * de lo contratio, elimina las relaciones existentes y crea una con la nueva "Maila".
     * @param String|Int $kategoriak
     */
    public function saveMailaRel($maila)
    {
        $mailaRelList = $this->getEdukiaRelMaila();
        $currentMailaId = current($mailaRelList)->getMailaId();

        if ($maila == $currentMailaId) {
            return;
        }

        foreach ($mailaRelList as $mailaRel) {
            $mailaRel->delete();
        }

        $newRelMaila = new \Klikasi\Model\EdukiaRelMaila();
        $newRelMaila->setEdukiaId($this->getId());
        $newRelMaila->setMailaId($maila);
        $newRelMaila->save();
    }

    /**
     * Elimina las relaciones con las etiquetas actuales.
     * Seguido comprueba los valores que tiene $etiketak
     * Si es numérico, crea la relación.
     * si es string crea la nueva etiqueta y crea la realación.
     * @param String|Int $kategoriak
     */
    public function saveEtiketakRel($etiketak)
    {
        $etiketaRelList = $this->getEtiketaRelEdukia();

        if (!empty($etiketaRelList)) {
            foreach ($etiketaRelList as $etiketaRel) {
                $etiketaRel->delete();
            }
        }

        if (!empty($etiketak)) {

            $etiketaList = explode(',', $etiketak);

            foreach ($etiketaList as $etiketa) {

                $etiketaRelModel = new \Klikasi\Model\EtiketaRelEdukia();

                if (is_numeric($etiketa)) {
                    $etiketaRelModel->addRel(
                        $etiketa,
                        $this->getId()
                    );
                } else {
                    $etiketaRelModel->newEtiketaAddRel(
                        $etiketa,
                        $this->getId()
                    );
                }

                $etiketaRelModel->save();

            }
        }
    }

    /**
     * Comprueba si a seleccionado un centro.
     * Si hay uno selecciondo comprueba si es el mismo que tiene actualmente.
     * Si es un nuevo centro. comprueba que privilegios tiene sobre ese centro,
     * con lo que se envia o no una solicitud para compartirlo.
     * @param String $eskola
     * @param Session $currentUser
     */
    public function saveEskolaRel($eskola, $currentUser)
    {
        $ikastegiaRelList = $this->getEdukiaRelIkastegia();

        if (isset($eskola) && is_numeric($eskola)) {

            $ikastegiaId = 0;

            if (!empty($ikastegiaRelList)) {
                $ikastegiaId = current($ikastegiaRelList)->getIkastegiaId();
            }

            if ($ikastegiaId != $eskola) {

                if (!empty($ikastegiaRelList)) {
                    foreach ($ikastegiaRelList as $ikastegiaRel) {
                        $ikastegiaRel->delete();
                    }
                }

                $edukiaRelIkastegia = new \Klikasi\Model\EdukiaRelIkastegia();
                $edukiaRelIkastegia
                    ->setIkastegiaId($eskola)
                    ->setEdukiaId($this->getId())
                    ->setEgoera('onartzeko');

                $moderatzaileak = $currentUser->getEdukiBatenModeratzaileak($this);

                if (empty($moderatzaileak)) {

                    $isAdmin = true;
                    $egoera = 'onartua';

                    $this->setEgoera($egoera);
                    $this->save();

                    $edukiaRelIkastegia->setEgoera($egoera);
                }

                $edukiaRelIkastegia->save();
            }

        } else {
            if (!empty($ikastegiaRelList)) {
                foreach ($ikastegiaRelList as $ikastegiaRel) {
                    $ikastegiaRel->delete();
                }
            }
        }
    }

    public function saveKanpainaRel($kanpainaKodeak)
    {
        if (!$this->getId()) {
            return $this;
        }

        $kanpainaMapper = new \Klikasi\Mapper\Sql\Kanpaina;
        $edukiaRelKanpainaMapper = new \Klikasi\Mapper\Sql\EdukiaRelKanpaina;

        $activeKanpainaIds = array(0);
        $activeKanpaina = $kanpainaMapper->fetchList("kodea != '' and egoera = 1 and bukaera > now()");

        foreach ($activeKanpaina as $item) {
            $activeKanpainaIds[] = $item->getId();
        }

        $where = "edukiaId = " . $this->getId() . " and kanpainaId in (". implode(',', $activeKanpainaIds) .")";
        $edukiaRelKanpaina = $edukiaRelKanpainaMapper->fetchList($where);

        $kanpainaIdsInUse = array();
        $kanpainaIdsNotDeleteable = array();

        foreach ($edukiaRelKanpaina as $relKanpaina) {
            $kanpainaIdsInUse[$relKanpaina->getKanpainaId()] = $relKanpaina->getKanpainaId();

            if ($relKanpaina->getIrabazlea()) {
                $kanpainaIdsNotDeleteable[$relKanpaina->getKanpainaId()] = $relKanpaina->getKanpainaId();
            }
        }

        $kanpainaMapper = new \Klikasi\Mapper\Sql\Kanpaina;

        if (is_array($kanpainaKodeak))
        foreach ($kanpainaKodeak as $kanpainaKodea) {

            if (empty($kanpainaKodea)) {
                continue;
            }

            $kanpaina = $kanpainaMapper->findOneByField("kodea", $kanpainaKodea);

            if (in_array($kanpaina->getId(), $kanpainaIdsInUse)) {
                unset($kanpainaIdsInUse[$kanpaina->getId()]);
                continue;
            }

            $relKanpaina = new EdukiaRelKanpaina;
            $relKanpaina->setKanpainaId($kanpaina->getId())
                        ->setEdukiaId($this->getId())
                        ->save();
        }

        foreach ($kanpainaIdsInUse as $id) {

            if (in_array($id, $kanpainaIdsNotDeleteable)) {
                continue;
            }

            $relToDelete = $edukiaRelKanpainaMapper->fetchList('edukiaId = ' . $this->getId() . ' and kanpainaId = ' . $id);
            if (!empty($relToDelete)) {
                $relToDelete[0]->delete();
            }

        }

        return $this;
    }

    /**
     *
     * @param unknown_type $besteEgile
     */
    public function saveBesteEgile($besteEgile)
    {
        $besteEgileRelList = $this->getErabiltzaileaRelEdukia();

        if (!empty($besteEgile)) {

            if (!empty($besteEgileRelList)) {

                $besteEgileExp = array_map(
                    'intval',
                    explode(
                        ',',
                        $besteEgile
                    )
                );

                foreach ($besteEgileRelList as $besteEgileRel) {
                    $besteEgileId = $besteEgileRel->getErabiltzaileaId();

                    $key = array_search(
                        $besteEgileId,
                        $besteEgileExp
                    );

                    if ($key !== false) {
                        unset($besteEgileExp[$key]);
                    } else {
                        $besteEgileRel->delete();
                    }

                }

                if (!empty($besteEgileExp)) {
                    foreach ($besteEgileExp as $newBesteEgileId) {
                        $newBesteEgileModel = new \Klikasi\Model\ErabiltzaileaRelEdukia();
                        $newBesteEgileModel->setEdukiaId($this->getId());
                        $newBesteEgileModel->setErabiltzaileaId($newBesteEgileId);
                        $newBesteEgileModel->setEgoera('onartzeko');
                        $newBesteEgileModel->save();
                    }
                }

            } else {

                $besteEgileExp = array_map(
                    'intval',
                    explode(
                        ',',
                        $besteEgile
                    )
                );

                if (!empty($besteEgileExp)) {
                    foreach ($besteEgileExp as $newBesteEgileId) {
                        $newBesteEgileModel = new \Klikasi\Model\ErabiltzaileaRelEdukia();
                        $newBesteEgileModel->setErabiltzaileaId($newBesteEgileId);
                        $newBesteEgileModel->setEdukiaId($this->getId());
                        $newBesteEgileModel->setEgoera('onartzeko');
                        $newBesteEgileModel->save();
                    }
                }
            }

        } else {
            if (!empty($besteEgileRelList)) {
                foreach ($besteEgileRelList as $besteEgileRel) {
                    $besteEgileRel->delete();
                }
            }
        }
    }

    /**
     * $paramIrudia Post del formulario irudia[]
     * Elimina todas las relaciones existentes e insterta nuevas,
     * segun elementos tenga $paramIrudia que no sean empty.
     */
    public function saveIrudia($paramIrudia)
    {
        $irudiakList = $this->getIrudia();

        if (sizeof($irudiakList) > 0) {
            foreach ($irudiakList as $irudia) {
                $irudia->delete();
            }
        }

        if (sizeof($paramIrudia) > 0) {
            foreach ($paramIrudia as $newIrudia) {
                if (trim($newIrudia) != '') {
                    $irudiaNewModel = new \Klikasi\Model\Irudia();
                    $irudiaNewModel->setEdukiaId($this->getId());
                    $irudiaNewModel->setUrl($newIrudia);
                    $irudiaNewModel->save();
                }
            }
        }
    }

    /**
     * $paramBideoa Post del formulario bideoa[]
     * Elimina todas las relaciones existentes e insterta nuevas,
     * segun elementos tenga $paramBideoa que no sean empty.
     */
    public function saveBideoa($paramBideoa)
    {
        $bideoakList = $this->getBideoa();

        if (sizeof($bideoakList) > 0) {
            foreach ($bideoakList as $bideoa) {
                $bideoa->delete();
            }
        }

        if (sizeof($paramBideoa) > 0) {
            foreach ($paramBideoa as $newBideoa) {
                if (trim($newBideoa) != '') {
                    $bideoaNewModel = new \Klikasi\Model\Bideoa();
                    $bideoaNewModel->setEdukiaId($this->getId());
                    $bideoaNewModel->setUrl($newBideoa);
                    $bideoaNewModel->save();
                }
            }
        }
    }

    /**
     * $paramAurkezpena Post del formulario aurkezpena[]
     * Elimina todas las relaciones existentes e insterta nuevas,
     * segun elementos tenga $paramAurkezpena que no sean empty.
     */
    public function saveAurkezpena($paramAurkezpena)
    {
        $aurkezpenakList = $this->getAurkezpena();

        if (sizeof($aurkezpenakList) > 0) {
            foreach ($aurkezpenakList as $aurkezpena) {
                $aurkezpena->delete();
            }
        }
        if (sizeof($paramAurkezpena) > 0) {
            foreach ($paramAurkezpena as $newAurkezpena) {
                if (trim($newAurkezpena) != '') {
                    $aurkezpenaNewModel = new \Klikasi\Model\Aurkezpena();
                    $aurkezpenaNewModel->setEdukiaId($this->getId());
                    $aurkezpenaNewModel->setUrl($newAurkezpena);
                    $aurkezpenaNewModel->save();
                }
            }
        }
    }

    /**
     * $paramEsteka Post del formulario esteka[]
     * Elimina todas las relaciones existentes e insterta nuevas,
     * segun elementos tenga $paramEsteka que no sean empty.
     */
    public function saveEsteka($paramEsteka)
    {
        $estekakList = $this->getEsteka();

        if (sizeof($estekakList) > 0) {
            foreach ($estekakList as $esteka) {
                $esteka->delete();
            }
        }

        if (sizeof($paramEsteka) > 0) {
            foreach ($paramEsteka as $newEsteka) {
                if (trim($newEsteka) != '') {
                    $estekaNewModel = new \Klikasi\Model\Esteka();
                    $estekaNewModel->setEdukiaId($this->getId());
                    $estekaNewModel->setUrl($newEsteka);
                    $estekaNewModel->save();
                }
            }
        }
    }

    /**
     * $paramFitxategia Post del formulario fitxategia[]
     * Elimina todas las relaciones existentes e insterta nuevas,
     * segun elementos tenga $paramFitxategia que no sean empty.
     */
    public function saveFitxategiak($paramFitxategia)
    {
        $fitxategiakList = $this->getFitxategia();

        if (sizeof($fitxategiakList) > 0) {
            foreach ($fitxategiakList as $fitxategia) {
                $fitxategia->delete();
            }
        }

        if (sizeof($paramFitxategia) > 0) {
            foreach ($paramFitxategia as $newFitxategia) {
                if (trim($newFitxategia) != '') {
                    $fitxategiaNewModel = new \Klikasi\Model\Fitxategia();
                    $fitxategiaNewModel->setEdukiaId($this->getId());
                    $fitxategiaNewModel->setUrl($newFitxategia);
                    $fitxategiaNewModel->save();
                }
            }
        }
    }

    /**
     * Hace un set de los datos princilaes del Edukiak.
     * @param Array $postData
     * @param Int $erabiltzaileaId
     * @param Boolean $isNew
     */
    public function setPostData($postData, $erabiltzaileaId, $isNew = false)
    {
        $this->setTitulua(
            strip_tags(
                $postData['titulua']
            )
        );

        $this->setDeskribapenLaburra(
            strip_tags(
                $postData['deskribapenLaburra']
            )
        );

        $this->setDeskribapena(
            strip_tags(
                $postData['deskribapena']
            )
        );

        $adina = explode(',', $postData['adina']);

        $this->setUrteakNoiztik($adina[0]);
        $this->setUrteakNoizarte($adina[1]);

        $this->setErabiltzaileaId($erabiltzaileaId);

        if ($isNew) {
            $this->setEgoera('onartzeko');

            $now = new \Zend_Date();
            $now = $now
                    ->setTimezone('Europe/Madrid')
                    ->toString('yyyy-MM-dd HH:mm:ss');

            $this->setSortzeData($now);
        }
    }

    /**
     * Hacer un return de los id's de los recursos con etiquetas relacionadas.
     */
    public function edukiakRelatedEtiketak()
    {
        $edukiaIds = array();
        $tags = $this->getEtiketaRelEdukia();

        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $tagRels = $tag->getEtiketa()->getEtiketaRelEdukia();
                if (!empty($tagRels)) {
                    foreach ($tagRels as $tagRel) {
                        if ($tagRel->getEdukia()->getEgoera() == 'onartua') {
                            $edukiaIds[] = $tagRel->getEdukia()->getId();
                        }
                    }
                }
            }
        }

        $uniques = array_unique($edukiaIds);

        return $uniques;
    }

    /**
     * Hacer un return de los id's de los recursos con categorias relacionadas.
     */
    public function edukiakRelatedKategoriak()
    {
        $edukiaIds = array();
        $categories = $this->getEdukiaRelKategoria();

        if (!empty($categories)) {
            foreach ($categories as $category) {
                $categoryRels = $category->getKategoria()->getEdukiaRelKategoria();
                if (!empty($categoryRels)) {
                    foreach ($categoryRels as $categoryRel) {
                        if ($categoryRel->getEdukia()->getEgoera() == 'onartua') {
                            $edukiaIds[] = $categoryRel->getEdukia()->getId();
                        }
                    }
                }
            }
        }

        $uniques = array_unique($edukiaIds);

        return $uniques;
    }

    /**
     * Return de los 4 id's de los recursos que compartan categoria o etiquetas.
     */
    public function relatedEdukiak()
    {
        $orderIds = array();

        $edukiaIds = array_merge(
            $this->edukiakRelatedEtiketak(),
            $this->edukiakRelatedKategoriak()
        );

        $uniques = array_unique($edukiaIds);

        if (!empty($uniques)) {
            $sizeOf = sizeof($uniques);
            if ($sizeOf > 4) {
                $orderIds = $this->_arrayRandom(
                    array_unique($uniques),
                    4
                );
            } else {
                $orderIds = $this->_arrayRandom(
                    $uniques,
                    $sizeOf
                );
            }
        }

        if (!empty($uniques)) {
            return array_slice($orderIds, 0, 3);
        } else {
            return $orderIds;
        }
    }

    public function toArrayApiList()
    {

        $erabiltzailea = $this->getErabiltzailea();
        $irudia = $erabiltzailea->getIrudia();

        if (!empty($irudia)) {
            $irudiaUrl = 'multimedia/erabiltzaile-irudia/irudia/' . $irudia->getIden();
        } else {
            $irudiaUrl = 'placeholder.png';
        }

        $kategoria = $this->kategoriaFirst();
        $kategoriaGlo = $kategoria->getKategoriakRelKategoriaGlobalak();
        $kategoriaGlo = reset($kategoriaGlo);
        $kategoryClass = $kategoriaGlo->getKategoriaGlobala()->getClassName();

        $data = array(
            'id' => $this->getId(),
            'image' => $this->irudiaRand('list'),
            'urteakNoiztik' => $this->getUrteakNoiztik(),
            'urteakNoizarte' => $this->getUrteakNoizarte(),
            'kategoria' => array(
                'id' => $kategoria->getId(),
                'title' => $kategoria->getIzena(),
                'class' => $kategoryClass
            ),
            'titulua' => $this->getTitulua(),
            'deskribapenLaburra' => $this->getDeskribapenLaburra(),
            'deskribapena' => $this->getDeskribapena(),
            'erabiltzailea' => array(
                'id' => $erabiltzailea->getId(),
                'name' => $erabiltzailea->getCompletName(),
                'irudia' => $irudiaUrl
            ),
            'bisitaKopurua' => $this->getBisitaKopurua(),
            'likes' => sizeof($this->getAtseginDut()),
            'comentarios' => $this->iruzkinaCount(),
            'sortzeData' => $this->getSortzeData()
        );

        return $data;

    }

    public function toArrayApi()
    {

        $etiketakEdikia = array();
        $erabiltzailea = $this->getErabiltzailea();
        $irudia = $erabiltzailea->getIrudia();

        if (!empty($irudia)) {
            $irudiaUrl = 'multimedia/erabiltzaile-irudia/irudia/' . $irudia->getIden();
        } else {
            $irudiaUrl = 'placeholder.png';
        }

        $kategoria = $this->kategoriaFirst();
        $kategoriaGlo = $kategoria->getKategoriakRelKategoriaGlobalak();
        $kategoriaGlo = reset($kategoriaGlo);
        $kategoryClass = $kategoriaGlo->getKategoriaGlobala()->getClassName();
        $etiketak = $this->getEtiketaRelEdukia();

        if (!empty($etiketak)) {
            foreach ($etiketak as $etiketa) {
                $etiketa = $etiketa->getEtiketa();
                $etiketakEdikia[] = array(
                    'id' => $etiketa->getId(),
                    'izena' => $etiketa->getIzena()
                );
            }
        }

        $relatedEdukiak = array();
        $relatedIds = $this->relatedEdukiak();
        if (!empty($relatedIds)) {
            $where = 'id IN (' . implode(', ', $relatedIds) . ') AND egoera = "onartua"';
            $related = new \Klikasi\Mapper\Sql\Edukia();
            $relatedList = $related->fetchList($where);
            foreach ($relatedList as $relatedItem) {
                $relatedEdukiak[] = array(
                    'id' => $relatedItem->getId(),
                    'name' => $relatedItem->getTitulua(),
                    'image' => $relatedItem->irudiaRand('list')
                );
            }
        }

        $bideoak = array();
        $bideoas = $this->getBideoa();
        if (!empty($bideoas)) {
            foreach ($bideoas as $bideoa) {
                $bideoak[] = array(
                    'id' => $bideoa->getId(),
                    'url' => $bideoa->getUrl(),
                    'sortzeData' => $bideoa->getSortzeData(),
                    'mota' => $bideoa->getMota()
                );
            }
        }

        $irudiak = array();
        $irudias = $this->getIrudia();
        if (!empty($irudias)) {
            foreach ($irudias as $irudia) {
                $irudiak[] = array(
                    'id' => $irudia->getId(),
                    'url' => $irudia->getUrl(),
                    'sortzeData' => $irudia->getSortzeData(),
                    'mota' => $irudia->getMota()
                );
            }
        }

        $aurkezpenak = array();
        $aurkezpenaList = $this->getAurkezpena();
        if (!empty($aurkezpenaList)) {
            foreach ($aurkezpenaList as $aurkezpenaItem) {
                $aurkezpenak[] = array(
                    'id' => $aurkezpenaItem->getId(),
                    'url' => $aurkezpenaItem->getUrl(),
                    'sortzeData' => $aurkezpenaItem->getSortzeData(),
                    'mota' => $aurkezpenaItem->getMota()
                );
            }
        }

        $fitxategiak = array();
        $fitxategias = $this->getFitxategia();
        if (!empty($fitxategias)) {
            foreach ($fitxategias as $fitxategia) {
                $fitxategiak[] = array(
                    'id' => $fitxategia->getId(),
                    'url' => $fitxategia->getUrl(),
                    'sortzeData' => $fitxategia->getSortzeData(),
                    'mota' => $fitxategia->getMota()
                );
            }
        }

        $estekak = array();
        $estekas = $this->getEsteka();
        if (!empty($estekas)) {
            foreach ($estekas as $esteka) {
                $estekak[] = array(
                    'id' => $esteka->getId(),
                    'url' => $esteka->getUrl(),
                    'sortzeData' => $esteka->getSortzeData(),
                    'mota' => $esteka->getMota()
                );
            }
        }

        $data = array(
            'id' => $this->getId(),
            'image' => $this->irudiaRand('list'),
            'urteakNoiztik' => $this->getUrteakNoiztik(),
            'urteakNoizarte' => $this->getUrteakNoizarte(),
            'tags' => $etiketakEdikia,
            'kategoria' => array(
                'id' => $kategoria->getId(),
                'title' => $kategoria->getIzena(),
                'class' => $kategoryClass
            ),
            'titulua' => $this->getTitulua(),
            'deskribapenLaburra' => $this->getDeskribapenLaburra(),
            'deskribapena' => $this->getDeskribapena(),
            'erabiltzailea' => array(
                'id' => $erabiltzailea->getId(),
                'name' => $erabiltzailea->getCompletName(),
                'irudia' => $irudiaUrl
            ),
            'bisitaKopurua' => $this->getBisitaKopurua(),
            'likes' => sizeof($this->getAtseginDut()),
            'comentarios' => $this->iruzkinaCount(),
            'sortzeData' => $this->getSortzeData(),
            'relacionados' => $relatedEdukiak,
            'bideoak' => $bideoak,
            'irudiak' => $irudiak,
            'aurkezpenak' => $aurkezpenak,
            'fitxategiak' => $fitxategiak,
            'estekak' => $estekak
        );

        return $data;

    }

    /**
     * Function magica para sacar arrays en random
     */
    protected function _arrayRandom($arr, $num = 1)
    {
        shuffle($arr);
        $r = array();

        for ($i = 0; $i < $num; $i++) {
            $r[] = $arr[$i];
        }

        return $r;
    }
}