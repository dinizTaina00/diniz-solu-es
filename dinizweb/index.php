<?php  
	include('config.php');
	
	if(isset($_SESSION['login'])){
        if($_SESSION['permissao'] != 0){
            header("Location: ".INCLUDE_PATH_PAINEL);
            die();
        }
    } else{
        header("Location: ".INCLUDE_PATH_APP);
        die();
    }
?>