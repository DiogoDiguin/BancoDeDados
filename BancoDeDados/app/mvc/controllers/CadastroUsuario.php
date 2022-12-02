<?php
session_start();
include '../../conexaoBD/conexao.php';
include 'CientistaDAO.php';

//if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $dataAtual = date("Y-m-d"); 
    $nome = htmlspecialchars($_REQUEST['nome']);
    $cpf = htmlspecialchars($_REQUEST['cpf']);
    $dataNascimento = date("Y-m-d", strtotime($_REQUEST['nascimento']));
    $email1 = htmlspecialchars($_REQUEST['email1']);
    $email2 = htmlspecialchars($_REQUEST['email2']);
    $lattes = htmlspecialchars($_REQUEST['lattes']);
    $senha = htmlspecialchars(mb_strimwidth(md5($_REQUEST['senha']),0,10));
    $cidade = htmlspecialchars($_REQUEST['cidades']);

    if(empty($nome)){
        $_SESSION['infoUsuario'] = 0;
        header("Location: ../views/View_CadastroUsuario.php");
    }

    if (!empty($nome) and !empty($cpf) and !empty($dataNascimento) and !empty($email1) and !empty($lattes) and !empty($senha) and !empty($cidade)) {
        $sql_CPF = "SELECT `CPF_CIENTISTA` FROM `t_cientista` WHERE `CPF_CIENTISTA` = '$cpf'";
        $sql_queryCPF = $conexao->query($sql_CPF) or die("Falha na execução do código SQL: " . $conexao->error);
        $qtdCPF = $sql_queryCPF->num_rows;
            if($qtdCPF < 1) {
                $sql_EMAIL = "SELECT `EMAIL_CIENTISTA` FROM `t_cientista` WHERE `EMAIL_CIENTISTA` = '$email1'";
                $sql_queryEMAIL = $conexao->query($sql_EMAIL) or die("Falha na execução do código SQL: " . $conexao->error);
                $qtdEMAIL = $sql_queryEMAIL->num_rows;
                if($qtdEMAIL < 1) {
                    $sql_LATTES = "SELECT `LATTES_CIENTISTA` FROM `t_cientista` WHERE `LATTES_CIENTISTA` = '$lattes'";
                    $sql_queryLATTES = $conexao->query($sql_LATTES) or die("Falha na execução do código SQL: " . $conexao->error);
                    $qtdLATTES = $sql_queryLATTES->num_rows;
                    if($qtdLATTES < 1) {
                        $sql_SENHA = "SELECT * FROM `t_cientista` WHERE `SENHA_CIENTISTA` = '$senha'";
                        $sql_querySENHA = $conexao->query($sql_SENHA) or die("Falha na execução do código SQL: " . $conexao->error);

                        $qtdSENHA = $sql_querySENHA->num_rows;

                        if($qtdSENHA == 1) {
                            echo "Existem registros incorretos";
                        }else {
                            try {        
                                /*$cientista1 = new Cientista("Diogo Vitor","11111111111","2002-06-30","email@teste.com","email02@teste2.com", "google.com", "1231231231");*/
                    
                                $sql_idCidade = mysqli_query($conexao, "SELECT `ID_CIDADE` from `t_cidade` WHERE `NOM_CIDADE` = '$cidade'");
                    
                                while($aux = mysqli_fetch_assoc($sql_idCidade)){
                                    $cidade = $aux['ID_CIDADE'];
                                }
                    
                                if(str_contains($lattes, "http://lattes.cnpq.br/")){
                                    if($dataNascimento < $dataAtual){
                                        $cientista1 = new Cientista($nome, $cpf, $dataNascimento, $email1, $email2, $lattes, $senha, $cidade);
                    
                                        $dao = new CientistaDAO();
                                        $dao->insert($cientista1);
                                    }else{
                                        $_SESSION['infoUsuario'] = 1;
                                        header("Location: ../views/View_CadastroUsuario.php");
                                    }
                                }else{
                                    $_SESSION['infoUsuario'] = 2;
                                    header("Location: ../views/View_CadastroUsuario.php");
                                }
                            }catch (PDOException $e) {
                                echo $e->getMessage();
                            }
                        }
                    }else{
                        $_SESSION['infoUsuario'] = 3;
                        header("Location: ../views/View_CadastroUsuario.php");
                    }
                }else{
                    $_SESSION['infoUsuario'] = 4;
                    header("Location: ../views/View_CadastroUsuario.php");
                }
            }else{
                $_SESSION['infoUsuario'] = 5;
                header("Location: ../views/View_CadastroUsuario.php");
            }
        }
//}
?>