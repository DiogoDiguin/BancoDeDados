<?php

    include 'AbstradaExibir.php';
    
    final class exibirAreaAtuacao extends exibir{

        public function getDetalhes($idCient){
            include '../../conexaoBD/conexao.php';
            $sql_AreasAtuacao = mysqli_query($conexao, "SELECT * FROM `t_area_atuacao`,`t_area_atuacao_cientista` WHERE `t_area_atuacao`.`ID_AREA_ATUACAO` = `t_area_atuacao_cientista`.`ID_AREA_ATUACAO` and `t_area_atuacao_cientista`.`ID_CIENTISTA` = '$idCient'");

            while($aux = mysqli_fetch_assoc($sql_AreasAtuacao)){
                $idArea = $aux['ID_AREA_ATUACAO'];
                $nome = $aux['NOM_AREA_ATUACAO'];
                echo "<li>".$nome;
                echo "<br><a href=../controllers/AreaAtuacaoALTERAR.php?id=$idArea>Alterar</a>";
                echo "<br><a href=../controllers/AreaAtuacaoEXCLUIR.php?id=$idArea>Excluir</a><br><br></li>";
            }
        }

    }

    
?>