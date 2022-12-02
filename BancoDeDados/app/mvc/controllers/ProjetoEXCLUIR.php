<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

$idProjeto = $_GET['id'];
include 'ProjetoDAO.php';

    $dao = new ProjetoDAO();
    $dao->delete($idProjeto, $idCient);
?>