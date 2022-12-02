<?php
    include '../../conexaoBD/conecta.php';
    include '../models/ClasseFormacao.php';
    include '../models/InterfaceInformacao.php';

    class FormacaoDAO implements Informacao{
        public function insert($formacao) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $idCient        = $formacao->getIdCient();
                $idTitulacao    = $formacao->getIdTitulacao();
                $dti            = $formacao->getDti();
                $dtt            = $formacao->getDtt();

                $sql_novaFormacao = "INSERT INTO `t_formacao`(`ID_CIENTISTA`, `ID_TITULACAO`, `DTI_FORMACAO`, `DTT_FORMACAO`) VALUES ('$idCient','$idTitulacao','$dti','$dtt')";

                $conn->exec($sql_novaFormacao);
                header("Location: ../views/View_Formacao.php");
            } 
            catch(PDOException $e) {
                echo $sql_novoTelefone . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*UPDATE Título*/
        public function updateFormacao1($idTitulacaoNova, $idCient, $idFormacao) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_updateFormacao = "UPDATE `t_formacao` SET `ID_TITULACAO`='$idTitulacaoNova' WHERE `ID_CIENTISTA`='$idCient' and `ID_FORMACAO`='$idFormacao'";

                $conn->exec($sql_updateFormacao);
                // header("Location: ../views/View_Telefone.php");
            } 
            catch(PDOException $e) {
                echo $sql_updateFormacao . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*UPDATE Tempo*/
        public function updateFormacao2($nDataInicioFormacao, $nDataFimFormacao, $idCient, $idFormacao) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_updateDataFormacao = "UPDATE `t_formacao` SET `DTI_FORMACAO`='$nDataInicioFormacao', `DTT_FORMACAO`='$nDataFimFormacao' WHERE `ID_CIENTISTA`='$idCient' and `ID_FORMACAO`='$idFormacao'";

                $conn->exec($sql_updateDataFormacao);
                // header("Location: ../views/View_Telefone.php");
            } 
            catch(PDOException $e) {
                echo $sql_updateDataFormacao . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function delete($idFormacao, $idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_excluirFormacao = "DELETE FROM `t_formacao` WHERE `ID_FORMACAO` = '$idFormacao' AND `ID_CIENTISTA` = '$idCient'";

                $conn->exec($sql_excluirFormacao);
                header("Location: ../views/View_Formacao.php");
            } 
            catch(PDOException $e) {
                echo $sql_excluirFormacao . "<br>" . $e->getMessage();
            }
            $conn = null;
        }
    }

?>