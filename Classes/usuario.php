<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class Usuario{
    private $id;
    private $login;
    private $senha;
    private $dtcadastro;

    public function setId($idInput){
        $this->id = $idInput;
    }
    public function getId(){
        return $this->id;
    }

    public function setLogin($loginInput){
        $this->login = $loginInput;
    }
    public function getLogin(){
        return $this->login;
    }

    public function setSenha($senhaInput){
        $this->senha = $senhaInput;
    }
    public function getSenha(){
        return $this->senha;
    }

    public function setDtcadastro($dtcadastroInput){
        $this->dtcadastro = $dtcadastroInput;
    }
    public function getDtcadastro(){
        return $this->dtcadastro;
    }

    //Método Construtor
    public function __construct($login = '', $senha = '')
    {
        $this->setLogin($login);
        $this->setSenha($senha);

    }

    // MÉTODOS DE CAPTURA DE DADOS PARA RETORNO NA TELA
    public function __toString(){
        return
        "Id: {$this->getId()} <br>
        Login: {$this->getLogin()} <br>
        Senha: {$this->getSenha()} <br>
        Data de Cadastro: {$this->getDtcadastro()}";             
    }

    public function setAll($idInput, $loginInput, $senhaInput, $dtcadastroInput){
        $this->setId($idInput);
        $this->setLogin($loginInput);
        $this->setSenha($senhaInput);
        $this->setDtcadastro($dtcadastroInput);
    }

    public function setUsuarioById($idInput){
        $database = new Sql();
        $rowsTable = $database->listDataBase("SELECT * FROM tabela_usuarios WHERE id = :ID", array(":ID" => $idInput));
        
        //Setting
        $this->setAll($rowsTable["id"], $rowsTable["deslogin"], $rowsTable["dessenha"], $rowsTable["dtcadastro"]);
    }

    public static function searchByLoginCharacters($loginInput){
        $database = new Sql();
        $rowsTable = $database->listDataBase("SELECT * FROM tabela_usuarios WHERE deslogin LIKE :LOGIN;",array(":LOGIN" => '%' . $loginInput . '%'));

        if ((count($rowsTable) >= 1) and ($loginInput != "")){
            return json_encode($rowsTable);
        }
        else{
            return "!!! Sem informaçãoes !!!";
        }      
    }

    public static function showAllData(){
        $database = new Sql();
        $rowsTable = $database->listDataBase("SELECT * FROM tabela_usuarios ORDER BY id;");
        
        return json_encode($rowsTable);
    }

    public function setUsuarioByAuthenticated($loginInput, $senhaInput){
        $database = new Sql();
        $rowsTable = $database->listDataBase("SELECT * FROM tabela_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD;", array(":LOGIN"=>$loginInput, ":PASSWORD"=>$senhaInput));
        
        if(count($rowsTable) >= 1){
            $this->setId($rowsTable["id"]);
            $this->setLogin($rowsTable["deslogin"]);
            $this->setSenha($rowsTable["dessenha"]);
            $this->setDtcadastro($rowsTable["dtcadastro"]);
        }
        else{
            return "!!! Esse usuario, não esta cadastrado !!! <br> Verifique os dados inseridos";
        }
    }
    
    //Métodos para inserção de dados
    public static function insert($login, $senha){
        $dataBase = new Sql();
        $response = $dataBase->prepareQuery("INSERT INTO tabela_usuarios(deslogin, dessenha) VALUES(:LOGIN, :PASSWORD);", array(":LOGIN"=>$login, "PASSWORD"=>$senha));

    }

    //metodo para atualização
    public function update($login, $senha){
        $dataBase = new Sql();
        $response = $dataBase->prepareQuery("UPDATE tabela_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE id = {$this->getId()}", array(":LOGIN"=>$login, ":PASSWORD"=>$senha));
        // var_dump($response);
    }

    public static function delete($id){
        $database = new Sql();
        $response = $database->prepareQuery("DELETE FROM tabela_usuarios WHERE id = :ID;", array(":ID"=>$id));
    }
}

?>