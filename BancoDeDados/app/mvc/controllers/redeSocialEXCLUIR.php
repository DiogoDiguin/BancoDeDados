<?php
session_start();
$idCient = $_SESSION['idCientista'];
$tipoRede = $_GET['tipo'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

include 'RedeSocialDAO.php';

    $dao = new RedeSocialDAO();
    $dao->delete($idCient, $tipoRede);

?>