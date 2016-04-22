<?php

class Application_Model_FollowMapper
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
            $this->setDbTable('Application_Model_DbTable_Follow');
        }
        return $this->_dbTable;
    }
    
    

    public function follow($pid,$uid,$status)       //insert the record to the follow table
    {
        $data = ['productId'       => $pid,
          'userId'          => $uid,
          'state'          => $status,
          
          ];
        $this->getDbTable()->insert($data);
      }
      
      
      
      public function check($pid,$uid)   //display the product with id=$pid is followed by the user with id = $uid
      {
          $select = $this->getDbTable()->select()
                  ->where('productId=?',$pid)
                  ->where('userId=?',$uid);
          
          $result = $select->query()->fetchAll();
          if(count($result))
          {
              return $result;
          }
      }
      
      
      public function checkfollow($uid)  //check whether the user with id=$uid following any product
      {
          $select = $this->getDbTable()->select()
                        ->where('userId=?',$uid);
          $result = $select->query()->fetchAll();
          if(count($result))
          {
              return $result;
          }
      }
      
      
      public function displayfollow($uid)     //To display all the products which are followed.
      {
          $db = Zend_Db_Table::getDefaultAdapter();
          $select = $db->select()
            ->from(['p' => 'products'])
            ->join(array('f' => 'follow'), 'f.productId = p.id')
            ->order('p.updated_at DESC')
            ->where('f.userId = ?', $uid);
          $result = $select->query()->fetchAll();
          return $result;
      }
      
      
      
      public function unfollow($pid,$uid)     //remove the productid = $pid which are followed by userid = $uid
      {
          $this->getDbTable()->delete(array('productId= ?' => $pid, 'userId=?' => $uid));
      }
      
      
      
      public function imagefollow($uid)   // display the images whose productid matched to the image table's productid
      {
          $db = Zend_Db_Table::getDefaultAdapter();
          $select = $db->select()
                    ->from(['i' => 'images'])
                    ->join(['f' => 'follow'], 'f.productId = i.productId')
                    ->where('f.userId =?',$uid);
          $result = $select->query()->fetchAll();
          return $result;
      }
}

