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
            $this->setDbTable('Application_Model_DbTable_Admin');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Admin $admin)
    {
        $data = array(
            'email'   => $admin->getEmail(),
            'companyName' => $admin->getCompanyName(),
            'name' => $admin->getName(),
        );
            $this->getDbTable()->insert($data);
  
    }
    
}

