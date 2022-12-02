<?php
session_start(); # Deve ser a primeira linha do arquivo

include '../app/conexaoBD/conecta.php';
include '../app/mvc/models/ClasseCientista.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="JS/script.js"></script>
    <link rel="stylesheet" href="Css/style03.css">
</head>

<title>Login</title>

<body>
    <main class="container">
        <h2>Login</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="input-field">
                <div class="error" id="usuario-required-error">Usuário é OBRIGATÓRIO</div>
                <input type="text" SIZE=11 MAXLENGTH=11 MINLENGTH=11 name="cpf" id="cpf" placeholder="Digite seu CPF">
                <div class="underline"></div>
            </div>
            <div class="input-field">
                <div class="error" id="usuario-required-error2">Senha é OBRIGATÓRIA</div>
                <input type="password" MAXLENGTH=10 name="senha" id="senha" placeholder="Digite sua senha">
                <div class="underline"></div>
                <input type="checkbox" onclick="mostrarOcultarSenha()"> Mostrar Senha
            </div>
            <input type="submit" value="Continue">
        </form>
        <br>
        <a href="../app/mvc/controllers/CadastroUsuario.php" target="_blank">Criar cadastro</a>
        <br>
        <a href="../app/mvc/controllers/Controller_esqueciSenha.php" target="_blank">Esqueci minha Senha</a>
        <style>
            a {
                text-decoration: none;
            }

            a:hover {
                color: #0000FF;
                text-decoration: none;
            }
        </style>
    <!--</main>
</body>-->

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $cpf = htmlspecialchars($_REQUEST['cpf']);
        $senha = htmlspecialchars(mb_strimwidth(md5($_REQUEST['senha']),0,10));
        //$senha = htmlspecialchars(md5($_REQUEST['senha']));
        
        if(empty($cpf) || empty($senha)) {
            header('Location: Index.php');
            exit();
        }else if (!empty($cpf) and !empty($senha)) {
            $sql_code = "SELECT * FROM `t_cientista` WHERE `CPF_CIENTISTA` = '$cpf' AND `SENHA_CIENTISTA` = '$senha'";
            $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1) {
                $cientista = $sql_query->fetch_assoc();
                /*if(!isset($_SESSION)) {
                    session_start();
                }*/
                $_SESSION['idCientista'] = $cientista['ID_CIENTISTA'];
                //$_SESSION['nome'] = $cientista['NOM_CIENTISTA'];

                header("Location: ../app/mvc/views/Perfil.php");
            }else {
                echo "<br><br>
                        Falha ao logar!
                    </main>
                </body>";
            }
        }
    }
?>
</html>