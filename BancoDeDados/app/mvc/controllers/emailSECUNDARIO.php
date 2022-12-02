<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

include '../../conexaoBD/conexao.php';
include 'CientistaDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = htmlspecialchars($_REQUEST['email']);
    $emailAtual = htmlspecialchars($_REQUEST['emailAtual']);

    if(!empty($email)){
        $dao = new CientistaDAO();
        $dao->updateEmail2($email, $idCient);
    }else{
        $dao = new CientistaDAO();
        $dao->deleteEmail2($idCient);
    }
}

?>