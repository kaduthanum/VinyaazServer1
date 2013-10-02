<?php

class Application_Model_Usermapper
{
    
    protected $_dbTable;

    public function setDbTable($dbTable)

    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_User');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_User $user)
    {
        $data = array('first_name'=>$user->getFirst_name(),
                      'middle_name'=>$user->getMiddle_name(),
                      'last_name'=>$user->getLast_name(),
                      'address1'=>$user->getAddress1(),
                      'email_id'=>$user->getEmail_id(),
                      'phone'=>$user->getPhone(),
                      'mobile'=>$user->getMobile(),
                      'home'=>$user->getHome(),
                      'fax'=>$user->getFax(),
                      'login_attempts'=>0,
                      'status'=>'active',
                      'user_type'=>'consumer',
                       );
            
        if (null === ($id = $user->getUser_id()))  
            {
                unset($data['id']);
                $id= $this->getDbTable()->insert($data);
                $user->setUser_id($id['user_id']);
            } 
        else 
            {
            $data = array('first_name'=>$user->getFirst_name(),
                          'middle_name'=>$user->getMiddle_name(),
                          'last_name'=>$user->getLast_name(),
                          'address1'=>$user->getAddress1(),
                          'email_id'=>$user->getEmail_id(),
                          'phone'=>$user->getPhone(),
                          'mobile'=>$user->getMobile(),
                          'home'=>$user->getHome(),
                          'fax'=>$user->getFax(),
                          'login_attempts'=>$user->getLogin_attempts(),
                          'status'=>'active',
                          'user_type'=>'consumer',
                         );

            $this->getDbTable()->update($data, array('user_id = ?' => $id));
            }
    }
    public function find( Application_Model_User $user)

    {
       $params = array('host'      =>'127.0.0.1', 
                       'username'  =>'root', 
                       'password'  =>'', 
                       'dbname'    =>'alpha'); 
       if($DB = new Zend_Db_Adapter_Pdo_Mysql($params))
       {
       $DB->setFetchMode(Zend_Db::FETCH_NUM);      
        $sql = "SELECT * FROM user where email_id='".$user->getEmail_id()."'"; 
        $result1 = $DB->fetchAll($sql);
        $row=$result1[0];
        $user->setUser_id($row[0])
             ->setFirst_name($row[1])
             ->setMiddle_name($row[2])
             ->setLast_name($row[3])
             ->setAddress1($row[4])
             ->setEmail_id($row[5])
             ->setPhone($row[6])
             ->setMobile($row[7]) 
             ->setHome($row[8])
             ->setFax($row[9])
             ->setLogin_attempts($row[10])
             ->setStatus($row[11])
             ->setUser_type($row[12]);
        $DB->closeConnection();
       }
       else
       {
            throw new Exception('Invalid db connection');
       }
     
      }
     public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_User();
            $entry->setuser_id($row->user_id)
                  ->setfirst_name($row->first_name)
                  ->setmiddle_name($row->middle_name)
                  ->setlast_name($row->last_name)
                  ->setaddress1($row->address1)
                  ->setemail_id($row->email_id)
                  ->setphone($row->phone)
                  ->setmobile($row->mobile) 
                  ->sethome($row->home)
                  ->setfax($row->fax);
            $entries[] = $entry;
        }
        return $entries;
    }



}

