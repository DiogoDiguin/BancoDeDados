<?php

    include 'AbstradaExibir.php';
    
    final class exibirProjetos extends exibir{

        public function getDetalhes($idCient){
            include '../../conexaoBD/conexao.php';
            $sql_Projetos = mysqli_query($conexao, "SELECT * FROM `t_projeto` WHERE `ID_CIENTISTA` = '$idCient'");
            
            while($aux = mysqli_fetch_assoc($sql_Projetos)){
                $idProjeto = $aux['ID_PROJETO'];
                $tituloProjeto = $aux['TIT_PROJETO'];
                $publiProjeto = $aux['PUB_PROJETO'];
                $resumoProjeto = $aux['RES_PROJETO'];
                $dataInicioP = explode("-",$aux['DTI_PROJETO']);
                $anoInicioP = $dataInicioP[0];
                $mesInicioP = $dataInicioP[1];
                $diaInicioP = $dataInicioP[2];
                $dataFimP = explode("-",$aux['DTT_PROJETO']);
                $anoFimP = $dataFimP[0];
                $mesFimP = $dataFimP[1];
                $diaFimP = $dataFimP[2];

                echo "<li><strong>".$tituloProjeto."</strong><br>";
                echo "<strong>Início: </strong>".$diaInicioP."/".$mesInicioP."/".$anoInicioP."<br>";
                echo "<strong>Final: </strong>".$diaFimP."/".$mesFimP."/".$anoFimP;
                echo "<br><strong>Resumo: </strong>".$resumoProjeto."<br>";
                echo "<strong>Tipo publicação: </strong>";
                if($publiProjeto == "privado"){
                    echo "Privado";
                }else{
                    echo "Público";
                }

                echo "<br><a href=../controllers/ProjetoALTERAR.php?id=$idProjeto>Editar</a>";
                echo "<br><a href=../controllers/ProjetoEXCLUIR.php?id=$idProjeto>Excluir</a><br><br></li>";
            }
        }

    }

?>