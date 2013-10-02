<?php

class Application_Model_Productpropertymapper
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
            $this->setDbTable('Application_Model_DbTable_Productproperty');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Productproperty $productpry)
    {
        if (null === ($id = $productpry->getProperty_id()))  
            {
                $data = array('product_id'=>$productpry->getProduct_id(),
                              'value'=>$productpry->getValue(),
                              'description'=>$productpry->getPrydescription(),
                              'long_description'=>$productpry->getLong_description(),
                              'status'=>'active',
                              );
                unset($data['id']);
                $id= $this->getDbTable()->insert($data);
                $productpry->setProperty_id($id);
            } 
        else 
            {
            $data = array('product_id'=>$productpry->getProduct_id(),
                          'value'=>$productpry->getValue(),
                          'description'=>$productpry->getprydescription(),
                          'long_description'=>$productpry->getLong_description(),
                          'status'=>'active',
                          );

            $this->getDbTable()->update($data, array('property_id = ?' => $id));
            }
    }
    public function find(Application_Model_Productproperty $productpry)

    {
       $params = array('host'      =>'127.0.0.1', 
                       'username'  =>'root', 
                       'password'  =>'', 
                       'dbname'    =>'alpha'); 
       if($DB = new Zend_Db_Adapter_Pdo_Mysql($params))
       {
            $DB->setFetchMode(Zend_Db::FETCH_NUM);      
            $sql = "SELECT * FROM product_property where value='".$productpry->getValue()."'"; 
            $result1 = $DB->fetchAll($sql);
            $row=$result1[0];
            $productpry->setProperty_id($row[0])
                        ->setProduct_id($row[1])
                        ->setValue($row[2])
                        ->setPrydescription($row[3])
                        ->setLong_description($row[4])
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
                $entry = new Application_Model_Productproperty();
                $entry->setProduct_id($row->product_id)
                      ->setProperty_id($row->property_id)
                      ->setValue($row->valus)
                      ->setprydescription($row->description)
                      ->setLong_description($row->long_description)
                      ->setStatus($row->status);
                    $entries[] = $entry;
        }
        return $entries;
    }



}

