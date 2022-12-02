<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

$tipoRede = $_GET['tipo'];
include '../../conexaoBD/conexao.php';

switch($tipoRede){
    case 'f':
        $nomeRede = 'Facebook';
        $filtro = "https://www.facebook";
        break;
    case 'i':
        $nomeRede = 'Instagram';
        $filtro = "https://www.instagram";
        break;
    case 'l':
        $nomeRede = 'LinkedIn';
        $filtro = "https://www.linkedin.com";
        break;
    case 'y':
        $nomeRede = 'Youtube';
        $filtro = "https://www.youtube.com/";
        break;
    case 't':
        $nomeRede = 'TikTok';
        $filtro = "https://www.tiktok.com/";
        break;
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
    <title><?php echo $nomeRede ?></title>
</head>
<body>

<div class="principal">
    <main class="container formulario2">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']."?tipo=".$tipoRede;?>">

        <?php
            echo "<strong>Link atual: </strong>";
            $sql_Cientista = mysqli_query($conexao, "SELECT `END_REDE_SOCIAL` FROM `t_redes_sociais` WHERE `ID_CIENTISTA` = '$idCient' and `TIP_REDE_SOCIAL` = '$tipoRede'");
            
            while($aux = mysqli_fetch_assoc($sql_Cientista)){
                echo $aux['END_REDE_SOCIAL'];
            }

            echo "<br><a href=../controllers/redeSocialEXCLUIR.php?tipo=$tipoRede>Excluir</a>";
            
            echo "
            <br><br>
                Novo link
                <div class=input-field>
                    <input type=url SIZE=50 MAXLENGTH=50 name=$nomeRede placeholder=$filtro | Nulo = Excluir>
                    <div class=underline></div>
                </div>
            <br>";
            
            /*$Erro = $_SESSION['erroRede'];
            
            if(!isset($_SESSION['erroRede'])){
                echo "";
            }else if($Erro == 1){
                echo "Link escrito de forma incorreta.<br>";
            }
            $_SESSION['erroRede'] = NULL;*/
        ?>
            <a href="../../paginas/Opcoes.php">&#8592;</a><br>
            <input type="hidden" id="tipoRede" name="tipoRede" value="<?=$tipoRede?>">
            <input type="hidden" id="filtro" name="filtro" value="<?=$filtro?>">
            <input type=submit value=OK>
        </form>
    <!--</main>
</div>-->

<?php

include '../controllers/RedeSocialDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $Rede = htmlspecialchars($_REQUEST[$nomeRede]);
    $tipoRede = htmlspecialchars($_REQUEST['tipoRede']);
    $filtro = htmlspecialchars($_REQUEST['filtro']);

    /*echo "Variável do form: ".$Rede."<br>";
    echo "Tipo variável: ".$tipoRede."<br>";
    echo "Nome: ".$nomeRede."<br>";
    echo "Filtro: ".$filtro."<br>";*/

    if(!empty($Rede)){
        $sql_code = "SELECT `END_REDE_SOCIAL` FROM `t_redes_sociais` WHERE `ID_CIENTISTA` = '$idCient' and `TIP_REDE_SOCIAL` = '$tipoRede'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1 and str_contains($Rede, $filtro)){

            //$redeSocial1 = new RedeSocial($idCient, $Rede, $tipoRede);
            $dao = new RedeSocialDAO();
            $dao->updtadeRede($Rede, $idCient, $tipoRede);

        }else if($quantidade == 0 and str_contains($Rede, $filtro)){

            $redeSocial1 = new RedeSocial($idCient, $Rede, $tipoRede);
            $dao = new RedeSocialDAO();
            $dao->insert($redeSocial1);

        }else if(!str_contains($Rede, $filtro)){
            echo "Link escrito de forma incorreta.<br>";
        }

    echo "</main>
    </div>";
    }
}
?>
</body>
</html>