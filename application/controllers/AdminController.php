<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $productsMapper = new Application_Model_ProductsMapper();
        $this->view->products = $productsMapper->fetchAll();
    }

    public function addNewEntryAction()
    {
        $form = new Application_Form_Product();
        
        $request = $this->getRequest();
        
        
        if($this->getRequest()->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $products = new Application_Model_Products($form->getValues());
                $request->getParam('id') ? $products->setId($request->getParam('id')) : null;
                $productsMapper = new Application_Model_ProductsMapper();
                
                $productsMapper->save($products);
                return $this->_helper->redirector('index');      
            }
        }
        
        $this->view->form = $form;
        // action body
    }

    public function changeProductAction()
    {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        $this->view->id = $id;
        
        $productsMapper = new Application_Model_ProductsMapper();
        $product = new Application_Model_Products();
        $productsMapper->find($id, $product);
        
        $form = new Application_Form_Product();
        $form->setValue($product);
        
        
        //todo: метод который показывает все перменые свои в Фзздшсфешщт
        $this->view->form = $form;
        
    }
    
    public function delProductAction()
    {
        $request = $this->getRequest();
        $id = $request->getParam('id');
        
        $productsMapper = new Application_Model_ProductsMapper();
        $productsMapper->delete($id);
        
        return $this->_helper->redirector('index');
    }


}





