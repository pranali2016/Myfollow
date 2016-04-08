<?php

class Application_Form_EndUserRegistration extends Zend_Form
{
    
    public function init() {
        parent::init();
        
        $this->setMethod('post'); //set Method
       
        //Email
        $this->addElement('text','email',array(
            'label'         => 'Email *',
            'placeholder'   => 'Email',
            'required'      => 'true',
            'validators'    => array('EmailAddress'),
            'class'         => array('form-control')
        ));
        
        //password
        $this->addElement('password', 'password', array(
                'label'          => 'Password *', 
                'placeholder'    => 'Password',
                'description'    => 'Must be at least 8 - 15 characters including  letters no number. ',
                     'required'   => true,
                     'validators' => array('Alpha'),
                'class'          => array('form-control')
        ));
        
        $this->addElement('password', 'verifypassword', array(
              'label'          => 'Confirm Password *',
            'placeholder'    => 'Confirm Password',
                'required'   => true,
                'validators' => array(
                    array('identical', true, array('password'))
                ),
              'class'          => array('form-control')
            ));
        //radio button
        $this->gender = new Zend_Form_Element_Radio('gender');
        $this->gender->setLabel("Gender *")
                ->setMultiOptions(array('1'=>'Male', '0'=>'Female'))
                ->setSeparator('&nbsp&nbsp    &nbsp')
                ->setValue("0");
        
        //date of birth
        $this->addElement('text','dob',array(
            'label'         => 'Date Of Birth *',
            'placeholder'    => 'Date of Birth',
            'description'    => 'Date format in (yyyy/mm/dd) ',
            'required'      => 'true',
            'validators'   => array (
                                array('date', false, array('yyyy/mm/dd'))
                                ),
            'class'         => array('form-control','col-lg-2')
        ));
        
        //Address
        $this->addElement('text','street1',array(
            'label'         => 'Street *',
            'placeholder'    => 'Street',
            'required'      => 'true',
            'class'         => array('form-control')
        ));
        
        $this->addElement('text','street2',array(
            'label'         => 'Area *',
            'placeholder'    => 'Area',
            'required'      => 'true',
            'class'         => array('form-control')
        ));
        
        $this->addElement('text','city',array(
            'label'         => 'City *',
            'placeholder'    => 'City',
            'required'      => 'true',
            'class'         => array('form-control')
        ));
        
        $this->addElement('text','state',array(
            'label'         => 'State *',
            'placeholder'    => 'State',
            'required'      => 'true',
            'class'         => array('form-control')
        ));
        
        $this->addElement('text','country',array(
            'label'         => 'country *',
            'placeholder'    => 'Country',
            'required'      => 'true',
            'class'         => array('form-control')
        ));
        
        $this->addElement('text','pin',array(
            'label'         => 'Pin Code *',
            'placeholder'    => 'Pin Code',
            'required'      => 'true',
            'validators'    => array(
                                        array('StringLength', false, array(6, 6, 'messages' => array(
                                                    'stringLengthInvalid'           => "Pin code Length Invalid entry",
                                                    'stringLengthTooShort'          => "pincode Invalid Length , ex. 390001"
                                            ))),
                               ),
            'class'         => array('form-control')
        ));
        
        $this->addElement('text','contactno',array(
            'label'         => 'Contact No *',
            'placeholder'    => 'Contact No',
            'required'      => 'true',
            'tabindex'      => '13',
            'validators'    => array(
                                        array('Digits', false, array(
                                                'messages' => array(
                                                    'notDigits'     => "Phone Invalid Digits, ex. 1234567890",
                                                    'digitsStringEmpty' => "can\'t be empty",
                                                ))),
                                        
                                        array('StringLength', false, array(10, 10, 'messages' => array(
                                                    'stringLengthTooShort'          => "Phone Invalid Length , ex. 1234567890"
                                            ))),
                                ),
            'filters'       => array('StringTrim'),
            'class'         => array('form-control')
        ));
        
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Register',
             'class'    => 'btn btn-primary'
        ));
    }
    
}

