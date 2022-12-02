<?php
    include '../../conexaoBD/conecta.php';
    include '../models/ClasseAreaAtuacao.php';
    include '../models/InterfaceInformacao.php';

    class AreaAtuacaoDAO implements Informacao{
        public function insert($areaAtuacao) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $idCient   = $areaAtuacao->getIdCient();
                $idArea    = $areaAtuacao->getIdArea();

                $sql_areaAtuacao = "INSERT INTO `t_area_atuacao_cientista`(`ID_CIENTISTA`, `ID_AREA_ATUACAO`) VALUES ('$idCient','$idArea')";

                $conn->exec($sql_areaAtuacao);
                header("Location: ../views/View_AreaAtuacao.php");
            } 
            catch(PDOException $e) {
                echo $sql_areaAtuacao . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function updateAreaAtuacao($idAreaNova, $idCient, $idAreaAtuacaoAtual) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_updateAreaAtuacao = "UPDATE `t_area_atuacao_cientista` SET `ID_AREA_ATUACAO`='$idAreaNova' WHERE `ID_CIENTISTA` = '$idCient' AND `ID_AREA_ATUACAO`='$idAreaAtuacaoAtual'";

                $conn->exec($sql_updateAreaAtuacao);
                header("Location: ../views/View_AreaAtuacao.php");
            } 
            catch(PDOException $e) {
                echo $sql_updateAreaAtuacao . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function delete($idAreaAtual, $idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_excluirArea = "DELETE FROM `t_area_atuacao_cientista` WHERE `ID_AREA_ATUACAO` = '$idAreaAtual' AND `ID_CIENTISTA` = '$idCient'";

                $conn->exec($sql_excluirArea);
                header("Location: ../views/View_AreaAtuacao.php");
            } 
            catch(PDOException $e) {
                echo $sql_excluirArea . "<br>" . $e->getMessage();
            }
            $conn = null;
        }
    }

?>