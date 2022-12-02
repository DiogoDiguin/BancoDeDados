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
    <title>Senha Usuário</title>
</head>
<body>

<div class="principal">
    <main class="container formulario2">
        <form method="post" action="../controllers/SenhaUsuario.php">
            Nova senha
            <div class="input-field">
                <input type="password" MAXLENGTH=10 name="senha" placeholder="Nova senha" id="senha" required>
                <div class="underline"></div>
            </div>
            <input type="checkbox" onclick="mostrarOcultarSenha()"> Mostrar Senha
        <br><br>
            Confirme a nova senha
            <div class="input-field">
                <input type="password" MAXLENGTH=10 name="senha2" placeholder="Confirme a nova senha" required>
                <div class="underline"></div> 
            </div>
        <br><br>

        <a href="../../paginas/Opcoes.php">&#8592;</a><br>
        <input type="submit" value="OK">
        </form>
    <!--</main>
</div>-->

<?php
include 'CientistaDAO.php';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $senha1 = htmlspecialchars(mb_strimwidth(md5($_REQUEST['senha']),0,10));
    $senha2 = htmlspecialchars(mb_strimwidth(md5($_REQUEST['senha2']),0,10));

    if(empty($senha1) || empty($senha2) || $senha1 <> $senha2){
        echo "Senhas diferentes";
    }else if(!empty($senha1) and $senha1 == $senha2){

        $dao = new CientistaDAO();
        $dao->updateSenha2($senha1, $idCient);
        
    }

//     echo "</main>
//     </div>";
}
?>
</body>
</html>