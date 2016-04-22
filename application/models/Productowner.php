<?php

class Application_Model_Productowner
{
    protected $_email;
    protected $_password;
    protected $_companyName;
    protected $_description;
    protected $_doj;
    protected $_foundedIn;
    protected $_street1;
    protected $_street2;
    protected $_city;
    protected $_state;
    protected $_country;
    protected $_pin;
    protected $_contactNo;
    protected $_websiteUrl;
    protected $_twitterHandler;
    protected $_facebookPage;
    
    
    public function __construct(array $options = NULL) {
        if(is_array($options))
        {
            $this->setOptions($options);
        }
    }
    
      public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }
 
    public function getEmail()
    {
        return $this->_email;
    }
     public function setPassword($password)
    {
        $this->_password = (string) $password;
        return $this;
    }
 
    public function getPassword()
    {
        return $this->_password;
    }
    
    
     public function setCompanyName($companyName)
    {
        $this->_companyName = (string) $companyName;
        return $this;
    }
 
    public function getCompanyName()
    {
        return $this->_companyName;
    }
    
    public function setDescription($description)
    {
        $this->_description = (string) $description;
        return $this;
    }
 
    public function getDescription()
    {
        return $this->_description;
    }
    
    public function setDoj($doj)
    {
        $this->_doj = (string) $doj;
        return $this;
    }
 
    public function getDoj()
    {
        return $this->_doj;
    }
    
    public function setFoundedIn($foundedin)
    {
        $this->_foundedIn = (string) $foundedin;
        return $this;
    }
 
    public function getFoundedIn()
    {
        return $this->_foundedIn;
    }
    
    public function setStreet1($street1)
    {
        $this->_street1 = (string) $street1;
        return $this;
    }
 
    public function getStreet1()
    {
        return $this->_street1;
    }
    
    public function setStreet2($street2)
    {
        $this->_street2 = (string) $street2;
        return $this;
    }
 
    public function getStreet2()
    {
        return $this->_street2;
    }
    
    public function setCity($city)
    {
        $this->_city = (string) $city;
        return $this;
    }
 
    public function getCity()
    {
        return $this->_city;
    }
    
    public function setState($state)
    {
        $this->_state = (string) $state;
        return $this;
    }
 
    public function getState()
    {
        return $this->_state;
    }
    
    public function setCountry($country)
    {
        $this->_country = (string) $country;
        return $this;
    }
 
    public function getCountry()
    {
        return $this->_country;
    }
    
    public function setPin($pin)
    {
        $this->_pin = (string) $pin;
        return $this;
    }
 
    public function getPin()
    {
        return $this->_pin;
    }
    
     public function setContactNo($contactNo)
    {
        $this->_contactNo = (string) $contactNo;
        return $this;
    }
 
    public function getContactNo()
    {
        return $this->_contactNo;
    }
    
    
    public function setWebsiteUrl($website)
    {
        $this->_websiteUrl = (string) $website;
        return $this;
    }
 
    public function getWebsiteUrl()
    {
        return $this->_websiteUrl;
    }
    
    public function setTwitterHandler($twitter)
    {
        $this->_twitterHandler = (string) $twitter;
        return $this;
    }
 
    public function getFacebookPage()
    {
        return $this->_facebookPage;
    }
    
    public function setFacebookPage($facebook)
    {
        $this->_facebookPage = (string) $facebook;
        return $this;
    }
 
    public function getTwitterHandler()
    {
        return $this->_twitterHandler;
    }
    
    
}