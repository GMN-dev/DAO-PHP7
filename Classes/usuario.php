<?php

class Usuario{
    private $id;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    // G/S ID
    public function setId($idInput){
        $this->id = $idInput;
    }
    public function getId(){
        return $this->id;
    }

    // G/S deslogin
    public function setDeslogin($desloginInput){
        $this->deslogin = $desloginInput;
    }
    public function getDeslogin(){
        return $this->deslogin;
    }

    // G/S dessenha
    public function setDessenha($dessenhaInput){
        $this->dessenha = $dessenhaInput;
    }
    public function getDessenha(){
        return $this->dessenha;
    }

    // G/s dtcadastro
    public function setDtcadastro($dtcadastroInput){
        $this->dtcadastro = $dtcadastroInput;
    }
    public function getDtcadasdtro(){
        return $this->dtcadastro;
    }

    //Método construtor:
    public function __construct($id){
        $chamadaBD = new Sql();
        $linhaTabela = $chamadaBD->selection("SELECT * FROM tabela_usuarios WHERE id = :ID", array(":ID"=>$id));
        
        $this->setId($linhaTabela['id']);
        $this->setDeslogin($linhaTabela['deslogin']);
        $this->setDessenha($linhaTabela['dessenha']);
        $this->setDtcadastro($linhaTabela['dtcadastro']);

    }

    public function __toString()
    {
        return "Id de usuario: {$this->getId()} <br>
        Nome de login do usuario: {$this->getDeslogin()} <br>
        Sua senha: {$this->getDessenha()} <br>
        Data de criação de conta: {$this->getDtcadasdtro()}";
    }

}


?>