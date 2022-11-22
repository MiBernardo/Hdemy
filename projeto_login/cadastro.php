<?php
    require_once 'Classes/usuarios.php';
    $v = new Usuario;
?>

<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <title>Cadastro de Usuários MVC</title>
    </head>
    <body>
        <header>
        <img src="LogoCompleta.png" alt="logo" style="width: 394px; height: 115.6px; padding-top: 0 px;">
            <a href="../index.html" target="_self"><strong>Voltar</strong></a>
        </header>
        <div id="corpo-form-cad">
            <h1>Cadastro</h1>
            <form method="POST">
                <input type="text" name="nome" placeholder="Nome Completo" maxlength="50">
                <input type="text" name="endereco" placeholder="Endereço" maxlength="75">
                <input type="text" name="cidade" placeholder="Cidade" maxlength="30">
                <input type="text" name="cep" placeholder="CEP" maxlength="9">
                <input type="text" name="uf" placeholder="UF" maxlength="2">
                <input type="text" name="telefone" placeholder="Telefone" maxlength="15">
                <input type="email" name="email" placeholder="Usuário" maxlength="50">
                <input type="password" name="senha" placeholder="Senha" maxlength="32">
                <input type="password" name="confsenha" placeholder="Confirmar Senha" maxlength="32">
                <input class="ca" type="submit" value="CADASTRAR">
                <a href="index.php">Se cadastrado, <strong>Entre</strong></a>
            </form>
        </div>
            <?php
                //verificar se o usuário clicou no botão
                if (isset($_POST['nome']))
                {
                    $nome = addslashes($_POST['nome']);
                    $endereco = addslashes($_POST['endereco']);
                    $cidade = addslashes($_POST['cidade']);
                    $cep = addslashes($_POST['cep']);
                    $uf = addslashes($_POST['uf']);
                    $telefone = addslashes($_POST['telefone']);
                    $email = addslashes($_POST['email']);
                    $senha = addslashes($_POST['senha']);
                    $confirmarsenha = addslashes($_POST['confsenha']);

                    //verificar se os campos estão preenchidos
                    if(!empty($nome) && !empty($endereco) && !empty($cidade) && !empty($cep) && !empty($uf) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarsenha))
                    {
                        $v->conectar("hdemybanco", "localhost", "root", "");
                        if($v->msgErro == "") //se está tudo certo (sem erros)
                        {
                            if($senha == $confirmarsenha)
                            {
                                if($v->cadastrar($nome, $endereco, $cidade, $cep, $uf, $telefone, $email, $senha))
                                {
                                    ?>
                                        <div id="msg-sucesso">
                                            Cadastrado! Faça Login!
                                        </div>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                        <div class="msg-erro">
                                            Usuário já existe
                                        </div>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                    <div class="msg-erro">
                                        Senha e Confirmar Senha estão diferentes!
                                    </div>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <div class="msg-erro">
                                    <?php echo "Erro: ".$v->msgErro; ?>
                                </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <div class="msg-erro">
                                Preencha todos os campos!
                            </div>
                        <?php
                    }
                }
       
                /*

                    BANCO DE DADOS (SQL):

                        create database hdemybanco;

                        use hdemybanco;

                        create table usuarios(
                            id_usuario int AUTO_INCREMENT PRIMARY KEY,
                            nome varchar(50),
                            endereco varchar(75),
                            cidade varchar(30),
                            cep varchar(9),
                            uf varchar(2),
                            telefone varchar(15),
                            email varchar(50),
                            senha varchar(32)
                        );
                */
            ?>
    </body>
</html>