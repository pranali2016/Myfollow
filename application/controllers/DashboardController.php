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
            
            $result = $mapper->display($id);  // display the products.
            $this->view->display = $result; //assign it to the view
    
    
    }
    
    public function productsAction() //to add new products
    {
           
        $request = $this->getRequest();
        $form    = new Application_Form_Products(); //create object of the form named Products
        $this->session = new Zend_Session_Namespace('user_session'); //start session for product owner
       
        $this->view->form = $form;
            if($this->getRequest()->isPost()) //if the requested method id post
            {
                if ($form->isValid($request->getPost()))
                  { //if the inserted data is valid
                     $id = $this->session->id;
                    $intro   = $this->getRequest()->getPost('intro');
                    $comment = $this->getRequest()->getPost('comment');
                    $upload = new Zend_File_Transfer_Adapter_Http(); //to upload file create object of file transfer adapter
                    $upload->setDestination(PUBLIC_PATH.'\uploads'); //set path where image to store in public folder
                                          
                    $files = $upload->getFileInfo(); //get the array of the form values
                     
                        echo "<pre>";
                    print_r($files);
                    $upload->receive();
                    
                    exit;
                
                      
                    $upload->receive();  //to upload images to the uploads directory.
                     echo "<pre>";
                      $image = array();
                    foreach ($files as $file) 
                    {
                        $target_file = $file['name'];
                        array_push($image,$target_file); //push image's names to the image array
                                 
                    }
                    $image1 = $image[0];
                    $image2 = $image[1];
                    $image3 = $image[2];
                    $image4 = $image[3];
                    $image5 = $image[4];
              
                    $mapper = new Application_Model_ProductsMapper(); // object of the productsmapper class
                    $pid = $mapper->add($intro,$comment,$id); //call add function to insert the data into database.
                    foreach ($image as  $value) {
                        if(!empty($value)){ //if image value is not empty
                        $mapper->images($pid,$value); //add images to image table with product id
                        }
                    }
                    
                    $this->_helper->flashMessenger('Product details are successfully added.'); //set flash message
                    return $this->_helper->redirector('index');
                  }
             }      
    }
    
    public function deleteAction(){   //to delete the products
        
        if($this->getRequest()->isGet()){
            $id = $this->getRequest()->getParam('id'); //get the product id
            $mapper = new Application_Model_ProductsMapper();
            $mapper->delete($id); //call delete function to delete the product with id = $id
            $this->_helper->flashMessenger('Products are successfully deleted.');   //set flash data
            return $this->_helper->redirector('index');
        }
    }
    
    public function updateAction()          // action to update the products
    {
        $id = $this->getRequest()->getParam('id');  //get the id to update product details
        $mapper = new Application_Model_ProductsMapper();
            if($this->getRequest()->isPost())       //if the request is post
            {
                $id = $this->getRequest()->getParam('id');
                $intro = $this->getRequest()->getParam('intro');
                $detail = $this->getRequest()->getParam('detail');


                $mapper->update($intro,$detail,$id);    //call update method.
                $this->_helper->flashMessenger('Products are successfully updated.');
                return $this->_helper->redirector('index');
            }
            if($this->getRequest()->isGet())        //if the request is get
            {
                $result = $mapper->find($id);
                $this->view->entry = $result;
                $images = $mapper->image($id);
               
                
                $this->view->image = $images;
            }
            $this->view->id = $id;

    }
    
    public function detailsAction()
    {
        $this->session = new Zend_Session_Namespace('user_session'); //start session for product owner
            
        $uid = $this->session->id;//userid
        $intro = $this->getRequest()->getParam('intro');
        $detail = $this->getRequest()->getParam('detail');
        $image = array();
        
        if ($this->getRequest()->isPost()) {
            $j = 0; //Variable for indexing uploaded image 

                $target_path = PUBLIC_PATH."/uploads/"; //Declaring Path for uploaded images
            for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

                $validextensions = array("jpeg", "jpg", "png", "mp4", "3gp", "mkv", "m4v");  //Extensions which are allowed
                $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
                $file_extension = end($ext); //store extensions in the variable

                        $new_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
                $j = $j + 1;//increment the number of uploaded images according to the files in array       

                  if (($_FILES["file"]["size"][$i] < 500000000) //Approx. 100kb files can be uploaded.
                        && in_array($file_extension, $validextensions)) {
                    if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $new_path)) {//if file moved to uploads folder
                        echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
                    } else {//if file was not moved.
                        echo $j. ').<span id="error">please try again!.</span><br/><br/>';
                    }
                } 
                else {//if file size and file type was incorrect.
                    echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
                }
                
                $imagename = md5(uniqid()) . "." . $ext[count($ext) - 1];   //name of the image when it uploads to the directory
                array_push($image, $imagename);
            }
            print_r($image);
           
            $mapper = new Application_Model_ProductsMapper(); // object of the productsmapper class
                    $pid = $mapper->add($intro,$detail,$uid); //call add function to insert the data into database.
                    foreach ($image as  $value) {
                        if(!empty($value)){ //if image value is not empty
                        $mapper->images($pid,$value); //add images to image table with product id
                        }
                    }
                    
                    $this->_helper->flashMessenger('Product details are successfully added.'); //set flash message
                    return $this->_helper->redirector('index');
        }
        
    }

}




  
