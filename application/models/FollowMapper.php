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
    
    

    public function follow($pid,$uid,$status) //insert the record to the databaase
    {
        
        $data = ['productId'       => $pid,
          'userId'          => $uid,
          'state'          => $status,
          
          ];
//        echo $pid." ".$uid." ".$status." <pre>";
//       exit;
        $this->getDbTable()->insert($data);
//        echo '<pre>';
//        print_r($db);
//        exit;
        
      }
      
      public function check($pid,$uid)      //check whether the product is followed or not
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
      public function checkfollow($uid)
      {
          $select = $this->getDbTable()->select()
                        ->where('userId=?',$uid);
          $result = $select->query()->fetchAll();
          if(count($result))
          {
              return $result;
          }
      }
      
      public function displayfollow($uid)   //display all the products which are followed.
      {
          $db = Zend_Db_Table::getDefaultAdapter();
          $select = $db->select()
            ->from(['p' => 'products'])
            ->join(array('f' => 'follow'), 'f.productId = p.id')
            ->where('f.userId = ?', $uid);
          $result = $select->query()->fetchAll();
          return $result;
      }
      
      public function unfollow($pid,$uid)       //delete the products from the follow table
      {
          $this->getDbTable()->delete(array('productId= ?' => $pid, 'userId=?' => $uid));
      }
}

