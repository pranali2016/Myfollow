<?php

class HomeController extends Zend_Controller_Action
{

    public function init()
    {
      $messages = $this->_helper->flashMessenger->getMessages();
      if (!empty($messages)) {
            $this->_helper->layout->getView()->message = $messages[0];
        }
    }

    public function indexAction()
    {
       $mapper = new Application_Model_FollowMapper();
        $this->session1 = new Zend_Session_Namespace('enduser_session');
       $this->view->id = $this->session1->id;
        $id = $this->session1->id;
        $result = $mapper->checkfollow($id);
        if(empty($result))
        {
            echo "<div class='container'><br><br><h3> Start Following Products <a href='http://myfollow.local/home/products/?id=".$id."'>Click here</a></h3></div>";
        }
        else 
        {
            $display = $mapper->displayfollow($id);
            $this->view->result = $display;
        }
    
    }
    
    public function productsAction()
    {
        $this->session1 = new Zend_Session_Namespace('enduser_session');
       $this->view->id = $this->session1->id;
        $id = $this->session1->id;      //user id
        $mapper = new Application_Model_ProductsMapper();
        $resultf = $mapper->item($id);
         $resultall = $mapper->ite();
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
         function udiffCompare($a, $b)
            {
             return $a['id'] - $b['id'];
            }

            $arrdiff = array_udiff($resultall, $newfollow, 'udiffCompare');
//            print_r($arrdiff);
         
       if(empty($resultf)){
           
        $this->view->result = $resultall;
        //
       }    
       else
       {
       $this->view->result = $arrdiff;
       }
    }
    
    public function moreAction()
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
    
    public function followAction()
    {
       
        
       $productId = $this->getRequest()->getParam('productId');
        
        $this->view->productid = $productId;
        
       $this->session1 = new Zend_Session_Namespace('enduser_session');
       $this->view->id = $this->session1->id;
        $id = $this->session1->id;
        //echo $id;
        $status = 1;
       $mapper = new Application_Model_FollowMapper();
       $check = $mapper->check($productId,$id);
       $this->_helper->flashMessenger('You started following product');
       if(empty($check))
       {
        $mapper->follow($productId,$id,$status);
       }
       else {
       $this->_helper->flashMessenger('You started following product');
       }
        $this->_helper->redirector('products');
        
    }
    
    public function unfollowAction()
    {
        $pid = $this->getRequest()->getParam('productId');
        $this->session1 = new Zend_Session_Namespace('enduser_session');
       $this->view->id = $this->session1->id;
        $uid = $this->session1->id;
        $mapper = new Application_Model_FollowMapper();
        $mapper->unfollow($pid, $uid);
        $this->_helper->flashMessenger("You have unfollow product");
        $this->_helper->redirector('index');
    }
    
   
}