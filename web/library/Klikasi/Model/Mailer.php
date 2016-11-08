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
class Mailer
{

    protected $_body;
    protected $_subject;
    protected $_useTemplate;
    protected $_template;
    protected $_name;

    protected $_to = array();
    protected $_replyTo;
    protected $_replyToName;
    
    protected $_fromIzena = 'Klikasi';
    protected $_fromPosta = 'no-reply@klikasi.com';


    protected $_now;

    /**
     * This method is called just after parent's constructor
     */
    public function __construct()
    {
        $this->_mustache = new \Mustache_Engine();
        $currentTime = new \Zend_Date();
        $this->_now = $currentTime->toString('yyyy-MM-dd HH:mm:ss');
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->_subject = $subject;
        return $this;
    }

    /**
     * @return string $subject
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * @return string $template
     */
    public function enableTemplate($template = false)
    {
        $this->_useTemplate = $template;
        return $this;
    }

    /**
     * @return string
     */
    public function setTemplate($templateName)
    {
        $this->_template = $templateName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->_template;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->_body = $body;
        return $this;
    }

    public function setReplyTo($email, $name = null) 
    {
        $this->_replyTo = $email;
        $this->_replyToName = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        if (is_null($this->getTemplate())) {

            return $this->_body;

        } elseif ($this->getTemplate() == 'default') {

            $plantilla = 'templates/abisua.phtml';

            $view = new \Zend_View();

            $bodyTemplate = $view->setScriptPath(
                APPLICATION_PATH .
                '/views/scripts'
            )->render($plantilla);

            return $this->_mustache->render(
                $bodyTemplate,
                array(
                    'gorputza' => $this->_body,
                    'erabiltzailea' => $this->_name
                )
            );
        }
    }

    public function resetTo()
    {
        $this->_to = array();
        return $this;
    }

    /**
     * Añadir un nuevo destinatario
     * @param string $email
     * @param string $name
     */
    public function addTo($email, $name = null)
    {
        $this->_name = $name;
        $this->_to[$email] = $name;
        return $this;
    }

    /**
     * @param Array correo => nombre destinatario
     */
    public function setTo(array $to)
    {
        $this->_to = $to;
        return $this;
    }

    /**
     * Envía el correo electronico.
     */
    public function send()
    {
        $zmail = new \Zend_Mail("UTF-8");
        $zmail->setFrom(
            $this->_fromPosta,
            $this->_fromIzena
        );

        foreach ($this->_to as $email => $name) {

            $zmail->addTo(
                $email,
                $name
            );

            ///$mail->addCc($email, $name='')
        }

        $zmail->setSubject($this->getSubject());
        if ($this->_replyTo) {
            $zmail->setReplyTo($this->_replyTo, $this->_replyToName);
        }

        if ($this->_useTemplate === false) {
            $zmail->setBodyText($this->getBody());
        } else {
            $zmail->setBodyHtml($this->getBody());
        }

        return $zmail->send();
    }
}
