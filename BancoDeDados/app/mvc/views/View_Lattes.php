<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
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
    <title>Lattes</title>
</head>
<body>

<div class="principal">
    <main class="container formulario2">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <a href="../../paginas/Opcoes.php">&#8592;</a><br>
        <?php
            echo "<strong>Link atual: </strong>";
            $sql_Cientista = mysqli_query($conexao, "SELECT `LATTES_CIENTISTA` FROM `t_cientista` WHERE `ID_CIENTISTA` = '$idCient'");
            while($aux = mysqli_fetch_assoc($sql_Cientista)){
                echo $aux['LATTES_CIENTISTA'];
            }
        ?>

        <br><br>
            Novo link
            <div class="input-field">
                <input type="url" SIZE=50 MAXLENGTH=50 name="lattes" placeholder="http://lattes.cnpq.br/" required>
                <div class="underline"></div>
            </div>
        <br>

        <input type="submit" value="OK">
        </form>
    <!--</main>
</div>-->

<?php
include '../controllers/CientistaDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $lattes = htmlspecialchars($_REQUEST['lattes']);

    if(!empty($lattes)){
        $sql_code = "SELECT `LATTES_CIENTISTA` FROM `t_cientista` WHERE `ID_CIENTISTA` = '$idCient'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1 and str_contains($lattes, "http://lattes.cnpq.br/")){
            $dao = new CientistaDAO();
            $dao->updateLattes($lattes, $idCient);
            
        }else if(!str_contains($lattes, "http://lattes.cnpq.br/")){
            echo "Link escrito de forma incorreta.<br>";
        }
        echo "</main>
        </div>";
    }
}
?>
</body>
</html>