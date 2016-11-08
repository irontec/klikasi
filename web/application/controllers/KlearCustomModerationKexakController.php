<?php

class KlearCustomModerationKexakController extends Zend_Controller_Action
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

        $pk = $this->getRequest()->getParam('pk', false);

        if ($pk) {
            $kexak = new \Klikasi\Mapper\Sql\Kexa();
            $kexa = $kexak->find($pk);

            if (!empty($kexa)) {

                $auth = Zend_Auth::getInstance();
                $user = $auth->getIdentity();

                $send = $this->getRequest()->getParam('send', false);
                $thatUser = $kexa->getErabiltzailea();
                $edukia = $kexa->getEdukia();

                $view = new \Zend_View();
                $edukiaUrl = $view->serverUrl(
                    $view->baseUrl(
                        '/edukiak/ikusi/edukia/'.$edukia->getUrl()
                    )
                );

                $message = '<a
                                href="' . $edukiaUrl. '"
                                title="' . $edukia->getTitulua() . '"
                                style="float: left;clear: both;width: 100%;"
                                target="_blank"
                                ><span
                                    class="ui-silk ui-silk-link"
                                    style="float: left;clear: both;"
                                    ></span>' . $edukia->getTitulua() . '</a><br />';
                $message .= '<p>' . $kexa->getKexa() . '</p><br />';

                if ($send) {

                    $subject = $this->getRequest()->getParam('subjectEmail', false);
                    $body = $this->getRequest()->getParam('bodyEmail', false);

                    $status = false;

                    if ($subject !== false && $body !== false) {
                        if (trim($subject) != '' && trim($body) != '') {
                            $status = true;
                        }
                    }

                    if ($status) {

                        $mail = new Zend_Mail('utf-8');
                        $mail->addTo(
                            $thatUser->getPosta(),
                            $thatUser->getCompletName()
                        );

                        $mustacheView = $this->_mustache->render(
                            $this->_bodyTemplate,
                            array(
                                'name' => $thatUser->getCompletName(),
                                'body' => $body
                            )
                        );

                        $mail->setSubject('[Klikasi] ' . $subject);
                        $mail->setBodyHtml($mustacheView);
                        $mail->setFrom($user->getEmail(), $user->getLogin());

                        try {
                            $mail->send();
                            $messageResult = 'Email enviado con éxito';
                        } catch (Exception $e) {
                            $error = $e->getMessage();
                            $messageResult = 'Ha ocurrido un error enviando el email.';
                            $messageResult .= '<br />[' . $error . ']<br />Consulte con su Administrador.';
                        }

                        $buttons = array(
                            'Salir' => array(
                                'recall' => false,
                                'reloadParent' => true
                            ),
                        );

                        $data = array(
                            'title' => 'Email Enviado',
                            'message'=> $messageResult,
                            'buttons'=> $buttons
                        );

                    } else {

                        $message .= 'Asunto y Mensaje Obligatorios  <br />';
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

                        $buttons = array(
                            'Aceptar' => array(
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
                            'title' => 'Contactar con: ' . $thatUser->getCompletName(),
                            'message'=> $message,
                            'buttons'=> $buttons
                        );

                    }

                } else {

                    $message .= '<input type="text" name="subjectEmail" placeholder="Asunto" /><br />';
                    $message .= '<textarea name="bodyEmail" placeholder="Mensaje" rows="6"></textarea><br />';

                    $buttons = array(
                        'Aceptar' => array(
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
                        'title' => 'Contacto con: ' . $thatUser->getCompletName(),
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