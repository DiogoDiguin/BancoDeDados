<?php
    function projeto($tituloProjeto, $resumoProjeto, $diaInicioP, $mesInicioP, $anoInicioP, $diaFimP, $mesFimP, $anoFimP, $responsavel, $idResponsavel, $conexao){
        $whatsapp = "http://api.whatsapp.com/send?1=pt_BR&phone=55";
        echo "<p class=container>
                        <strong>$tituloProjeto</strong><br>
                        <br>$resumoProjeto<br>
                        <strong><br>Início: </strong>".$diaInicioP."/".$mesInicioP."/".$anoInicioP." - 
                        <strong>Final: </strong>".$diaFimP."/".$mesFimP."/".$anoFimP;

                echo "<br><strong> Responsável: </strong>$responsavel<br>";

                $sql_telefoneCientista = mysqli_query($conexao, "SELECT * FROM `t_telefone`,`t_cientista` WHERE `t_telefone`.`ID_CIENTISTA` = `t_cientista`.`ID_CIENTISTA` and `t_telefone`.`ID_CIENTISTA` = $idResponsavel");

                while($aux = mysqli_fetch_assoc($sql_telefoneCientista)){
                    $numero = $aux['NUM_TELEFONE'];
                    $ddd = $aux['DDD_TELEFONE'];
                    echo"<br><strong> Telefone: </strong>"."(".$ddd.") "."$numero <a href=$whatsapp$ddd$numero target=_blank><img src=../../Imagens/whatsapp.svg alt=Whatsapp Logo width=25px heigth=25px/></a>";
                }
        echo "</p><br>";
        /*echo "ID Cientista: ".$idResponsavel;*/
    }/*FIM PROJETO*/
?>