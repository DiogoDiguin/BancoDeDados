<?php
    session_start();
    $nomeCientista = $_SESSION['nomeCientista'];
    $idCientista = $_SESSION['idAlterar'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../../publico/JS/script.js"></script>
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
    <title>Esqueci minha senha</title>
</head>
<body>
    <div class="principal">
        <main class="container">
            <h2>Esqueci minha senha</h2>
            <?php
                echo "<strong>Usuário: </strong>".$nomeCientista;
            ?>
            <form method="post" action="../controllers/Controller_esqueciSenha-Alterar.php">
            <br>
            Nova senha
                <div class="input-field">
                    <input type="password" MAXLENGTH=10 name="senha" id="senha" placeholder="Digite sua nova senha">
                    <div class="underline"></div>
                </div>
                <br>
                    <input type="checkbox" onclick="mostrarOcultarSenha()"> Mostrar Senha 
                <br><br>      
            Confirme a nova senha
                <div class="input-field">
                    <input type="password" MAXLENGTH=10 name="senha02" id="senha02" placeholder="Confirme sua nova senha" style="width: 100%!important">
                    <div class="underline"></div>
                </div>

                <input type="submit" value="Alterar">
            </form>
            <br>
        <!--</main>
    </div>-->

<?php

$erroSenhaAlterar = $_SESSION['erroSenhaAlterar'];

switch($erroSenhaAlterar){
    case 0:
        echo "Senha alterada com sucesso";
        break;
    case 1:
        echo "Valores não digitados";
        break;
    case 2:
        echo "Valores diferentes";
        break;
}

echo "</main>
</div>";

?>

</body>
</html>