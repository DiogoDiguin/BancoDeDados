<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src = "../js/index.js"></script>
    <link rel="stylesheet" href="../../../publico/Css/style02.css">
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
            <form method="post" action="../controllers/Controller_esqueciSenha.php">
                <div class="input-field">
                        <input type="text" SIZE=11 MAXLENGTH=11 MINLENGTH=11 name="cpf" id="cpf" placeholder="Digite seu CPF">
                    <div class="underline"></div>
                </div>
                <div class="input-field">
                        <input type="text" name="email" id="email" placeholder="Digite seu E-mail">
                    <div class="underline"></div>
                </div>
                <br>
                <input type="submit" value="Consultar">
            </form>
            <br>
        
        <!-- </main> 
    </div> -->

<?php
$erroSenha = $_SESSION['erroSenha'];

switch($erroSenha){
    case 1:
        echo "CPF ou Email não digitados";
        break;
    case 2:
        echo "Valores não encontrados!";
        break;

echo "</main>
</body>";
}   
?>
</body>
</html>