<?php


class Application_Form_AddNewProduct extends Application_Form_ProductAbstract
{
    
    public function init()
    {
        parent::init();
        
        $this->addElement('file', 'foto', array(
            'label' => 'Загрузить фото:',
            'destination' => PUBLIC_PATH . '/imgs',
            'order' => 4
        ));
    }
    
}

?>
