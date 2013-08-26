<?php
//TODO избавиться от использования метода __call

class Application_Model_Products
{
    protected $id;
    protected $type;
    protected $name;
    protected $amount;
    protected $description;
    protected $price;
    protected $foto;
    protected $recommended_products;
    
    function __call($func_name, $args)
    {

        $vars_args = get_class_vars(__CLASS__);
        $key_args = array_keys($vars_args);
        $functionName = substr($func_name, 0, 3);
        $propertyName = lcfirst(substr($func_name, 3));
        $propertyValue = $args ? $args[0] : false;    

        if (!in_array($propertyName, $key_args))
        {
            return NULL;
        };

        switch ($functionName)
        {
            case 'get':
                return $this->$propertyName;
            case 'set':
                $this->$propertyName = $propertyValue;
                return $this;
            default:
                return NULL;
        }
    }
    
    public function __construct(array $options = null)
    {
        if(is_array($options))
        {
            $this->setOptions($options);
        }
        
    }
    
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value)
        {
            $method = 'set' . ucfirst($key);
//            if(in_array($method, $methods))
//            {
                $this->$method($value);
//            }
        }
        return $this;
    }
    
    public function getVars()
    {
        return get_class_vars(__CLASS__);
    }
    
    public function unsetFoto()
    {
        unset($this->foto);
    }
    

}

