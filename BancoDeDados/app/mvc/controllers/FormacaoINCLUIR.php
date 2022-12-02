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
    <title>INCLUIR Formação</title>
</head>
<body>

    <div class="principal">
        <main class="container formulario2">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label for="titulacao"><strong>INSERIR formação</strong></label><br><br>
                    <div>
                        <select name="titulacao" id="titulacao" required>
                            <option value="">Selecione uma opção</option>
                        <?php
                            $sql_Titulacao = mysqli_query($conexao, "SELECT * FROM `t_titulacao`");

                            while($aux = mysqli_fetch_assoc($sql_Titulacao)){
                                $nomeArea = $aux['NOM_TITULACAO'];
                                echo "<option value=$nomeArea>$nomeArea</option>";
                            }
                        ?>
                        </select>
                    </div>
                
                <br>
                <label for="inicioFormacao">Início:</label>
                <div class="input-field">
                    <input type="date" name="inicioFormacao" id="inicioFormacao" required>
                </div><br>

                <label for="finalFormacao">Final/Previsão:</label>
                <div class="input-field">
                    <input type="date" name="finalFormacao" id="finalFormacao">
                </div>
                    <br>
                    <a href="../../paginas/Opcoes.php">&#8592;</a><br>
                <input type="submit" value="OK">
            </form>
        <!--</main>
    </div>-->

<?php
include 'FormacaoDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $dataAtual = date("Y-m-d"); 
    $inicioFormacao = date("Y-m-d", strtotime($_REQUEST['inicioFormacao']));
    $finalFormacao = date("Y-m-d", strtotime($_REQUEST['finalFormacao']));
    $nomeTitulacaoNova = htmlspecialchars($_REQUEST['titulacao']);

    $sql_idATitulacaoNova = mysqli_query($conexao, "SELECT `ID_TITULACAO` FROM `t_titulacao` WHERE `NOM_TITULACAO` = '$nomeTitulacaoNova'");
    while($aux = mysqli_fetch_assoc($sql_idATitulacaoNova)){
        $idTitulacaoNova = $aux['ID_TITULACAO'];
    }

    if(!empty($nomeTitulacaoNova)){
        if($inicioFormacao <= $dataAtual and $finalFormacao > $inicioFormacao){

            $formacao1 = new Formacao($idCient, $idTitulacaoNova, $inicioFormacao, $finalFormacao);

            $dao = new FormacaoDAO();
            $dao->insert($formacao1);
        }else{
            echo "Datas não coincidem.
                </main>
            </div>";
        }
    }
}

?>
</body>
</html>