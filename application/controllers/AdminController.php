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
         $this->session = new Zend_Session_Namespace('admin_session'); //start session for product owner
         $this->view->id = $this->session->id;
         $mapper  = new Application_Model_AdminMapper();
            $display = $mapper->display();
           
            $this->view->display = $display;
    }
   
    
    public function addAction()
    {   
            $id = $this->getRequest()->getParam('id');
            $mapper  = new Application_Model_AdminMapper();
            
            $display = $mapper->fetch($id);
            $name = $display[0]['name'];
            $email = $display[0]['email'];
            $company = $display[0]['companyName'];
            $map  = new Application_Model_TokanMapper();
            $token = $map->token($email, $company);
            
            $link = "RegLnk9894";//.$token;
            $lis = md5($link).$token;
            $mapper->update($id);
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
                $mail->setBodyText("hiee Redgistration link is http://myfollow.local/productowner/?token=".$lis)
                //->setBodyHtml('<a href = "http://myfollow.local/productowner/?email=$email&companyName=$company">Registration link</a>')
                ->setFrom('pranali@promactinfo.com', 'Pranali Jadhav')
                ->addTo($email,$name)
                ->setSubject('Registration Link')
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