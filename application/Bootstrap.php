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
   
  protected function _initPlaceholders()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        
        $view->doctype('XHTML1_STRICT');

        $view->placeholder('sidebar')
             // "prefix" -> markup to emit once before all items in collection
             ->setPrefix("<div class=\"sidebar\">\n    <div class=\"block\">\n")
             // "separator" -> markup to emit between items in a collection
             ->setSeparator("</div>\n    <div class=\"block\">\n")
             // "postfix" -> markup to emit once after all items in a collection
             ->setPostfix("</div>\n</div>");
    }
     

}

