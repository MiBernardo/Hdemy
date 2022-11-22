<?php
    Class Usuario
    {
        private $pdo;
        public $msgErro = "";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;
            global $msgErro;

            try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
            } catch (PDOException $e) {
                $msgErro = $e->getMessage();
            }
        }

        public function cadastrar($nome, $endereco, $cidade, $cep, $uf, $telefone, $email, $senha)
        {
            global $pdo;

            //verificar se já está cadastrado
            $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
            $sql->bindValue(":e", $email);
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                return false; //já cadastrado
            }
            else
            {
            //caso não esteja, cadastre
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, endereco, cidade, cep, uf, telefone, email, senha) VALUES (:n, :d, :c, :p, :u, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":d", $endereco);
            $sql->bindValue(":c", $cidade);
            $sql->bindValue(":p", $cep);
            $sql->bindValue(":u", $uf);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true; //cadastrado com sucesso
            }
        }

        public function logar($email, $senha)
        {
            global $pdo;
            //verificar se já está cadastrado, caso sim
            $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                //entrar no sistema (sessão)
                $dado = $sql->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dado['id_usuario'];
                return true; //login bem sucedido
            }
            else
            {
                return false; //não foi possível fazer login
            }
        }
    }
?>