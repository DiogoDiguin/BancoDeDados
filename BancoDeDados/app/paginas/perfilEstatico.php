<?php
    session_start(); # Deve ser a primeira linha do arquivo
    $idCient = $_GET['id'];

    if(!isset($_SESSION['idCientista'])){
        header('Location: ../../../publico/Index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src = "../js/index.js"></script>
    <link rel="stylesheet" href="../../publico/Css/style.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <style>
        a{
            text-decoration: none;
        }
        a:hover{
            color: #0000FF;
            text-decoration: none;
        }
    </style>
    <title>Perfil</title>
</head>
<body>
<div>
        <nav>
            <ul class="menu">
            <li><a href='BuscarCientista.php' target="_blank"><i class="fa-solid fa-address-card" style="margin-right: 4px"></i>Buscar Cientistas</a></li>
            <li><a href='BuscarProjeto.php' target="_blank"><i class="fa-solid fa-magnifying-glass"></i> Buscar Projetos</a></li>
            <li><a href='projetoInserir.php' target="_blank"><i class="fa-solid fa-plus" style="margin-right: 4px"></i>Inserir Projeto</a></li>
            <li><a href='Perfil.php' target="_blank"><i class="fa-solid fa-user"></i> Perfil</a></li>
            <li><a href='Opcoes.php' target="_blank">Preferências</a></li>
            <li><a href='logout.php'><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
            </ul>
        </nav>
    </div>
    

<?php
    //include ("../mvc/models/Importacao.php");
    include '../conexaoBD/conexao.php';
    $whatsapp = "http://api.whatsapp.com/send?1=pt_BR&phone=55";

    $sql_dadosCientista = "SELECT * FROM `t_cientista` WHERE `ID_CIENTISTA` = '$idCient'";
    
    $queryDadosCientista = $conexao->query($sql_dadosCientista) or die("Falha na execução do código SQL: " . $conexao->error);
    $quantidadeDados = $queryDadosCientista->num_rows;
    $cientista = $queryDadosCientista->fetch_assoc();
    $dataNasc = explode("-",$cientista['DTN_CIENTISTA']);
    $ano = $dataNasc[0];
    $mes = $dataNasc[1];
    $dia = $dataNasc[2];

    $lattes = $cientista['LATTES_CIENTISTA'];

    $sql_telefoneCientista = mysqli_query($conexao, "SELECT * FROM `t_telefone` WHERE `ID_CIENTISTA` = '$idCient'");

    $sql_areaAtuacaoCientista = mysqli_query($conexao, "SELECT * FROM `t_area_atuacao_cientista`, `t_area_atuacao` WHERE `t_area_atuacao`.`ID_AREA_ATUACAO` = `t_area_atuacao_cientista`.`ID_AREA_ATUACAO` and `t_area_atuacao_cientista`.`ID_CIENTISTA` = '$idCient'");

    $sql_formacaoCientista = mysqli_query($conexao, "SELECT * FROM `t_formacao`, `t_titulacao` WHERE `t_formacao`.`ID_TITULACAO` = `t_titulacao`.`ID_TITULACAO` and `t_formacao`.`ID_CIENTISTA` = '$idCient'");

    $sql_redesSociaisCientista = mysqli_query($conexao, "SELECT * FROM `t_redes_sociais` WHERE `ID_CIENTISTA` = '$idCient'");

    $sql_projetoCientista = mysqli_query($conexao, "SELECT * FROM `t_projeto` WHERE `ID_CIENTISTA` = '$idCient' and `PUB_PROJETO` != 'privado'");

    $sql_CidadeCientista = mysqli_query($conexao, "SELECT `NOM_CIDADE` FROM `t_cidade`, `t_cientista` WHERE t_cientista.ID_CIDADE = t_cidade.ID_CIDADE and `t_cientista`.ID_CIENTISTA = '$idCient'");

    while($aux = mysqli_fetch_assoc($sql_CidadeCientista)){
        $cidade = $aux['NOM_CIDADE'];  
    }

    echo "<div class=principal>
    <main class=container formulario2>
    <h2 style=text-align: center; margin-top: 30px;>".$cientista['NOM_CIENTISTA']."</h2>
    <br>
    <strong>Data de Nascimento: </strong>".$dia."/".$mes."/".$ano."</label><br>
    <strong> E-mail 01: </strong><a href=mailto:".$cientista['EMAIL_CIENTISTA'].">".$cientista['EMAIL_CIENTISTA']."</a><br>
    <strong> E-mail 02: </strong><a href=mailto:".$cientista['EMAIL2_CIENTISTA'].">".$cientista['EMAIL2_CIENTISTA']."</a><br>
    <strong>CPF: </strong>".$cientista['CPF_CIENTISTA']."</label><br>
    <strong>Cidade: </strong>".$cidade."</label><br>
    <a href= $lattes target=_blank>Lattes</a>";

    echo "<br><br><strong>Contato: </strong>";

    while($aux = mysqli_fetch_assoc($sql_telefoneCientista)){

        $numero = $aux['NUM_TELEFONE'];
        $ddd = $aux['DDD_TELEFONE'];
        echo "<br>";
        echo"("."$ddd".") "."$numero <a href=$whatsapp$ddd$numero target=_blank><img src=../Imagens/whatsapp.svg alt=Whatsapp Logo
        width=25px heigth=25px/></a>";
    }

    echo "<br><br><strong>Áreas Atuação: </strong><br>";

    while($aux = mysqli_fetch_assoc($sql_areaAtuacaoCientista)){
        //$idAreaAtuacao = $aux['ID_AREA_ATUACAO'];
        if($aux != NULL){
            $nomeAreaAtuacao = $aux['NOM_AREA_ATUACAO'];
            //echo $idAreaAtuacao;
            echo $nomeAreaAtuacao."<br>";
        }
    }

    echo "<br><strong>Formações: </strong><br>";

    while($aux = mysqli_fetch_assoc($sql_formacaoCientista )){
        //echo $idAreaAtuacao;
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

    echo "<br><strong>Social: </strong><br>";

    while($aux = mysqli_fetch_assoc($sql_redesSociaisCientista )){
        //echo $idAreaAtuacao;
        $nomeRedeSocial = $aux['END_REDE_SOCIAL'];

        if(str_contains($nomeRedeSocial, "www.instagram")){/*Instagram*/
            echo "<a href=$nomeRedeSocial target=_blank><img src=../Imagens/instagram.svg alt=Instagram Logo width=25px heigth=25px></a> ";
        }
        if(str_contains($nomeRedeSocial, "facebook")){/*Facebook*/
            echo "<a href=$nomeRedeSocial target=_blank><img src=../Imagens/facebook.svg alt=Facebook Logo width=25px heigth=25px></a> ";
        }
        if(str_contains($nomeRedeSocial, "www.linkedin")){/*Linkedin*/
            echo "<a href=$nomeRedeSocial target=_blank><img src=../Imagens/linkedin.svg alt=Linkedin Logo width=25px heigth=25px></a> ";
        }
        if(str_contains($nomeRedeSocial, "www.youtube")){/*Youtube*/
            echo "<a href=$nomeRedeSocial target=_blank><img src=../Imagens/youtube.svg alt=Youtube Logo
            width=25px heigth=25px></a> ";
        }
        if(str_contains($nomeRedeSocial, "www.tiktok")){/*Tiktok*/
            echo "<a href=$nomeRedeSocial target=_blank><img src=../Imagens/tiktok.svg alt=Tiktok Logo
            width=25px heigth=25px></a> ";
        }
    }

    echo "<br><br><strong>Projetos: </strong><br>";

    while($aux = mysqli_fetch_assoc($sql_projetoCientista)){
        $tituloProjeto = $aux['TIT_PROJETO'];
        $resumoProjeto = $aux['RES_PROJETO'];
        $dataInicioP = explode("-",$aux['DTI_PROJETO']);
        $anoInicioP = $dataInicioP[0];
        $mesInicioP = $dataInicioP[1];
        $diaInicioP = $dataInicioP[2];
        $publicacao = $aux['PUB_PROJETO'];

        $dataFimP = explode("-",$aux['DTT_PROJETO']);
        $anoFimP = $dataFimP[0];
        $mesFimP = $dataFimP[1];
        $diaFimP = $dataFimP[2];

        if($publicacao <> 0){
            echo "<p><Strong>Título: </Strong>$tituloProjeto";
            echo "<br><style=text-align: justify>$resumoProjeto</style><br>";
            echo "<strong>Início: </strong>".$diaInicioP."/".$mesInicioP."/".$anoInicioP." - <strong>Final: </strong>".$diaFimP."/".$mesFimP."/".$anoFimP;
            echo "<br><br></p>";
        }
    }

    echo "</main>
        <br>
    </div>";

?>
</body>
</html>