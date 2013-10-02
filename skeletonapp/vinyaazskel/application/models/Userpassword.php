<?php

class Application_Model_Userpassword
{
     protected $user_id;
     protected $current_password;
     protected $new_password;
     protected $change_date;
     protected $requested_date;
     protected $generated_key;
    
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
            throw new Exception('Invalid userpassword property');
        }
        $this->$method($value);
    }
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid userpassword property');
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
    public function setUser_id($text)
    {
        $this->user_id=(string)$text;
        return $this;
    }
    public function getUser_id()
    {
       return $this->user_id;
        
    }
    public function setCurrent_password($text)
    {
        $this->current_password = (string) $text;
        return $this;
    }

    public function getCurrent_password()
    {

        return $this->current_password;
    }
    
    public function setNew_password($text)
    {
        $this->new_password = (string) $text;
        return $this;
    }

    public function getNew_password()
    {

        return $this->new_password;
    }
       
    public function setChange_date($text)
    {
        $this->change_date = (int) $text;
        return $this;
    }

    public function getChange_date()
    {

        return $this->change_date;
    }
    
    public function setRequested_date($text)
    {
        $this->requested_date= (int) $text;
        return $this;
    }

    public function getRequested_date()
    {

        return $this->requested_date;
    }

    public function setGenerated_key($email)
    {
        $this->generated_key = (string) $email;
        return $this;
    }

    public function getGenerated_key()
    {
        return $this->generated_key;
    }
    
    


}

