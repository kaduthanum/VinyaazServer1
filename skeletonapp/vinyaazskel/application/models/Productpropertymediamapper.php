<?php

class Application_Model_Productpropertymediamapper
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
            $this->setDbTable('Application_Model_DbTable_Productppropertymedia');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Productpropertymedia $productprymda)
    {
                    
        if (null === ($id = $productprymda->getMedia_id()))  
            {
                $data = array('product_id'=>$productprymda->getProduct_id(),
                              'type'=>$productprymda->getType(),
                              'path'=>$productprymda->getPath(),
                              'usage_type'=>'mention values',
                              'status'=>'active',
                             );
                unset($data['id']);
                $id= $this->getDbTable()->insert($data);
                $productprymda->setMedia_id($id);
           } 
        else 
            {
                $data = array('product_id'=>$productprymda->getProduct_id(),
                              'type'=>$productprymda->getType(),
                              'path'=>$productprymda->getPath(),
                              'usage_type'=>$productprymda->getUsage_type(),
                              'status'=>$productprymda->getStatus(),
                             );
                $this->getDbTable()->update($data, array('media_id = ?' => $id));
            }
    }
    public function find(Application_Model_Productpropertymedia $productprymda)

    {
       $params = array('host'      =>'127.0.0.1', 
                       'username'  =>'root', 
                       'password'  =>'', 
                       'dbname'    =>'alpha'); 
       if($DB = new Zend_Db_Adapter_Pdo_Mysql($params))
        {
            $DB->setFetchMode(Zend_Db::FETCH_NUM);      
            $sql = "SELECT * FROM product_property_media where type='".$productprymda->getType()."'"; 
            $result1 = $DB->fetchAll($sql);
            $row=$result1[0];
            $productprymda->setMedia_id($row[0])
                          ->setProduct_id($row[1])
                          ->settype($row[2])
                          ->setpath($row[3])
                          ->setUsage_type($row[4])
                          ->setStatus($row[5]);
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
            foreach ($resultSet as $row) 
                {
                     $entry = new Application_Model_Productpropertymedia();
                     $entry->setMedia_id($row->media_id)
                           ->setProduct_id($row->product_id)
                           ->setType($row->type)
                           ->setPath($row->path)
                           ->setUsage_type($row->usage_type)
                           ->setStatus($row->status);
                    $entries[] = $entry;
                }
            return $entries;
        }



}

