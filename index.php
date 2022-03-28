<?php
require_once("config.php");

$retornoParaTela = new Usuario();

$retornoParaTela->setUsuarioById(5);

$retornoParaTela->update("marcola", "beramar");

$retornoParaTela->setUsuarioById(5);

// echo $retornoParaTela;
echo Usuario::showAllData();
?>