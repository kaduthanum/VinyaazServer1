<?php

class Application_Model_Productmapper
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
            $this->setDbTable('Application_Model_DbTable_Product1');
        }
        return $this->_dbTable;
    }
    public function save(Application_Model_Product $product)
    {
        if (null === ($id = $product->getProduct_id()))  
            {
                 $data = array('name'=>$product->getName(),
                               'description'=>$product->getDescription(),
                               'category'=>$product->getCategory(),
                               'status'=>'active',
                               'exclusive_indicatoy'=>$product->getExclusive_indicatoy(),
                               'user_id'=>$product->getUser_id(),
                              );
                unset($data['id']);
                $id= $this->getDbTable()->insert($data);
                $product->setProduct_id($id);
            } 
        else 
            {
                $data = array('name'=>$product->getName(),
                              'description'=>$product->getDescription(),
                              'category'=>$product->getCategory(),
                              'status'=>'active',
                              'exclusive_indicatoy'=>$product->getExclusive_indicatoy(),
                              'user_id'=>$product->getUser_id(),
                            );

            $this->getDbTable()->update($data, array('product_id = ?' => $id));
            }
    }
    public function find(Application_Model_Product $product)

    {
       $params = array('host'      =>'127.0.0.1', 
                       'username'  =>'root', 
                       'password'  =>'', 
                       'dbname'    =>'alpha'); 
       if($DB = new Zend_Db_Adapter_Pdo_Mysql($params))
       {
       $DB->setFetchMode(Zend_Db::FETCH_NUM);      
        $sql = "SELECT * FROM product where name='".$product->getName()."'"; 
        $result1 = $DB->fetchAll($sql);
        $row=$result1[0];
        $product->setProduct_id($row[0])
                ->setName($row[1])
                ->setDescription($row[2])
                ->setCategory($row[3])
                ->setStatus($row[4])
                ->setExclusive_indicatoy($row[5])
                ->setUser_id($row[6]);
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
            $entry = new Application_Model_Product();
            $entry->setProduct_id($row->product_id)
                  ->setName($row->name)
                  ->setDescription($row->description)
                  ->setCategory($row->category)
                  ->setStatus($row->status)
                  ->setExclusive_indicatoy($row->exclusive_indicatoy)
                  ->setUser_id($row->user_id);
            $entries[] = $entry;
        }
        return $entries;
    }



}

