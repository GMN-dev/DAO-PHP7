<?php

class Sql extends PDO{
    private $conn;
    
    public function __construct(){
        $this->conn = new PDO("mysql:host=localhost;dbname=dbphp; 'root', ''");
    }


    //Serve para preparar a query e ligar os parametros a query
    private function prepareQuery($rawQuery, $params = array()){
        $stmt = $this->conn->prepare($rawQuery);

        foreach($params as $paramKey => $paramValue){
            $stmt->bindParam($paramKey, $paramValue);
        }
        $stmt->execute();

        return $stmt;
    }

    //Essa função retorna a tabela
    public function selection($rawQuery, $params = array()){
        $statment = $this->prepareQuery($rawQuery, $params);
        
        $response = $statment->fetchAll(PDO::FETCH_ASSOC)[0];
        return $response;
    }

}

?>