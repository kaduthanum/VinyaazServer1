<?php

class Application_Model_Productproperty
{
   protected $property_id;
   protected $product_id;
   protected $value;
   protected $prydescription;
   protected $long_description;
   protected $status;



   public function __construct(array $options = null)
    {
        if (is_array($options)) 
        {
            $this->setOptions($options);
        }
    }
    public function __set($name, $value)

    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid user property');
        }
        $this->$method($value);
    }
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid user property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }

        return $this;
    }
    public function setProperty_id($ts)
    {
        $this->property_id=(int)$ts;
        return $this;
    }
    public function getProperty_id()
    {
       return $this->property_id;
        
    }
    public function setProduct_id($ts)
    {
        $this->product_id = (int) $ts;
        return $this;
    }

    public function getProduct_id()
    {

        return $this->product_id;
    }
    
    public function setValue($text)
    {
        $this->value = (string) $text;
        return $this;
    }

    public function getValue()
    {

        return $this->value;
    }
       
    public function setPrydescription($text)
    {
        $this->prydescription = (string) $text;
        return $this;
    }

    public function getPrydescription()
    {

        return $this->prydescription;
    }
    
    public function setLong_description($text)
    {
        $this->long_description = (string) $text;
        return $this;
    }

    public function getLong_description()
    {

        return $this->long_description;
    }
    public function setStatus($text)
    {
        $this->status=(string)$text;
        return $this;
    }
    public function getStatus()
    {
        return $this->status;
    }
}

