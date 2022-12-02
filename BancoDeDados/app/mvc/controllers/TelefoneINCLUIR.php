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
    <title>INCLUIR Telefone</title>
</head>
<body>

    <div class="principal">
        <main class="container formulario2">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label for="titulacao"><strong>INSERIR Telefone</strong></label><br><br>

                <label for="novoDDD">DDD:</label>
                <div class="input-field">
                    <input type="text" onkeypress="return onlynumber();" name="novoDDD" MAXLENGTH=2 MINLENGTH=1 id="novoDDD" required>
                    <div class="underline"></div>
                </div>
                <br>

                <label for="novoNumero">Número:</label>
                <div class="input-field">
                    <input type="text" onkeypress="return onlynumber();" name="novoNumero" MAXLENGTH=9 MINLENGTH=8 id="novoNumero" required>
                    <div class="underline"></div>
                </div>
                <br>
                <a href="../../paginas/Opcoes.php">&#8592;</a><br>
                <input type="submit" value="OK">
            </form>
        <!--</main>
    </div>-->

<?php

include 'TelefoneDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $novoDDD = htmlspecialchars($_REQUEST['novoDDD']);
    $novoNumero = htmlspecialchars($_REQUEST['novoNumero']);

    if(!empty($novoDDD) and !empty($novoNumero)){
        $sql_code = "SELECT * FROM `t_telefone` WHERE `DDD_TELEFONE` = '$novoDDD' and `NUM_TELEFONE` = '$novoNumero'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 0){

            $telefone1 = new Telefone($idCient, $novoDDD, $novoNumero);
                    
            $dao = new TelefoneDAO();
            $dao->insert($telefone1);

            exit();
        }else{
            echo "<br>Número já existente.";
            exit();
        }
        echo "</main>
        </div>";
    }
}

?>
</body>
</html>