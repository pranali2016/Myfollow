<?php

class Application_Form_Login extends Zend_Form
{
    public function init() {
        
        $this->setMethod('post');
        $this->setAttrib('action', 'login');
        
        $this->addElement('text','email',array(
            'label'          => 'Email', 'class' => array('col-lg-2 control-label'),
            'required'       => 'true',
            'filters'        => array('StringTrim'),
            'validators'     => array('EmailAddress'),
            'class'          => array('form-group')
        ));
          
            $this->addElement('password', 'password', array(
                'label'          => 'Password', 'class' => array('col-lg-2 control-label'),
                     'required'   => true,
                     'validators' => array('Alpha'),
                'class'          => array('form-group')
                 ));
          $this->addElement('password', 'verifypassword', array(
              'label'          => 'Confirm Password', 'class' => array('col-lg-2 control-label'),
                'required'   => true,
                'validators' => array(
                    array('identical', true, array('password'))
                ),
              'class'          => array('form-group')
            ));
         $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Login',
             'class'    => 'btn btn-primary'
        ));
        
    }
}
