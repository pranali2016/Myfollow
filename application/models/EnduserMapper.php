<?php

class Application_Model_EnduserMapper
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
            $this->setDbTable('Application_Model_DbTable_Enduser');
        }
        return $this->_dbTable;
    }
    
    public function insert($e,$e1,$e2,$e3,$e4,$e5,$e6,$e7,$e8,$e9,$e10)
    {
        /*echo $e." ".$e1." ".$e2." ".$e3." ".$e4." ".$e5." ".$e6;
        exit;*/
        
        $data = array(
            'email'         => $e,
            'password'      => $e1,
            'gender'        => $e2,
            'dob'           => $e3,
            'street1'       => $e4,
            'street2'       => $e5,
            'city'          => $e6,
            'state'         => $e7,
            'country'       => $e8,
            'pin'           => $e9,
            'contactNo'     => $e10
            
        );
        
        $this->getDbTable()->insert($data);
    }
    
    public function login($email,$password)
    {
       $select = $this->getDbTable()->select()
               ->where('email=?',$email)
                ->where('password=?', $password);
       
       $result = $select->query()->fetchAll();
    
       if(count($result) != 0)
       {
           return $result;
       }
    }
}

