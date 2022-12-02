<?php
    session_start(); # Deve ser a primeira linha do arquivo
    include '../../conexaoBD/conexao.php';

    if(!isset($_SESSION['idCientista'])){
        header('Location: ../../../publico/Index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Cientistas</title>
    <link rel="stylesheet" type="text/css" href="../../../publico/Css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet">
</head>

<title>Buscar Cientista</title>

<body>
    <div>
        <nav>
            <ul class="menu">
            <li><a href='BuscarCientista.php'><i class="fa-solid fa-address-card" style="margin-right: 4px"></i>Buscar Cientistas</a></li>
            <li><a href='BuscarProjeto.php' target="_blank"><i class="fa-solid fa-magnifying-glass"></i> Buscar Projetos</a></li>
            <li><a href='projetoINCLUIR.php' target="_blank"><i class="fa-solid fa-plus" style="margin-right: 4px"></i>Inserir Projeto</a></li>
            <li><a href='../views/Perfil.php' target="_blank"><i class="fa-solid fa-user"></i> Perfil</a></li>
            <li><a href='../../paginas/Opcoes.php' target="_blank">Preferências</a></li>
            <li><a href='../../paginas/logout.php'><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
            </ul>
        </nav>
    </div>

    <div class="principal">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <main class="container formulario2">
            <!-- Para o usuário manipular -->
            <h2 style=text-align:center; margin-top: 30px;>Buscar Cientistas</h2>
        <br>
            <div class="input-field">
                <input type="text" name="nome" placeholder="Insira uma palavra/frase - ENTER = Todos">
                <div class="underline"></div>
            </div>
            <br>
            <label for="cidades">Escolha a cidade:</label>
            <div>
                <select name="cidades" id="cidades">
                <option value="0">Selecione uma opção</option>
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
            <input type="submit" value="OK">
            </main>
        </form>
    </div>
    
<?php

    include_once '../views/View_BuscarCientista.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $busca = htmlspecialchars($_REQUEST['nome']);
        $buscaCidade=htmlspecialchars($_REQUEST['cidades']);
        $todos = "todos";

        $sql_Cientista = mysqli_query($conexao, "SELECT * FROM `t_cientista`");

        if(!empty($busca) and empty($buscaCidade)){
            while($aux = mysqli_fetch_assoc($sql_Cientista)){
                $nome = $aux['NOM_CIENTISTA'];
                $cpf = $aux['CPF_CIENTISTA'];
                $dataNasc = explode("-",$aux['DTN_CIENTISTA']);
                $anoNasc = $dataNasc[0];
                $mesNasc = $dataNasc[1];
                $diaNasc = $dataNasc[2];
                $email = $aux['EMAIL_CIENTISTA'];
                $email_02 = $aux['EMAIL2_CIENTISTA'];
                $lattes = $aux['LATTES_CIENTISTA'];
                $idResponsavel = $aux['ID_CIENTISTA'];
                $idCidade = $aux['ID_CIDADE'];

                if(str_contains(strtoupper($nome), strtoupper($busca))){
                    perfil($nome,  $cpf, $diaNasc, $mesNasc, $anoNasc, $email, $email_02, $lattes, $idResponsavel, $conexao, $idCidade);
                }
            }
        }else if(!empty($buscaCidade) and empty($busca)){
            while($aux = mysqli_fetch_assoc($sql_Cientista)){
                $nome = $aux['NOM_CIENTISTA'];
                $cpf = $aux['CPF_CIENTISTA'];
                $dataNasc = explode("-",$aux['DTN_CIENTISTA']);
                $anoNasc = $dataNasc[0];
                $mesNasc = $dataNasc[1];
                $diaNasc = $dataNasc[2];
                $email = $aux['EMAIL_CIENTISTA'];
                $email_02 = $aux['EMAIL2_CIENTISTA'];
                $lattes = $aux['LATTES_CIENTISTA'];
                $idResponsavel = $aux['ID_CIENTISTA'];
                $idCidadeCientista = $aux['ID_CIDADE'];

                $sql_cidadeCientista = mysqli_query($conexao, "SELECT * FROM t_cidade WHERE t_cidade.ID_CIDADE = '$idCidadeCientista'");

                while($cont = mysqli_fetch_assoc($sql_cidadeCientista)){
                    $nomeCidade = $cont['NOM_CIDADE'];
                    $idCidade = $cont['ID_CIDADE'];

                    if($buscaCidade == $nomeCidade){
                        perfil($nome,  $cpf, $diaNasc, $mesNasc, $anoNasc, $email, $email_02, $lattes, $idResponsavel, $conexao, $idCidade);
                    }
                }
            }
        }else if(!empty($buscaCidade) and !empty($busca)){
            while($aux = mysqli_fetch_assoc($sql_Cientista)){
                $nome = $aux['NOM_CIENTISTA'];
                $cpf = $aux['CPF_CIENTISTA'];
                $dataNasc = explode("-",$aux['DTN_CIENTISTA']);
                $anoNasc = $dataNasc[0];
                $mesNasc = $dataNasc[1];
                $diaNasc = $dataNasc[2];
                $email = $aux['EMAIL_CIENTISTA'];
                $email_02 = $aux['EMAIL2_CIENTISTA'];
                $lattes = $aux['LATTES_CIENTISTA'];
                $idResponsavel = $aux['ID_CIENTISTA'];
                $idCidadeCientista = $aux['ID_CIDADE'];
                
                $sql_cidadeCientista = mysqli_query($conexao, "SELECT * FROM `t_cidade`, `t_cientista` WHERE `t_cidade`.`ID_CIDADE` = $idCidadeCientista and `t_cientista`.`ID_CIENTISTA` = $idResponsavel");

                while($cont = mysqli_fetch_assoc($sql_cidadeCientista)){
                    $nomeCidade = $cont['NOM_CIDADE'];
                    $idCidade = $cont['ID_CIDADE'];

                    if(($buscaCidade == $nomeCidade) and (str_contains(strtoupper($nome), strtoupper($busca)))){
                        perfil($nome,  $cpf, $diaNasc, $mesNasc, $anoNasc, $email, $email_02, $lattes, $idResponsavel, $conexao, $idCidade);
                    }
                }
            }
        }else{
            while($aux = mysqli_fetch_assoc($sql_Cientista)){
                $nome = $aux['NOM_CIENTISTA'];
                $cpf = $aux['CPF_CIENTISTA'];
                $dataNasc = explode("-",$aux['DTN_CIENTISTA']);
                $anoNasc = $dataNasc[0];
                $mesNasc = $dataNasc[1];
                $diaNasc = $dataNasc[2];
                $email = $aux['EMAIL_CIENTISTA'];
                $email_02 = $aux['EMAIL2_CIENTISTA'];
                $lattes = $aux['LATTES_CIENTISTA'];
                $idResponsavel = $aux['ID_CIENTISTA'];
                $idCidadeCientista = $aux['ID_CIDADE'];

                perfil($nome,  $cpf, $diaNasc, $mesNasc, $anoNasc, $email, $email_02, $lattes, $idResponsavel, $conexao, $idCidadeCientista);
            }
        }
    }
?>

</body>
</html>