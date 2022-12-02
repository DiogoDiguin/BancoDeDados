<?php

    include 'AbstradaExibir.php';
    
    final class exibirFormacao extends exibir{

        public function getDetalhes($idCient){
            include '../../conexaoBD/conexao.php';
                            $sql_Formacoes = mysqli_query($conexao, "SELECT * FROM `t_formacao`,`t_titulacao` WHERE `t_titulacao`.`ID_TITULACAO` = `t_formacao`.`ID_TITULACAO` and `t_formacao`.`ID_CIENTISTA` = '$idCient'");

                while($aux = mysqli_fetch_assoc($sql_Formacoes)){
                    $idFormacao = $aux['ID_FORMACAO'];
                    //$idFormacao = $aux['ID_TITULACAO'];
                    $nome = $aux['NOM_TITULACAO'];
                    $dataInicio = explode("-",$aux['DTI_FORMACAO']);
                    $anoInicio = $dataInicio[0];
                    $mesInicio = $dataInicio[1];
                    $diaInicio = $dataInicio[2];

                    $dataFinal = explode("-",$aux['DTT_FORMACAO']);
                    $anoFinal = $dataFinal[0];
                    $mesFinal = $dataFinal[1];
                    $diaFinal = $dataFinal[2];

                    echo "<li>".$nome."<br>";
                    echo "Início: ".$diaInicio."/".$mesInicio."/".$anoInicio."<br>";
                    echo "Final: ".$diaFinal."/".$mesFinal."/".$anoFinal;

                    echo "<br><a href=../controllers/FormacaoALTERAR.php?id=$idFormacao target=_blank>Alterar</a>";
                    echo "<br><a href=../controllers/FormacaoEXCLUIR.php?id=$idFormacao>Excluir</a><br><br></li>";
                }
        }

    }

?>