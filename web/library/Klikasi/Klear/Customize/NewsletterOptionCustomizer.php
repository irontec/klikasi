<?php
namespace Klikasi\Klear\Customize;

class NewsletterOptionCustomizer implements \KlearMatrix_Model_Interfaces_ParentOptionCustomizer
{
   /**
    * @var KlearMatrix_Model_RouteDispatcher
    */
   protected $_mainRouter = null;

   /**
    * @var array
    */
   protected $_mainRouterOriginalParams = null;

   /**
    * @var KlearMatrix_Model_AbstractOption
    */
   protected $_option = null;

   protected $_resultWrapper = 'div';
   protected $_cssClass = 'hidden';

   public function __construct(\Zend_Config $configuration)
   {

       $front = \Zend_Controller_Front::getInstance();
       $this->_mainRouter = $front->getRequest()->getUserParam('mainRouter');
       $this->_mainRouterOriginalParams = $this->_mainRouter->getParams();

   }

   public function setOption (\KlearMatrix_Model_Option_Abstract $option)
   {
       $this->_option = $option;
   }

   /**
    * @return KlearMatrix_Model_ParentOptionCustomizer_Response
    */
    public function customize($parentModel)
    {

        $item = $this->_mainRouter->loadDialog($this->_option->getName());
        $model = $item->getObjectInstance();
        $mapper = $model->getMapper();

        $this->_mainRouter->setParams(
            array(
                'pk' => $parentModel->getPrimaryKey(),
            )
        );

        $response = new \KlearMatrix_Model_ParentOptionCustomizer_Response();
        $response->setParentWrapper($this->_resultWrapper)
                ->setParentCssClass($this->_cssClass);

        if ($this->_option->getName() == 'newsletterSendNow_dialog') {
            if ($parentModel->getSend() == 0 && $parentModel->getActive() == 1) {
                return null;
            }
        }

        return $response;

    }

}