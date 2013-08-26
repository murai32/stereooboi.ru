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
        $this->view->stamps = $mapper->fetchTypeWhere('штамп');
        $this->view->wallpapers = $mapper->fetchTypeWhere('обои');
        $this->view->rollers = $mapper->fetchTypeWhere('ролик');
    }

}

