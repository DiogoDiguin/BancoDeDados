<?php
    session_start();
    $idCientista = $_SESSION['idAlterar'];
    
    include 'CientistaDAO.php';

    //if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $senha = htmlspecialchars($_REQUEST['senha']);
        $senha02 = htmlspecialchars($_REQUEST['senha02']);

        if(empty($senha) or empty($senha02)){
            $_SESSION['erroSenhaAlterar'] = 1;
            header("Location: ../views/View_esqueciSenha-Alterar.php");
        }else if(!empty($senha) and !empty($senha02)){
            if($senha == $senha02){
                $senhaNova = mb_strimwidth(md5($senha),0,10);

                $dao = new CientistaDAO();
                $dao->updateSenha($senhaNova, $idCientista);
            }else{
                $_SESSION['erroSenhaAlterar'] = 2;
                header("Location: ../views/View_esqueciSenha-Alterar.php");
            }
        }
    //}
?>