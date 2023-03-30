<?php 
    
    session_start();
   
    $data['sucesso'] = true;

    if (isset($_POST['tipo_acao']) && $_POST['tipo'] == 'cad_client') {
       sleep(1);
       $name = $_POST['name'];
       $sale_price = $_POST['sale_price'];
       $cost_price = $_POST['cost_price'];
       $category = $_POST['category'];
       $status = $_POST['status'];
       $image = $_FILES['image'];
       $success = true;
       $highlight = $_POST['highlight'];
       $copywriting = "";
       $sdcard = "";


        $searchProduct = Painel::selectWhere('products','name = ?',array($name));

        if(!empty($searchProduct)){
            Painel::alert('err','Já possui um produto com esse nome cadastrado');
        }else{
            $image = ['type'=>$_FILES['image']['type']];
                if(Painel::validImage($image) == false){
                    $success = false;
                    Painel::alert("err","A imagem 1 não é válida");
                    die();
                }

                if($success == true) {
                    $image = ['tmp_name' => $_FILES['image']['tmp_name'], 'name' => $_FILES['image']['name']];
                    $img = Painel::uploadFile($image);

                    $cad_product = MySql::conectar()->prepare("INSERT INTO products VALUES (null,?,?,?,?,?,?,?,?,?,?,?)");
                    $cad_product->execute(array($name,$sale_price,$cost_price,$category,$status,$img,$highlight,$copywriting,$sdcard,$sdcard,$sdcard));
                }
        }
    }

    die(json_encode($data));

?>