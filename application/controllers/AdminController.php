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
        
//        echo 'Идентификатор: ' . $id;
        
        $form = new Application_Form_Product();
//        $form->id = (string)$id;
        
        $this->view->form = $form;
        $form->setAttrib('id',$id);
        
        
    }


}





