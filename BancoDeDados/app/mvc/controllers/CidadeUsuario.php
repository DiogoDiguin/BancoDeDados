<?php
session_start();
$idCient = $_SESSION['idCientista'];

if(!isset($_SESSION['idCientista'])){
    header('Location: ../../../publico/Index.php');
}

include '../../conexaoBD/conexao.php';
include 'CientistaDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $cidadeNova = htmlspecialchars($_REQUEST['novaCidade']);
    $sql_idCidadeNova = mysqli_query($conexao, "SELECT `ID_CIDADE` from `t_cidade` WHERE `NOM_CIDADE` = '$cidadeNova'");

    while($aux = mysqli_fetch_assoc($sql_idCidadeNova)){
        $cidade = $aux['ID_CIDADE'];
    }

    if(!empty($cidadeNova)){
        $dao = new CientistaDAO();
        $dao->updateCidade($cidade, $idCient);
    }
}
?>