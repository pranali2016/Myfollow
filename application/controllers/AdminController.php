<?php

use Zend_Mail_Transport_Smtp;
use Zend\Mail;

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
        /*$config = array('auth' => 'login',
                'username' => 'pranali@promactinfo.com',
                'password' => 'lifeislov',
                'ssl' => 'ssl',
                'port' => 465); // Optional port number supplied
 
        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
 
        $mail = new Zend_Mail();
        $mail->setBodyText('This is the text of the mail.');
        $mail->setFrom('anita@promactinfo.com', 'Some Sender');
        $mail->addTo('nehal@promactinfo.com', 'Some Recipient');
        $mail->setSubject('TestSubject');
       $mail->send($transport);*/
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
        require_once 'Zend/Mail.php';
        //require_once 'Zend/Mail/Transport/Smtp.php';
//   $comment = new Application_Model_Admin($this->getAllParams());
//            $mapper  = new Application_Model_AdminMapper();
            //$mapper->save($comment);
            $email = $this->getRequest()->getParam('email');
            $name = $this->getRequest()->getParam('name');
            $config = array('auth' => 'login',
                'username' => '',
                'password' => '',
                'ssl' => 'tls',
            'port' => 587); // Optional port number supplied
 
        $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
        
        $mail = new Mail\Message();
        $mail->setBody('This is the text of the email.');
        $mail->setFrom('', 'Sender\'s name');
        $mail->addTo($email, $name);
        $mail->setSubject('TestSubject');

$transport = new Mail\Transport\Sendmail();
$transport->send($mail);
        
//        echo "<pre>";
//        print_r($transport);
//        $mail = new Zend_Mail();
//        $mail->setBodyText('This is the text of the mail.');
//        $mail->setFrom('pranalivj9@gmail.com', 'Pranali');
//        $mail->addTo($email, $name);
//        $mail->setSubject('TestSubject');
//       $mail->send($transport);
//       print_r($mail);exit;
// 
//            $this->_helper->flashMessenger('Request is successfully sent.');
//            $this->_helper->redirector('index');
    }
    
}
