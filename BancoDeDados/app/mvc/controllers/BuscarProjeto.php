<?php
    session_start(); # Deve ser a primeira linha do arquivo

    if(!isset($_SESSION['idCientista'])){
        header('Location: ../../../publico/Index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../../publico/Css/style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
</head>

<title>Buscar Projetos</title>

<body>

    <div>
        <nav>
            <ul class="menu">
            <li><a href='BuscarCientista.php' target="_blank"><i class="fa-solid fa-address-card" style="margin-right: 4px"></i>Buscar Cientistas</a></li>
            <li><a href='BuscarProjeto.php'><i class="fa-solid fa-magnifying-glass"></i> Buscar Projetos</a></li>
            <li><a href='projetoINCLUIR.php' target="_blank"><i class="fa-solid fa-plus" style="margin-right: 4px"></i>Inserir Projeto</a></li>
            <li><a href='../views/Perfil.php' target="_blank"><i class="fa-solid fa-user"></i> Perfil</a></li>
            <li><a href='../../paginas/Opcoes.php' target="_blank">Preferências</a></li>
            <li><a href='../../paginas/logout.php'><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
            </ul>
        </nav>
    </div>
    
    <div class="principal">
    <main class="container formulario2">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <!-- Para o usuário manipular -->
            <h2 style=text-align:center; margin-top: 30px;>Buscar Projetos</h2>
        <br>
            <div class="input-field">
                <input type="text" name="nProjeto" placeholder="Nome do projeto">
                <div class="underline"></div>
            </div>
        <br>
        <!--
            <div class="input-field">
                <input type="text" name="nProjetoEspecifico" placeholder="Nome do projeto COMPLETO">
                <div class="underline"></div>
            </div>
        <br>
        -->
            <div class="input-field">
                <input type="text" name="nResponsavel" placeholder="Nome do responsável">
                <div class="underline"></div>
            </div>
        <br>
            <input type="submit" value="OK">
        </form>
    </main>
    </div>
    
<?php
    //echo '<prev>';
    //$busca = $_POST['palavra'];

    include '../../conexaoBD/conexao.php';
    include_once '../views/View_BuscarProjeto.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $buscaPr = htmlspecialchars($_REQUEST['nProjeto']);
        //$buscaPrEspc = htmlspecialchars($_REQUEST['nProjetoEspecifico']);
        $buscaCient = htmlspecialchars($_REQUEST['nResponsavel']);

        //$sql_projetos = mysqli_query($conexao, "SELECT * FROM `t_projetos`");
        $sql_projetoCientista = mysqli_query($conexao, "SELECT * FROM `t_projeto`,`t_cientista` WHERE `t_projeto`.`ID_CIENTISTA` = `t_cientista`.`ID_CIENTISTA` and `t_projeto`.`PUB_PROJETO` != 'privado'");

        if(!empty($buscaPr) and empty($buscaCient)){
            while($aux = mysqli_fetch_assoc($sql_projetoCientista)){
                $tituloProjeto = $aux['TIT_PROJETO'];
                //$publiProjeto = $aux['PUB_PROJETO'];
                $resumoProjeto = $aux['RES_PROJETO'];
                $dataInicioP = explode("-",$aux['DTI_PROJETO']);
                $anoInicioP = $dataInicioP[0];
                $mesInicioP = $dataInicioP[1];
                $diaInicioP = $dataInicioP[2];

                $dataFimP = explode("-",$aux['DTT_PROJETO']);
                $anoFimP = $dataFimP[0];
                $mesFimP = $dataFimP[1];
                $diaFimP = $dataFimP[2];

                $responsavel = $aux['NOM_CIENTISTA'];
                $idResponsavel = $aux['ID_CIENTISTA'];

                if(str_contains(strtoupper($tituloProjeto), strtoupper($buscaPr)) /*and $publiProjeto <> 0*/){
                    /*$resumo = $p->resProjeto;
                    $dataInicio = $p->dti_Projeto;
                    $dataFim = $p->dtt_Projeto;*/

                    projeto ($tituloProjeto, $resumoProjeto, $diaInicioP, $mesInicioP, $anoInicioP, $diaFimP, $mesFimP, $anoFimP, $responsavel, $idResponsavel, $conexao);
                }
            }
        }else if(!empty($buscaCient) and empty($buscaPr)){
            while($aux = mysqli_fetch_assoc($sql_projetoCientista)){
                $tituloProjeto = $aux['TIT_PROJETO'];
                //$publiProjeto = $aux['PUB_PROJETO'];
                $resumoProjeto = $aux['RES_PROJETO'];
                $dataInicioP = explode("-",$aux['DTI_PROJETO']);
                $anoInicioP = $dataInicioP[0];
                $mesInicioP = $dataInicioP[1];
                $diaInicioP = $dataInicioP[2];

                $dataFimP = explode("-",$aux['DTT_PROJETO']);
                $anoFimP = $dataFimP[0];
                $mesFimP = $dataFimP[1];
                $diaFimP = $dataFimP[2];

                $responsavel = $aux['NOM_CIENTISTA'];
                $idResponsavel = $aux['ID_CIENTISTA'];

                if(str_contains(strtoupper($responsavel), strtoupper($buscaCient)) /*and $publiProjeto <> 0*/){
                    projeto ($tituloProjeto, $resumoProjeto, $diaInicioP, $mesInicioP, $anoInicioP, $diaFimP, $mesFimP, $anoFimP, $responsavel, $idResponsavel, $conexao);
                }
            }
        }else if(!empty($buscaCient) and !empty($buscaPr)){
            while($aux = mysqli_fetch_assoc($sql_projetoCientista)){
                $tituloProjeto = $aux['TIT_PROJETO'];
                //$publiProjeto = $aux['PUB_PROJETO'];
                $resumoProjeto = $aux['RES_PROJETO'];
                $dataInicioP = explode("-",$aux['DTI_PROJETO']);
                $anoInicioP = $dataInicioP[0];
                $mesInicioP = $dataInicioP[1];
                $diaInicioP = $dataInicioP[2];

                $dataFimP = explode("-",$aux['DTT_PROJETO']);
                $anoFimP = $dataFimP[0];
                $mesFimP = $dataFimP[1];
                $diaFimP = $dataFimP[2];

                $responsavel = $aux['NOM_CIENTISTA'];
                $idResponsavel = $aux['ID_CIENTISTA'];

                if(str_contains(strtoupper($responsavel), strtoupper($buscaCient)) and str_contains(strtoupper($tituloProjeto), strtoupper($buscaPr))){
                    projeto ($tituloProjeto, $resumoProjeto, $diaInicioP, $mesInicioP, $anoInicioP, $diaFimP, $mesFimP, $anoFimP, $responsavel, $idResponsavel, $conexao);
                }
            }
        }else{
            while($aux = mysqli_fetch_assoc($sql_projetoCientista)){
                $tituloProjeto = $aux['TIT_PROJETO'];
                //$publiProjeto = $aux['PUB_PROJETO'];
                $resumoProjeto = $aux['RES_PROJETO'];
                $dataInicioP = explode("-",$aux['DTI_PROJETO']);
                $anoInicioP = $dataInicioP[0];
                $mesInicioP = $dataInicioP[1];
                $diaInicioP = $dataInicioP[2];

                $dataFimP = explode("-",$aux['DTT_PROJETO']);
                $anoFimP = $dataFimP[0];
                $mesFimP = $dataFimP[1];
                $diaFimP = $dataFimP[2];

                $responsavel = $aux['NOM_CIENTISTA'];
                $idResponsavel = $aux['ID_CIENTISTA'];

                projeto ($tituloProjeto, $resumoProjeto, $diaInicioP, $mesInicioP, $anoInicioP, $diaFimP, $mesFimP, $anoFimP, $responsavel, $idResponsavel, $conexao);
            }
        }
    }
?>

</body>
</html>