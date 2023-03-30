<?php 
    include('../config.php');

    if (isset($_GET['loggout'])) {
        Painel::loggout();
    }
    include("main.php");
?>