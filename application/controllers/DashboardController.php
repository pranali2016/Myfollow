<?php
class DashboardController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
       $this->session = new Zend_Session_Namespace('user_session');
    $this->view->id = $this->session->id;
    }
    
}
