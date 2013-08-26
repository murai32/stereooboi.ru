<?php

class AdminController extends Zend_Controller_Action
{
    //TODO Нельзя сохранить два фаила с одинаковым название
    //если изображения нет, надо об этом как то сообщить в model_product->checkImg() 
    //проверяет есть ли изображение и выдает тэг img или сообщение о том что нет 
    //Расставить валидаторы на все элементы формы
    //ошибка при загрузке фаила с человеком на фоне скалы, в шляпе
    //coockie должны быть включены для работы сайта
    


    //в эту папку сохраняются фотографии 
    protected $imgFolder = '/imgs/';

    public function init()
    {
        /* Initialize action controller here */
        $auth = Zend_Auth::getInstance();
        if(!$auth->getIdentity())
        {
            $this->_redirect('/auth/login');
        }
    }

    public function indexAction()
    {
        $productsMapper = new Application_Model_ProductsMapper();
        
        $this->view->products = $productsMapper->fetchAll();
        
    }

    public function addNewEntryAction()
    {
        $form = new Application_Form_AddNewProduct();
        
        $request = $this->getRequest();
        
        
        if($this->getRequest()->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $products = new Application_Model_Products($form->getValues());
//                $request->getParam('id') ? $products->setId($request->getParam('id')) : null;
                $imgName = $this->imgFolder . $form->getValue('foto');
                $products->setFoto($imgName);
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
        $form = new Application_Form_ChangeProduct();
        $request = $this->getRequest();
        
        if (!$this->getRequest()->isPost())
        {
            $id = $request->getParam('id');
            $this->view->id = $id;

            $productsMapper = new Application_Model_ProductsMapper();
            $product = new Application_Model_Products();
            $productsMapper->find($id, $product);

            
            $form->setValue($product);

            
        }
        else if($this->getRequest()->isPost())
        {
            if($form->isValid($request->getPost()))
            {
                $products = new Application_Model_Products($form->getValues());
//                $products->setId($request->getParam('id'));
                
                if($form->getValue('foto'))
                {
                    $imgName = $this->imgFolder . $form->getValue('foto');
                    $products->setFoto($imgName);
                }
                else
                {
                    $products->unsetFoto();
                }
                
                $productsMapper = new Application_Model_ProductsMapper();
                
                $productsMapper->save($products);
                return $this->_helper->redirector('index');      
            }
        }
        
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





