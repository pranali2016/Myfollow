<?php

class Application_Model_ProductsMapper
{
    
     protected $_dbTable;
    
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Products');
        }
        return $this->_dbTable;
    }
    
    public function add($intro,$detail,$image1,$image2,$image3,$image4,$image5,$id)     //insert product details
    {
        //echo $intro." ".$detail." ".$id;
      $data = array( 'intro' => $intro,
		    'detail' => $detail,
		    'image1' => $image1,
		    'image2' => $image2,
		    'image3' => $image3,
                    'image4' => $image4,
                    'image5' => $image5,
                    'ownerId'=> $id          
          );
    $this->getDbTable()->insert($data);
       
    }
    
    public function display($id)    //fetch all the products added by the owner with id = $id
    {
        $select = $this->getDbTable()->select()
                        ->where('ownerId=?',$id);
        $result = $select->query()->fetchAll();
        return $result;
    }
    
    public function delete($id)     // delete the products
    {
        $this->getDbTable()->delete(array('id = ?' => (int) $id));
    }
    
     public function update($intro,$detail,$id)     //update the products
    {
     $data = array(
         'intro'  => $intro,
         'detail' => $detail,
     );
     
     $this->getDbTable()->update($data,array('id = ?' => $id));
      
    }
    
    public function find($id)       // find the products.
    {
        $select = $this->getDbTable()->select()
                        ->where('id=?',$id);
        $result = $select->query()->fetchAll();
        return $result;
    }
    
    
    public function item($id)       //join query for follow and products to get the which user follow wich items
    { 
        $db = Zend_Db_Table::getDefaultAdapter();
        //print_r($db);
        echo "<pre>";
        $select = $db->select()
            ->from(['p' => 'products'], ['id','intro'])
            ->join(array('f' => 'follow'), 'f.productId = p.id')
            ->where('f.userId = ?', $id)
            ->where('f.state=?',1);

$query = $select->query()->fetchAll();
//       print_r($query);
//    exit; 
//    $select = "SELECT * 
//            FROM products
//            JOIN follow ON products.id != follow.productId
//            WHERE follow.userId =1";
//    
    
    return $query;
    }
    
    public function ite()       //get all the products 
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                    ->from('products',['id','intro']);
                $result = $select->query()->fetchAll();        
    
    return $result;
    }

    public function itemid($id)     //get product by product id.
    { 
    $select = $this->getDbTable()->select()
            ->where('id=?',$id);
    $result = $select->query()->fetchAll();        
    
    return $result;
    }
}

