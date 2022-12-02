<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

include '../../conexaoBD/conexao.php';
include 'CientistaDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = htmlspecialchars($_REQUEST['nomeUsuario']);

    if(!empty($nome)){
        $dao = new CientistaDAO();
        $dao->updateNome($nome, $idCient);
    }
}
?>