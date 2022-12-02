<?php

    session_start();
    unset ($_SESSION['idCientista']);
    $_SESSION['erroLogin'] = 0;
    header('Location: ../../publico/Index.php');
    exit();

?>