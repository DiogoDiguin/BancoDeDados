<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $idTelefone = $_GET['id'];
}

if(empty($idTelefone)){
    header('Location: ../views/View_Telefone.php');
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
    <script type="text/javascript" src = "../../../publico/JS/script.js"></script>
    <style>
        a{
            text-decoration: none;
        }
        a:hover{
            color: #0000FF;
            text-decoration: none;
        }
    </style>
    <title>EDITAR Telefone</title>
</head>
<body>

<div class="principal">
    <main class="container formulario2">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

            <?php         
                $sql_telefones = mysqli_query($conexao, "SELECT * FROM `t_telefone` WHERE `ID_CIENTISTA` = '$idCient' and `ID_TELEFONE` = '$idTelefone'");
                while($aux = mysqli_fetch_assoc($sql_telefones)){
                $dddTelefone = $aux['DDD_TELEFONE'];
                $numTelefone = $aux['NUM_TELEFONE'];
                    echo "<strong>Telefone: </strong>(".$dddTelefone.") ".$numTelefone;
                }            

                echo"<br><br><select name=novoDDD id=novoDDD required>
                <option value=$dddTelefone>$dddTelefone</option>";
                for($i = 0; $i < 100; $i=$i+1){
                    echo "<option value=$i>$i</option>";
                }

                echo "
                </select>";
            ?>

            <div class=input-field>
                <input type="text" onkeypress="return onlynumber();" MAXLENGTH=9 MINLENGTH=8 name=novoNumero id=novoNumero required>
                <div class=underline></div>
            </div>
            <br>

            <input type="hidden" id="idTelefone" name="idTelefone" value="<?=$idTelefone?>">
            <a href="../views/View_Telefone.php">&#8592;</a><br>
            <input type=submit value=OK>
        </form>
    <!--</main>
</div>-->

<?php
include 'TelefoneDAO.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $novoDdd = $_REQUEST['novoDDD'];
    $novoNumero = $_REQUEST['novoNumero']; 
    $idTelefoneAtual = $_REQUEST['idTelefone'];

    /*echo "novoDDD: ".$novoDdd."<br>";
    echo "novoNumero: ".$novoNumero."<br>";
    echo "idTelefoneAtual: ".$idTelefoneAtual."<br>";*/

    /*$sql_code = "SELECT * FROM `t_telefone` WHERE `ID_TELEFONE` = '$idTelefone'";
    $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

    $quantidade = $sql_query->num_rows;*/
    if(!empty($novoDdd) and !empty($novoNumero)) {
                    
        $dao = new TelefoneDAO();
        $dao->uptadeTelefone($novoDdd, $novoNumero, $idTelefoneAtual, $idCient);

    }
}

echo "</main>
    </div>";
?>

</body>
</html>