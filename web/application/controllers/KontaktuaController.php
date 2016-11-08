<?php
use Klikasi\Mapper\Sql\Orrialdea as OrrialdeaMapper;

class KontaktuaController extends Zend_Controller_Action
{
    public function indexAction()
    {
    	$this->_orrialdeaMapper = new OrrialdeaMapper;
    	 
        $this->_helper->layout->setLayout('simple');
        $this->view->title = 'Kontaktua';
        
        $orrialdea = $this->_orrialdeaMapper->findOneByField("titulua", "Kontaktua");
        $this->view->metaDescription = $orrialdea->getMetaDescription();
        $this->view->metaTitle = $orrialdea->getMetaTitle();
        $this->view->metaKeywords = $orrialdea->getMetaKeywords();
        $this->view->currentUrl = $this->view->serverUrl($this->view->url());
        $this->view->urlMetaImage = $orrialdea->orrialdeaIrudiaUrl();
        $this->view->metaType = "website";

        $captcha = new Zend_Form_Element_Captcha(  
            'kamchatka',
            array(
                'label' => 'Write the chars to the field',  
                'captcha' => array(  
                    'captcha' => 'Figlet',
                    'wordLen' => 6,
                    'timeout' => 300,
                    /*"messages" => array(
                        "badCaptcha" => "Idatzi irudian agertzen den berdina"
                    ),*/
                )
            )
        );
        
        $captcha->setErrorMessages(array('lol' => "Idatzi irudian agertzen den berdina")); 
        
        $this->view->captcha = $captcha->getCaptcha(); 

        if ($this->getRequest()->isPost()) {

            $form = new Klikasi_Form_Kontaktua;
            $form->addElement($captcha);

            $datuak = $this->getRequest()->getParams();
            $form->populate($datuak);
            if (!$form->isValid($datuak)) {

                $errors = array();

                foreach ($form->getErrors() as $field => $errorArray) {
                    if ($field == 'kamchatka') {
                        $message = $errorArray[0];
                        $errorArray[0] = substr($message, 0, strpos($message, $captcha->getErrorMessageSeparator()));
                    }

                    foreach ($errorArray as $errorea) {
                        $errors[] = $errorea;
                    }
                }
                $this->view->erroreMezuak = $errors;

            } else {

                $model = new Klikasi\Model\Kontaktua;
                $model->setIzena($this->_request->getParam("izena"))
                      ->setPosta($this->_request->getParam("posta"))
                      ->setGaia($this->_request->getParam("gaia"))
                      ->setMezua($this->_request->getParam("mezua"))
                      ->setNondik($this->_request->getParam("nondik"))
                      ->save();

                $this->view->alertWarning = array("Ekintza ondo gauzatu da");
                $this->view->success = true;
                $this->view->captcha->generate();

            }
        } else {

            $this->view->captcha->generate();
        }
    }
}