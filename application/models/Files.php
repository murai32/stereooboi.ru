<?php

class Application_Model_Files
{
    protected $id;
    protected $name;
    protected $type;
    protected $path;
    protected $album;
    protected $description;
    protected $date;
    
    //magic methods
    public function __set($name, $value)
    {
        $this->$name = $value;
        return $this;
    }
    
    public function __get($name)
    {
//        $name = lcfirst($name);
        
        return $this->$name;
    }
    
    function __call($func_name, $args)
    {

        $vars_args = get_class_vars(__CLASS__);
        $key_args = array_keys($vars_args);
        $functionName = substr($func_name, 0, 3);
        $propertyName = lcfirst(substr($func_name, 3));
        $propertyValue = $args[0];

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

    //regular methods
        

}

