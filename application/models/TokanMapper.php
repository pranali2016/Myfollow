<?php

class Application_Model_TokanMapper
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
            $this->setDbTable('Application_Model_DbTable_Tokan');   //gives admin table.
        }
        return $this->_dbTable;
    }
 
    public function token($email,$company) 
    {
        
        $data = [
          'email'   => $email,
          'company' => $company
        ];
        
       $token = $this->getDbTable()->insert($data);
        
       return $token;
    }
    
    public function fetchdetail($token)        //get the details of product owner by the is given
    {
       
        $select = $this->getDbTable()->select()
            ->where('tokan = ?', $token);
          $result = $select->query()->fetchAll();
         
        if(count($result) != 0)
        {
            return $result;
        }
    }
}

