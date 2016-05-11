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
        $token = $this->getRequest()->getParam('token');
        $mapper = new Application_Model_AdminMapper();
         $map  = new Application_Model_TokanMapper();
         $token = substr($token,32);
        $result = $map->fetchdetail($token);
       
        $this->view->email = $result[0]['email'];
        $this->view->company = $result[0]['company'];
    }
    
    public function addAction() //add product owner details.
    {
        $email = $this->getRequest()->getParam('email');
        
          
          $mapper  = new Application_Model_ProductownerMapper();
          
          $fetch = $mapper->fetch($email);
       
          if(empty($fetch))
          {
            $comment = new Application_Model_Productowner($this->getAllParams());
            $mapper->save($comment);
            $this->_helper->flashMessenger('Registration Successfull');
          }
          else
          {
              $this->_helper->flashMessenger('error');
          }
            return $this->_helper->redirector('index');
    }

}
            
