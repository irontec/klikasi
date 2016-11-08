<?php

use Klikasi\Model\Mezuak as MezuakModel;
use Klikasi\Mapper\Sql\Mezuak as MezuakMapper;

class MezuakController extends Zend_Controller_Action
{

    protected $_session = false;

    protected $_mezuakMapper;

    public function init()
    {

        $this->_session = $this->_sessionStart();
        $this->_helper->layout->setLayout('container-principal-title');

        $this->_jakinarazpenakUrl = $this->view->baseUrl('jakinarazpenak');
        $this->_initMappers();

        $this->_helper->ironContextSwitch()
            ->addActionContext('is-new', 'json')
            ->addActionContext('delete-message', 'json')
            ->addActionContext('reply-message', 'json')
            ->initContext();

        $baseUrl = $this->view->baseUrl();

        $this->view->appendJs = array(
            '/js/klikasi.mezuak.js'
        );

    }

    protected function _initMappers()
    {

        $this->_mezuakMapper = new MezuakMapper();

    }

    public function indexAction()
    {

        $mezuakArray = array();

        $where = array(
            'noriId = ?' => $this->_session->getId()
        );

        $mezuakList = $this->_mezuakMapper->fetchList(
            $where,
            array(
                'ikusita DESC',
                'sortzeData DESC'
            )
        );

        $mezuakCount = sizeof($mezuakList);
        $this->view->mezuakList = $mezuakList;

        $this->view->mezuakCount = $mezuakCount;
        $this->view->title = 'Mezuak (' . $mezuakCount . ') ';

    }

    public function isNewAction()
    {

        $param = $this->getRequest()->getParam('mezuakId', false);

        if ($param) {

            $mezuak = $this->_mezuakMapper->find($param);

            if ($mezuak) {

                $mezuak->setIkusita(0);
                $mezuak->save();
                $this->view->status = true;

            } else {
                $this->view->status = false;
            }

        } else {
            $this->view->status = false;
        }

    }

    public function deleteMessageAction()
    {

        $param = $this->getRequest()->getParam('mezuakId', false);

        if ($param) {

            $mezuak = $this->_mezuakMapper->find($param);

            if ($mezuak) {

                $mezuak->delete();
                $this->view->status = true;

            } else {
                $this->view->status = false;
            }

        } else {
            $this->view->status = false;
        }

    }

    public function replyMessageAction()
    {

        $param = $this->getRequest()->getParam('mezuakId', false);
        $mezua = $this->getRequest()->getParam('newMezuak', false);
        $noriId = $this->getRequest()->getParam('nori', false);

        if ($param && $mezua && $noriId) {

            $newModel = new MezuakModel();
            $newModel->replyMezuak(
                $this->_session->getId(),
                $noriId,
                $mezua
            );

            $this->view->status = true;

        } else {
            $this->view->status = false;
        }

    }

    /**
     * @return Model Session
     */
    protected function _sessionStart()
    {

        $session = $this->_helper->SessionUser();

        if (!$session) {
            $this->_redirect('sartu');
        }

        return $session;

    }

}