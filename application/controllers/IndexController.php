<?php

use Zend_Session;

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $messages = $this->_helper->flashMessenger->getMessages();
        if(!empty($messages))
        $this->_helper->layout->getView()->message = $messages[0];/* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
    
    public function loginAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Login();
 
       if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                
                $email = $this->getRequest()->getPost('email');
                $password = $this->getRequest()->getPost('password');
                 Zend_Session::start();
                $mapper  = new Application_Model_ProductownerMapper();
                $result = $mapper->login($email,$password);
                $login_id = $result[0]['id'];
                
                $mapp  = new Application_Model_EnduserMapper();
                $result1 = $mapp->login($email,$password);
                //print_r($request); 
                $l_id = $result1[0]['id'];
                if($email=='admin' && $password=='admin')
                {
                    $session = new Zend_Session_Namespace('admin_session');
                    $session->id = 'Admin';
                    $this->_redirect('admin');
                }
                if($login_id)
                {   
                   
                    $session = new Zend_Session_Namespace('user_session');
                    $session->id = $login_id;
                    $this->_redirect('Dashboard');
                }
                
                elseif($l_id)
                    {
                        $session = new Zend_Session_Namespace('enduser_session');
                        $session->id = $l_id;
                        $this->_redirect('Home');
                    }
                else
                {
                    echo "Invalid username or password";
                }
            }
        }
        $this->view->form = $form;
    }
    
    public function logoutAction(){
     
        Zend_Session::destroy(); 
        $this->_helper->redirector('index');
      
    }
    
     public function saveAction()
    {
       if ($this->getRequest()->isPost()) {
           
           $mapper  = new Application_Model_AdminMapper();
           $email = $this->getRequest()->getParam('email');
           
           $result = $mapper->find($email);
           if(empty($result))
           {
            $comment = new Application_Model_Admin($this->getAllParams());
            $mapper->save($comment);
            $this->_helper->flashMessenger('Request is successfully sent.');
           }
           else{
               $this->_helper->flashMessenger('error');
           }
      }
      
            $this->_helper->redirector('index');
    }
}

