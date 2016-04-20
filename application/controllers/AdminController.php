<?php

use Zend_Mail_Transport_Smtp;
use Zend_Mail;

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        $messages = $this->_helper->flashMessenger->getMessages();
        if(!empty($messages))
        $this->_helper->layout->getView()->message = $messages[0];
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }
  /*  public function saveAction()
    {
       if ($this->getRequest()->isPost()) {
            $comment = new Application_Model_Admin($this->getAllParams());
            $mapper  = new Application_Model_AdminMapper();
            $mapper->save($comment);
            return $this->_helper->redirector('index');
      }
    }*/
    
    public function addAction()
    {   
            $email = $this->getRequest()->getParam('email');
            $name = $this->getRequest()->getParam('name');
            
            //echo $email." ".$name;exit;
            $config = ['auth' => 'login',
                'username' => 'pranali@promactinfo.com',
                'password' => 'WhaOZRpkTY1(cPJl',
                //'SMTPAuth ' => false,
                //'ssl' => 'tsl',
                //'host' => 'localhost',
                'port' => 587
            ]; // Optional port number supplied
 
        $transport = new Zend_Mail_Transport_Smtp('webmail.promactinfo.com', $config);
          echo "<pre>";
        //print_r($transport);
       
        $mail = new Zend_Mail();
        
        
        try {
                $mail->setBodyText("hiee Redgistration link")
                ->setBodyHtml('<a href = "http://myfollow.local/productowner">Registration link</a>')
                ->setFrom('pranali@promactinfo.com', 'Pranali Jadhav')
                ->addTo($email,$name)
                ->setSubject('My Certificate')
                ->send($transport);
            
        } catch (Exception $ex) {
            echo $ex;
        }
        
      $this->_helper->flashMessenger('Request is successfully sent.');
            $this->_helper->redirector('index');
// 
//            
    }
    
}