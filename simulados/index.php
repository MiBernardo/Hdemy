<?php include 'banco.php'; ?>
<?php
    /*
    * Obter quantidade total de questões
    */
    $query = "SELECT * FROM questoes";
    //Obter resultados
    $resultados = $mysqli->query($query) or die($mysqli->error.__LINE__);
    $total = $resultados->num_rows;
?>

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
    </head>
    <body>
        <header>
            <img src="LogoCompleta.png" alt="logo" style="width: 394px; height: 115.6px;">
            <a href="../projeto_login/sair.php"><strong>Sair</strong></a>
        </header>
        <main>
            <div class="container">
                <div class="conteudo-texto">
                    <h2>Teste seus conhecimentos!</h2>
                    <p>Boas vindas à Hdemy! Aqui você pode realizar simulados ou criar seus próprios!</p>
                    <ul>
                        <li><strong>Quantidade de questões: </strong><?php echo $total; ?></li>
                        <li><strong>Tempo estimado: </strong><?php echo $total * 3; ?> minutos</li>
                    </ul>
                </div>
                <div class="position-links">
                        <a href="questao.php?n=1" class="start">Iniciar simulado</a>
                        <a href="adicionar.php" class="adicionar">Adicionar questão</a>
                </div>
            </div>
        </main>
        <footer>
            <div class="cop-footer">
                <p><strong>Copyright &copy; 2022, Hdevs</strong></p> 
            </div>
        </footer>
    </body>
</html>