<?php

class Klikasi_Form_Pasahitza extends Zend_Form
{

    public function __construct()
    {
        $this->_decorators = array(
            "ViewHelper",
            array(
                "Description",
                array(
                    "class" => "alert alert-info"
                    )
                ),
            "FormElements",
            array(
                "HtmlTag",
                array(
                    "tag" => "div",
                    "class" => "form-group col-md-6"
                    )
                ),
            array(
                "Label",
                array(
                    "placement" => "prepend",
                    "class" => "col-md-4 control-label"
                    )
                ),
        );

        $this->addAttribs(array("class" => "form-horizontal"));
        $this->setAttrib("autocomplete", "off");

        parent::__construct();

    }

    public function init()
    {

        $pasahitza = $this->createElement("password", "pasahitza");
        $pasahitza
            ->setLabel("Pasahitza")
            ->setAttrib("class", "form-control")
            ->addValidator("NotEmpty", true, array("messages" => "Mesedez sartu ezazu pasahitza."))
            ->addValidator(
                "StringLength", false,
                array(
                    4,
                    "messages" => "Pasahitzak 4 karaktere baino gehiago eduki behar ditu."
                )
            )
            ->setDecorators($this->_decorators)
            ->setRequired();

        $pasahitzaBaieztatu = $this->createElement("password", "pasahitzaBaieztatu");
        $pasahitzaBaieztatu
            ->setAttrib("class", "form-control")
            ->setLabel("Pasahitza baieztatu")
            ->addValidator("NotEmpty", true, array("messages" => "Mesedez pasahitza berretzi behar duzu."))
            ->setDecorators($this->_decorators)
            ->setRequired();

        $bidali = $this->createElement("submit", "bidali");
        $bidali->setLabel("Bidali")
            ->setDecorators($this->_decorators)
            ->removeDecorator("Label")
            ->setAttrib("class", "btn btn-success");

        $this->addElements(
            array(
                $pasahitza,
                $pasahitzaBaieztatu,
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