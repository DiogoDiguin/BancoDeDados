<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $idAreaAtual = $_GET['id'];
}

if(empty($idAreaAtual)){
    header('Location: ../views/View_AreaAtuacao.php');
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
    <title>ALTERAR</title>
</head>
<body>

    <div class="principal">
        <main class="container formulario2">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <?php
                $sql_areaAtual = mysqli_query($conexao, "SELECT `NOM_AREA_ATUACAO` FROM `t_area_atuacao` WHERE `ID_AREA_ATUACAO` = '$idAreaAtual'");
                while($aux = mysqli_fetch_assoc($sql_areaAtual)){
                    $nomeArea = $aux['NOM_AREA_ATUACAO'];
                    echo "<strong>Área atual: </strong>".$nomeArea;
                }
            ?>
            <br><br>
                <label for="areaAtuacao">Escolha a área de atuação:</label>
                    <div>
                        <select name="areaAtuacao" id="areaAtuacao" required>
                        <option value="">Selecione uma opção</option>
                        <?php
                            $sql_areasAtuacao = mysqli_query($conexao, "SELECT * FROM `t_area_atuacao`");

                            while($aux = mysqli_fetch_assoc($sql_areasAtuacao)){
                                $nomeArea = $aux['NOM_AREA_ATUACAO'];
                                echo "<option value=$nomeArea>$nomeArea</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <br>
                <input type="hidden" id="idAreAtuacao" name="idAreAtuacao" value="<?=$idAreaAtual?>">
                <a href="../views/View_AreaAtuacao.php">&#8592;</a><br>
                <input type="submit" value="OK">
            </form>
        </main>
    </div>

<?php
include 'AreaAtuacaoDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $idAreaAtuacaoAtual = htmlspecialchars($_REQUEST['idAreAtuacao']);
    $nomeAreaNova = htmlspecialchars($_REQUEST['areaAtuacao']);
    $sql_idAreaNova = mysqli_query($conexao, "SELECT `ID_AREA_ATUACAO` FROM `t_area_atuacao` WHERE `NOM_AREA_ATUACAO` = '$nomeAreaNova'");
    
    while($aux = mysqli_fetch_assoc($sql_idAreaNova)){
        $idAreaNova = $aux['ID_AREA_ATUACAO'];
    }

    /*echo $idAreaNova;*/

    if(!empty($nomeAreaNova)){
        $sql_code = "SELECT * FROM `t_area_atuacao_cientista` WHERE `ID_AREA_ATUACAO` = '$idAreaNova' AND `ID_CIENTISTA` = '$idCient'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            echo "Área já inserida";
            exit();
        }else{                    
            $dao = new AreaAtuacaoDAO();
            $dao->updateAreaAtuacao($idAreaNova, $idCient, $idAreaAtuacaoAtual);
        }   
    }
}

echo "<br><br> 
    </main>
</body>";

?>
</body>
</html>