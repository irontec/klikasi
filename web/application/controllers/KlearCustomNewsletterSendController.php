<?php

class KlearCustomNewsletterSendController extends Zend_Controller_Action
{

    protected $_mainRouter;

    public function init()
    {

        if (
            (!$this->_mainRouter = $this->getRequest()->getParam("mainRouter"))
        ||
            (!is_object($this->_mainRouter))
            ) {

                throw New Zend_Exception(
                    '',
                    Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
                );

        }

        $this->_helper->ContextSwitch()
            ->addActionContext('send', 'json')
           ->initContext('json');

        $this->_helper->layout->disableLayout();

        $this->_mustache = new \Mustache_Engine();
        $this->_scriptPath = APPLICATION_PATH . '/views/scripts/templates/';
        $this->_template = 'moderation.phtml';
        $this->_view = new \Zend_View();
        $this->_bodyTemplate = $this->_view->setScriptPath(
            $this->_scriptPath
        )->render($this->_template);

    }

    public function sendAction()
    {

        $pk = $this->getRequest()->getParam('pk', false);

        if ($pk) {

            $newsletter = new \Klikasi\Mapper\Sql\Newsletter();
            $newsletter = $newsletter->find($pk);

            if (!empty($newsletter)) {

                $send = $this->getRequest()->getParam('send', false);

                if ($send) {

                    $newsletter->sendNewsletter();

                    if ($newsletter->getSent() > 0) {

                        $message = '<p>El newsletter se envío correctamente a ';
                        $message .= $newsletter->getSent() . ' usuarios.';
                        $message .= '<br />';

                    } else {

                        $message = '<p>Hubo un error al enviar el newsletter.</p>';

                    }

                    $buttons = array(
                        'Salir' => array(
                            'recall' => false,
                            'reloadParent' => true
                        ),
                    );

                    $data = array(
                        'title' => 'Newsleter Manual',
                        'message'=> $message,
                        'buttons'=> $buttons
                    );

                } else {

                    $message = '<p>¿Quieres enviar el newslatter con asunto';
                    $message .= ' "<strong>' . $newsletter->getTitle() . '</strong>" ahora?</p>';
                    $message .= '<br />';

                    $buttons = array(
                        'Enviar' => array(
                            'recall'=> true,
                            'params'=> array(
                                'send' => true
                            ),
                        ),
                        'Cancelar' => array(
                            'recall' => false
                        ),
                    );

                    $data = array(
                        'title' => 'Newsleter Manual',
                        'message'=> $message,
                        'buttons'=> $buttons
                    );

                }
            }
        }

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule(
            'klearMatrix'
        );

        $jsonResponse->setPlugin(
            'klearMatrixGenericDialog'
        );

        $jsonResponse->addJsFile(
            '/js/plugins/jquery.klearmatrix.genericdialog.js'
        );

        $jsonResponse->setData(
            $data
        );

        $jsonResponse->attachView(
            $this->view
        );

    }

}