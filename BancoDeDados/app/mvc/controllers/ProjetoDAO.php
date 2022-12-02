<?php
    include '../../conexaoBD/conecta.php';
    include '../models/ClasseProjeto.php';
    include '../models/InterfaceInformacao.php';

    class ProjetoDAO implements Informacao{
        public function insert($projeto) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $idCientista     = $projeto->getCientista();
                $tituloProjeto   = $projeto->getTitulo();
                $resumoProjeto   = $projeto->getResumoProjeto();
                $dtInicioPr      = $projeto->getDtInicio();
                $dtFimPr         = $projeto->getDtFim();
                $tipoPublicacao  = $projeto->getTipoPublicao();

                $insertProjeto = "INSERT INTO t_projeto (id_cientista, tit_projeto, res_projeto, dti_projeto, dtt_projeto, pub_projeto) VALUES ('$idCientista','$tituloProjeto','$resumoProjeto', '$dtInicioPr', '$dtFimPr', '$tipoPublicacao')";

                $conn->exec($insertProjeto);
                echo "Registro inserido com sucesso";
            } 
            catch(PDOException $e) {
                echo $insertProjeto . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*UPDATE Título Projeto*/
        public function updateTitulo($novoTitulo, $idCient, $idProjeto) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_novoTitulo = "UPDATE `t_projeto` SET `TIT_PROJETO`='$novoTitulo' WHERE `ID_CIENTISTA` = '$idCient' and `ID_PROJETO` = '$idProjeto'";

                $conn->exec($sql_novoTitulo);
                
            } 
            catch(PDOException $e) {
                echo $sql_novoTitulo . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*UPDATE Resumo Projeto*/
        public function updateResumo($novoResumo, $idCient, $idProjeto) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_novoResumo = "UPDATE `t_projeto` SET `RES_PROJETO`='$novoResumo' WHERE `ID_CIENTISTA` = '$idCient' and `ID_PROJETO` = '$idProjeto'";

                $conn->exec($sql_novoResumo);
                
            } 
            catch(PDOException $e) {
                echo $sql_novoResumo . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*UPDATE Datas Projeto*/
        public function updateDatas($novaDataInicio, $novaDataFim, $idCient, $idProjeto) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_novasDatas = "UPDATE `t_projeto` SET `DTI_PROJETO`='$novaDataInicio', `DTT_PROJETO`='$novaDataFim' WHERE `ID_CIENTISTA` = '$idCient' and `ID_PROJETO` = '$idProjeto'";

                $conn->exec($sql_novasDatas);
                
            } 
            catch(PDOException $e) {
                echo $sql_novasDatas . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*UPDATE Tipos Publicação*/
        public function updatePublicacao($novaPublicacao, $idCient, $idProjeto) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_novaPublicacao = "UPDATE `t_projeto` SET `PUB_PROJETO`='$novaPublicacao' WHERE `ID_CIENTISTA` = '$idCient' and `ID_PROJETO` = '$idProjeto'";

                $conn->exec($sql_novaPublicacao);
                
            } 
            catch(PDOException $e) {
                echo $sql_novaPublicacao . "<br>" . $e->getMessage();
            }
            $conn = null;
        }

        /*DELETE Projeto*/
        public function delete($idProjeto, $idCient) {
            try {
                $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DBNAME, USERNAME, PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql_excluirProjeto = "DELETE FROM `t_projeto` WHERE `ID_PROJETO` = '$idProjeto' AND `ID_CIENTISTA` = '$idCient'";
                header("Location: ../views/View_Projetos.php");

                $conn->exec($sql_excluirProjeto);
                
            } 
            catch(PDOException $e) {
                echo $sql_excluirProjeto . "<br>" . $e->getMessage();
            }
            $conn = null;
        }
    }

?>