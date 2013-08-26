<?php

class Application_Form_ProductAbstract extends Zend_Form {

    
    
    public function init()
    {
        $this->setMethod('post')->setAttrib('enctype', 'multipart/form-data');
        
        
        $this->addElement('text', 'type', array(
            'label' => 'Тип продукта:'
        ));
        
        $this->addElement('text', 'album', array(
            'label' => 'Альбом продукта:'
        ));

        $this->addElement('text', 'name', array(
            'label' => 'Название:'
        ));

        $this->addElement('text', 'amount', array(
            'label' => 'Количество на складе:'
        ));

        $this->addElement('textarea', 'description', array(
            'label' => 'Описание товара:',
            'rows' => '10'
        ));

        $this->addElement('text', 'price', array(
            'label' => 'Цена:'
        ));


        $this->addElement('text', 'recommended_products', array(
            'label' => 'Сопутствующие товары:'
        ));


        $this->addElement('submit', 'submit', array(
            'label' => 'Сохранить'
        ));
    }
    
    public function setValue(Application_Model_Products $product)
    {
//        $this->getElement('type')->setOptions(array(
//            'value' => $product->getType()
//        ));
        
//        $allElements = $this->getElements();
        $allElements = array_keys($this->getElements());
//        $a = get_class_vars('Application_Model_Products');
//        $allVariables = $product->getVars();
        $allVariables = array_keys($product->getVars());
        
        foreach ($allElements as $element)
        {
            if(in_array($element, $allVariables))
            {
                $getterName = 'get' . ucfirst($element);
                $this->getElement($element)->setOptions(array(
                    'value' => $product->$getterName()
                ));
            }
        }
    }
          

}

