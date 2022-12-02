<?php
    include '../../conexaoBD/conecta.php';
    include '../models/ClasseRedeSocial.php';
    include '../models/InterfaceInformacao.php';

    class RedeSocialDAO implements Informacao{
        public function insert($redeSocial) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $idCient   = $redeSocial->getId();
                $endereco  = $redeSocial->getEndereco();
                $tipo      = $redeSocial->getTipo();

                $sql_novaRede = "INSERT INTO `t_redes_sociais`(`ID_CIENTISTA`, `END_REDE_SOCIAL`, `TIP_REDE_SOCIAL`) VALUES ('$idCient','$endereco','$tipo')";

                $conn->exec($sql_novaRede);
                header("Location: ../../paginas/Opcoes.php");
            } 
            catch(PDOException $e) {
                echo $sql_novaRede . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function updtadeRede($Rede, $idCient, $tipoRede) {
            try {
                session_start();
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_updateRede = "UPDATE `t_redes_sociais` SET `END_REDE_SOCIAL` ='$Rede' WHERE `ID_CIENTISTA` = '$idCient' and `TIP_REDE_SOCIAL` = '$tipoRede'";

                $conn->exec($sql_updateRede);
                header("Location: ../../paginas/Opcoes.php");
            } 
            catch(PDOException $e) {
                echo $sql_updateRede . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        public function delete($idCient, $tipoRede) {
            try {
                session_start();
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_removeRede = "DELETE FROM `t_redes_sociais` WHERE `ID_CIENTISTA` = '$idCient' and `TIP_REDE_SOCIAL` = '$tipoRede'";

                $conn->exec($sql_removeRede);
                header("Location: ../../paginas/Opcoes.php");
            } 
            catch(PDOException $e) {
                echo $sql_removeRede . "<br>" . $e->getMessage();
            }
            $conn = null;
        }
    }

?>