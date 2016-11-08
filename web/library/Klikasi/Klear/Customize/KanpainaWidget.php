<?php
namespace Klikasi\Klear\Customize;

class KanpainaWidget implements \KlearMatrix_Model_Interfaces_ParentOptionCustomizer
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
       $this->_mainRouter = $front->getRequest()->getUserParam("mainRouter");
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
        $item = $this->_mainRouter->loadScreen($this->_option->getName());
        $model = $item->getObjectInstance();
        $mapper = $model->getMapper();

        //Al tratarse de un filtered screen necesita la pk del padre
        $this->_mainRouter->setParams(array("pk" => $parentModel->getPrimaryKey()));

        $response = new \KlearMatrix_Model_ParentOptionCustomizer_Response();
        $response->setParentWrapper($this->_resultWrapper)
            ->setParentCssClass($this->_cssClass);

        switch ( $this->_option->getName() ) {
            case 'widgetEdukiak_screen':
                if ($parentModel->getWidgetEdukiak() == '1') {
                    return null;
                } else {
                    return $response;
                }
                break;
            case 'widgetIkastegiak_screen':
                if ($parentModel->getWidgetIkastegiak() == '1') {
                    return null;
                } else {
                    return $response;
                }
            case 'widgetKategoriak_screen':
                if ($parentModel->getWidgetKategoriak() == '1') {
                    return null;
                } else {
                    return $response;
                }
            default:
                return null;
                break;
        }
   }
}
