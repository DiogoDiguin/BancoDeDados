<?php
session_start();
include '../../conexaoBD/conexao.php';
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
</head>

<title>Criar Usuário</title>

<body>   
    <div class="principal">
    <main class=" container formulario2">
        <form class="formulario" method="post" action="../controllers/CadastroUsuario.php">
            <h2 style=text-align: center; margin-top: 30px;>Criar Usuário</h2>
            <!--<h1>Criar Usuário</h1>-->
            <br>

            <label for="nome">Nome:</label>
            <div class="input-field">
                <input type="text" MAXLENGTH=50 name="nome" id="nome" required>
                <div class="underline"></div>
            </div><br>

            <label for="cpf">CPF:</label>
            <div class="input-field">
                <input type="text" SIZE=11 MAXLENGTH=11 MINLENGTH=11 name="cpf" id="cpf" required>
                <div class="underline"></div>
            </div><br>

            <label for="nascimento">Data Nascimento:</label>
            <div class="input-field">
                <input type="date" name="nascimento" id="nascimento">
                <div class="underline"></div>
            </div><br>


            <label for="cidades">Escolha a cidade:</label>
            <div>
                <select name="cidades" id="cidades" required>
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
            <br>

            <label for="snh">Senha:</label><br>
            
            <div class="input-field">
                <input type="password" MAXLENGTH=10 name="senha" id="senha" required>
                <div class="underline"></div>
            </div><br>
            <input type="checkbox" onclick="mostrarOcultarSenha()"> Mostrar Senha            
                        
            <br><br>
            <label for="email1">Email 01:</label>
            <div class="input-field">
                <input type="email" MAXLENGTH=50 name="email1" id="email1" required>
                <div class="underline"></div>
            </div><br>

            <label for="email2">Email 02:</label>
            <div class="input-field">
                <input type="email" MAXLENGTH=50 name="email2" id="email2">
                <div class="underline"></div>
            </div><br>
            
            <h3>Social</h3>
            <br>

            <label for="lattes">Lattes:</label>
            <div class="input-field">
                <input type="text" MAXLENGTH=50 name="lattes" id="lattes" placeholder="Link do Lattes" required>
                <div class="underline"></div>
            </div><br>

            <input type="submit" class="submitButton" name="enviar" value="Criar Usuario"/>

    <!--</form>
    </main>
</div>

</body>
</html>-->

<?php
$infoUsuario = $_SESSION['infoUsuario'];

switch($infoUsuario){
    case 0:
        echo "";
        break;
    case 1:
        echo "Data de nascimento no futuro";
        break;
    case 2:
        echo "Lattes inválido (Escrita incorreta)";
        break;
    case 3:
        echo "Lattes inválido";
        break;
    case 4:
        echo "E-mail inválido";
        break;
    case 5:
        echo "CPF inválido";
        break;
    case 6:
        echo "Registro Inserido com sucesso";
        break;
}

echo "</form>
</main>
</div>
</body>
</html>";
?>