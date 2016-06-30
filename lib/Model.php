<?php

abstract class Model 
{
    private $databaseConnection = null;


    public function __construct()
    {
            $this->databaseConnection = new DatabaseConnection();
            $this->databaseConnection->connect();
    }
 
	 /**
     * Sql doorgeven, zonder pdo!
     * @param type $sql
     */
    protected function setSql($sql){
       $this->databaseConnection->setSql($sql);    
    }
    
    /**
     * Parameters doorgegven, zonder pdo!
     * @param type $label
     * @param type $value
     * @param type $type
     */
    protected function addParam($label, $value, $type =''){
        $this->databaseConnection->addParam($label, $value, $type);
    }
    
    /**
     * Effictief prepare, binden en uitvoeren van query + waarder teruggeven
     * @return type
     */
    protected function fetch(){                
        return $this->databaseConnection->fetch();
    }
    
    protected function fetchOne(){
        $result = $this->databaseConnection->fetch();
         if(count($result) == 0)
            return array();

        return $result[0];
    } 

    protected function query(){        
        return $this->databaseConnection->query();   
    }

    protected function asInteger(){
        return $this->databaseConnection->paramInteger();
    }

    protected function asString(){
        return $this->databaseConnection->paramString();
    }
    
    protected function asBool(){
        return $this->databaseConnection->paramBool();
    }

    protected function asNull(){
        return $this->databaseConnection->paramNull();
    }
}