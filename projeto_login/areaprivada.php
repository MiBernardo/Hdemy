<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }
?>

<h1>Você entrou com seus dados cadastrados!</h1>

<a href="../projeto_login/sair.php"><h2><strong>Sair</strong></h2></a>