<?php include 'banco.php'; ?>
<?php SESSION_START(); ?>
<?php
    //Verificar se a pontuação está configurada
    if(!isset($_SESSION['pontuacao'])){
        $_SESSION['pontuacao'] = 0;
    }


    if($_POST){
        $numero = $_POST['numero']; //////number//////
        $alternativa_selecionada = $_POST['alternativa'];

        echo $numero.'<br>';
        echo $alternativa_selecionada;
        $seguinte = $numero+1;

        /*
        *   Obter total de questões
        */

        $query = "SELECT * FROM questoes";
        //Obter resultado
        $resultados = $mysqli->query($query) or die($mysqli->error.__LINE__);
        $total = $resultados->num_rows;

        /*
        *   Obter alternativa correta
        */

        $query = "SELECT * FROM alternativas
                    WHERE questao_numero = $numero AND esta_correto = 1";

        //Obter resultado
        $resultado = $mysqli->query($query) or die($mysqli->error.__LINE__);

        //Obter coluna
        $coluna = $resultado->fetch_assoc();

        //Alternativa correta

        $alternativa_correta = $coluna['id'];

        //Comparar
        if($alternativa_correta == $alternativa_selecionada){
            //Resposta correta
            $_SESSION['pontuacao']++;
        }

        //Verificar se é a última questão
        if($numero == $total){
            header("Location: final.php");
            exit();
        } else {
            header("Location: questao.php?n=".$seguinte);
        }
    }