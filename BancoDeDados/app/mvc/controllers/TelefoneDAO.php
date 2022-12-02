<?php
    include '../../conexaoBD/conecta.php';
    include '../models/ClasseTelefone.php';
    include '../models/InterfaceInformacao.php';

    class TelefoneDAO implements Informacao{
        public function insert($telefone) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $idCient   = $telefone->getId();
                $ddd       = $telefone->getDDD();
                $telefone  = $telefone->getTelefone();

                $sql_novoTelefone = "INSERT INTO `t_telefone`(`ID_CIENTISTA`, `DDD_TELEFONE`, `NUM_TELEFONE`) VALUES ('$idCient','$ddd','$telefone')";

                $conn->exec($sql_novoTelefone);
                header("Location: ../../paginas/Opcoes.php");
            } 
            catch(PDOException $e) {
                echo $sql_novoTelefone . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function uptadeTelefone($novoDdd, $novoNumero, $idTelefoneAtual, $idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_updateTelefone = "UPDATE `t_telefone` SET `DDD_TELEFONE`='$novoDdd', `NUM_TELEFONE`='$novoNumero' WHERE `ID_TELEFONE`='$idTelefoneAtual' and `ID_CIENTISTA`='$idCient'";

                $conn->exec($sql_updateTelefone);
                // header("Location: ../views/View_Telefone.php");
            } 
            catch(PDOException $e) {
                echo $sql_updateTelefone . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function delete($idTelefone, $idCient) {
            try {
                session_start();
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_excluirTelefone = "DELETE FROM `t_telefone` WHERE `ID_TELEFONE` = '$idTelefone' AND `ID_CIENTISTA` = '$idCient'";

                $conn->exec($sql_excluirTelefone);
                header("Location: ../views/View_Telefone.php");
            } 
            catch(PDOException $e) {
                echo $sql_excluirTelefone . "<br>" . $e->getMessage();
            }
            $conn = null;
        }
    }

?>