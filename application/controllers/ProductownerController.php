<?php

class ProductownerController extends Zend_Controller_Action
{

    public function init()
    {
        $messages = $this->_helper->flashMessenger->getMessages();
        if(!empty($messages))
        $this->_helper->layout->getView()->message = $messages[0];
    }

    public function indexAction()
    {
        $name = 'Pranali';
        $this->view->name = $name;
    }
    
    public function addAction() //add product owner details.
    {
          $comment = new Application_Model_Productowner($this->getAllParams());
          $mapper  = new Application_Model_ProductownerMapper();
            $mapper->save($comment);
            $this->_helper->flashMessenger('Registration Successfull');
            return $this->_helper->redirector('index');
    }

}
            
    