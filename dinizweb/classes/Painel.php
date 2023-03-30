<?php

    class Painel{
        public static function convertMoney($valor){
            return number_format($valor, 2, ',', '.');
        }
    
        public static function loadPagePainel(){
            if(isset($_GET['url'])){
                $url = explode('/', $_GET['url']);
                if(file_exists('pages/'.$url[0].'.php')){
                    include('pages/'.$url[0].'.php');
                }else{
                    header('Location: '.INCLUDE_PATH_PAINEL);
                }
            }else{
                include('pages/home.php');
            }
        }

        public static function loadPageApp(){
            if(isset($_GET['url'])){
                $url = explode('/',$_GET['url']);
                if(file_exists('pages/'.$url[0].'.php')){
                    include('pages/'.$url[0].'.php');
                }else{
                    header('Location: '.INCLUDE_PATH_APP);
                }
            }else{
                include('pages/home.php');
            }
        }

        public static function alert($type,$msg){
			if ($type == 'success') {
				echo "<div class='col-md-8 alert alert-success'><i class='fa fa-check'></i> ".$msg."</div>";
			}elseif ($type == 'err') {
				echo "<div class='col-md-8 alert alert-danger'><i class='fa fa-close'></i> ".$msg."</div>";
			}else if($type = 'warning'){
				echo "<div class='col-md-8 alert alert-warning'><i class='fa fa-warning'></i> ".$msg."</div>";
			}
		}

        public static function validImage($image){
            if($image['type'] == 'image/jpeg' || 
                $image['type'] == 'image/jpg' ||
                $image['type'] == 'image/png' ||
                $image['type'] == 'image/gif'){
                    return true;
            }else{ 
                return false;
            }
        }

        public static function uploadFile($file){
            $format = explode('.', $file['name']);
            $nameImage = uniqid().'.'.$format[count($format) - 1];
            if(move_uploaded_file($file['tmp_name'],ROOT.'/public/images/'.$nameImage)){
                return $nameImage;
            }else{
                return false;
            }
        }

        public static function select($table,$query,$arr){
            $sql = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $query");
            $sql->execute($arr);
            return $sql->fetch();
        }

        public static function selectFetchAllOrderBy($table,$query,$orderby,$arr){
            $sql = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $query ORDER BY $orderby");
            $sql->execute($arr);
            return $sql->fetchAll();
        }

        public static function selectAll($table){
            $sql = MySql::conectar()->prepare("SELECT * FROM $table");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function selectAllOrder($table,$orderby){
            $sql = MySql::conectar()->prepare("SELECT * FROM $table ORDER BY $orderby");
            $sql->execute();
            return $sql->fetchAll();
        }

        public static function selectWhere($table,$query,$arr){
            $sql = MySql::conectar()->prepare("SELECT * FROM $table WHERE $query");
            $sql->execute($arr);
            return $sql->fetchAll();
        }

        public static function delete($table,$where){
            $sql = MySql::conectar()->prepare("DELETE FROM `$table` WHERE $where");
            $sql->execute();
        }

        public static function redirect($url){
            echo "<script>location.href='".$url."'</script>";
            die();
        }

        public static function refresh(){
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
        }

        public static function loggout(){
            session_destroy();
            header('Location: '.INCLUDE_PATH_APP);
        }

        public static function verificaPermissaoUser(){
            if(isset($_SESSION['login'])){
                if($_SESSION['permissao'] == 1){
                    Painel::redirect(INCLUDE_PATH_PAINEL.'home');
                }
            } 
        }

        public static function verificaPermissaoAdmin(){
            if(isset($_SESSION['login'])){
                if($_SESSION['permissao'] == 0){
                    Painel::redirect(INCLUDE_PATH_APP);
                }
            } else{
                Painel::redirect(INCLUDE_PATH_APP);
            }
        }

    }
    

?>