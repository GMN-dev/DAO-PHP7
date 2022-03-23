<?php

class Sql extends PDO{
    private $conex;

    public function __construct(){
        $this->conex = new PDO("mysql:dbname=db;hostname=localhost'root',''");

    }

    public function setParam($stmt, $chave, $valor){
        $stmt->bindParam($chave, $valor);
    }

    public function prepareQuery($stringQuery, $params = array()){
        $query = $this->conex->prepare($stringQuery);

        foreach ($params as $key => $value) {
            $this->setParam($query, $key, $value);
        }
        $query->execute();

        return $query;
    }


    public function listDataBase($rawQuery, $parameters = array()){
        $stmt = $this->prepareQuery($rawQuery, $parameters);

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 1){
            return $result;
        }
        else{
            return $result[0];
        }
    }


}



?>