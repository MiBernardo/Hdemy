<?php include 'banco.php'; ?>

<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: ../projeto_login/index.php");
        exit;
    }
?>



<?php
    //Configurar formato do número da questão
    $numero = (int) $_GET['n'];

    /*
    *   Obter total de questões
    */

    $query = "SELECT * FROM questoes";
    //Obter resultado
    $resultados = $mysqli->query($query) or die($mysqli->error.__LINE__);
    $total = $resultados->num_rows;

    /*
    * Obter questão
    */
    $query = "SELECT * FROM questoes 
    WHERE questao_numero = $numero";
    //Obter resultados
    $resultado = $mysqli->query($query) or die($mysqli->error.__LINE__);

    $questao = $resultado->fetch_assoc();

    /*
    * Obter alternativas
    */
    $query = "SELECT * FROM alternativas 
    WHERE questao_numero = $numero";
    //Obter resultados
    $alternativas = $mysqli->query($query) or die($mysqli->error.__LINE__);
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
        <script src="visibilidade.js"></script> 
    </head>
    <body>
        <header>
            <img src="LogoCompleta.png" alt="logo" style="width: 394px; height: 115.6px;">
            <a href="../projeto_login/sair.php"><strong>Sair</strong></a>
        </header>
        <main>
            <div class="container">
                <div class="atual">Questão <?php echo $questao['questao_numero']; ?> de <?php echo $total; ?></div>
                <p class="questao">
                    <?php echo $questao['questao_texto']; ?>
                </p>
                <form method="post" action="processo.php">
                    <ul class="alternativas">
                        <?php while($row = $alternativas->fetch_assoc()): ?>
                            <li><input name="alternativa" type="radio" value="<?php echo $row['id']; ?>" /><?php echo $row['alternativa_texto']; ?></li>
                        <?php endwhile; ?>
                        <div id="resposta">
                        <?php
                            $connection=mysqli_connect("localhost", "root", "", "hdemybanco"); //endereço do banco - server, username, senha, nome do banco

                            if($connection){
                                echo "<h4>Alternativa correta: </h4>";
                            } else{
                                die("Conexão falhou. Razão: ".mysqli_connect_error());
                            }

                            $sql="SELECT id, alternativa_texto FROM alternativas WHERE questao_numero = $numero and esta_correto = 1";

                            $resultadoquery=mysqli_query($connection,$sql);

                            if (mysqli_num_rows($resultadoquery)>0)

                            while($rowquery=mysqli_fetch_array($resultadoquery)){
                                //if(mysqli_query(esta_correto from alternativas = 1)) {
                                    //echo "aaa";
                                //} else{
                                    //echo "ouo";
                                //}
                                echo "<h4>$rowquery[1]</h4>"; //." ".$rowquery[2];
                                echo '<br>';
                            }

                        ?>
                        </div>
                    </ul>
                 
                        <input type="submit" value="Próxima questão" />
                        <input type="hidden" name="numero" value="<?php echo $numero; ?>" />   <!-----number------>
                  
                
                <!--<a href="index.php" class="verificar">Verificar</a>-->
                </form>

                <div class="links-questao">
                <button class="verificar" onclick="Visibilidade()">Verificar alternativa correta</button>
                    <a href="final.php" class="finish">Encerrar simulado</a>
                </div>
            </div>
        </main>
    </body>
</html>