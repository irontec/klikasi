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
class Iruzkina extends Raw\Iruzkina
{

    protected $_now;
    protected $_currentUser;
    protected $_manualInit;

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {

    }

    protected function _manualInit()
    {

        $currentTime = new \Zend_Date();
        $this->_now = $currentTime->toString('yyyy-MM-dd HH:mm:ss');

        $currentUser = new \Klikasi_Controller_Action_Helper_SessionUser();
        $this->_currentUser = $currentUser->getSessionUser();

    }

    public function createIruzkina($datuak, $egoera)
    {

        $this->_manualInit();

        $this->setEdukiaId($datuak["edukiaId"]);
        if (trim($datuak['responseIruzkina']) != '') {
            $iruzkinaResponseId = str_replace(
                'iruzkina-',
                '',
                $datuak['responseIruzkina']
            );
            $this->setIruzkinaId($iruzkinaResponseId);
        }
        $this->setErabiltzaileaId($this->_currentUser->getId());
        $this->setIruzkin(
            strip_tags($datuak["comment"])
        );
        $this->setEgoera($egoera);
        $this->setSortzeData($this->_now);
        $this->save();

    }

    /**
     * Calcula hace cuanto tiempo se hiso el comentario.
     * @param String $sortzeData
     * @return string
     */
    public function dateComment()
    {

        $date = strtotime($this->getSortzeData());
        $currentTime = new \Zend_Date();
        $this->_now = $currentTime->toString('yyyy-MM-dd HH:mm:ss');
        
        $difference = strtotime($this->_now) - $date;
        $seconds = $difference;
        $minutes = round($difference / 60);
        $hours = round($difference / 3600);
        $days = round($difference / 86400);
        $weeks = round($difference / 604800);
        $month = round($difference / 2419200);

        $years = round($difference / 29030400);

        if ($seconds <= 60) {
            
            $literal = "duela segundo batzuk";
            
        } else if ($minutes <=60) {

            $literal = "duela $minutes minutu";

        } else if ($hours <= 24) {

            $literal = "duela $hours ordu";

        } else if ($days <= 7) {

            $literal = "duela $days egun";

        } else if ($weeks <= 4) {

            $literal = "duela $weeks aste";

        } else if ($month <= 12) {

            $literal = "duela $month hilabete";

        } else {

            $literal = "duela $years urte";

        }

        return $literal;

    }

    /**
     * Lista los comentarios hijos Aceptados
     * @return multitype:\Klikasi\Mapper\Sql\Iruzkina
     */
    public function iruzkinaSon()
    {

        $iruzkinakSon = array();
        $iruzkinak = new \Klikasi\Mapper\Sql\Iruzkina();
        $iruzkinakList = $iruzkinak->findByField('iruzkinaId', $this->getId());
        if (sizeof($iruzkinakList) > 0) {
            foreach ($iruzkinakList as $iruzkinak) {
                if ($iruzkinak->getEgoera() == 'onartua') {
                    $iruzkinakSon[] = $iruzkinak;
                }
            }
        }

        return $iruzkinakSon;

    }

    /**
     * Lista los comentarios hijos Aceptados Preparados para la vista.
     * @return multitype:
     */
    public function iruzkinaSonArray($isModerate = false)
    {

        $view = new \Zend_View();

        $iruzkinakSon = array();
        $iruzkinak = new \Klikasi\Mapper\Sql\Iruzkina();
        $iruzkinakList = $iruzkinak->findByField('iruzkinaId', $this->getId());

        if (sizeof($iruzkinakList) > 0) {
            foreach ($iruzkinakList as $iruzkina) {

                $needModeration = false;
                $erabiltzailea = $iruzkina->getErabiltzailea();

                if ($iruzkina->getEgoera() == 'onartua') {

                    $iruzkinaArray = array(
                        'authorUrl' => $erabiltzailea->urlProfile(),
                        'authorName' => $erabiltzailea->getCompletName(),
                        'iruzkinaDate' => $iruzkina->dateComment(),
                        'iruzkinaIruzkin' => $iruzkina->getIruzkin(),
                        'iruzkinaId' => $iruzkina->getId()
                    );

                } elseif ($iruzkina->getEgoera() == 'onartzeko' && $isModerate === true) {

                    $needModeration = true;

                    $moderationUrl = $view->url(
                        array(
                            'controller' => 'edukiak',
                            'action' => 'iruzkinak-moderate',
                            'iruzkinaId' => $iruzkina->getId()
                        ),
                        'default',
                        true
                    );
                    
                    $iruzkinaArray = array(
                        'authorUrl' => $erabiltzailea->urlProfile(),
                        'authorName' => $erabiltzailea->getCompletName(),
                        'iruzkinaDate' => $iruzkina->dateComment(),
                        'iruzkinaIruzkin' => $iruzkina->getIruzkin(),
                        'iruzkinaId' => $iruzkina->getId(),
                        'needModeration' => $needModeration,
                        'moderationUrl' => $moderationUrl,
                    );

                }
                   
                $avatar = $erabiltzailea->avatarData();
                    
                if ($avatar['type'] == 'default') {
                    $iruzkinaArray['avatarIrudia'] = false;
                    $iruzkinaArray['color'] = $avatar['color'];
                    $iruzkinaArray['classProfila'] = $avatar['classProfila'];
                } else {
                    $iruzkinaArray['avatarIrudia'] = true;
                    $iruzkinaArray['autorIrudiaUrl'] = $avatar['irudiaUrl'];
                }

                $iruzkinakSon[] = $iruzkinaArray;
            }
        }

        return $iruzkinakSon;

    }

}