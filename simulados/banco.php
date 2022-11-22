<?php
//Criação das credenciais da conexão
$db_host = 'localhost';
$db_name = 'hdemybanco';
$db_user = 'root';
$db_pass ='';

//msqli
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

//Erros
if($mysqli->connect_error){
    printf("Conexão falhou: %s\n", $mysqli->connect_error);
    exit();
}