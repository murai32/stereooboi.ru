<?php

class Application_Model_FilesMapper
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
            $this->setDbTable('Application_Model_DbTable_Files');
        }
        return $this->dbTable;
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        
        foreach ($resultSet as $row)
        {
            $entry = new Application_Model_Files();
            $entry->setId($row->id);
            $entries[] = $entry;
        }
        
        return $entries;
    }

}

