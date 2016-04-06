<?php

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
                
                $mapper  = new Application_Model_ProductownerMapper();
                $result = $mapper->login($email,$password);
                $login_id = $result[0]['id'];
                if($login_id)
                {   
                    Zend_Session::start();
                    $session = new Zend_Session_Namespace('user_session');
                    $session->id = $login_id;
                    $this->_redirect('Dashboard');
                   
                    echo "password matched" ;
                }
                else{
                    echo "Invalid username or password";
                }
            }
        }
        $this->view->form = $form;
    }
    
    
}

