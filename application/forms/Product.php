<?php

class Application_Form_Product extends Zend_Form {

    public function init()
    {
        $this->setAction('controller/add-new-entry')->setMethod('post');

        

        $this->addElement('text', 'type', array(
            'label' => 'Тип продукта:',
            'value' => $this->id ? $this->id : NULL
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

        $this->addElement('text', 'foto', array(
            'label' => 'Адрес где находится фотография:'
        ));

        $this->addElement('text', 'recommended_products', array(
            'label' => 'Сопутствующие товары:'
        ));


        $this->addElement('submit', 'submit', array(
            'label' => 'Сохранить'
        ));
    }

}

