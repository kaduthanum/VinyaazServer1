<?php

class Application_Model_Product
{
    protected $product_id;
    protected $name;
    protected $description;
    protected $category;
    protected $status;
    protected $exclusive_indicatoy;
    protected $user_id;
    
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
    public function setProduct_id($text)
    {
        $this->product_id=(int)$text;
        return $this;
    }
    public function getProduct_id()
    {
       return $this->product_id;
        
    }
    public function setName($text)
    {
        $this->name = (string) $text;
        return $this;
    }

    public function getName()
    {

        return $this->name;
    }
    
    public function setDescription($text)
    {
        $this->description = (string) $text;
        return $this;
    }

    public function getDescription()
    {

        return $this->description;
    }
       
    public function setCategory($text)
    {
        $this->category = (string) $text;
        return $this;
    }

    public function getCategory()
    {

        return $this->category;
    }
    
    public function setStatus($text)
    {
        $this->status = (string) $text;
        return $this;
    }

    public function getStatus()
    {

        return $this->status;
    }

    public function setExclusive_indicatoy($ts)
    {
        $this->exclusive_indicatoy = (int) $ts;
        return $this;
    }

    public function getExclusive_indicatoy()
    {
        return $this->exclusive_indicatoy;
    }
    
    public function setUser_id($ts)
    {
        $this->user_id =(int) $ts;
        return $this;
    }
    public function getUser_id()
    {
        return $this->user_id;

    }
}

