<?php
    session_start();
    include '../../conexaoBD/conexao.php';
    $idCient = $_SESSION['idCientista'];

    if(!isset($_SESSION['idCientista'])){
        header('Location: ../../../publico/Index.php');
    }
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
    <style>
        a{
            text-decoration: none;
        }
        a:hover{
            color: #0000FF;
            text-decoration: none;
        }
    </style>
    <title>Upload de Projeto</title>
</head>
<body>
    <div>
        <nav>
            <ul class="menu">
            <li><a href='BuscarCientista.php' target="_blank"><i class="fa-solid fa-address-card" style="margin-right: 4px"></i>Buscar Cientistas</a></li>
            <li><a href='BuscarProjeto.php' target="_blank"><i class="fa-solid fa-magnifying-glass"></i> Buscar Projetos</a></li>
            <li><a href='projetoINCLUIR.php'><i class="fa-solid fa-plus" style="margin-right: 4px"></i>Inserir Projeto</a></li>
            <li><a href='../views/Perfil.php' target="_blank"><i class="fa-solid fa-user"></i> Perfil</a></li>
            <li><a href='../../paginas/Opcoes.php' target="_blank">Preferências</a></li>
            <li><a href='../../paginas/logout.php'><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
            </ul>
        </nav>
    </div>


    <div class="principal">
        <main class="container formulario2">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <h1 style=margin-bottom: 20px; text-align: center;>Upload Projeto</h1>
                <label for=responsavel><strong>Responsável:</strong></label>
                        <?php
                        $sql_nomeCentista = mysqli_query($conexao, "SELECT `NOM_CIENTISTA`FROM `t_cientista` WHERE `ID_CIENTISTA` = '$idCient'");

                        while($aux = mysqli_fetch_assoc($sql_nomeCentista)){
                            $nomeCientista = $aux['NOM_CIENTISTA'];
                            echo $nomeCientista;
                        }
                        ?>
                <br><br>

                <label for=titulo>Título:</label>
                <div class=input-field>
                    <input type=text name=titulo MAXLENGTH=50 id=titulo placeholder=Título required>
                    <div class=underline></div>
                </div><br>

                <label for=resumo>Resumo:</label>
                <div class=input-field>
                    <input type=text name=resumo MAXLENGTH=250 id=resumo placeholder=Resumo required>
                    <div class=underline></div>
                </div><br>

                <label for=inicio>Data Inicio:</label>
                <div class=input-field>
                    <input type=date name=inicio id=inicio required>
                    <div class=underline></div>
                </div><br>

                <label for=fim>Data Fim/Previsão:</label>
                <div class=input-field>
                    <input type=date name=fim id=fim required>
                    <div class=underline></div>
                </div><br>

                Público
                <input type="radio" id="publico" name="publicacao" value='publico'>
                <br>
                <!--<label for="publico">Publico</label><br>-->
                Privado
                <input type="radio" id="privado" name="publicacao" value='privado'>
                <!--<label for="privado">Privado</label><br>-->
                <br><br>
                <input type=submit value=Cadastrar Projeto>
            </form>
        <!--</main>
    </div>-->

</body>
</html>

<?php
    include 'ProjetoDAO.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        $titulo = htmlspecialchars($_REQUEST['titulo']);
        $Resumo = htmlspecialchars($_REQUEST['resumo']);
        $dataInicio = date("Y-m-d", strtotime($_REQUEST['inicio']));
        $dataFim = date("Y-m-d", strtotime($_REQUEST['fim']));
        $dataAtual = date("Y-m-d"); 
        $tipoPublicacao = htmlspecialchars($_REQUEST['publicacao']);       

        try {
            if(!empty($tipoPublicacao) and $dataFim > $dataInicio){
                $projeto1 = new Projeto($idCient, $titulo, $Resumo, $dataInicio, $dataFim, $tipoPublicacao);

                $dao = new ProjetoDAO();
                $dao->insert($projeto1);
            }else{
                echo "Informações inválidas.
                </main>
            </div>";
            }
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>

</body>
</html>