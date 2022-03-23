<?php
require_once("config.php");

$retornoParaTela = new Usuario;
$retornoParaTela->setUsuarioById(2);

echo $retornoParaTela;
?>