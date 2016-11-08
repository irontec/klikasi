<?php

use Klikasi\Custom\Imagick;

class Klikasi_Form_IzenaEmanBi extends Zend_Form
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
        $izena = $this->createElement("text", "izena");
        $izena->setLabel("Izena")
            ->setRequired()
            ->setAttrib("class", "form-control")
            ->addValidator("NotEmpty", true, array("messages" => "Izena beharrezkoa da."))
            ->setDecorators($this->_decorators);

        $abizena = $this->createElement("text", "abizena");
        $abizena->setLabel("Abizena")
            ->addValidator("NotEmpty", true, array("messages" => "Abizena beharrezkoa da."))
            ->setDecorators($this->_decorators)
            ->setAttrib("class", "form-control")
            ->setRequired();

        $bigarrenAbizena = $this->createElement("text", "abizena2");
        $bigarrenAbizena->setLabel("Bigarren abizena")
            ->setDecorators($this->_decorators)
            ->setAttrib("class", "form-control");

        $jaiotzeData = $this->createElement("text", "jaiotzeData");
        $jaiotzeData
            ->setLabel("Jaiotze data")
            ->addValidator("NotEmpty", true, array("messages" => "Mesedez hautatu ezazu jaiotze data."))
            ->setDecorators($this->_decorators)
            ->setAttrib("class", "form-control datepicker")
            ->setRequired();

        $deskribapena = $this->createElement("textarea", "deskribapena");
        $deskribapena->setLabel("Deskribapena")
            ->setAttrib("cols", "40")
            ->setAttrib("rows", "4")
            ->setAttrib("class", "form-control")
            ->setDecorators($this->_decorators);

        $irudia = $this->createElement("hidden", "irudiaSelector")
            ->setLabel("Irudia")
            ->setAttrib("data-plugin", "avatarSelector")
            ->setAttrib("data-show-default", "true")
            ->setAttrib("data-selector", ($this->_erabiltzailea->isSenior()) ? "true" : "false")
            ->setDecorators($this->_decorators);

        $next = $this->createElement("submit", "Hurrengoa");
        $next->setLabel("Hurrengoa")
            ->setDecorators($this->_decorators)
            ->removeDecorator("Label")
            ->setAttrib("class", "btn btn-success");

        $this->addElements(
            array(
                $izena,
                $abizena,
                $bigarrenAbizena,
                $jaiotzeData,
                $deskribapena,
                $irudia,
                $next
            )
        );

        $this->setDecorators(
            array(
                "FormElements",
                "Fieldset",
                "Form"
            )
        );
    }

    public function firstPopulate()
    {

        $this->populate($this->_erabiltzailea->toArray());
        $irudia = $this->_erabiltzailea->getIrudia();

        if (!is_null($irudia)) {

            $avatarSelector = $this->getElement("irudiaSelector");
            $avatarSelector->setAttrib("data-preselected-image", true)
                ->setAttrib("data-preselected-type", "image")
                ->setAttrib("data-preselected-path", $irudia->getIden())
                ->setAttrib("data-profile-image", true);

        }

        return $this;

    }

    public function postPopulate($data)
    {
        if (isset($data["irudiaSelector"])
                && $data["irudiaSelector"] != "") {
            $avatarSelector = $this->getElement("irudiaSelector");
            $avatarSelector->setAttrib("data-preselected-image", true);

            if ($data["irudiaSelector"] == "image") {
                $avatarSelector->setAttrib("data-preselected-type", "image");
                $path = $data["imagePath"];
                $irudia = $this->_erabiltzailea->getIrudia();

                if (strpos($path, sys_get_temp_dir()) >= 0
                        && $path != $irudia->getIden()) {
                    if (isset($data["x"]) && isset($data["y"])
                            && isset($data["w"]) && isset($data["h"])) {
                        $imagick = new Imagick();
                        $path = $imagick->saveThumbImg($data, $this->_erabiltzailea->getErabiltzaileIzena());
                    }
                    $avatarSelector->setAttrib("data-profile-image", false);

                } else {
                    $avatarSelector->setAttrib("data-profile-image", true);
                }

                $avatarSelector->setAttrib("data-preselected-path", $path);
            } elseif ($data["irudiaSelector"] == "avatar") {
                $avatarSelector->setAttrib("data-preselected-type", "avatar")
                    ->setAttrib("data-preselected-avatar", $data["avatarId"]);
            }
        }

        return $this;
    }
}

