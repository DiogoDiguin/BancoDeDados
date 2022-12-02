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
    <title>Data Nascimento</title>
</head>
<body>

<div class="principal">
    <main class="container formulario2">
        <form method="post"  action="<?php echo $_SERVER['PHP_SELF'];?>">

        <?php
            $sql_Cientista = mysqli_query($conexao, "SELECT `DTN_CIENTISTA` FROM `t_cientista` WHERE `ID_CIENTISTA` = '$idCient'");
            time();
            while($aux = mysqli_fetch_assoc($sql_Cientista)){
                $data = explode("-",$aux['DTN_CIENTISTA']);
                $ano = $data[0];
                $mes = $data[1];
                $dia = $data[2];

                echo "<strong>Data Atual: </strong>".$dia."/".$mes."/".$ano;
            }
        ?>

        <br><br>
            Nova data
            <div class="input-field">
                <input type="date" name="dataNascimento" required>
                <div class="underline"></div>
            </div>
        <br>
        <a href="../../paginas/Opcoes.php">&#8592;</a><br>
        <input type="submit" value="OK">
        </form>
    <!--</main>
</div>-->

<?php
include 'CientistaDAO.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $dataNascimento = date("Y-m-d", strtotime($_REQUEST['dataNascimento']));
        $dataAtual = date("Y-m-d"); 

        if(!empty($dataNascimento) and $dataNascimento < $dataAtual){
            $dao = new CientistaDAO();
            $dao->updateNascimento($dataNascimento, $idCient);
        }else{
            echo "<br>Parâmetros não correspondem ao esperado";
        }
        
        echo "
            </main>
        </div>";
    }
?>
</body>
</html>