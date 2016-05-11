
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
            $this->setDbTable('Application_Model_DbTable_Products'); //get the table products.
        }
        return $this->_dbTable;
    }
    
    public function add($intro,$detail,$id)  //insert product details
    {
       
      $data = array( 'intro' => $intro,
		    'detail' => $detail,
                    'ownerId'=> $id          
          );
          $pid = $this->getDbTable()->insert($data);
          return $pid;
       
    }
    
    public function display($id)  //fetch all the products added by the owner with id = $id
    {
        $select = $this->getDbTable()->select()
                        ->order('updated_at DESC')
                        ->where('ownerId=?',$id);
        $result = $select->query()->fetchAll();
        return $result;
    }
    
    public function delete($id) // delete the products
    {
        $this->getDbTable()->delete(array('id = ?' => (int) $id));
    }
    
     public function update($intro,$detail,$id)  //update the products
    {
     $data = array(
         'intro'  => $intro,
         'detail' => $detail,
     );
     
     $this->getDbTable()->update($data,array('id = ?' => $id));
      
    }
    
    public function find($id)  // find the products for update action.
    {
        $select = $this->getDbTable()->select()
                        ->where('id=?',$id);
        $result = $select->query()->fetchAll();
        return $result;
    }
    
    public function image($pid)     //update action
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                    ->from('images')
                    ->where('productId = ?',$pid);
        return $select->query()->fetchAll();
    }
    
    public function item($id)  //join query for follow and products to get the which user follow wich items
    { 
        $db = Zend_Db_Table::getDefaultAdapter();
        echo "<pre>";
        $select = $db->select()
            ->from(['p' => 'products'], ['id','intro'])
            ->join(array('f' => 'follow'), 'f.productId = p.id')
            ->where('f.userId = ?', $id)
            ->where('f.state=?',1);

        $query = $select->query()->fetchAll();

        return $query;
    }
    
    public function ite() //get all the products as result 
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()
                    ->order('updated_at desc')
                    ->from('products',['id','intro']);
                $result = $select->query()->fetchAll();        
    
    return $result;
    }

    public function itemid($id)  //get product by product id.
    { 
    $select = $this->getDbTable()->select()
            ->where('id=?',$id);
    $result = $select->query()->fetchAll();        
    
    return $result;
    }
    
    public function linkedinitem($id)  //join query for follow and products to get the which user follow which items for oauth users
    { 
        $db = Zend_Db_Table::getDefaultAdapter();
        echo "<pre>";
        $select = $db->select()
            ->from(['p' => 'products'], ['id','intro'])
            ->join(array('f' => 'follow'), 'f.productId = p.id')
            ->where('f.userId = ?', $id)
            ->order('p.updated_at desc')
            ->where('f.state=?',1);

        $query = $select->query()->fetchAll();  
    
        return $query;
    }
    
    public function images($pid,$images)  //to insert images in the images folder.
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $data = [
          'productId'   => $pid,
           'image'      => $images,
        ];
        $db->insert('images',$data);
    }
    
}

