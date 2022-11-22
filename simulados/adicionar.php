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
    if(isset($_POST['enviar'])){ //enviar
        //Obter as variáveis
        $questao_numero = $_POST['questao_numero'];
        $questao_texto = $_POST['questao_texto'];
        $alternativa_correta = $_POST['alternativa_correta'];
        //Array de alternativas
        $alternativas = array();
        $alternativas[1] = $_POST['alternativa1'];
        $alternativas[2] = $_POST['alternativa2'];
        $alternativas[3] = $_POST['alternativa3'];
        $alternativas[4] = $_POST['alternativa4'];
        $alternativas[5] = $_POST['alternativa5'];

        //Query das questões
        $query = "INSERT INTO questoes (questao_numero, questao_texto)
                    VALUES('$questao_numero', '$questao_texto')";

        //Rodar query
        $inserir_coluna = $mysqli->query($query) or die($mysqli->error.__LINE__);

        //Validar a inserção
        if($inserir_coluna){
            foreach($alternativas as $alternativa => $value){
                if($value != ''){
                    if($alternativa_correta == $alternativa){
                        $esta_correto = 1;
                    } else{
                        $esta_correto = 0;
                    }
                    //Query da alternativa
                    $query = "INSERT INTO alternativas (questao_numero, esta_correto, alternativa_texto)
                                VALUES ('$questao_numero', '$esta_correto', '$value')";

                    //Rodar query
                    $inserir_coluna = $mysqli->query($query) or die($mysqli->error.__LINE__);

                    //Validar a inserção
                    if($inserir_coluna){
                        continue;
                    } else{
                        die('Erro: ('.$mysqli->error . ') '. $mysqli->error);
                    }
                }
            }
            $msg = 'Questão adicionada';
        }
    }

    /*
        *   Obter total de questões
        */

        $query = "SELECT * FROM questoes";
        //Obter resultado
        $resultados = $mysqli->query($query) or die($mysqli->error.__LINE__);
        $total = $resultados->num_rows;
        $seguinte = $total+1;
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
        <title>Hdemy simulados</title>
    </head>
    <body>
        <header>
            <img src="LogoCompleta.png" alt="logo" style="width: 394px; height: 115.6px;">
            <a href="../projeto_login/sair.php"><strong>Sair</strong></a>
        </header>
        
        <main>
            <div class="container">
                <h2>Adicionar uma questão</h2>
                <?php
                    if(isset($msg)){
                        echo '<p>'.$msg.'</p>';
                    }
                ?>
                <form method="post" action="adicionar.php">
                    <p>
                        <label>Número da questão: </label>
                        <input type="number" value="<?php echo $seguinte; ?>" name="questao_numero" />
                    </p>
                    <p>
                        <label>Texto da questão: </label>
                        <input type="text" name="questao_texto" />
                    </p>
                    <p>
                        <label>Alternativa 1: </label>
                        <input type="text" name="alternativa1" />
                    </p>
                    <p>
                        <label>Alternativa 2: </label>
                        <input type="text" name="alternativa2" />
                    </p>
                    <p>
                        <label>Alternativa 3: </label>
                        <input type="text" name="alternativa3" />
                    </p>
                    <p>
                        <label>Alternativa 4: </label>
                        <input type="text" name="alternativa4" />
                    </p>
                    <p>
                        <label>Alternativa 5: </label>
                        <input type="text" name="alternativa5" />
                    </p>
                        <label>número da alternativa correta: </label>
                        <input type="number" name="alternativa_correta" />
  
                        <div class="links-questao">
                    <input type="submit" name="enviar" value="Enviar"/>
                </div>
                </form>
                <div class="links-questao">
                    <a href="index.php" class="start">Voltar</a>
                </div>
                
            </div>
        </main>
        <footer>
            <div class="cop-footer-ques">
               <p><strong>Copyright &copy; 2022, Hdevs</strong></p> 
            </div>
        </footer>
    </body>
</html>