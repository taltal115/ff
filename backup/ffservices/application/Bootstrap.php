<?php


     class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {


             protected function _initRequest()
             {
                    Zend_Layout::startMvc();

             }


     }
