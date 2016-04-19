<?php

class EnduserController extends Zend_Controller_Action
{
    public function init() {
        parent::init();
        //to set the flash message
        $messages = $this->_helper->flashMessenger->getMessages();
        if(!empty($messages))
        $this->_helper->layout->getView()->message = $messages[0];
    }
    
    public function indexAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_EndUserRegistration(); //create EndUserRegistration form object.
        $this->view->form = $form; //apply it to index view
       if ($this->getRequest()->isPost()) //if data post in the form
         {
            if ($form->isValid($request->getPost())) // validation is working or not in post data in form
            {
                $e = $this->getRequest()->getParam('email');
                $e1 = $this->getRequest()->getParam('password');
                $e2 = $this->getRequest()->getParam('gender');
                $e3 = $this->getRequest()->getParam('dob');
                $e4 = $this->getRequest()->getParam('street1');
                $e5 = $this->getRequest()->getParam('street2');
                $e6 = $this->getRequest()->getParam('city');
                $e7 = $this->getRequest()->getParam('state');
                $e8 = $this->getRequest()->getParam('country');
                $e9 = $this->getRequest()->getParam('pin');
                $e10 = $this->getRequest()->getParam('contactno');

                if($e2) //radio button gives value 0 || 1
                { $e2 = 'Male';}
                else
                {   $e2 = 'Female';}
                
                $mapper = new Application_Model_EnduserMapper(); //create object of EnduserMapper model
                $mapper->insert($e,$e1,$e2,$e3,$e4,$e5,$e6,$e7,$e8,$e9,$e10);
                
               
              $this->_helper->flashMessenger('Registration Successfull');
            return $this->_helper->redirector('index');
             }
            
        }
    }
   
}
