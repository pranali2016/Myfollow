<?php

class HomeController extends Zend_Controller_Action
{

    public function init()
    {
      
    }

    public function indexAction()
    {
       $mapper = new Application_Model_EnduserMapper();
        $this->session1 = new Zend_Session_Namespace('enduser_session');
       $this->view->id = $this->session1->id;
        $id = $this->session1->id;
       
    
    }
    
}