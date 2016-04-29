<?php

class Application_Model_AdminMapper
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
            $this->setDbTable('Application_Model_DbTable_Admin');   //gives admin table.
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Admin $admin)    //insert data to the admin table
    {
        $data = array(
            'email'   => $admin->getEmail(),
            'companyName' => $admin->getCompanyName(),
            'name' => $admin->getName(),
        );
            $this->getDbTable()->insert($data);
  
    }
    
   public function display()        //get the details of product owner by the is given
    {
        $select = $this->getDbTable()->select();
        $result = $select->query()->fetchAll();
        
        if(count($result) != 0)
        {
            return $result;
        }
    }
    
     public function fetch($id)        //get the details of product owner by the is given
    {
        $select = $this->getDbTable()->select()
                    ->where('id = ?',$id);
        $result = $select->query()->fetchAll();
        
        if(count($result) != 0)
        {
            return $result;
        }
    }
    
    public function update($id)        //get the details of product owner by the is given
    {
        $set = ['approve' => 1];
        $where = ['id = ?' => $id];
        $this->getDbTable()->update($set,$where);
    }
    
    public function find($email)        //get the details of product owner by the is given
    {
        $select = $this->getDbTable()->select()
                    ->where('email = ?',$email);
        $result = $select->query()->fetchAll();
        
        if(count($result) != 0)
        {
            return $result;
        }
    }
    public function token($email,$company) 
    {
        $db = Zend_Db_Table::getDefaultAdapter();
      
        $data = [
          'email'   => $email,
          'company' => $company
        ];
        
       $token = $db->insert('tokan', $data);
        
       return $token;
    }
    
    public function fetchdetail($token)        //get the details of product owner by the is given
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        
        $select = $db->select()
            ->from('tokan')
            ->where('tokan = ?', $token);
          $result = $select->query()->fetchAll();
         
        if(count($result) != 0)
        {
            return $result;
        }
    }
}

