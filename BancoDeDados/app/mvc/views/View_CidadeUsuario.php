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
    <title>Cidade do Usuário</title>
</head>
<body>

<div class="principal">
    <main class="container formulario2">
        <form method="post" action="../controllers/CidadeUsuario.php">

        <?php
            $sql_CidadeCientista = mysqli_query($conexao, "SELECT `NOM_CIDADE` FROM `t_cidade`, `t_cientista` WHERE t_cientista.ID_CIDADE = t_cidade.ID_CIDADE and `t_cientista`.ID_CIENTISTA = '$idCient'");
            while($aux = mysqli_fetch_assoc($sql_CidadeCientista)){
                echo "<strong>Cidade atual: </strong>".$aux['NOM_CIDADE'];
            }
        ?>
        <br>
        <label for="novaCidade">Escolha a cidade:</label>
            <div>
            <select name="novaCidade" id="novaCidade" required>
                <option value="">Selecione uma opção</option>
                    <?php
                        $sql_cidade = mysqli_query($conexao, "SELECT * FROM `t_cidade`");

                        while($aux = mysqli_fetch_assoc($sql_cidade)){
                            $nomeCidade = $aux['NOM_CIDADE'];
                            $nomeCidade2 = str_replace("_", " ", $aux['NOM_CIDADE']);
                            echo "<option value=$nomeCidade>$nomeCidade2</option>";
                        }
                    ?>
            </select>
            </div>

        <a href="../../paginas/Opcoes.php">&#8592;</a><br>
        <input type="submit" value="OK">
        </form>
    </main>
</div>
</body>
</html>