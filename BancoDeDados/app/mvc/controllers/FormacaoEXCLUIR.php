<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

$idFormacao = $_GET['id'];
include 'FormacaoDAO.php';

    $dao = new FormacaoDAO();
    $dao->delete($idFormacao, $idCient);
?>