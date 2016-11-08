<?php

class Klikasi_Form_Sartu extends Zend_Form
{

    public function __construct()
    {

        $this->_decorators = array(
            "ViewHelper",
            array(
                    "Label",
                    array(
                            "placement" => "prepend"
                        )
                ),
            array(
                    array(
                            "wrapperAll" => "HtmlTag"
                        ),
                    array(
                            "tag" => "div",
                            "class" => "form-line"
                        )
                ),
        );

        parent::__construct();

    }

    public function init()
    {

        $erabil = $this->createElement(
            "text",
            "erabiltzailea",
            array(
                "autocomplete" => "off"
                )
        );

        $erabil->setLabel("Erabiltzailea")
            ->addValidator("NotEmpty", true, array("messages" => "Mesedez sartu ezazu Erabiltzailea."))
            ->setDecorators($this->_decorators)
            ->setRequired();

        $pasahitza = $this->createElement("password", "pasahitza");
        $pasahitza
            ->setLabel("Pasahitza")
            ->addValidator("NotEmpty", true, array("messages" => "Mesedez sartu ezazu Pasahitza."))
            ->setDecorators($this->_decorators)
            ->setRequired();

        $gogoratu = $this->createElement("checkbox", "gogoratu");
        $gogoratu->setLabel("Gogoratu")
            ->setRequired(false)
            ->setDecorators($this->_decorators);

        $referer = $this
            ->createElement("hidden", "referer")
            ->setDecorators(
                array(
                "ViewHelper",
                array( "Label", array( "placement" => "prepend" ) ),
                array( array( "wrapperAll" => "HtmlTag" ), array( "tag" => "div", "class" => "hidden" ) )
                )
            );

        $bidali = $this->createElement("submit", "bidali");
        $bidali->setLabel("Bidali");

        $this->addElements(
            array(
                $erabil,
                $pasahitza,
                $gogoratu,
                $referer,
                $bidali
            )
        );

        $this->setDecorators(
            array(
                "FormElements",
                array("HtmlTag", array("tag" => "dl")),
                "Fieldset",
                "Form"
            )
        );

    }

}