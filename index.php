<?php
require_once("config.php");

$sql = new Sql();

$sql->select("SELECT * FROM tabela_usuarios");

?>