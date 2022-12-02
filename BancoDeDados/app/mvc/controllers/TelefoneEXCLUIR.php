<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

$idTelefone = $_GET['id'];
include '../../conexaoBD/conexao.php';
include 'TelefoneDAO.php';

    $dao = new TelefoneDAO();
    $dao->delete($idTelefone, $idCient);
?>