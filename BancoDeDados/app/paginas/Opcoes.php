<?php
session_start();
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
    <link rel="stylesheet" href="../../publico/Css/style.css">

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
    <title>Preferências</title>
</head>
<body>

<div>
        <nav>
            <ul class="menu">
            <li><a href='../mvc/controllers/BuscarCientista.php' target="_blank"><i class="fa-solid fa-address-card" style="margin-right: 4px"></i>Buscar Cientistas</a></li>
            <li><a href='../mvc/controllers/BuscarProjeto.php' target="_blank"><i class="fa-solid fa-magnifying-glass"></i> Buscar Projetos</a></li>
            <li><a href='../mvc/controllers/projetoINCLUIR.php' target="_blank"><i class="fa-solid fa-plus" style="margin-right: 4px"></i>Inserir Projeto</a></li>
            <li><a href='../mvc/views/Perfil.php' target="_blank"><i class="fa-solid fa-user"></i> Perfil</a></li>
            <li><a href='Opcoes.php'>Preferências</a></li>
            <li><a href='logout.php'><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
            </ul>
        </nav>
    </div>

    <div class="principal">
        <main class="container formulario2">

            <h3>Pessoal</h3>
            <ul class="lista">
                <li><a href='../mvc/views/View_NomeUsuario.php'>Alterar nome de usuário</a></li>
                <li><a href='../mvc/controllers/DataNascimento.php'>Alterar data de nascimento</a></li>
                <li><a href='../mvc/views/View_emailPRINCIPAL.php'>Alterar e-mail PRINCIPAL</a></li>
                <li><a href='../mvc/views/View_emailSECUNDARIO.php'>Alterar e-mail ALTERNATIVO</a></li>
                <li><a href='../mvc/views/View_CidadeUsuario.php'>Alterar CIDADE</a></li>
                <li><a href='../mvc/controllers/SenhaUsuario.php'>Alterar SENHA</a></li>
            </ul>
<?php
$facebook  = 'f';
$instagram = 'i';
$linkedin  = 'l';
$youtube   = 'y';
$tiktok    = 't';

echo "<h3>Social</h3>";
echo "<ul class=opcoes>";
echo "<li><a href=../mvc/views/View_alteraRedeSocial.php?tipo=$instagram>INSTAGRAM</a></li>";
echo "<li><a href=../mvc/views/View_alteraRedeSocial.php?tipo=$facebook>FACEBOOK</a></li>";
echo "<li><a href=../mvc/views/View_alteraRedeSocial.php?tipo=$linkedin>LINKEDIN</a></li>";
echo "<li><a href=../mvc/views/View_alteraRedeSocial.php?tipo=$youtube>YOUTUBE</a></li>";
echo "<li><a href=../mvc/views/View_alteraRedeSocial.php?tipo=$tiktok>TIKTOK</a></li>";
echo "<li><a href=../mvc/views/View_Lattes.php>Lattes</a></li></ul><br><br>";
?>
            <!--<a href='Instagram.php' target="_blank">Alterar INSTAGRAM</a><br>
            <a href='Facebook.php' target="_blank">Alterar FACEBOOK</a><br>
            <a href='Linkedin.php' target="_blank">Alterar LINKEDIN</a><br>
            <a href='Youtube.php' target="_blank">Alterar YOUTUBE</a><br>
            <a href='TikTok.php' target="_blank">Alterar TIKTOK</a><br>
            <a href='Lattes.php' target=_blank>Alterar link do Lattes</a><br>-->
            <h3>Contato/Telefone</h3>
            <ul class=opcoes>
                <li><a href='../mvc/views/View_Telefone.php'>ALTERAR/EXCLUIR</a></li>
                <li><a href='../mvc/controllers/TelefoneINCLUIR.php'>INSERIR</a></li>
                <!-- <li><a href='Telefone.php' target="_blank">EXCLUIR</a></li> -->
            </ul>

            <h3>Acadêmico</h3>
            <h4>Área de Atuação</h4>
            <ul class=opcoes>
                <li><a href='../mvc/views/View_AreaAtuacao.php'>ALTERAR/EXCLUIR</a></li>
                <li><a href='../mvc/controllers/AreaAtuacaoINCLUIR.php'>INSERIR</a></li>
                <!-- <li><a href='AreaAtuacao.php' target="_blank">EXCLUIR</a></li> -->
            </ul>

            <h4>Formação</h4>
            <ul class=opcoes>
                <li><a href='../mvc/views/View_Formacao.php'>ALTERAR/EXCLUIR</a></li>
                <li><a href='../mvc/controllers/FormacaoINCLUIR.php'>INSERIR</a></li>
                <!-- <li><a href='Formacao.php' target="_blank">EXCLUIR</a></li> -->
            </ul>

            <h4>Projetos</h4>
            <ul class=opcoes>
                <li><a href='../mvc/views/View_Projetos.php'>ALTERAR/EXCLUIR</a></li>
                <li><a href='../mvc/controllers/projetoINCLUIR.php'>INSERIR</a></li>
                <!-- <li><a href='projetoEXCLUIR.php' target="_blank">EXCLUIR</a></li> -->
            </ul>
            <br><br><hr><br>
            <h2><a class="excluir" href='../mvc/views/View_excluirCONTA.php' target="_blank">EXCLUIR CONTA</a></h2>
        </main>
        <br>
    </div>
    
</body>
</html>