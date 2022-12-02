<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

$idAreaAtual = $_GET['id'];
include '../../conexaoBD/conexao.php';
include 'AreaAtuacaoDAO.php';

    $dao = new AreaAtuacaoDAO();
    $dao->delete($idAreaAtual, $idCient);
?>