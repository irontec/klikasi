<?php

class Klikasi_Form_Kontaktua extends Zend_Form
{

    public function __construct()
    {
        $this->addAttribs(array("class" => "form-horizontal"));
        $this->setAttrib("autocomplete", "off");

        parent::__construct();
    }

    public function init()
    {
        $izena = $this->createElement("text", "izena");
        $izena->setLabel("Izena")
              ->addValidator("NotEmpty", true)
              ->addErrorMessage("Mesedez sartu ezazu zure izena.", Zend_Validate_NotEmpty::IS_EMPTY)
              ->setRequired();

        $posta = $this->createElement("text", "posta");
        $posta
            ->setLabel("Posta elektronikoa")
            ->addValidator("NotEmpty", true)
            ->addValidator("EmailAddress", true)
            ->setRequired()
            ->addErrorMessage("Sartutako posta helbidea ez da zuzena", Zend_Validate_EmailAddress::INVALID_FORMAT)
            ->addErrorMessage("Mesedez sartu ezazu posta elektronikoa.", Zend_Validate_NotEmpty::IS_EMPTY);

        $gaia = $this->createElement("text", "gaia");
        $gaia->setLabel("Gaia")
             ->addValidator("NotEmpty", true)
             ->addErrorMessage("Mesedez sartu ezazu gaia", Zend_Validate_NotEmpty::IS_EMPTY)
             ->setRequired();

        $mezua = $this->createElement("text", "mezua");
        $mezua->setLabel("Mezua")
              ->addValidator("NotEmpty", true )
              ->addErrorMessage("Mesedez sartu ezazu mezua", Zend_Validate_NotEmpty::IS_EMPTY)
              ->setRequired();

        $bidali = $this->createElement("submit", "bidali");
        $bidali->setLabel("Bidali")
               ->removeDecorator("Label")
               ->setAttrib("class", "btn btn-success");

        $this->addElements(
            array(
                $izena,
                $posta,
                $gaia,
                $mezua,
                $bidali
            )
        );
    }
}