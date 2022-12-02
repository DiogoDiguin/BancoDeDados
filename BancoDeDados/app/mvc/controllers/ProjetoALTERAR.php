<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $idProjetoAtual = $_GET['id'];
}

if(empty($idProjetoAtual)){
    header('Location: ../views/View_Projetos.php');
}

include '../../conexaoBD/conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src = "../js/index.js"></script>
    <link rel="stylesheet" href="../../../publico/Css/style.css">
    <style>
        a{
            text-decoration: none;
        }
        a:hover{
            color: #0000FF;
            text-decoration: none;
        }
    </style>
    <title>EDITAR Projeto</title>
</head>
<body>

    <div class="principal">
        <main class="container formulario2">
        <a href="../views/View_Projetos.php">&#8592;</a><br>
            <strong>Editar projeto </strong><br><br>
                <?php
                    $sql_Projetos = mysqli_query($conexao, "SELECT * FROM `t_projeto` WHERE `ID_CIENTISTA` = '$idCient' and ID_PROJETO = '$idProjetoAtual'");

                    while($aux = mysqli_fetch_assoc($sql_Projetos)){
                        /*$idProjeto = $aux['ID_PROJETO'];*/
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

                        echo "<p><Strong>Título: </Strong>$tituloProjeto";
                        echo "<br><style=text-align: justify>$resumoProjeto</style><br>";
                        echo "<strong>Início: </strong>".$diaInicioP."/".$mesInicioP."/".$anoInicioP." - <strong>Final: </strong>".$diaFimP."/".$mesFimP."/".$anoFimP;
                        if($publiProjeto == 'publico'){
                            echo "<br><strong>Tipo publicação: </strong>Público</p>";
                        }else{
                            echo "<br><strong>Tipo publicação: </strong>Privado</p>";
                        }
                    }
                ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <br>
                <label for=nTituloProjeto>Título:</label>
                    <div class=input-field>
                        <input type=text name=nTituloProjeto MAXLENGTH=50 placeholder=Nome do projeto COMPLETO>
                        <div class=underline></div>
                    </div>
            <br>

                <label for=nResumoProjeto>Resumo:</label>
                    <div class=input-field>
                        <input type=text name=nResumoProjeto MAXLENGTH=250 placeholder=Resumo do projeto COMPLETO>
                        <div class=underline></div>
                    </div>
            <br>

                <label for=nDtiProjeto>Data início:</label>
                    <div class=input-field>
                        <input type=date name=nDtiProjeto>
                        <div class=underline></div>
                    </div>
            <br>

                <label for=nDttProjeto>Data final/Previsão:</label>
                    <div class=input-field>
                        <input type=date name=nDttProjeto>
                        <div class=underline></div>
                    </div>
                <br>

                Público
                <input type="radio" id="publico" name="nPublicacao" value='publico'>
                <br>
                <!--<label for="publico">Publico</label><br>-->
                Privado
                <input type="radio" id="privado" name="nPublicacao" value='privado'>
                <!--<label for="privado">Privado</label><br>-->
                <br><br>
                
                <input type="hidden" id="idProjeto" name="idProjeto" value="<?=$idProjetoAtual?>">
                <input type="submit" value="OK">
        </form>
        <!--</main>
    </div>-->

<?php

include 'ProjetoDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $novoTitulo = htmlspecialchars($_REQUEST['nTituloProjeto']);
    $novoResumo = htmlspecialchars($_REQUEST['nResumoProjeto']);
    $novaDataInicio = htmlspecialchars($_REQUEST['nDtiProjeto']);
    $novaDataFim = htmlspecialchars($_REQUEST['nDttProjeto']);
    $novaPublicacao = htmlspecialchars($_REQUEST['nPublicacao']);
    $idProjeto = htmlspecialchars($_REQUEST['idProjeto']);

    if(!empty($novoTitulo)){
        $dao = new ProjetoDAO();
        $dao->updateTitulo($novoTitulo, $idCient, $idProjeto);
    }
    if(!empty($novoResumo)){
        $dao = new ProjetoDAO();
        $dao->updateResumo($novoResumo, $idCient, $idProjeto);
    }
    if(!empty($novaDataInicio) and !empty($novaDataFim) and $novaDataInicio < $novaDataFim){
        $dao = new ProjetoDAO();
        $dao->updateDatas($novaDataInicio, $novaDataFim, $idCient, $idProjeto);
    }else{
        echo "Intervalo não aceito.";
    }
    if(!empty($novaPublicacao)){
        $dao = new ProjetoDAO();
        $dao->updatePublicacao($novaPublicacao, $idCient, $idProjeto);
    }
    /*echo "Publicação: ".$novaPublicacao."<br>";
    echo "Cientista: ".$idCient."<br>";
    echo "Id Projeto: ".$idProjeto."<br>";*/
}

echo "
        </main>
        <br>
    </div>";
?>
</body>
</html>