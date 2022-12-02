<?php
    include '../../conexaoBD/conecta.php';
    include '../models/ClasseCientista.php';
    include '../models/InterfaceInformacao.php';

    class CientistaDAO implements Informacao{
        public function insert($cientista) {
            try {
                session_start();
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $nome       = $cientista->getNome();
                $cpf        = $cientista->getCpf();
                $dataNasc   = $cientista->getDataNascimento();
                $email      = $cientista->getEmail();
                $email02    = $cientista->getEmail02();
                $lattes     = $cientista->getLattes();
                $senha      = $cientista->getSenha();
                $cidade     = $cientista->getCidade();

                $insertCientista = "INSERT INTO t_cientista (nom_cientista, cpf_cientista, dtn_cientista, email_cientista, email2_cientista, lattes_cientista, senha_cientista, id_cidade) VALUES ('$nome','$cpf','$dataNasc', '$email', '$email02', '$lattes', '$senha', '$cidade')";

                $conn->exec($insertCientista);
                $_SESSION['infoUsuario'] = 6;
                header("Location: ../views/View_CadastroUsuario.php");
            } 
            catch(PDOException $e) {
                echo $insertCientista . "<br>" . $e->getMessage();
            }
            $conn = null;
        }
        
        /*"Esqueci minha senha"*/
        public function updateSenha($senha, $id) {
            try {
                session_start();
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_alterarSenha = "UPDATE `t_cientista` SET `SENHA_CIENTISTA` = '$senha' WHERE `ID_CIENTISTA` = '$id'";

                $conn->exec($sql_alterarSenha);
                $_SESSION['erroSenhaAlterar'] = 0;
                header("Location: ../views/View_esqueciSenha-Alterar.php");
            } 
            catch(PDOException $e) {
                echo $sql_alterarSenha . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*Interno da plataforma*/
        public function updateSenha2($senha, $id) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_alterarSenha2 = "UPDATE `t_cientista` SET `SENHA_CIENTISTA` = '$senha' WHERE `ID_CIENTISTA` = '$id'";

                $conn->exec($sql_alterarSenha2);
                header("Location: ../../paginas/Opcoes.php");
            } 
            catch(PDOException $e) {
                echo $sql_alterarSenha2 . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function updateNome($nome, $id) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_novoNome = "UPDATE `t_cientista` SET `NOM_CIENTISTA`='$nome' WHERE `ID_CIENTISTA`='$id'";
                $conn->exec($sql_novoNome);
                header("Location: ../views/View_NomeUsuario.php");
            } 
            catch(PDOException $e) {
                echo $sql_novoNome . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function updateCidade($cidade, $idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sqlnovaCidade = "UPDATE `t_cientista` SET `ID_CIDADE`='$cidade' WHERE `ID_CIENTISTA`='$idCient'";
                $conn->exec($sqlnovaCidade);
                header("Location: ../views/View_CidadeUsuario.php");
            } 
            catch(PDOException $e) {
                echo $sqlnovaCidade . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function updateNascimento($dataNascimento, $idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_novoNascimento = "UPDATE `t_cientista` SET `DTN_CIENTISTA`='$dataNascimento' WHERE `ID_CIENTISTA`='$idCient'";
                $conn->exec($sql_novoNascimento);
                header("Location: DataNascimento.php");
            } 
            catch(PDOException $e) {
                echo $sql_novoNascimento . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function updateEmail($email, $idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_novoEmail = "UPDATE `t_cientista` SET `EMAIL_CIENTISTA`='$email' WHERE `ID_CIENTISTA`='$idCient'";
                $conn->exec($sql_novoEmail);
                header("Location: ../views/View_emailPRINCIPAL.php");
            } 
            catch(PDOException $e) {
                echo $sql_novoEmail . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*E-mail ALTERNATIVO*/
        public function updateEmail2($email, $idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_novoEmail2 = "UPDATE `t_cientista` SET `EMAIL2_CIENTISTA`='$email' WHERE `ID_CIENTISTA`='$idCient'";
                $conn->exec($sql_novoEmail2);
                header("Location: ../views/View_emailSECUNDARIO.php");
            } 
            catch(PDOException $e) {
                echo $sql_novoEmail2 . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function deleteEmail2($idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_deleteEmail2 = "UPDATE `t_cientista` SET `EMAIL2_CIENTISTA`=NULL WHERE `ID_CIENTISTA`='$idCient'";
                $conn->exec($sql_deleteEmail2);
                header("Location: ../views/View_emailSECUNDARIO.php");
            } 
            catch(PDOException $e) {
                echo $sql_deleteEmail2 . "<br>" . $e->getMessage();
            }
            $conn = null;
        }
        /**/

        /*LATTES*/
        public function updateLattes($lattes, $idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_Lattes = "UPDATE `t_cientista` SET `LATTES_CIENTISTA` ='$lattes' WHERE `ID_CIENTISTA` = '$idCient'";
                $conn->exec($sql_Lattes);
                header("Location: ../views/View_Lattes.php");
            } 
            catch(PDOException $e) {
                echo $sql_Lattes . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*EXCLUSÃO DE CONTA*/
        public function excluirCONTA($idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_deleteRedesSociais = "DELETE FROM `t_redes_sociais` WHERE `ID_CIENTISTA` = '$idCient'";
                $sql_deleteAtuacoes = "DELETE FROM `t_area_atuacao_cientista` WHERE `ID_CIENTISTA` = '$idCient'";
                $sql_deleteFormacoes = "DELETE FROM `t_formacao` WHERE `ID_CIENTISTA` = '$idCient'";
                $sql_deleteTelefones = "DELETE FROM `t_telefone` WHERE `ID_CIENTISTA` = '$idCient'";
                $sql_deleteProjetos = "DELETE FROM `t_projeto` WHERE `ID_CIENTISTA` = '$idCient'";
                $sql_deleteCientista = "DELETE FROM `t_cientista` WHERE `ID_CIENTISTA` = '$idCient'";

                $conn->exec($sql_deleteRedesSociais);
                $conn->exec($sql_deleteAtuacoes);
                $conn->exec($sql_deleteFormacoes);
                $conn->exec($sql_deleteTelefones);
                $conn->exec($sql_deleteProjetos);
                $conn->exec($sql_deleteCientista);
                header('Location: ../../../publico/Index.php');
            } 
            catch(PDOException $e) {
                echo $sql_Lattes . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*NÃO UTILIZADO*/
        public function delete($valor1, $valor2) {
        }
    }

?>