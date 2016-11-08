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
class Erabiltzailea extends Raw\Erabiltzailea
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {

    }

    /**
     * Check for usarname not exist and not empty
     * @param String $name
     */
    public function erabiltzaileIzenaIsValid($name)
    {

        $result = array(
            'status' => true,
            'errors' => array()
        );

        if (trim($name) == '') {
            $result['status'] = false;
            $result['errors'] = 'Erabiltzaile izena betetzea beharrezkoa da';
            return $result;
        }

        $strpbrk = strpbrk($name, ' ');

        if ($strpbrk !== false) {
            $result['status'] = false;
            $result['errors'] = 'Erabiltzailearen izena idazterakoan ezin dira hutsuneak egon';
            return $result;
        }

        if (strlen($name) < 5) {
            $result['status'] = false;
            $result['errors'] = '[es] el nombre de usaurio necesita minimo 5 caracteres';
            return $result;
        }

        $erabiltzailea = new \Klikasi\Mapper\Sql\Erabiltzailea();
        $exist = $erabiltzailea->findByField('erabiltzaileIzena', $name);

        if (!empty($exist)) {
            $result['status'] = false;
            $result['errors'] = '[es] el nombre de usaurio ya esta registrado';
            return $result;
        }

        return $result;

    }

    /**
     * Check for email not exist and is valid.
     * @param String $email
     * @param Boolean $isNew
     * @return Array
     */
    public function emailIsValid($email, $isNew = false)
    {

        $result = array(
            'status' => true,
            'errors' => array()
        );

        if (trim($email) == '') {
            $result['status'] = false;
            $result['errors'] = 'Posta betetzea beharrezkoa da';
            return $result;
        }

        $options = array(
            'allow' => \Zend_Validate_Hostname::ALLOW_DNS,
            'mx' => true,
            'deep' => true,
        	'domain' => false,
        );

        $validator = new \Zend_Validate_EmailAddress($options);

        if (!$validator->isValid($email)) {
            $result['status'] = false;
            $result['errors'] = 'Posta elektronikoko helbidea ez da zuzena';
            return $result;
        }

        if ($isNew) {

            $erabiltzailea = new \Klikasi\Mapper\Sql\Erabiltzailea();
            $exist = $erabiltzailea->findByField('posta', $email);

            if (!empty($exist)) {
                $result['status'] = false;
                $result['errors'] = '[es] este email ya esta registrado.';
                return $result;
            }
        }

        return $result;

    }

    public function passwordIsValid($password)
    {

        $result = array(
            'status' => true,
            'errors' => array()
        );

        if (trim($password) == '') {
            $result['status'] = false;
            $result['errors'] = 'Pasahitza betetzea beharrezkoa da';
            return $result;
        }

        $strpbrk = strpbrk($password, ' ');

        if ($strpbrk !== false) {
            $result['status'] = false;
            $result['errors'] = '[es] la contraseña no puede tener espacios';
            return $result;
        }

        if (strlen($password) < 5) {
            $result['status'] = false;
            $result['errors'] = '[es] la contraseña necesita minimo 5 caracteres';
            return $result;
        }

        return $result;

    }

    public function jaiotzeDataIsValid($age)
    {

        $result = array(
            'status' => true,
            'errors' => array()
        );

        if (trim($age) == '') {
            $result['status'] = false;
            $result['errors'] = 'Jaiotze data betetzea beharrezkoa da';
            return $result;
        }

        return $result;

    }

    /**
     * Comprueba que los datos del primer formulario de registro sean validos.
     */
    public function registrationIsValid($postData)
    {

        $status = true;
        $errors = array();

        $erabiltzaileIzenaIsValid = $this->erabiltzaileIzenaIsValid($postData['erabiltzailea']);
        if ($erabiltzaileIzenaIsValid['status'] === false) {
            $status = false;
            $errors[] = $erabiltzaileIzenaIsValid['errors'];
        }

        $emailIsValid = $this->emailIsValid($postData["posta"], true);
        if ($emailIsValid['status'] === false) {
            $status = false;
            $errors[] = $emailIsValid['errors'];
        }

        $passwordIsValid = $this->passwordIsValid($postData['pasahitza']);
        if ($passwordIsValid['status'] === false) {
            $status = false;
            $errors[] = $passwordIsValid['errors'];
        }

        $jaiotzeDataIsValid = $this->jaiotzeDataIsValid($postData['jaiotzeData']);
        if ($jaiotzeDataIsValid['status'] === false) {
            $status = false;
            $errors[] = $jaiotzeDataIsValid['errors'];
        }

        return array(
            'status' => $status,
            'errors' => $errors
        );

    }

    /**
     * @return \Klikasi\Model\Raw\ErabiltzaileaSettings $settings
     */
    public function getNotifikazioSettings()
    {
        $settings = $this->getErabiltzaileaSettings();
        if (count($settings) > 0) {
            return current($settings);
        }

        return  new \Klikasi\Model\Raw\ErabiltzaileaSettings;
    }

    public function checkNotifikazioConfigPrivileges()
    {
        $institutoBerria = false; //Nuevo instituto
        $ikasleBerria = false; //Nuevo centro
        $edukiBerria = false; //Nuevo contenido
        $edukiariSalaketa = false; //Denuncia
        $iradokizunak = true; //Sugerencia

        if ($this->getSuperErabiltzailea() === 1) {

            $institutoBerria = true;
            $ikasleBerria = true;
            $edukiBerria = true;
            $edukiariSalaketa = true;

        } else if ($this->getProfila() == "irakasle") {

            $edukiariSalaketa = true;

            $where = '(jabea = 1 OR administratzailea = 1) AND egoera = "onartua"';
            $relIkastegia = $this->getErabiltzaileaRelIkastegia($where);

            if (count($relIkastegia) > 0) {
                $institutoBerria = true;
                $ikasleBerria = true;
                $edukiBerria = true;

            } else {

                $where = 'egoera = "onartua"';
                $relIkaslea = $this->getErabiltzaileaRelIrakasleaByIrakaslea($where);
                if (count($relIkaslea)) {

                    $ikasleBerria = true;
                    $edukiBerria = true;
                }
            }
        }

        $response = new \Klikasi\Model\ErabiltzaileaSettingsPrivileges;
        $response->setModerazioBerria($ikasleBerria)
                 ->setEdukiariSalaketa($edukiariSalaketa)
                 ->setIradokizunak($iradokizunak);

        return $response;
    }


    public function addProfileData($datuak)
    {
        $this->setIzena($datuak['izena'])
            ->setAbizena($datuak['abizena'])
            ->setAbizena2($datuak['abizena2'])
            ->setDeskribapena($datuak['deskribapena'])
            ->setJaiotzeData($datuak['jaiotzeData']);

        if (isset($datuak['pasahitza']) && $datuak['pasahitza'] != '') {
            $mapper = $this->getMapper();
            $pasahitza = $mapper->cryptValue($datuak['pasahitza']);
            $this->setPasahitza($pasahitza);
        }

        $this->save();
        return $this;
    }

    public function addNewProfileData($datuak)
    {
        $this->setIzena($datuak['izena'])
            ->setAbizena($datuak['abizena'])
            ->setAbizena2($datuak['bigarrenAbizena'])
            ->setDeskribapena($datuak['deskribapena'])
            ->setEgoera('aktibatua')
            ->save();

        // Ikastegia bidaltzen bada erlazionatu
        if (isset($datuak['ikastegia']) && $datuak['ikastegia'] != '') {
            $erlazioa = new \Klikasi\Model\ErabiltzaileaRelIkastegia();
            $erlazioa->setErabiltzaileaId($this->getId())
                ->setIkastegiaId($datuak['ikastegia'])
                ->setEgoera('onartzeko')
                ->save();
        }

        // Irakaslea bidaltzen bada erlazionatu
        if (isset($datuak['irakaslea']) && $datuak['irakaslea'] != '') {
            $irakaslea = new \Klikasi\Model\ErabiltzaileaRelIrakaslea();
            $irakaslea->setErabiltzaileaId($this->getId())
                ->setIrakasleaId($datuak['irakaslea'])
                ->setEgoera('onartzeko')
                ->save();
        }

        return $this;
    }

    public function setAvatar(\Klikasi\Model\ErabiltzaileenIrudiak $avatar)
    {
        $this->setIrudiaId($avatar->getId())->save();
    }

    public function getCompletName()
    {
        if (!$this->getIzena()
            && !$this->getAbizena()) {
            return $this->getErabiltzaileIzena();
        }
        $izenOsoa = $this->getIzena();
        if ($this->getAbizena()) {
            $izenOsoa .= ' ' . $this->getAbizena();
        }
        if ($this->getAbizena2()) {
            $izenOsoa .= ' ' . $this->getAbizena2();
        }
        return $izenOsoa;
    }

    public function isSenior()
    {

        $jaio = new \Zend_Date($this->getJaiotzeData(), 'yyyy-MM-dd');

        $gaur = \Zend_Date::now();
        $diff = $jaio->sub($gaur)->toValue();
        $days = floor((($diff/60)/60)/24);

        return (abs(floor($days/365)) > 14) ? true : false;

    }

    protected function _salt()
    {

        $salt = "";

        for ($i = 0; $i < 22; $i++) {
            $salt .= substr("./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789", mt_rand(0, 63), 1);
        }

        return $salt;

    }

    public function cryptValue($password)
    {

        $strength = "08";
        $salt = $this->_salt();
        $ret = crypt($password, "$2a$" . $strength . "$" . $salt . "$");

        return $ret;

    }

    public function atseginDutArray()
    {
        $atseginDutArray = array();

        if (sizeof($this->getAtseginDut()) > 0) {
            foreach ($this->getAtseginDut() as $atseginDut) {
                $atseginDutArray[] = $atseginDut->getEdukiaId();
            }
        }

        return $atseginDutArray;

    }

    public function gustokoArray()
    {
        $gustokoArray = array();

        if (sizeof($this->getGustokoa()) > 0) {
            foreach ($this->getGustokoa() as $gustokoa) {
                $gustokoArray[] = $gustokoa->getEdukiaId();
            }
        }

        return $gustokoArray;

    }

    public function urlProfile()
    {

        $view = new \Zend_View();

        $url = $view->url(
            array(
                'controller' => 'erabiltzaileak',
                'action' => 'ikusi',
                'erabiltzailea' => $this->getUrl()
            ),
            'default',
            true
        );

        return $url;

    }

    public function urlIrudia()
    {

        $view = new \Zend_View();
        $irudia = $this->getIrudia();

        if ($irudia) {
            $url = $view->url(
                array(
                    'controller' => 'multimedia',
                    'action' => 'erabiltzaile-irudia',
                    'irudia' => $irudia->getIden()
                ),
                'default',
                true
            );
        } else {
            $url = $view->baseUrl() . '/holder.js/340x165';
        }

        return $url;

    }

    public function avatarView($width = 200, $inline = false)
    {

        $html = '';

        $type = $this->getTypeAvatar();

        if ($type == 'default') {

            $color = $this->getIrudiaDefault();

            switch ($this->getProfila()) {
                case 'irakasle':
                    $class = 'perfil-irakasle';
                    break;
                case 'ikasle':
                    $class = 'perfil-ikasle';
                    break;
                case 'otros':
                    $class = 'perfil-ikastegi';
                    break;
            }

            $style = '';
            if ($inline) {
                $style = 'style="font-size: initial;"';
            }

            $html = '<span class="' . $color . ' perfil ' . $class . '" ' . $style . '></span>';

        } elseif ($type == 'irudia') {

            $img = $this->getIrudia();

            if ($img) {

                $view = new \Zend_View();

                $url = $view->url(
                    array(
                        'controller' => 'multimedia',
                        'action' => 'erabiltzaile-irudia',
                        'irudia' => $img->getIden()
                    ),
                    'default',
                    true
                );

                $html = '<img
                            class="img-circle"
                            src="' . $url . '"
                            width="' . $width . '"
                            alt="' . $this->getCompletName() . '"
                            />';

            }

        }

        return $html;

    }

    public function avatarData()
    {

        $data = array();

        $type = $this->getTypeAvatar();
        $data['type'] = $type;

        if ($type == 'default') {

            $color = $this->getIrudiaDefault();

            switch ($this->getProfila()) {
                case 'irakasle':
                    $class = 'perfil-irakasle';
                    break;
                case 'ikasle':
                    $class = 'perfil-ikasle';
                    break;
                case 'otros':
                    $class = 'perfil-ikastegi';
                    break;
            }

            $data['color'] = $color;
            $data['classProfila'] = $class;

        } elseif ($type == 'irudia') {

            $img = $this->getIrudia();

            if ($img) {

                $data['isIrudia'] = true;

                $view = new \Zend_View();
                $data['irudiaUrl'] = $view->url(
                    array(
                        'controller' => 'multimedia',
                        'action' => 'erabiltzaile-irudia',
                        'irudia' => $img->getIden()
                    ),
                    'default',
                    true
                );

            } else {
                $data['isIrudia'] = false;
            }

        }

        return $data;

    }

    /**
     * @param boolean $status
     * @return return de los recursos que a escrito.
     * $status == true  Lista todos los recursos.
     * $status == false Lista los recursos validados.
     */
    public function nireEdukiak($status = false)
    {
        $edukiak = array();
        $edukiakList = $this->getEdukia();

        if (sizeof($edukiakList) > 0) {
            if ($status) {
                $edukiak = $edukiakList;
            } else {
                foreach ($edukiakList as $edukiakModel) {
                    if ($edukiakModel->getEgoera() == 'onartua') {
                        $edukiak[] = $edukiakModel;
                    }
                }
            }

        }

        return $edukiak;

    }

    /**
     * @return en los que es colanorador valido.
     */
    public function kolaboratzailea()
    {

        $edukiak = array();
        $edukiakRelList = $this->getErabiltzaileaRelEdukia();

        if (sizeof($edukiakRelList) > 0) {
            foreach ($edukiakRelList as $edukiakRel) {
                if ($edukiakRel->getEgoera() == 'onartua') {
                    if ($edukiakRel->getEdukia()->getEgoera() == 'onartua') {
                        $edukiak[] = $edukiakRel->getEdukia();
                    }
                }
            }
        }

        return $edukiak;

    }

    /**
     * @param boolean $status
     * @return de los comentarios que a escrito y han validado.
     * $status == true  Lista todos los comentarios.
     * $status == false Lista los comentarios validados.
     */
    public function nireIruzkinak($status = false)
    {

        $iruzkinak = array();
        $iruzkinakList = $this->getIruzkina();

        if (sizeof($iruzkinakList) > 0) {
            foreach ($iruzkinakList as $iruzkina) {

                if ($iruzkina->getEgoera() == 'onartua') {
                    $iruzkinak[] = $iruzkina;
                }
            }
        }

        return $iruzkinak;

    }

    /**
     * @return de los recursos que tiene agregados como favoritos.
     */
    public function nireGustokoak()
    {

        $gustokoak = array();
        $gustokoaKRelList = $this->getGustokoa();
        if (sizeof($gustokoaKRelList) > 0) {
            foreach ($gustokoaKRelList as $gustokoaRel) {
                $gustokoak[] = $gustokoaRel->getEdukia();
            }
        }

        return $gustokoak;

    }

    /**
     * @param boolean $irakasle
     * @return de los centros en los que esta relacionado y aceptado.
     */
    public function nireIkastegiak($irakasle = false)
    {

        $ikastegiak = array();
        $where = array();
        $where[] = 'egoera = "onartua"';
        $where[] = 'erabiltzaileaId = "' . $this->getId() . '"';

        if ($irakasle) {
            $where[] = '(administratzailea = "1" OR jabea = "1")';
        } else {
            $where[] = '(administratzailea = "0" AND jabea = "0")';
        }

        $ikastegiaRelMapper = new \Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia();
        $ikastegiaRelList = $ikastegiaRelMapper->fetchList(
            implode(' AND ', $where)
        );

        if (sizeof($ikastegiaRelList) > 0) {
            $ikastegiak = $ikastegiaRelList;
        }

        return $ikastegiak;

    }

    public function nireIkastegiakIds($irakasle = false)
    {

        $ikastegiakids = array();
        $where = array();
        $where[] = 'egoera = "onartua"';
        $where[] = 'erabiltzaileaId = "' . $this->getId() . '"';

        if ($irakasle) {
            $where[] = '(administratzailea = "1" OR jabea = "1")';
        } else {
            $where[] = '(administratzailea = "0" AND jabea = "0")';
        }

        $ikastegiaRelMapper = new \Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia();
        $ikastegiaRelList = $ikastegiaRelMapper->fetchList(
            implode(' AND ', $where)
        );

        $ikastegiak = array();
        if (sizeof($ikastegiaRelList) > 0) {
            foreach ($ikastegiaRelList as $ikastegiaRel) {
                $ikastegiak[] = $ikastegiaRel->getIkastegiaId();
            }
        }

        return $ikastegiak;

    }


    public function isValidPublicate()
    {

        if ($this->getEgoera() != 'aktibatua') {
            return false;
        }

        if ($this->getSuperErabiltzailea() === 1) {
            return true;
        }

        if ($this->getProfila() == 'irakasle') {
            return true;
        }

        if ($this->getProfila() == 'ikasle' && $this->isSenior()) {
            return true;
        } else {

            if ($this->isSenior()) {
                return true;
            } else {

                $where = array();
                $where['erabiltzaileaId = ?'] = $this->getId();
                $where['egoera = ?'] = 'onartua';

                $relIrakaslea = new \Klikasi\Mapper\Sql\ErabiltzaileaRelIrakaslea();
                $relIrakasleaList = $relIrakaslea->fetchList($where);

                if (sizeof($relIrakasleaList) == 0) {
                    return false;
                } else {
                    foreach ($relIrakasleaList as $relIrakaslea) {
                        if ($relIrakaslea->getIkastegia()->getAktibatua() === 1) {
                            return true;
                        }
                    }
                    return false;
                }
            }
        }

        if ($this->getProfila() == 'otros' && $this->isSenior()) {
            return true;
        }

        return false;

    }

    /**
     * Usuarios que deben validar este contenido.
     * Si no hay resultados auto-aprobar
     * @return array of Klikasi\Model\Erabiltzailea
     */
    public function getEdukiBatenModeratzaileak(Edukia $edukia, $getAll = false)
    {
        if ($this->getSuperErabiltzailea() && !$getAll) {
            return array();
        }

        $edukiModeratzaileak = array();
        $edukiaRelIkastegiak = $edukia->getEdukiaRelIkastegia(null, null, true);

        if (!is_null($edukiaRelIkastegiak)) {

            //Mis profesores en el centro relacionado
            foreach ($edukiaRelIkastegiak as $edukiaRelIkastegia) {

                $ikastegia = $edukiaRelIkastegia->getIkastegia();
                $irakasleakMapper = new \Klikasi\Mapper\Sql\ErabiltzaileaRelIrakaslea;

                if ($ikastegia) {

                    $where = "egoera = 'onartua' AND erabiltzaileaId = " . $edukia->getErabiltzaileaId() . " ";
                    $where .= "AND ikastegiaId = " . $ikastegia->getId();

                    $moderatzaileak = $irakasleakMapper->fetchList($where);

                    foreach ($moderatzaileak as $moderatzailea) {

                        if ($moderatzailea->getIrakasleaId() == $this->getId() && !$getAll) {
                            return array();
                        }

                        $edukiModeratzaileak[] = $moderatzailea->getIrakaslea();
                    }
                }
            }

            if (!empty($edukiModeratzaileak) && !$getAll) {
                return $edukiModeratzaileak;
            }

            foreach ($edukiaRelIkastegiak as $edukiaRelIkastegia) {

                //Administradores o dueños del centro seleccionado
                $ikastegia = $edukiaRelIkastegia->getIkastegia();
                if ($ikastegia) {

                    $moderatzaileak = $ikastegia->getErabiltzaileaRelIkastegia("(administratzailea = 1 OR jabea = 1) AND egoera='onartua'");
                    foreach ($moderatzaileak as $moderatzailea) {

                        if ($moderatzailea->getErabiltzaileaId() == $this->getId() && !$getAll) {
                            return array();
                        }

                        $edukiModeratzaileak[] = $moderatzailea->getErabiltzailea();
                    }
                }
            }
        }

        if (!empty($edukiModeratzaileak) && !$getAll) {
            return $edukiModeratzaileak;
        }

        if ($getAll) {
            return ($this->_getSuperErabiltzaileak() + $edukiModeratzaileak);
        }
        return $this->_getSuperErabiltzaileak();
    }

    /**
     * usuarios con niveles de administración superiores al mio
     * @return array of Klikasi\Model\Erabiltzailea
     */
    public function nireModeratzaileak()
    {
        if ($this->getSuperErabiltzailea()) {
            return array();
        }

        if ($this->getProfila() !== 'irakasle') {

            $irakasleak = $this->getErabiltzaileaRelIrakasleaByIrakaslea();
            if (!empty($irakasleak)) {
                return $irakasleak;
            }
        }

        $erabiltzaileaRelIkastegiak = $this->getErabiltzaileaRelIkastegia();
        if (!empty($erabiltzaileaRelIkastegiak)) {

            $arduradunak = array();
            foreach ($erabiltzaileaRelIkastegiak as $erabiltzaileaRelIkastegia) {

                $ikastegia = $erabiltzaileaRelIkastegia->getIkastegia();
                $tmp = $ikastegia->nireAdmins();

                foreach ($tmp as $key =>$arduraduna) {
                    $arduradunak[$key] = $arduraduna;
                }

            }

            if (!empty($arduradunak)) {
                return $arduradunak;
            }
        }

        return $this->_getSuperErabiltzaileak();
    }

    public function datuPertsonalakIsValid($post)
    {

        $status = true;
        $erros = array();

        if (empty(trim($post['izena']))) {
            $status = false;
            $erros['izena'] = 'Izena ezin da hutsik egon.';
        }

        if (empty(trim($post['abizena']))) {
            $status = false;
            $erros['abizena'] = 'Abizena ezin da hutsik egon.';
        }

        if (empty(trim($post['abizena2']))) {
            $status = false;
            $erros['abizena2'] = 'Bigarren abizena ezin da hutsik egon.';
        }

        if (empty(trim($post['deskribapena']))) {
            $status = false;
            $erros['deskribapena'] = 'Deskribapena ezin da hutsik egon.';
        }

        if (empty(trim($post['posta']))) {
            $status = false;
            $erros['posta'] = 'Posta ezin da hutsik egon.';
        }

        if (strlen($post['deskribapena']) > 140) {
            $status = false;
            $erros['deskribapena'] = '[es] deskribapena no puede tener mas de 140 caracteres.';
        }

        if (!empty(trim($post['pasahitza']))) {

            $passwordIsValid = $this->passwordIsValid($post['pasahitza']);
            if (!$passwordIsValid['status']) {
                $status = false;
                $erros['pasahitza'] = $passwordIsValid['errors'];
            }

            if ($post['pasahitza'] != $post['pasahitzaBaieztatu']) {
                $status = false;
                $erros['pasahitzaBaieztatu'] = 'Pasahitza ez da berdina.';
            }

        }

        if (empty(trim($post['jaiotzeData']))) {
            $status = false;
            $erros['jaiotzeData'] = 'Jaiotze data ezin da hutsik egon.';
        }

        return array(
            'status' => $status,
            'errors' => $erros
        );

    }

    public function datuPertsonalak($post)
    {

        $this->setIzena($post['izena']);
        $this->setAbizena($post['abizena']);
        $this->setAbizena2($post['abizena2']);
        $this->setJaiotzeData($post['jaiotzeData']);
        $this->setDeskribapena($post['deskribapena']);
        $this->setPosta($post['posta']);
        $this->setNewsletter($post['newsletter']);

        if (!empty(trim($post['pasahitza']))) {
            $mapper = $this->getMapper();
            $pasahitza = $mapper->cryptValue($post['pasahitza']);
            $this->setPasahitza($pasahitza);
        }

    }

    protected function _getSuperErabiltzaileak()
    {
        $erabiltzaileaMapper = new \Klikasi\Mapper\Sql\Erabiltzailea;
        $administratzaileak = $erabiltzaileaMapper->fetchList("superErabiltzailea = 1");
        return $administratzaileak;

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

        if (isset($postData['google'])) {
            if (trim($postData['google']) != '') {
                $isValid = \Zend_Uri::check($postData['google']);
                if ($isValid) {
                    $this->setGoogle($postData['google']);
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
     * Última camapaña ganada por el usuario
     * @return null | Klikasi\Model\Kanpaina
     */
    public function getLastTrophy()
    {
        if (!$this->getId()) {
            return null;
        }

        $edukiakIds = array();
        $edukiak = $this->getEdukia();

        foreach ($edukiak as $edukia) {
            $edukiakIds[] = $edukia->getId();
        }

        if (empty($edukiakIds)) {
            return null;
        }

        $edukiaRelKanpainaMapper = new \Klikasi\Mapper\Sql\EdukiaRelKanpaina;
        $irabazlea = $edukiaRelKanpainaMapper->fetchList('edukiaId in ('. implode(',', $edukiakIds) .') and irabazlea = 1', 'id desc', 1);

        if (!$irabazlea) {
            return null;
        }

        return $irabazlea->getKanpaina();
    }

    public function authData()
    {

        $data = array();
        $data['id'] = $this->getId();
        $data['izena'] = $this->getIzena();
        $data['abizena'] = $this->getAbizena();
        $data['abizena2'] = $this->getAbizena2();
        $data['deskribapena'] = $this->getDeskribapena();
        $data['erabiltzaileIzena'] = $this->getErabiltzaileIzena();
        $data['posta'] = $this->getPosta();
        $data['jaiotzeData'] = $this->getJaiotzeData();
        $data['profila'] = $this->getProfila();
        $data['twitter'] = $this->getTwitter();
        $data['facebook'] = $this->getFacebook();
        $data['google'] = $this->getGoogle();
        $data['linkedin'] = $this->getLinkedin();
        $data['pinterest'] = $this->getPinterest();
        $data['flickr'] = $this->getFlickr();
        $data['youtube'] = $this->getYoutube();
        $data['instagram'] = $this->getInstagram();

        return $data;

    }

}