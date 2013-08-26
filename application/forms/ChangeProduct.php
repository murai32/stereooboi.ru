<?php
class Application_Form_ChangeProduct extends Application_Form_ProductAbstract
{
    public function init()
    {
        parent::init();
        
        $this->addElement('file', 'foto', array(
            'label' => 'Загрузить новое фото:',
            'destination' => PUBLIC_PATH . '/imgs',
            'order' => 4
        ));
        
//        $this->addElement('hidden', 'id', array(
//            'label' => 'ID товара',
//            'order' => 0
//        ));
    }
}
?>
