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
    
    public function add($intro,$detail,$image1,$image2,$image3,$image4,$image5,$id)
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
    
    public function display($id)
    {
        $select = $this->getDbTable()->select()
                        ->where('ownerId=?',$id);
        $result = $select->query()->fetchAll();
        return $result;
    }
    
    public function delete($id)
    {
        $this->getDbTable()->delete(array('id = ?' => (int) $id));
    }
    
     public function update($intro,$detail,$id)
    {
     $data = array(
         'intro'  => $intro,
         'detail' => $detail,
     );
     
     $this->getDbTable()->update($data,array('id = ?' => $id));
      
    }
    
    public function find($id)
    {
        $select = $this->getDbTable()->select()
                        ->where('id=?',$id);
        $result = $select->query()->fetchAll();
        return $result;
    }
    
    
    public function item($id)
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
    
    public function ite()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                    ->from('products',['id','intro']);
                $result = $select->query()->fetchAll();        
    
    return $result;
    }

        public function itemid($id)
    { 
    $select = $this->getDbTable()->select()
            ->where('id=?',$id);
    $result = $select->query()->fetchAll();        
    
    return $result;
    }
}

