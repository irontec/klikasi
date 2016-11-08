<?php
/**
 * Menu  superior con los datos y las notificaciones del usuarios registrado
 * un enlace al formulario de login.
 * @author dani
 *
 */

class Zend_View_Helper_ErabiltzaileMenua extends Zend_View_Helper_Abstract
{
    protected $_erabiltzailea;

    public function __construct()
    {

        $this->_erabiltzailea = false;
        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity() && $auth->getIdentity() instanceof \Klikasi\Model\Erabiltzailea) {
            $this->_erabiltzailea = $auth->getIdentity();
        }

    }

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function ErabiltzaileMenua()
    {
        if ($this->_erabiltzailea) {
            return $this->_drawUserMenu();
        } else {
            return $this->_drawLogin();
        }
    }

    protected function _drawLogin()
    {

        $html = '';

        $url = $this->view->baseUrl('sartu');

        $html .= '<li class="icon-login">';
            $html .= '<a href=' . $url . '>';
                $html .= 'Saioa hasi';
            $html .= '</a>';
        $html .= '</li>';

        return $html;

    }

    protected function _drawUserMenu()
    {

        $html = '';

        $imgProfile = $this->erabiltzaileIrudia(
            $this->_erabiltzailea,
            22,
            "img-circle"
        );

        $jakinarazpenak = $this->_jakinarazpenak();

        $html .= $this->_likes($jakinarazpenak["likes"]);
        $html .= $this->_comments($jakinarazpenak["comments"]);
        $html .= $this->_messages($jakinarazpenak["messages"]);

        $html .= '<li class="dropdown mi-cuenta">';

            $html .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                $html .= $this->_erabiltzailea->getCompletName();
                $html .= ' ';
                $html .= $imgProfile;
                $html .= '<b class="caret"></b>';
            $html .= "</a>";

            $html .= '<ul class="dropdown-menu">';
                $html .= $this->_profile();
                //$html .= $this->_comments($jakinarazpenak["comments"], true);
                $html .= $this->_favorites($jakinarazpenak["favorites"], true);
                //$html .= $this->_likes($jakinarazpenak["likes"], true);
                $html .= $this->_notifications($jakinarazpenak["all"], true);
                //$html .= $this->_messages($jakinarazpenak["messages"], true);
                $html .= '<li class="divider"></li>';
                $html .= $this->_logout();

            $html .= "</ul>";

        $html .= "</li>";

        return $html;

    }

    protected function _likes($count, $literal = false)
    {

        $dataLikes = array(
            "controller" => "jakinarazpenak",
            "action" => "index",
            'mota' => 'atsegin-dut'
        );
        $urlLikes = $this->view->url($dataLikes, 'default', true);

        $html = '';
        $html .= '<li class="icon-login">';
            $html .= '<a href="' . $urlLikes . '" title="Atsegin Dut">';
                $html .= '<span class="glyphicon glyphicon-heart-empty"></span>';
                if ($literal) {
                    $html .= 'Atsegin dut';
                }
                if ($count > 0) {
                    $html .= '<span class="cantidad">' . $count . '</span>';
                }
            $html .= '</a>';
        $html .= '</li>';

        return $html;

    }

    protected function _messages($count, $literal = false)
    {

        $dataComments = array(
            "controller" => "mezuak"
        );
        $urlComments = $this->view->url($dataComments, 'default', true);

        $html = '';
        $html .= '<li class="icon-login">';
            $html .= '<a href="' . $urlComments . '" title="Mezuak">';
                $html .= '<i class="fa fa-envelope-o"></i>';
                if ($literal) {
                    $html .= 'Mezuak';
                }
                if ($count > 0) {
                    $html .= '<span class="cantidad">' . $count . '</span>';
                }
            $html .= '</a>';
        $html .= '</li>';

        return $html;

    }

    protected function _comments($count, $literal = false)
    {

        $dataComments = array(
            "controller" => "jakinarazpenak",
            "action" => "index",
            'mota' => 'iruzkin-berria'
        );
        $urlComments = $this->view->url($dataComments, 'default', true);

        $html = '';
        $html .= '<li class="icon-login">';
            $html .= '<a href="' . $urlComments . '" title="Iruzkin Berria">';
                $html .= '<i class="fa fa-comments"></i>';
                if ($literal) {
                    $html .= 'Iruzkinak';
                }
                if ($count > 0) {
                    $html .= '<span class="cantidad">' . $count . '</span>';
                }
            $html .= '</a>';
        $html .= '</li>';

        return $html;

    }

    protected function _favorites($count, $literal = false)
    {

        $dataFavorites = array(
            "controller" => "jakinarazpenak",
            "action" => "index",
            'mota' => 'gustoko-berria'
        );
        $urlFavorites = $this->view->url($dataFavorites, 'default', true);

        $html = '';
        $html .= '<li class="icon-login">';
            $html .= '<a href="' . $urlFavorites . '" title="Gustoko Berria">';
                $html .= '<i class="glyphicon glyphicon-star"></i>';
                if ($literal) {
                    $html .= 'Gogokoak';
                }
                if ($count > 0) {
                    $html .= '<span class="cantidad">' . $count . '</span>';
                }
            $html .= '</a>';
        $html .= '</li>';

        return $html;

    }

    protected function _notifications($count)
    {

        $dataNotifications = array(
            'controller' => 'jakinarazpenak',
            'action' => 'index',
        );

        $urlNotifications = $this->view->url(
            $dataNotifications,
            "default",
            true
        );

        $html = '';
        $html .= '<li class="icon-login">';
            $html .= '<a href="' . $urlNotifications . '">';
                $html .= '<i class="fa fa-globe"></i>';
                $html .= 'Jakinarazpenak';
                if ($count > 0) {
                    $html .= '<span class="cantidad">' . $count . '</span>';
                }
            $html .= '</a>';
        $html .= '</li>';

        return $html;

    }

    protected function _profile()
    {

        $dataProfile = array(
            "controller" => "erabiltzaileak",
            "action" => "ikusi",
            "erabiltzailea" => $this->_erabiltzailea->getUrl()
        );
        $urlProfile = $this->view->url($dataProfile, 'default', true);

        $imgProfile = $this->erabiltzaileIrudia(
            $this->_erabiltzailea,
            20,
            "img-circle"
        );

        $html = '';
        $html .= '<li>';
            $html .= '<a href="' . $urlProfile . '" class="perfil">';
                $html .= $imgProfile;
                $html .= $this->_erabiltzailea->getCompletName();
            $html .= '</a>';
        $html .= '</li>';

        return $html;

    }

    protected function _logout()
    {

        $dataLogout = array(
            "controller" => "sartu",
            "action" => "irten"
        );
        $urlLogout = $this->view->url($dataLogout, 'default', true);

        $html = '';
        $html .= '<li class="icon-login">';
            $html .= '<a href="' . $urlLogout . '" title="Saioa Itxi">';
                $html .= '<span class="glyphicon glyphicon-log-out"></span>';
                $html .= 'Saioa Itxi';
            $html .= '</a>';
        $html .= '</li>';

        return $html;

    }

    public function erabiltzaileIrudia(
        Klikasi\Model\Erabiltzailea $erabiltzailea,
        $width = 200,
        $class = 'img-thumbnail'
    )
    {

        $html = '';

        $type = $erabiltzailea->getTypeAvatar();

        if ($type == 'default') {

            $color = $erabiltzailea->getIrudiaDefault();

            switch ($erabiltzailea->getProfila()) {
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

            $html = '<span class="avatar ' . $color . ' perfil ' . $class . '"></span>';

        } elseif ($type == 'irudia') {

            $img = $erabiltzailea->getIrudia();

            if ($img) {

                $url = $this->view->baseUrl(
                    'multimedia/erabiltzaile-irudia/irudia/' . $img->getIden()
                );

                $html = '<img class="avatar ' . $class . '" src="' . $url . '" width="' . $width . 'px" />';

            }

        }

        return $html;

    }

    protected function _jakinarazpenak()
    {

        $jakinarazpenakResults = array(
            'likes' => 0,
            'comments' => 0,
            'favorites' => 0,
            'messages' => 0,
            'all' => 0
        );

        $erabiltzailea = $this->_erabiltzailea;

        $where = array(
            'erabiltzaileaId = ?' => $this->_erabiltzailea->getId(),
            'ikusita = ?' => 0,
            'motaId != ?' => 6
        );

        $jakinarazpenak = new \Klikasi\Mapper\Sql\Jakinarazpenak();
        $jakinarazpenak = $jakinarazpenak->fetchList($where);

        $whereMezuak = array(
            'noriId = ?' => $this->_erabiltzailea->getId(),
            'ikusita = ?' => 1,
        );

        $mezuak = new \Klikasi\Mapper\Sql\Mezuak();
        $mezuak = $mezuak->fetchList($whereMezuak);

        $jakinarazpenakResults['messages'] = sizeof($mezuak);

        if (empty($jakinarazpenak)) {
            return $jakinarazpenakResults;
        }

        foreach ($jakinarazpenak as $model) {

            if ($model->getMotaId() == 11) {
                $jakinarazpenakResults['likes'] = $jakinarazpenakResults['likes'] + 1;
            } elseif ($model->getMotaId() == 5) {
                $jakinarazpenakResults['comments'] = $jakinarazpenakResults['comments'] + 1;
            } elseif ($model->getMotaId() == 9) {
                $jakinarazpenakResults['favorites'] = $jakinarazpenakResults['favorites'] + 1;
            }

            $jakinarazpenakResults['all'] = $jakinarazpenakResults['all'] + 1;

        }

        return $jakinarazpenakResults;

    }

}
