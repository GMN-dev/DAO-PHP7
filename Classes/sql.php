<?php

class Sql extends PDO{
    private $conn;
    
    public function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp; 'root', ''");
    }

    private function prepareQuery($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);

        foreach($params as $paramKey => $paramValue){
            $stmt->bindParam($paramKey, $paramValue);
        }
        $stmt->execute();

        return $stmt;
    }

    
    public function select($rawQuery, $params = array()){
        $statment = $this->prepareQuery($rawQuery, $params);
        
        print_r($statment->fetchAll(PDO::FETCH_ASSOC));
    }

}

?>