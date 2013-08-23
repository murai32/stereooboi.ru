<?php

class CatalogueController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $mapper = new Application_Model_ProductsMapper();
        $this->view->products = $mapper->fetchAll();
    }


}

