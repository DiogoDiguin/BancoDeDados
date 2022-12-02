<?php
    session_start();

    include '../../conexaoBD/conexao.php';
    include '../models/ClasseCientista.php';

    //if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $cpf = htmlspecialchars($_REQUEST['cpf']);
        $email=htmlspecialchars($_REQUEST['email']);

        if(empty($cpf) or empty($email)){
            $_SESSION['erroSenha'] = 1;
            header("Location: ../views/View_esqueciSenha.php");
        }else{
            $sql_Busca = "SELECT * FROM `t_cientista` WHERE `CPF_CIENTISTA` = '$cpf' AND `EMAIL_CIENTISTA` = '$email'";
            $sql_query = $conexao->query($sql_Busca) or die("Falha na execução do código SQL: " . $conexao->error);

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1) {
                $cientista = $sql_query->fetch_assoc();
                /*if(!isset($_SESSION)) {
                    session_start();
                }*/
                $_SESSION['idAlterar'] = $cientista['ID_CIENTISTA'];
                $_SESSION['nomeCientista'] = $cientista['NOM_CIENTISTA'];

                header("Location: Controller_esqueciSenha-Alterar.php");

            }else {
                $_SESSION['erroSenha'] = 2;
                header("Location: ../views/View_esqueciSenha.php");
            }
        }
    //}

?>