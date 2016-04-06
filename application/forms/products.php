<?php

class Application_Form_Products extends Zend_Form
{
    public function init() {
     
        $this->setMethod('post');
        $this->setAttrib('encrypt','multipart/form-data');
        

        $this->addElement('textarea','intro',array(
            'label'          => 'Introduction',
            'required'       => 'true',
             'rows'       => '3',
            'filters'        => array('StringTrim'),
            'class'          => array('form-group')
         ));
        
        $this->addElement('textarea', 'comment', array(
            'rows'       => '5',
            'label'      => 'Brief about your product ',
            'required'   => 'true',
            'validators' => array(
                            array('validator' => 'StringLength')// 'options' => array(0, 10))
                                  ),
             'class'     => array('form-group')
         ));
       
        
       $this->image = new Zend_Form_Element_File('image');
        $this->image->setLabel("Upload Image ")
            ->setMultiFile(5)
            ->setMaxFileSize(10240000) // limits the filesize on the client side
            ->setDescription('Click Choose File and click on the image file you would like to upload')
            ->addValidator('Count', false, 5)                // ensure only 1 file
            ->addValidator('Size', false, 10240000)
            ->addValidator('Extension', false, 'jpg,jpeg,png,gif');

        
   
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Submit',
            'class'    => 'btn btn-primary'
        ));
         
           
    }
    
 }


