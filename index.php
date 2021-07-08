<?php 

require_once("config.php"); //Chamando o config no qual busca as classes

$sql = new Sql(); //Chamando a classe 

$usuarios = $sql->select("SELECT * FROM tb_usuarios"); //Usando a classe e fazendo um comando no Banco de Dados

echo json_encode($usuarios); //Retornando o resultado

?>