<?php 
	session_start();

	ini_set('display_errors', 1);

	date_default_timezone_set('America/Sao_Paulo');

	$autoload = function($class){
		if($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoLoad.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);

	define('INCLUDE_PATH','http://localhost/dinizweb/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
	define('INCLUDE_PATH_APP',INCLUDE_PATH.'app/');

	define('BASE_DIR_PAINEL',__DIR__.'/painel');
	define('ROOT',__DIR__.'/');

	//Conectar com o banco de dados
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','dinizweb');
    define('PORT','3306');


	
?>