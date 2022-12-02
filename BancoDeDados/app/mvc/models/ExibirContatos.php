<?php

    include 'AbstradaExibir.php';
    
    final class exibirContatos extends exibir{

        public function getDetalhes($idCient){
            include '../../conexaoBD/conexao.php';
            $sql_Telefones = mysqli_query($conexao, "SELECT * FROM `t_telefone` WHERE `ID_CIENTISTA` = '$idCient'");
            while($aux = mysqli_fetch_assoc($sql_Telefones)){
                $idTelefone = $aux['ID_TELEFONE'];
                $ddd = $aux['DDD_TELEFONE'];
                $num = $aux['NUM_TELEFONE'];
                
                echo "<li><br>(".$ddd.") ".$num."<br>";
                echo "<a href=../controllers/TelefoneALTERAR.php?id=$idTelefone target=_blank>Alterar</a><br>";
                echo "<a href=../controllers/TelefoneEXCLUIR.php?id=$idTelefone>Excluir</a></li>";
            }
        }

    }


    
?>