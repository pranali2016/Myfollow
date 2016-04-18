<?php

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
       
   $comment = new Application_Model_Admin($this->getAllParams());
            $mapper  = new Application_Model_AdminMapper();
            //$mapper->save($comment);
            $email = $this->getRequest()->getParam('email');
            
            $to       = $email;
            $subject  = 'Registration link';
            $message  = 'Hi, you just received an email using sendmail!';
            $headers  = 'From: pranalivj9@gmail.com' . "\r\n" .
                        'MIME-Version: 1.0' . "\r\n" .
                        'Content-type: text/html; charset=utf-8';
            if(mail($to, $subject, $message, $headers))
            {  echo "Email sent";}
            else
            {  echo "Email sending failed";  }          
            
//            $this->_helper->flashMessenger('Request is successfully sent.');
//            $this->_helper->redirector('index');
    }
    
}