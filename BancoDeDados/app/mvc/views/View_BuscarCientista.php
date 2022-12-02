<?php

function perfil($nome,  $cpf, $diaNasc, $mesNasc, $anoNasc, $email, $email_02, $lattes, $idResponsavel, $conexao, $idCidade){
    $whatsapp = "http://api.whatsapp.com/send?1=pt_BR&phone=55";
    echo "
        <p class=container>";

        $sql_formacaoCientista = mysqli_query($conexao, "SELECT * FROM `t_formacao`, `t_titulacao` WHERE `t_formacao`.`ID_TITULACAO` = `t_titulacao`.`ID_TITULACAO` and `t_formacao`.`ID_CIENTISTA` = '$idResponsavel'");

        $sql_telefone = mysqli_query($conexao, "SELECT * FROM `t_telefone` WHERE `ID_CIENTISTA` = '$idResponsavel'");

        $sql_areaAtuacaoCientista = mysqli_query($conexao, "SELECT * FROM `t_area_atuacao_cientista`, `t_area_atuacao` WHERE `t_area_atuacao`.`ID_AREA_ATUACAO` = `t_area_atuacao_cientista`.`ID_AREA_ATUACAO` and `t_area_atuacao_cientista`.`ID_CIENTISTA` = '$idResponsavel'");

        $sql_redesSociaisCientista = mysqli_query($conexao, "SELECT `END_REDE_SOCIAL`,`TIP_REDE_SOCIAL` FROM `t_redes_sociais` WHERE `ID_CIENTISTA` = '$idResponsavel'");

        $sql_cidadeCientista = mysqli_query($conexao, "SELECT * FROM `t_cidade` WHERE `t_cidade`.`ID_CIDADE` = $idCidade");

        echo "<br><strong>$nome</strong><br>";

        while($aux = mysqli_fetch_assoc($sql_cidadeCientista)){
            $nomeCidade = str_replace("_", " ",$aux['NOM_CIDADE']);
            echo "<strong>Cidade: </strong>$nomeCidade<br>";
        }

        echo"
        <strong> Data Nasc.: </strong>".$diaNasc."/".$mesNasc."/".$anoNasc."
        <br><strong> Cpf: </strong>$cpf
        <br><strong> Email: </strong><a href=mailto:$email> $email</a>
        <br><strong> Email 02: </strong><a href=mailto:$email_02> $email_02 </a>
        <br><a href=$lattes target=_blank>Lattes</a>
        <br>";  
        
        echo "<br><a href=../../paginas/perfilEstatico.php?id=$idResponsavel target=_blank>Visualizar Perfil</a><br>";

            echo "<br><strong>Formações: </strong><br>";

            while($aux = mysqli_fetch_assoc($sql_formacaoCientista)){
                if($idResponsavel == $aux['ID_CIENTISTA']){
                    $nomeFormacao = $aux['NOM_TITULACAO'];

                    $dataInicio = explode("-",$aux['DTI_FORMACAO']);
                    $anoInicio = $dataInicio[0];
                    $mesInicio = $dataInicio[1];
                    $diaInicio = $dataInicio[2];

                    $dataFim = explode("-",$aux['DTT_FORMACAO']);
                    $anoFim = $dataFim[0];
                    $mesFim = $dataFim[1];
                    $diaFim = $dataFim[2];

                    echo $nomeFormacao.": ".$diaInicio."/".$mesInicio."/".$anoInicio." - ".$diaFim."/".$mesFim."/".$anoFim;
                    echo "<br>";
                }
            }

            echo "<br><strong>Contato: </strong>";

            while($aux = mysqli_fetch_assoc($sql_telefone)){
                if($idResponsavel == $aux['ID_CIENTISTA']){

                    $numero = $aux['NUM_TELEFONE'];
                    $ddd = $aux['DDD_TELEFONE'];
                    echo "<br>";
                    echo"("."$ddd".")"."$numero <a href=$whatsapp$ddd$numero target=_blank><img src=../../Imagens/whatsapp.svg alt=Whatsapp Logo
                    width=25px heigth=25px/></a>";
                }
            }

            echo "<br><br><strong>Áreas Atuação: </strong><br>";
            
            while($aux = mysqli_fetch_assoc($sql_areaAtuacaoCientista)){
                if($aux != NULL){
                    $nomeAreaAtuacao = $aux['NOM_AREA_ATUACAO'];
                    //echo $idAreaAtuacao;
                    echo $nomeAreaAtuacao."<br>";
                }
            }

            echo "<strong><br>Social: </strong><br>";

            while($aux = mysqli_fetch_assoc($sql_redesSociaisCientista)){
                $endRedeSocial = $aux['END_REDE_SOCIAL'];
                $tipoRedeSocial = $aux['TIP_REDE_SOCIAL'];

                if($tipoRedeSocial == 'i'){/*Instagram*/
                    echo "<a href=$endRedeSocial target=_blank><img src=../../Imagens/instagram.svg alt=Instagram Logo width=25px heigth=25px></a> ";
                }
                if($tipoRedeSocial == 'f'){/*Facebook*/
                    echo "<a href=$endRedeSocial target=_blank><img src=../../Imagens/facebook.svg alt=Facebook Logo width=25px heigth=25px></a> ";
                }
                if($tipoRedeSocial == 'l'){/*Linkedin*/
                    echo "<a href=$endRedeSocial target=_blank><img src=../../Imagens/linkedin.svg alt=Linkedin Logo width=25px heigth=25px></a> ";
                }
                if($tipoRedeSocial == 'y'){/*Youtube*/
                    echo "<a href=$endRedeSocial target=_blank><img src=../../Imagens/youtube.svg alt=Youtube Logo width=25px heigth=25px></a> ";
                }
                if($tipoRedeSocial == 't'){/*Tiktok*/
                    echo "<a href=$endRedeSocial target=_blank><img src=../../Imagens/tiktok.svg alt=Tiktok Logo
                    width=25px heigth=25px></a> ";
                }
            }  
            echo "</p><br>";          
}/*FIM PERFIL*/

?>