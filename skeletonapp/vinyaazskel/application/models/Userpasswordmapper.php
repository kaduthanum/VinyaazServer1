<?php

class Application_Model_Userpasswordmapper
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
            $this->setDbTable('Application_Model_DbTable_Userpassword');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Userpassword $userpassword)
    {
        $usersave=new Zend_Session_Namespace('register');
        $date = new Zend_Date();
        if (null === ($id = $userpassword->getuser_id()))  
           {
                $data = array('user_id'=>$usersave->user_id,
                              'current_password'=>$userpassword->getCurrent_password(),
                              'new_password'=>'adsfadfgadf',
                              'change_date'=>'4547',
                              'requested_date'=>'4567457',
                              'generated_key'=>'asdgag');
        
                $this->getDbTable()->insert($data);
           } 
           else 
            {
               $data = array('user_id'=>$userpassword->getUser_id(),
                             'current_password'=>$userpassword->getNew_password(),
                             'new_password'=>'new_password',
                             'change_date'=>$date->get('YY-MM-dA HH:mm:ss'),
                             'requested_date'=>$data->get('YY-MM-dd HH:mm:ss'),
                             'generated_key'=>'xdhdhdhg');
        
                $this->getDbTable()->update($data, array('user_id = ?' => $id));
            }
    }
    public function find(Application_Model_Userpassword $userpassword)

    {
        $params = array('host'      =>'127.0.0.1', 
                       'username'  =>'root', 
                       'password'  =>'', 
                       'dbname'    =>'alpha'); 
       if($DB = new Zend_Db_Adapter_Pdo_Mysql($params))
       {
            $DB->setFetchMode(Zend_Db::FETCH_NUM);      
            $sql = "SELECT * FROM user_password where user_id=".$userpassword->getUser_id(); 
            $result1 = $DB->fetchAll($sql);
            $row=$result1[0];
            $userpassword->setUser_id($row[0])
                         ->setCurrent_password($row[1])
                         ->setNew_password($row[2])
                         ->setChange_date($row[3])
                         ->setRequested_date($row[4])
                         ->setGenerated_key($row[5]);
            $DB->closeConnection();
       }
       else
       {
            throw new Exception('Invalid db connection');
       }
     

       /* $id=$userpassword->getUser_id();
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $userpassword->setuser_id($row->user_id)
                     ->setcurrent_password($row->current_password);*/
    }
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) 
        {
            $entry = new Application_Model_Userpassword();
            $entry->setuser_id($row->user_id)
                  ->setcurrent_password($row->current_password);
            $entries[] = $entry;
        }
        return $entries;
    }


}

