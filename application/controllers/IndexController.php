<?php

use Zend_Session;

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
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
    
    
}

