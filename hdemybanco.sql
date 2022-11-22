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

                        create table questoes(
                            questao_numero int(11) primary key,
                            questao_texto text
                        );
                        
                        create table alternativas(
                            id int(11) AUTO_INCREMENT primary key,
                            questao_numero int(11) foreign key references questoes(questao_numero),
                            alternativa_texto text,
                            esta_correto tinyint(1),
                        );