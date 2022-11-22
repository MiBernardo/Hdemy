<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: ../projeto_login/index.php");
        exit;
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, inicial-scalete=1.0">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css" />
    </head>
    <body>
        <header>
            <img src="LogoCompleta.png" alt="logo" style="width: 394px; height: 115.6px;">
            <a href="../projeto_login/sair.php"><strong>Sair</strong></a>
        </header>
        <main>
            <div class="container">
                <div class="conteudo-texto-final">
                    <h2>Parabéns!</h2>
                        <p>Você finalizou o simulado!</p>
                        <p>Pontuação final: <?php echo $_SESSION['pontuacao']; ?></p>
                </div>
                <div class="position-links">
                    <a href="questao.php?n=1" class="start">Refazer o simulado</a>
                    <a href="index.php" class="finish">Encerrar simulado</a>
                </div>  
            </div>
        </main>
        </footer>
    </body>
</html>