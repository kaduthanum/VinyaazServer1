<?php

class Application_Model_Productpropertymedia
{

    protected $media_id;
    protected $product_id;
    protected $type;
    protected $path;
    protected $usage_type;
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
    public function setMedia_id($ts)
    {
        $this->media_id=(int)$ts;
        return $this;
    }
    public function getMedia_id()
    {
       return $this->media_id;
        
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
    
    public function setType($text)
    {
        $this->type = (string) $text;
        return $this;
    }

    public function getType()
    {

        return $this->type;
    }
       
    public function setPath($text)
    {
        $this->path = (string) $text;
        return $this;
    }

    public function getPath()
    {

        return $this->path;
    }
    
    public function setUsage_type($text)
    {
        $this->usage_type = (string) $text;
        return $this;
    }

    public function getUsage_type()
    {

        return $this->usage_type;
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

