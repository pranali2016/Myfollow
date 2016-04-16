<?php

class HomeController extends Zend_Controller_Action
{

    public function init()
    {
      $messages = $this->_helper->flashMessenger->getMessages();
        if(!empty($messages))
        $this->_helper->layout->getView()->message = $messages[0];
    }

    public function indexAction()
    {
       $mapper = new Application_Model_EnduserMapper();
        $this->session1 = new Zend_Session_Namespace('enduser_session');
       $this->view->id = $this->session1->id;
        $id = $this->session1->id;
        
       
    
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
       if(empty($check))
       {
        $mapper->follow($productId,$id,$status);
       }
       else {
       $this->_helper->flashMessenger('You have already followed product.');
       }
        $this->_helper->redirector('products');
        
    }
    
   
}