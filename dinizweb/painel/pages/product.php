<?php 
        
    $url = $_GET['url'];

    //Select para buscar o produto
    if(isset($_GET['id'])){
        $idProduct = $_GET['id'];
        $produto = Painel::select('products','id = ?',array($_GET['id']));
        //echo "<script>window.alert('".$id."')</script>";
    }else{
        Painel::alert('err','Produto não encontrado');
        die();
    }

    //Update
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        $highlight = $_POST['highlight'];
        $sale_price = $_POST['sale_price'];
        $installment_sale = $_POST['installment_sale'];
        $cost_price = $_POST['cost_price'];
        $description = $_POST['description'];
         
        if($_FILES['image']['error'] == 4){
            $img = $produto['image'];
            $success = true;
        }else{
            $image = $_FILES['image'];
            $success = true;

            $image = ['type'=>$_FILES['image']['type']];
            if(Painel::validImage($image) == false){
                $success = false;
                Painel::alert("err","A imagem não é válida");
                die();
            }else{
                $image = ['tmp_name' => $_FILES['image']['tmp_name'], 'name' => $_FILES['image']['name']];
                $img = Painel::uploadFile($image);
            }
        }
        if($success){
                $sql = MySql::conectar()->prepare("UPDATE `products` SET name=?,sale_price=?,installment_sale=?,cost_price=?,category=?,status=?,image=?,highlight=?, description=? WHERE id = ?");
                $sql->execute(array($name,$sale_price,$installment_sale,$cost_price,$category,$status,$img,$highlight,$description,$_GET['id']));

                echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
                }
    }

    //Add descrição
    if(isset($_POST['add_description'])){
        $title_description = $_POST['title_description'];
        $description = $_POST['description'];
        $id_product = $produto['id'];
        $success = true;
        $position = 0;
        $section = $_POST['section'];

        if ($_FILES['image']['name'] == "") {
            $image = "";
        }else{
            $image = $_FILES['image'];
            $image = ['type'=>$_FILES['image']['type']];
            if (Painel::validImage($image) == false) {
                $success = false;
                Painel::alert('err', 'A imagem não é válida');
            } else{
                $image = ['tmp_name' => $_FILES['image']['tmp_name'], 'name' => $_FILES['image']['name']];
                $img = Painel::uploadFile($image);

                $sql = MySql::conectar()->prepare("INSERT INTO product_description_multicolumn VALUES (null,?,?,?,?,?,?)");
                $sql->execute(array($id_product,$title_description,$description,$img,$position,$section));
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
            }
        }
    }

    //Deleta descrição
    if(isset($_POST['delete_description'])){
        $image = $_POST['current_image'];
        Painel::delete('product_description_multicolumn','id='.$_POST['id']);
        @unlink(ROOT.'public/images/'.$image); 
    }

    //Update descrição
    if(isset($_POST['update_description'])){
        $id = $_POST['id'];
        $title = $_POST['title_description'];
        $description = $_POST['description'];
        $position = $_POST['position'];
        $section = $_POST['section'];

        $success = true;

        if ($_FILES['image']['name'] == "") {
            $img = $_POST['current_image'];
            $sql = MySql::conectar()->prepare("UPDATE product_description_multicolumn SET title = ?, description = ?, image = ?, position = ?, section = ? WHERE id = ?");
            $sql->execute(array($title,$description,$img,$position,$section,$id));
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
        }else{
            $image = $_FILES['image'];
            $image = ['type'=>$_FILES['image']['type']];
            if (Painel::validImage($image) == false) {
                $success = false;
                Painel::alert('err', 'A imagem não é válida');
            } else{
                $image = ['tmp_name' => $_FILES['image']['tmp_name'], 'name' => $_FILES['image']['name']];
                $img = Painel::uploadFile($image);
                
                $sql = MySql::conectar()->prepare("UPDATE product_description_multicolumn SET title = ?, description = ?, image = ?, position = ?, section = ? WHERE id = ?");
                $sql->execute(array($title,$description,$img,$position,$section,$id));
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
            }
        }
    }


    //Upload das imagens complementares
    if(isset($_POST['add_description_images'])){
        $success = true;

        for($i = 0; $i < count($_FILES['image']['name']); $i++){

            $id_product = $_POST['id_product'];

            $image = ['type'=>$_FILES['image']['type'][$i]];

                if(Painel::validImage($image) == false){
                    $success = false;
                    Painel::alert("err","A imagem não é válida");
                } else{
                    $image = ['tmp_name' => $_FILES['image']['tmp_name'][$i], 'name' => $_FILES['image']['name'][$i]];
                    $img = Painel::uploadFile($image);
                }

                $cad_image = MySql::conectar()->prepare("INSERT INTO product_description_images VALUES (null,?,?)");
                $cad_image->execute(array($id_product,$img));
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
            }
    }

    //Deleta imagem complementar
    if(isset($_POST['deleteImage'])){
        $id = $_POST['id'];
        $image = $_POST['image'];
        $delete = Painel::delete('product_description_images','id = '.$id);
        @unlink(ROOT.'public/images/'.$image); 
    }
    
    //Cadastra link do Youtube
    if(isset($_POST['add_video'])){
        $id_product = $_POST['id'];
        $title = $_POST['title'];
        $url = $_POST['url'];

        $sql = MySql::conectar()->prepare("INSERT INTO product_video_link VALUES (null,?,?,?)");
        $sql->execute(array($id_product,$title,$url));
    }

    //Delete link de video 
    if(isset($_POST['deleteUrlVideo'])){
        $id = $_POST['id'];
        $delete = Painel::delete('product_video_link',$id);
    }

    //Update armazenamentos
    if (isset($_POST['updateRecordingDays'])) {
        $id_product = $_POST['id_product'];
        Painel::delete('product_storage','id_product='.$id_product);
        foreach ($_POST['storage'] as $key => $value) {
            $insert = MySql::conectar()->prepare("INSERT INTO product_storage VALUES (null,?,?,?)");
            $insert->execute(array($id_product,$value,$_POST['sale_price'][$key]));
        }

        // $sql = MySql::conectar()->prepare("UPDATE products SET sdcard32 = ?, sdcard64 = ?, sdcard128 = ? WHERE id = ?");
        // $sql->execute(array($sdcard32,$sdcard64,$sdcard128,$produto['id']));
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    }

?>

<section class="container my-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title"><?php echo $produto['name']; ?> </h5>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" value="<?php echo $produto['name']; ?>" class="form-control"
                                        placeholder="Nome do produto..." name="name">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Preço de venda</label>
                                    <div class="input-group input-group-sm mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">R$</span>
                                      </div>
                                        <input type="text" name="sale_price" value="<?php echo Painel::convertMoney($produto['sale_price']); ?>" class="form-control"
                                        placeholder="Valor do produto..." >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Preço de venda parcelada</label>
                                    <div class="input-group input-group-sm mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">R$</span>
                                      </div>
                                        <input type="text" name="installment_sale" value="<?php echo Painel::convertMoney($produto['installment_sale']); ?>" class="form-control"
                                        placeholder="Valor do produto parcelado..." >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Preço de custo</label>
                                    <div class="input-group input-group-sm mb-3">
                                      <div class="input-group-prepend"> 
                                        <span class="input-group-text" id="inputGroup-sizing-sm">R$</span>
                                      </div>
                                        <input type="text" name="cost_price" value="<?php echo Painel::convertMoney($produto['cost_price']); ?>" class="form-control"
                                        placeholder="Valor do produto...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="category" class="form-select">
                                        <?php 
                                    $category = Painel::selectAll('categories');
                                    foreach($category as $key => $category){
                                    ?>

                                        <option value="<?php echo $category['name']; ?>"
                                            <?php if($category['name'] == $produto['category']) echo "selected";?>>
                                            <?php echo $category['name']; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="">
                                <div class="form-group">
                                    <label>Status (se está disponível a venda)</label>
                                    <select name="status">
                                        <option value="ativo" <?= $produto['status'] == 1 ? "selected" : ""; ?>>Ativo</option>
                                        <option value="inativo" <?= $produto['status'] == 0 ? "selected" : ""; ?>>Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Imagem</label>
                                    <input type="file" name="image" class="form-control"
                                        placeholder="Imagem do produto">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="pr-1">
                                <div class="form-group">
                                    <label>Produto em destaque?</label>
                                    <select name="highlight" class="form-control" required>
                                        <option value="1" <?= $produto['highlight'] == 1 ? "selected" : ""; ?>>Destacar</option>
                                        <option value="0" <?= $produto['highlight'] == 0 ? "selected" : ""; ?>>Não</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Descrição</label>
                                    <textarea name="description" class="form-control" rows="6"><?= $produto['description']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" name="update" value="Atualizar informações do produto"
                                        class="btn btn-sm btn-outline-dark">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="">
                    <?php echo "<img class='card-img-top' src='".INCLUDE_PATH."/public/images/".$produto['image']."'>"; ?>
                </div>
                <hr>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>

<section class="container py-4">
    <div class="row">
        <div class="col-lg d-flex flex-wrap">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Imagens complementares</h5>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="">Imagem</label>
                        <input type="file" name="image[]" multiple="multiple">
                        <input type="submit" name="add_description_images" value="Fazer upload das imagens"
                            class="btn btn-sm btn-outline-dark">
                        <input type="hidden" name="id_product" value="<?php echo $produto['id']; ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg d-flex flex-wrap">
            <?php 
                $sql_images = MySql::conectar()->prepare("SELECT * FROM product_description_images WHERE id_product = ?");
                $sql_images->execute(array($produto['id']));
                $sql_images = $sql_images->fetchAll();
                foreach($sql_images as $key => $product_image_item){
                        echo '<div class="card col-sm m-3 mb-2" style="max-width: 282px; max-height: 282px; min-width: 282px; min-height: 282px;">
                        <div class="card-image">
                            <img src="'.INCLUDE_PATH.'/public/images/'.$product_image_item['image'].'" style="width: 100%;">
                            </div>
                            <div class="card-body" style="position: absolute; top: 260px; left: 25%;">
                            <form method="post">
                            <button type="submit" name="deleteImage" class="btn btn-default">Deletar</button>
                            <input type="hidden" name="id" value="'.$product_image_item['id'].'">
                            <input type="hidden" name="image" value="'.$product_image_item['image'].'">
                            </form>
                            </div>
                            </div>';
                }
            ?>
        </div>
    </div>

</section>

<div class="divider"></div>

<section class="container my-5">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Armazenamentos</h5>
                </div>
                <form method="post">
                    <div class="d-flex flex-wrap my-5 mx-5">
                        <?php

                            foreach (Painel::selectAll('storages') as $key => $storage) {
                            $try = MySql::conectar()->prepare("SELECT * FROM product_storage WHERE storage = ? AND id_product = ?");
                            $try->execute(array($storage['title'],$idProduct));

                            ?>
                            <div class="form-group col-md-3 mx-1 my-2">
                                <label class="fw-bold"><?= $storage['title']; ?></label>
                                <input type="checkbox" name="storage[]" value="<?= $storage['title']; ?>" class="" 
                                <?php 
                                if($try->rowCount() > 0) {
                                    echo "checked"; } ?>>
                            </div>
                            <input type="hidden" name="sale_price[]" value="<?= $storage['sale_price']; ?>">
                            <?php
                            }
                        ?>
                    </div>

                    <input type="hidden" name="id_product" value="<?= $produto['id']; ?>">

                    <div class="form-group mx-5 my-2">
                        <button type="submit" name="updateRecordingDays" class="btn btn-sm btn-outline-dark">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="divider"></div>
    
<section class="container py-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Caracteristicas</h5>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">

                        <div class="col-md-6 px-1 mb-2">
                            <div class="form-group mb-2">
                                <label>Titulo</label>
                                <input type="text" class="form-control" placeholder="Título da descrição..."
                                    name="title_description">
                            </div>

                            <div class="form-group mb-2">
                                <label>Descrição</label>
                                <textarea class="form-control" placeholder="Descrição do produto..." name="description"
                                    style="height: 100px"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label>Imagem</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Sessão</label>
                                <select name="section" class="form-control">
                                    <option value="descricao1">Descrição 1</option>
                                    <option value="descricao2">Descrição 2</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="add_description" value="Adicionar descrição"
                                    class="btn btn-sm btn-outline-dark">
                            </div>
                        </div>
                    </form>
                </div>

                <hr class="divider">

                    <div class="row">
                        <div class="col-lg p-4 d-flex flex-wrap">
                            <?php 
                                    $description = MySql::conectar()->prepare("SELECT * FROM product_description_multicolumn WHERE id_product = ?");
                                    $description->execute(array($produto['id']));
                                    $description = $description->fetchAll();
                                    foreach($description as $key => $descripton_item){
                                        ?>
                            <div class="card col-md-8 m-1 p-3 ">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-10 form-group">
                                            <label>Posição</label>
                                            <input type="number" name="position" value="<?= $descripton_item['position']; ?>" class="form-control mb-3">

                                            <label>Titulo</label>
                                            <input type="text" class="form-control mb-3"
                                                value="<?php echo $descripton_item['title'] ?>" name="title_description">

                                            <label>Descrição</label>
                                            <textarea class="form-control mb-3" name="description"
                                                style='height: 150px'> <?php echo $descripton_item['description'] ?> </textarea>

                                            <label>Sessão</label>
                                            <input type="text" name="section" value="<?= $descripton_item['section']; ?>" class="form-control mb-3">

                                            <input type="file" name="image" class="form-control mb-2">

                                            <input type="submit" name="update_description" value="Atualizar"
                                                class="btn btn-sm btn-primary">

                                            <input type="hidden" name="current_image" value="<?= $descripton_item['image']; ?>">

                                            <input type="submit" name="delete_description" value="Excluir" class="btn btn-sm btn-danger" />

                                            <input type="hidden" name="id" value="<?php echo $descripton_item['id']; ?>">
                                        </div>
                                        <div class="col">
                                            <img src="<?= INCLUDE_PATH ?>public/images/<?= $descripton_item['image']; ?>" style="width: 100%;">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <?php
                                    }
                                ?>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</section>

<div class="divider"></div>

<section class="container py-4">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5>Adicionar um novo video</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <form action="" method="post" enctype="multipart/form-data">
                            <label>Como instalar</label>
                            <input type="text" name="title" placeholder="Titulo..." class="form-control mb-3">

                            <label>Link do vídeo do YouTube</label>
                            <input type="text" name="url" placeholder="Insira aqui a URL do video..."
                                class="form-control">
                            <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                            <input type="submit" name="add_video" value="Enviar video" class="btn btn-sm btn-outline-dark">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row scrollspy-example" id="url_video" data-bs-spy="scroll" data-bs-offset="0">
        <div class="col-md-8" id="scrollVideos">

        <?php 
        $id_product = $produto['id'];
        $sql_urlVideo = MySql::conectar()->prepare("SELECT * FROM product_video_link WHERE id_product = $id_product");
        $sql_urlVideo->execute();
        $sql_urlVideo = $sql_urlVideo->fetchAll();
        //$urls_video = Painel::select('product_video_link','id = $id');

        foreach($sql_urlVideo as $key => $urlsVideo){
        ?>
            <div class="card p-5">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $urlsVideo['id']; ?>">
                    <input type="submit" class="m-2 btn btn-default" name="deleteUrlVideo" value="Deletar video">
                </form>

                <iframe class="col-sm-12" width="560" height="315" src="<?php echo $urlsVideo['url']; ?>" title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
            </div>

            <?php } ?>
        </div>
    </div>
</section>