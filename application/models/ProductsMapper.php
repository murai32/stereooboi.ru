<?php

class Application_Model_ProductsMapper
{
    protected $dbTable;
    
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable))
        {
            $dbTable = new $dbTable();
        }
        if(!$dbTable instanceof Zend_Db_Table_abstract)
        {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->dbTable = $dbTable;
        
        return $this;
    }
    
    public function getDbTable()
    {
        if (null === $this->dbTable)
        {
            $this->setDbTable('Application_Model_DbTable_Products');
        }
        return $this->dbTable;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        
        foreach ($resultSet as $row)
        {
            $entry = new Application_Model_Products();
            $entry->setId($row->id)
                    ->setType($row->type)
                    ->setAlbum($row->album)
                    ->setName($row->name)
                    ->setAmount($row->amount)
                    ->setDescription($row->description)
                    ->setPrice($row->price)
                    ->setFoto($row->foto)
                    ->setRecommended_products($row->recommended_products);
//            $entry->setAmount($row->amount);
            
            $entries[] = $entry;
        }
        
        return $entries;
    }
    
    public function save(Application_Model_Products $products)
    {
        $data = array(
            'type' => $products->getType(),
            'name' => $products->getName(),
            'amount' => $products->getAmount(),
            'description' => $products->getDescription(),
            'price' => $products->getPrice(),
            'foto' => $products->getFoto(),
            'recommended_products' => $products->getRecommended_products()
            
        );
        
        if (null === ($id = $products->getId()))
        {
            unset($data[$id]);
//            unset($data['type']);
            $this->getDbTable()->insert($data);
        }
        else 
        {
            if($data['foto'] === null)
            {
                unset($data['foto']);
            }
            $this->getDbTable()->update($data,array('id = ?' => $id));
        }
    }
    
    
    public function find ($id, Application_Model_Products $product)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result))
        {
            return;
        }
        
        $row = $result->current();
        $product->setId($row->id)
                ->setType($row->type)
                ->setAlbum($row->album)
                ->setName($row->name)
                ->setAmount($row->amount)
                ->setDescription($row->description)
                ->setPrice($row->price)
                ->setFoto($row->foto)
                ->setRecommended_products($row->recommended_products);
        
//       return $product;
    }
    
    public function delete($id)
    {
        $this->getDbTable()->delete(array('id = ?' => $id));
    }
    
    public function fetchTypeWhere($where)
    {
        $dbTable = $this->getDbTable();
        $query = $dbTable->select()->where('type = ?', (string)$where);
        $resultRaws = $dbTable->fetchAll($query);
        $entries = array();
        
        foreach ($resultRaws as $row)
        {
            $entry = new Application_Model_Products();
            $entry->setId($row->id)
                    ->setType($row->type)
                    ->setAlbum($row->album)
                    ->setName($row->name)
                    ->setAmount($row->amount)
                    ->setDescription($row->description)
                    ->setPrice($row->price)
                    ->setFoto($row->foto)
                    ->setRecommended_products($row->recommended_products);
            
            $entries[] = $entry;
        }
        
        
        return $entries;
        
        
    }
    
    

}

