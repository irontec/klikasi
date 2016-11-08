<?php

class KlearCustomModerationIkastegiakController extends Zend_Controller_Action
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
            ->addActionContext('moderation', 'json')
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

    public function moderationAction()
    {

        $ikastegiak = new \Klikasi\Mapper\Sql\Ikastegia();
        $ikastegia = $ikastegiak->find($this->getRequest()->getParam('pk'));

        $where = array(
            'motaid = ?' => 10,
            'idKanpotarra = ?' => $ikastegia->getId()
        );

        $jakinarazpenak = new \Klikasi\Mapper\Sql\Jakinarazpenak();
        $jakinarazpena = $jakinarazpenak->fetchOne($where);

         $auth = Zend_Auth::getInstance();
         $user = $auth->getIdentity();

        if ($this->getRequest()->getParam("send")) {

            $subject = $this->getRequest()->getParam('subjectEmail', false);
            $body = $this->getRequest()->getParam('bodyEmail', false);

            if (
                $subject != false && trim($subject) != ''
            &&
                $body != false && trim($body) != ''
                ) {

                $thatUser = $jakinarazpena->getThatUser();

                $mail = new Zend_Mail('utf-8');
                $mail->addTo(
                    $thatUser->getPosta(),
                    $thatUser->getCompletName()
                );

                $mustacheView = $this->_mustache->render(
                    $this->_bodyTemplate,
                    array(
                        'name' => $thatUser->getCompletName(),
                        'body' => $body,
                        'adminEmail' => $user->getEmail()
                    )
                );

                $mail->setSubject('[Klikasi] ' . $subject);
                $mail->setBodyText($mustacheView);
                $mail->setFrom($user->getEmail(), $user->getLogin());

                try {
                    $mail->send();
                    $messageResult = 'Email enviado con éxito';
                } catch (Exception $e) {
                    $error = $e->getMessage();
                    $messageResult = 'Ha ocurrido un error enviando el email.';
                    $messageResult .= '<br />[' . $error . ']<br />Consulte con su Administrador.';
                }

                $data = array(
                            'title' => 'Email Enviado',
                            'message'=> $messageResult,
                            'buttons'=> array(
                                            'Salir' => array(
                                                        'recall' => false,
                                                        'reloadParent' => true
                                                        ),
                                            )
                            );

            } else {

                $thatUser = $jakinarazpena->getThatUser();

                $message = 'Asunto y Mensaje Obligatorios  <br />';
                $message .= '<input
                                type="text"
                                name="subjectEmail"
                                value="' . $subject . '"
                                placeholder="Asunto"
                                /><br />';
                $message .= '<textarea
                                name="bodyEmail"
                                placeholder="Mensaje"
                                >' . $body . '</textarea><br />';

                $data = array(
                            'title' => 'Contacto con: ' . $thatUser->getCompletName(),
                            'message'=> $message,
                            'buttons'=> array(
                                'Aceptar' => array(
                                                'recall'=> true,
                                                'params'=> array(
                                                            'send' => true
                                                            ),
                                            ),
                                'Cancelar' => array(
                                    'recall' => false,
                                ),
                            )
                        );

            }

        } else {

            if (!empty($ikastegia) && !empty($jakinarazpena)) {

                $thatUser = $jakinarazpena->getThatUser();

                $message = '';
                $message .= '<input type="text" name="subjectEmail" placeholder="Asunto" /><br />';
                $message .= '<textarea name="bodyEmail" placeholder="Mensaje"></textarea><br />';

                $data = array(
                            'title' => 'Contacto con: ' . $thatUser->getCompletName(),
                            'message'=> $message,
                            'buttons'=> array(
                                'Aceptar' => array(
                                                'recall'=> true,
                                                'params'=> array(
                                                            'send' => true
                                                            ),
                                            ),
                                'Cancelar' => array(
                                    'recall' => false,
                                ),
                            )
                        );

            } else {

                $data = array(
                    'title' => 'Error',
                    'message'=> 'No se a encontrado el centro o la notificación relacionada con este centro.',
                    'buttons'=>array(
                        'Salir' => array(
                            'recall' => false,
                            'reloadParent' => true
                        ),
                    )
                );

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