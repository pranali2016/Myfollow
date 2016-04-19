<?php

class HomeController extends Zend_Controller_Action
{

    public function init()
    {
           //set the flash messages
            $messages = $this->_helper->flashMessenger->getMessages();
            if (!empty($messages)) {
                  $this->_helper->layout->getView()->message = $messages[0];
              }
    }

    public function indexAction()
    {
        $mapper = new Application_Model_FollowMapper();
        $this->session1 = new Zend_Session_Namespace('enduser_session'); //set the session for the end user
        $this->view->id = $this->session1->id; //get the id of the current session
        $id = $this->session1->id;
        $result = $mapper->checkfollow($id);    //call checkfollow method to check if the user follows the products
        if(empty($result))
        {
            //if empty, given the link to start following products
            echo "<div class='container'><br><br><h3> Start Following Products <a href='http://myfollow.local/home/products/?id=".$id."'>Click here</a></h3></div>";
        }
        else 
        {
            $display = $mapper->displayfollow($id);
            $this->view->result = $display;
        }
    
    }
    
    public function productsAction()    //an action related to the products
    {
        $this->session1 = new Zend_Session_Namespace('enduser_session');
        $this->view->id = $this->session1->id;
        $id = $this->session1->id;      //user id
        $mapper = new Application_Model_ProductsMapper();
        $resultf = $mapper->item($id);      //gives the product which are followed by the current session.
         $resultall = $mapper->ite();       //gives evry products exists.
         $newfollow = array();
         foreach ($resultf as $key => $value) {
             $newf = array_slice($value,0,2);
             array_push($newfollow, $newf);
         }
//         echo "new Follow : " ;
//         print_r($newfollow);
//         echo "new all products : " ;
//         print_r($resultall);
//         
         function udiffCompare($a, $b)  // a function for getting the remaining products which are yet not followed by the user.
            {
             return $a['id'] - $b['id'];
            }

            $arrdiff = array_udiff($resultall, $newfollow, 'udiffCompare');
//            print_r($arrdiff);
         
       if(empty($resultf)){     //if the user is not following any products
           
        $this->view->result = $resultall;   //display all the products
        //
       }    
       else
       {
       $this->view->result = $arrdiff;      //display products that are unfollowed.
       }
    }
    
    public function moreAction()    //to show the more derails about the products.
    {
        $o_id = $this->getRequest()->getParam('ownerid');
        $id = $this->getRequest()->getParam('id');
        //echo $o_id." ".$id; exit;
        $mapper = new Application_Model_ProductsMapper();
        $result = $mapper->itemid($id);
        $this->view->result = $result;
        
            //$this->view->result = $id;
           $mapr = new Application_Model_ProductownerMapper();
           $data = $mapr->get($o_id);
           $this->view->companydetail = $data;
          // echo '<pre>';
          // print_r($result);
           //break;
        
    }
    
    public function followAction()  //to follow the products.
    {
       
        
       $productId = $this->getRequest()->getParam('productId'); //get the id of the product.
        
        $this->view->productid = $productId;
        
       $this->session1 = new Zend_Session_Namespace('enduser_session');
       $this->view->id = $this->session1->id;
        $id = $this->session1->id;
        //echo $id;
        $status = 1;
       $mapper = new Application_Model_FollowMapper();
       $check = $mapper->check($productId,$id);
       $this->_helper->flashMessenger('You started following product');     //set flash message
       if(empty($check))    //check whether the product olready followed or not.
       {
        $mapper->follow($productId,$id,$status);
       }
       else {
       $this->_helper->flashMessenger('You started following product');
       }
        $this->_helper->redirector('products');
        
    }
    
    public function unfollowAction()    //to unfollow the products
    {
        $pid = $this->getRequest()->getParam('productId');
        $this->session1 = new Zend_Session_Namespace('enduser_session');    //object of the session
       $this->view->id = $this->session1->id;       
        $uid = $this->session1->id;                 //get the session id
        $mapper = new Application_Model_FollowMapper();
        $mapper->unfollow($pid, $uid);              // call unfollow methos to unfollow item
        $this->_helper->flashMessenger("You have unfollow product");
        $this->_helper->redirector('index');
    }
    
   public function linkedinAction()
   {
       if(isset($_SESSION["loggedin_user_id"]) && !empty($_SESSION["user"])) 
        {
	$user = $_SESSION["user"];
//        echo $user->formattedName;
//        echo $user->emailAddress;
//        echo $user->location->name;
        $id = $user->id;
        $mapper = new Application_Model_FollowMapper();
        $result = $mapper->checkfollow($id);    //call checkfollow method to check if the user follows the products
        if(empty($result))
        {
            //if empty, given the link to start following products
            echo "<div class='container'><br><br><h3> Start Following Products <a href='http://myfollow.local/home/linkedinproducts'>Click here</a></h3></div>";
        }
        else 
        {
            $display = $mapper->displayfollow($id);
            $this->view->result = $display;
        }
        
        }
        else{
		
	if(isset($_SESSION["err_msg"]) && $_SESSION["err_msg"] <> ""){
		echo $_SESSION["err_msg"];
	}
   }
   }
   
   public function linkedinproductsAction()    //an action related to the products
    {
        $user = $_SESSION["user"];
        $id = $user->id;      //user id
       // echo $id; 
        $mapper = new Application_Model_ProductsMapper();
        $resultf = $mapper->linkedinitem($id);      //gives the product which are followed by the current session.
         $resultall = $mapper->ite();       //gives evry products exists.
         $newfollow = array();
         
//         print_r($resultf);
         foreach ($resultf as $key => $value) {
             $newf = array_slice($value,0,2);
             array_push($newfollow, $newf);
         }
         //echo "new Follow : " ;
         //print_r($newfollow);
         //echo "new all products : " ;
         //print_r($resultall);
         
         function udiffCompare($a, $b)  // a function for getting the remaining products which are yet not followed by the user.
            {
             return $a['id'] - $b['id'];
            }

            $arrdiff = array_udiff($resultall, $newfollow, 'udiffCompare');
         //   print_r($arrdiff);
         
     if(empty($resultf)){     //if the user is not following any products
          
        $this->view->result = $resultall;   //display all the products

       }    
       else
       {
       $this->view->result = $arrdiff;      //display products that are unfollowed.
       }
     }
    
       public function linkedinfollowAction()  //to follow the products.
        {


           $productId = $this->getRequest()->getParam('productId'); //get the id of the product.

            $this->view->productid = $productId;

           $user = $_SESSION["user"];
            $id = $user->id; 
            //echo $id;
            $status = 1;
           $mapper = new Application_Model_FollowMapper();
           $check = $mapper->check($productId,$id);
           $this->_helper->flashMessenger('You started following product');     //set flash message
           if(empty($check))    //check whether the product olready followed or not.
           {
            $mapper->follow($productId,$id,$status);
           }
           else {
           $this->_helper->flashMessenger('You started following product');
           }
            $this->_helper->redirector('linkedinproducts');

        }
        
        public function linkedinunfollowAction()    //to unfollow the products
        {
            $pid = $this->getRequest()->getParam('productId');
            $user = $_SESSION["user"];
            $uid = $user->id;                 //get the session id
            $mapper = new Application_Model_FollowMapper();
            $mapper->unfollow($pid, $uid);              // call unfollow methos to unfollow item
            $this->_helper->flashMessenger("You have unfollow product");
            $this->_helper->redirector('linkedin');
        }
   
}