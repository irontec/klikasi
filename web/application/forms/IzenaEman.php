<?php

class Klikasi_Form_IzenaEman extends Zend_Form
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

        $erabil = $this->createElement("text", "erabiltzailea");

        $erabil->setLabel("Erabiltzaile izena")
            ->setAttrib("class", "form-control")
            ->addValidator(
                "StringLength", false,
                array(
                    5,
                    "messages" => "Erabiltzaile izenak 5 hizki baino gehiago eduki behar ditu."
                )
            )
            ->addValidator(
                "alnum", true,
                array(
                    "messages" => "Erabiltzaile izena hizki edo zenbakiz bakarrik osa daiteke (hutsunerik gabe)."
                )
            )
            ->addValidator(
                "regex", true,
                array(
                    "pattern" => "/^[a-z0-9]+$/",
                    "messages" => "Erabiltzaile izena hizki minuskulekin idatzia egon behar da."
                )
            )
            ->addValidator("NotEmpty", true, array("messages" => "Mesedez sartu ezazu erabiltzaile izen bat."))
            ->setDecorators($this->_decorators)
            ->setRequired();

        $posta = $this->createElement("text", "posta");
        $posta
            ->setLabel("Posta elektronikoa")
            ->addValidator("NotEmpty", true, array("messages" => "Mesedez sartu ezazu posta elektronikoa."))
            ->addValidator("EmailAddress", true)
            ->setDecorators($this->_decorators)
            ->setRequired()
            ->setAttrib("class", "form-control")
            ->setAttrib("autofocus", "true")
            ->addErrorMessage("Sartutako posta helbidea ez da zuzena", Zend_Validate_EmailAddress::INVALID_FORMAT);

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

        $jaiotzeData = $this->createElement("text", "jaiotzeData");
        $jaiotzeData->setAttrib("class", "datepicker form-control")
            ->setLabel("Jaiotze data")
            ->addValidator("NotEmpty", true, array("messages" => "Mesedez hautatu ezazu jaiotze data."))
            ->setDecorators($this->_decorators)
            ->setRequired();


        /*$profila = $this->createElement('select','profila');
        $profila->setDecorators($this->_decorators)
                ->setLabel("Profila")
                ->addMultiOptions(array(
                    'ikasle' => 'Ikaslea',
                    'irakasle' => 'Irakaslea',
                    'otros' => 'Bestelakoak'
                ));*/

        $captcha = $this->createElement(
            "captcha", "captcha",
            array(
                "required" => true,
                "captcha" => array(
                    "captcha" => "Image",
                    "font" => APPLICATION_PATH."/../public/css/comicate.ttf",
                    "fontSize" => "28",
                    "wordLen" => 6,
                    "height" => "100",
                    "width" => "150",
                    "imgDir" => APPLICATION_PATH."/../public/captcha",
                    "imgUrl" => Zend_Controller_Front::getInstance()->getBaseUrl() . "/captcha",
                    "dotNoiseLevel" => 10,
                    "lineNoiseLevel" => 2,
                    "messages" => array(
                        "badCaptcha" => "Idatzi irudian agertzen den berdina"
                    ),
                )
            )
        );

        $captcha->setLabel("Idatzi hurrengo hizki eta zenbakiak:")
                ->setDecorators(array(
                    array(
                        "HtmlTag",
                        array(
                            "tag" => "div",
                            "class" => "col-md-6"
                        )
                    ),
                    array(
                        "Label",
                        array(
                            "placement" => "prepend",
                            "class" => "col-md-4 control-label"
                        )
                    ),
                ));

        $bidali = $this->createElement("submit", "bidali");
        $bidali->setLabel("Bidali")
               ->setDecorators($this->_decorators)
               ->setDecorators(array(
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
                            "class" => "col-md-4 control-label"
                            )
                        ),
                ))
               ->removeDecorator("Label")
               ->setAttrib("class", "btn btn-success");

        $this->addElements(
            array(
                $posta,
                $erabil,
                $jaiotzeData,
                //$profila,
                $pasahitza,
                $pasahitzaBaieztatu,
                $captcha,
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