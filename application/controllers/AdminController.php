<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
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
        
        $name = $this->getRequest()->getPost('name',NULL);
        $emaill = $this->getRequest()->getPost('companyName',NULL);
        $email = $this->getRequest()->getPost('email',NULL);
        $this->view->name = $name;
        $this->view->email = $email;
        $this->view->companyName = $emaill;
   $comment = new Application_Model_Admin($this->getAllParams());
            $mapper  = new Application_Model_AdminMapper();
            $mapper->save($comment);
    }
   
}