<?php 

spl_autoload_register(function($class_name){  //Criando uma função de auto load

    $filename = "class".DIRECTORY_SEPARATOR. $class_name. ".php"; //pegando o nome do arquivo e atribuindo a extenção .php

    if (file_exists($filename)) { //Verifica se o arquivo existe
        require_once($filename); //Existindo ele o chama. 
    }
});

?>