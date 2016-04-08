<?php

class Application_Form_Login extends Zend_Form
{
    public function init() {
        
        $this->setMethod('post');
        $this->setAttrib('action', 'login');
        
        $this->addElement('text','email',array(
            'label'          => 'Email Id *', 
            'required'       => 'true',
            'filters'        => array('StringTrim'),
            'validators'     => array('EmailAddress'),
            'class'          => array('form-control')
        ));
          
            $this->addElement('password', 'password', array(
                'label'          => 'Password *', 
                     'required'   => true,
                     'validators' => array('Alpha'),
                'class'          => array('form-control')
                 ));
          
         $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
             'class'    => 'btn btn-primary col-lg-12'
        ));
        
    }
}
