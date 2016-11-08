<?php
/**
 * Saio hasteko botoiak edo erabiltzaile datuak
* erakusteko plugina
*
* @author arkaitz
*/

class Zend_View_Helper_IkastegiarekinErlazionatu extends Zend_View_Helper_Abstract
{
    protected $_erabiltzailea;

    public function __construct()
    {

        $this->_erabiltzailea = false;
        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $this->_erabiltzailea = $auth->getIdentity();
        }

    }

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function ikastegiarekinErlazionatu(Klikasi\Model\Ikastegia $ikastegia)
    {
        // Saioa hasi barik badago, ezer egin gabe itzuli
        if (!$this->_erabiltzailea) {
            return;
        }

        $html = '<div class="col-md-12">';
            $html .= '<h2>Erlazioa</h2>';
        // Erlazioa dagoen ikusi

        $erlazioMapper = new Klikasi\Mapper\Sql\ErabiltzaileaRelIkastegia();
        $erlazioa = $erlazioMapper->findOneByField(
            array(
                'ikastegiaId',
                'erabiltzaileaId'
            ),
            array(
                $ikastegia->getId(),
                $this->_erabiltzailea->getId()
            )
        );

        if ($erlazioa) {

            $egoera = 'Ikastegiarekin erlazionatuta';
            if ($erlazioa->getEgoera() == 'onartzeko') $egoera = 'Onartua izateko zain';
            $html .= '<p><span class="label label-primary">' . $egoera . '</span</p>';

        } else {

            $url = $this->view->serverUrl(
                $this->view->url(
                    array(
                        'controller' => 'ikastegiak',
                        'action' => 'erlazio-berria',
                        'ikastegia' => $ikastegia->getUrl()
                    ), '', true
                )
            ) . '?format=json';

            $html .= '<a id="ikastegiaErlazioBerria" data-url="' . $url . '" class="btn btn-primary">';
                $html .= 'Ikastegiarekin erlazionatu';
            $html .= '</a>';

        }

        $html .= '</div>';

        return $html;

    }

}