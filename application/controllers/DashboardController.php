<?php

use Application_Model_ProductsMapper;

class DashboardController extends Zend_Controller_Action
{

    public function init()
    {
        //provide the flashdata
        $messages = $this->_helper->flashMessenger->getMessages();
        if(!empty($messages))
        $this->_helper->layout->getView()->message = $messages[0];
        /* Initialize action controller here */
    }

    public function indexAction()
    {
         $mapper = new Application_Model_ProductsMapper();
            $this->session = new Zend_Session_Namespace('user_session'); //start session for product owner
            $this->view->id = $this->session->id;
             $id = $this->session->id;
            $result = $mapper->display($id);
            $this->view->display = $result;
    
    
    }
    
    public function productsAction()    //to add new products
    {
           
        $request = $this->getRequest();
        $form    = new Application_Form_Products();
        $this->session = new Zend_Session_Namespace('user_session');
       
        $this->view->form = $form;
            if($this->getRequest()->isPost())
            {
                if ($form->isValid($request->getPost())) {
                     $id = $this->session->id;
                    $intro   = $this->getRequest()->getPost('intro');
                    $comment = $this->getRequest()->getPost('comment');
                    $upload = new Zend_File_Transfer_Adapter_Http();
                    $upload->setDestination(PUBLIC_PATH.'\uploads'); //set path where image to store in public folder
                    $files = $upload->getFileInfo();
                    $upload->setValidators(['Count' => ['min' => 1, 'max' => 5], 
                                            ]);     //set max and min number fo images to upload
                    $upload->receive();  
                     echo "<pre>";
                      $image = array();
                    foreach ($files as $file) 
                    {
                        $target_file = $file['name'];
                        array_push($image,$target_file);
                                 
                    }
                    $image1 = $image[0];
                    $image2 = $image[1];
                    $image3 = $image[2];
                    $image4 = $image[3];
                    $image5 = $image[4];
               // echo $intro." ".$comment." ".$id;
                    
                    $mapper = new Application_Model_ProductsMapper();
                    $pid = $mapper->add($intro,$comment,$image1,$image2,$image3,$image4,$image5,$id);
                    foreach ($image as  $value) {
                        $mapper->images($pid,$value);
                    }
                    
                    $this->_helper->flashMessenger('Product details are successfully added.'); //set flash message
                    return $this->_helper->redirector('index');
             }
         }
            
          
    }
    
    public function deleteAction(){             //to delete the products
        
        if($this->getRequest()->isGet()){
            $id = $this->getRequest()->getParam('id');
            $mapper = new Application_Model_ProductsMapper();
            $mapper->delete($id);
            $this->_helper->flashMessenger('Products are successfully deleted.');   //set flash data
            return $this->_helper->redirector('index');
        }
    }
    
    public function updateAction()          // action to update the products
    {
        $id = $this->getRequest()->getParam('id');
        $mapper = new Application_Model_ProductsMapper();
        if($this->getRequest()->isPost())       //to post new updates
        {
            $id = $this->getRequest()->getParam('id');
            $intro = $this->getRequest()->getParam('intro');
            $detail = $this->getRequest()->getParam('detail');
            
            
            $mapper->update($intro,$detail,$id);
            $this->_helper->flashMessenger('Products are successfully updated.');
            return $this->_helper->redirector('index');
        }
        if($this->getRequest()->isGet())        //get the values for update action
        {
            $result = $mapper->find($id);
            $this->view->entry = $result;
            
        }
        $this->view->id = $id;
        
    }

}




  
