<?php

namespace Klikasi\Custom;

class Notifikazioa
{
    protected $_templateHtml;
    protected $_templateText;

    protected $_bodyHtml;
    protected $_bodyText;

    //adibidez
    /*
    protected $_from = array(
            "izena" => "Klikasi", //mezua izango duen titulua
            "posta" => "no-reply@your-domain.com" //email
            );
    */
    protected $_from = array(
        "izena" => "Klikasi",
        "posta" => "USER_CONFIGURABLE:YOUR_NO_REPLY_EMAIL_ADDRESS"
    );

    protected $_mail;
    protected $_mustache;

    protected $_notifikazioMapper;

    protected $_erabil;
    protected $_datuak;

    public function __construct($izena, $erabiltzailea, $datuak, $admin = false)
    {

        $this->_mail = new \Zend_Mail('utf-8');
        $this->_mustache = new \Mustache_Engine();
        $this->_notifikazioMapper = new \Klikasi\Mapper\Sql\Notifikazioa();

        $this->_erabil = $erabiltzailea;
        $this->_datuak = $datuak;

        $this->notifikazioaSortu($izena, $admin);

    }

    /**
     *
     * @param string $izena
     * @return boolean
     */
    protected function notifikazioaSortu($izena, $admin)
    {

        $lerroa = $this->_notifikazioMapper->findOneByField(
            'identifikatzailea',
            $izena
        );

        if ($lerroa) {

            $plantilla = 'templates/abisua.phtml';

            $view = new \Zend_View();

            $body = $view->setScriptPath(
                APPLICATION_PATH .
                '/views/scripts'
            )->render($plantilla);

            $this->_templateHtml = $this->_mustache->render(
                $body,
                array(
                    'gorputza' => $lerroa->getEdukiaHtml(),
                    'erabiltzailea' => $this->_erabil->getCompletName()
                )
            );

            $this->_templateText = $lerroa->getEdukiaText();

            $this->notifikazioDatuakSartu();

        } else {
            throw new \Zend_Application_Exception(
                'Ezin da notifikazioa sortu',
                404
            );
        }

    }

    public function notifikazioDatuakSartu()
    {

        $this->_mail->setBodyHtml(
            $this->_mustache->render(
                $this->_templateHtml,
                $this->_datuak
            )
        );

        $this->_mail->setBodyText(
            $this->_mustache->render(
                $this->_templateText,
                $this->_datuak
            )
        );

    }

    public function postaJaso()
    {

        $html = $this->_mustache->render(
            $this->_templateHtml,
            $this->_datuak
        );

        $text = $this->_mustache->render(
            $this->_templateText,
            $this->_datuak
        );

        return array(
            "html" => $html,
            "text" => $text
        );

    }

    public function notifikazioaBidali($gaia)
    {

        $this->_mail->addTo(
            $this->_erabil->getPosta(),
            $this->_erabil->getCompletName()
        );

        $this->_mail->setFrom(
            $this->_from["posta"],
            $this->_from["izena"]
        );

        $this->_mail->setSubject($gaia);
        $this->_mail->send();

    }

}