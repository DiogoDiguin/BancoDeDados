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
    <title>Email PRINCIPAL</title>
</head>
<body>

<div class="principal">
    <main class="container formulario2">
        <form method="post" action="../controllers/emailPRINCIPAL.php">

        <?php
            $sql_Cientista = mysqli_query($conexao, "SELECT `EMAIL_CIENTISTA` FROM `t_cientista` WHERE `ID_CIENTISTA` = '$idCient'");
            while($aux = mysqli_fetch_assoc($sql_Cientista)){
                echo "<strong>E-mail principal atual: </strong>".$aux['EMAIL_CIENTISTA'];
            }
        ?>

        <br><br>
            Novo e-mail
            <div class="input-field">
                <input type="email" SIZE=50 MAXLENGTH=50 name="email" placeholder="E-mail" required>
                <div class="underline"></div>
            </div>
        <br>
        <a href="../../paginas/Opcoes.php">&#8592;</a><br>
        <input type="submit" value="OK">
        </form>
    </main>
</div>
</body>
</html>