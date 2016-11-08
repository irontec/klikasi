<?php

class Klikasi_Form_IzenaEmanIru extends Zend_Form
{
    protected $_decorators;
    protected $_erabiltzailea;

    public function __construct($erabiltzailea)
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

        $this->_erabiltzailea = $erabiltzailea;
        $this->addAttribs(array("class" => "form-horizontal"));

        parent::__construct();

    }

    public function init()
    {

        /**
         * Profila
         */
        $profila = $this->createElement("select", "profila");
        $profila->setLabel("Profila")
            ->setAttrib("class", "form-control")
            ->setDecorators($this->_decorators);


        $profila->addMultiOption("ikasle", "Ikaslea");
        if ($this->_erabiltzailea->isSenior()) {
            $profila->addMultiOption("irakasle", "Irakaslea");
            $profila->addMultiOption("otros", "Bestelakoak");
        }

        /**
         * Ikastegiak
         */
        $ikastegiak = $this->createElement("select", "ikastegiak");
        $ikastegiak->setLabel("Ikastegiak")
            ->setAttrib("class", "form-control")
            ->setDecorators($this->_decorators);

        $ikastegiakMapper = new Klikasi\Mapper\Sql\Ikastegia();
        $ikastegiaWhere = "aktibatua = '1'";
        $ikastegiaOrder = "izena";
        $ikastegiakList = $ikastegiakMapper->fetchListToArray(
            $ikastegiaWhere,
            $ikastegiaOrder
        );

        $ikastegiak->addMultiOption("new", "Ikastegi berria proposatu");
        foreach ($ikastegiakList as $ikastegia) {
            $ikastegiak->addMultiOption($ikastegia["id"], $ikastegia["izena"] . ", " . $ikastegia["herria"]);
        }

        $next = $this->createElement("submit", "Amaitu");
        $next->setLabel("Amaitu")
            ->setDecorators($this->_decorators)
            ->removeDecorator("Label")
            ->setAttrib("class", "btn btn-success");

        /**
         * Irakasle
         */
        $irakasle = $this->createElement("select", "irakasle");
        $irakasle->setLabel("Irakasle")
            ->setAttrib("class", "form-control")
            ->setDecorators($this->_decorators);

        if (!$this->_erabiltzailea->isSenior()) {
            $irakasle->setRequired();
        }

        $erabiltzaileaMapper = new Klikasi\Mapper\Sql\Erabiltzailea();
        $erabiltzaileaWhere = "profila = 'irakasle'";
        $erabiltzaileaOrder = array("izena", "abizena", "abizena2");
        $erabiltzaileaList = $erabiltzaileaMapper->fetchListToArray(
            $erabiltzaileaWhere,
            $erabiltzaileaOrder
        );

        $irakasle->addMultiOption("new", "Irakasle berri bat proposatu");
        foreach ($erabiltzaileaList as $erabiltzailea) {
            $irakasle->addMultiOption(
                $erabiltzailea["id"],
                $erabiltzailea["izena"] .
                " " .
                $erabiltzailea["abizena"] .
                " " .
                $erabiltzailea["abizena2"]
            );
        }


        $this->addElement($profila);
        $this->addElement($ikastegiak);
        $this->addElement($irakasle);
        $this->addElement($next);

        $this->setDecorators(
            array(
                "FormElements",
                "Fieldset",
                "Form"
            )
        );
    }

}