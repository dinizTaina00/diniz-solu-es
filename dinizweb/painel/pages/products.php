<?php 
    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $image = $_POST['image'];
        Painel::delete('products','id = '.$id);
        foreach(Painel::selectWhere('product_description_multicolumn','id_product=?',array($id)) as $description){
            @unlink(ROOT.'public/images/'.$description['image']);   
        }
        foreach(Painel::selectWhere('product_description_images','id_product=?',array($id)) as $description_image){
            @unlink(ROOT.'public/images/'.$description_image);   
        }
        Painel::delete('product_description_multicolumn', 'id_product ='.$id);
        Painel::delete('product_description_images', 'id_product ='.$id);
        @unlink(ROOT.'public/images/'.$image);    
    }

    include 'formAdd-product.php';
?>

<section class="container my-5">
    <div class="row">
        <div class="col-lg">
            <div class="">
                <div class="card-header">
                    <!-- <h5 class="title">Lista de Produtos</h5> -->
                    <div class="col-md-4 mb-5">
                        <a onclick="showFormAddProduct()" id="btnshowFormAdd" class="btn btn-outline-dark">Adicionar um novo produto <i class="fa-solid fa-plus mx-2"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex flex-row justify-content-center flex-wrap">
                        <?php 

                        $sql = MySql::conectar()->prepare("SELECT * FROM products WHERE status = 'ativo' ORDER BY category ASC");
                        $sql->execute();
                        $result_pesquisa = $sql->fetchAll();
                        foreach ($result_pesquisa as $key => $produto) {
                        ?>
                        <div class="card-group p-2">
                            <div class="card shadow" style="width: 15rem; border: none;">
                                <?php echo "<img class='card-img-top' src='".INCLUDE_PATH."/public/images/".$produto['image']."'>"; ?>
                                <div class="card-body mt-5">
                                    <h5 class="card-title" style="font-weight: 300;"><?php echo $produto['name']; ?></h5>
                                    <p class="card-text" style="font-weight: 300;"><?php echo $produto['category']; ?></p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">
                                            <a href="product?id=<?= $produto['id']; ?>" class="btn btn-sm btn-outline-dark">Ver »</a>
                                        </div>

                                        <div class="col">
                                            <form method="post">
                                                <button type="submit" name="delete" class="btn btn-sm btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <input type="hidden" name="id" value="<?= $produto['id']; ?>">
                                                <input type="hidden" name="image" value="<?= $produto['image']; ?>">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
