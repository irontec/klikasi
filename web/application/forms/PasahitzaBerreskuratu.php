<?php

class Klikasi_Form_PasahitzaBerreskuratu extends Zend_Form
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
            ->addValidator(
                "NotEmpty",
                true,
                array(
                    "messages" => "Mesedez sartu ezazu Erabiltzailea."
                )
            )
            ->setAttrib("autofocus", "true")
            ->setDecorators($this->_decorators)
            ->setRequired();

        $bidali = $this->createElement("submit", "bidali");
        $bidali->setLabel("Bidali");

        $this->addElements(
            array(
                $erabil,
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