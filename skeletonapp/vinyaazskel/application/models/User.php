<?php

class Application_Model_User
{
    protected $user_id;
    protected $first_name;
    protected $middle_name;
    protected $last_name;
    protected $address1;
    protected $email_id;
    protected $phone;
    protected $mobile;
    protected $home;
    protected $fax;
    protected $login_attempts;
    protected $status;
    protected $user_type;


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
    public function setUser_id($text)
    {
        $this->user_id=(int)$text;
        return $this;
    }
    public function getUser_id()
    {
       return $this->user_id;
        
    }
    public function setFirst_name($text)
    {
        $this->first_name = (string) $text;
        return $this;
    }

    public function getFirst_name()
    {

        return $this->first_name;
    }
    
    public function setMiddle_name($text)
    {
        $this->middle_name = (string) $text;
        return $this;
    }

    public function getMiddle_name()
    {

        return $this->middle_name;
    }
       
    public function setLast_name($text)
    {
        $this->last_name = (string) $text;
        return $this;
    }

    public function getLast_name()
    {

        return $this->last_name;
    }
    
    public function setAddress1($text)
    {
        $this->address1 = (string) $text;
        return $this;
    }

    public function getAddress1()
    {

        return $this->address1;
    }

    public function setEmail_id($email)
    {
        $this->email_id = (string) $email;
        return $this;
    }

    public function getEmail_id()
    {
        return $this->email_id;
    }
    
    public function setPhone($ts)
    {
        $this->phone =(string) $ts;
        return $this;
    }
    public function getPhone()
    {
        return $this->phone;

    }
    
    public function setMobile($ts)
    {
        $this->mobile =(string) $ts;
        return $this;
    }
    public function getMobile()
    {
        return $this->mobile;

    }
    public function setHome($ts)
    {
        $this->home =(string) $ts;
        return $this;
    }
    public function getHome()
    {
        return $this->home;

    }
    
    public function setFax($ts)
    {
        $this->fax =(string) $ts;
        return $this;
    }
    public function getFax()
    {
        return $this->fax;

    }
    public function setLogin_attempts($text)
    {
        $this->login_attempts=(int)$text;
        return $this;
    }
    public function getLogin_attempts()
    {
        return $this->login_attempts;
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
    public function setUser_type($text)
    {
        $this->user_type=(string)$text;
        return $this;
    }
    public function getUser_type()
    {
        return $this->user_type;
    }
   



}

