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
    <title>EXCLUIR conta</title>
</head>
<body>

<div class="principal">
    <main class="container formulario2">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <a href="../../paginas/Opcoes.php">&#8592;</a><br>
        <strong>Excluir conta</strong><br>
            <label for="cpf">CPF:</label>
            <div class="input-field">
                <input type="text" SIZE=11 MAXLENGTH=11 MINLENGTH=11 name="cpf" id="cpf" required>
                <div class="underline"></div>
            </div><br>

            <label for="senha">Senha:</label>
            <div class=input-field>
                <input type=password MAXLENGTH=10 name="senha" id="senha" required>
                <div class=underline></div>
                <input type="checkbox" onclick="mostrarOcultarSenha()"> Mostrar Senha 
            </div><br>

            <label for="emailPrincipal">E-mail PRINCIPAL:</label>
            <div class=input-field>
                <input type=email MAXLENGTH=50 name="emailPrincipal" id="emailPrincipal" required>
                <div class=underline></div>
            </div><br>

            <?php
                $qtd = rand(5, 15);
                function getName($qtd) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randomString = '';
                    for ($i = 0; $i < $qtd; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randomString .= $characters[$index];
                    }
                    return $randomString;
                }
                $palavra = getName($qtd);
            ?>

            <label for="pVerificacao">Transcreva a palavra de verificação: <?php echo $palavra;?></label>
            <input type="hidden" id="pVerificacao" name="pVerificacao" value="<?=$palavra?>">

            <div class="input-field">
                <input type="text" MAXLENGTH=15 name="pVerificacaoEscrito" id="pVerificacaoEscrito" required>
                <div class="underline"></div>
            </div><br>

            <input type=submit value="Excluir conta">
        </form>
    <!--</main>
</div>-->

<?php
include '../Controllers/CientistaDAO.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $cpf = $_REQUEST['cpf'];
    $senha = htmlspecialchars(mb_strimwidth(md5($_REQUEST['senha']),0,10));
    $emailPrincipal = $_REQUEST['emailPrincipal'];
    $pVerificacaoEscrito = $_REQUEST['pVerificacaoEscrito'];
    $pVerificacao = $_REQUEST['pVerificacao'];

    if(!empty($cpf) and !empty($senha) and !empty($emailPrincipal) and !empty($pVerificacaoEscrito)){
        $sql_Usuario = mysqli_query($conexao, "SELECT `CPF_CIENTISTA`, `SENHA_CIENTISTA`, `EMAIL_CIENTISTA` FROM `t_cientista` WHERE `ID_CIENTISTA` = '$idCient'");

        while($aux = mysqli_fetch_assoc($sql_Usuario)){
            $cpfUsuario = $aux['CPF_CIENTISTA'];
            $senha = $aux['SENHA_CIENTISTA'];
            $email = $aux['EMAIL_CIENTISTA'];
        }

        if($cpf == $cpfUsuario and $senha == $senha and $emailPrincipal == $email and $pVerificacaoEscrito == $pVerificacao ){
            $dao = new CientistaDAO();
            $dao->excluirCONTA($idCient);
        }else{
            echo "Dados não coincidem.
            </main>
        </div>";
        }
    }else{
        echo "Existem dados faltantes.
            </main>
        </div>";
    }
}

?>

</body>
</html>