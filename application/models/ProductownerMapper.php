<?php

class Application_Model_ProductownerMapper
{
    protected $_dbTable;

    //protected $_db = 'myfollow';


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
            $this->setDbTable('Application_Model_DbTable_Productowner');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Productowner $owner)
    {
        $data = array(
            'email'   => $owner->getEmail(),
            'password'   => $owner->getPassword(),
            'companyName' => $owner->getCompanyName(),
            'description' => $owner->getDescription(),
            'doj'         => $owner->getDoj(),
            'foundedIn'   => $owner->getFoundedIn(),
            'street1'     => $owner->getStreet1(),
            'street2'     => $owner->getStreet2(),
            'city'        => $owner->getCity(),
            'state'       => $owner->getState(),
           'country'     => $owner->getCountry(),
           'pin'         => $owner->getPin(),
           'contactNo'   => $owner->getContactNo(),
           'websiteUrl'  => $owner->getWebsiteUrl(),
           'twitterHandler' =>$owner->getTwitterHandler(),
           'facebookPage'=> $owner->getFacebookPage(),
        );
            $this->getDbTable()->insert($data);
  
    }

        public function login($email,$password)
    {
        echo "<pre>";
   
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

