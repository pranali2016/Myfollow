<?php

class ProductownerController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $name = 'Pranali';
        $this->view->name = $name;
    }
    
    public function addAction()
    {
          $comment = new Application_Model_Productowner($this->getAllParams());
          $mapper  = new Application_Model_ProductownerMapper();
            $mapper->save($comment);
            
            return $this->_helper->redirector('index');
    }

}
            
    