<?php

use Zend_Layout;

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

protected function _initDoctype()
    {
        $bootstrap = $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
        
        Zend_Layout::startMvc();
    }
   
   

}

