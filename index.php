<?php
require_once("config.php");

Usuario::delete(2);
// echo $retornoParaTela;
echo Usuario::showAllData();
?>