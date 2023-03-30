<div class="row form_addProduct" id="form_addProduct" style="display: none;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Adicionar novo produto</h5>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-8 pr-1 m-2">
                            <div class="form-group">
                                <label>Nome</label>
                                <input type="text" class="form-control" placeholder="Nome do produto..." name="name"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 pr-1 m-1">
                            <div class="col-md-5 px-1">
                                <div class="form-group">
                                    <label>Preço de venda</label>
                                    <div class="input-group input-group-sm mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">R$</span>
                                      </div>
                                        <input type="text" name="sale_price" class="form-control"
                                        placeholder="Valor do produto...">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 px-1">
                                <div class="form-group">
                                    <label>Preço de venda parcelado</label>
                                    <div class="input-group input-group-sm mb-3">
                                      <div class="input-group-prepend"> 
                                        <span class="input-group-text" id="inputGroup-sizing-sm">R$</span>
                                      </div>
                                        <input type="text" name="installment_sale" class="form-control"
                                        placeholder="Valor parcelado...">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 px-1">
                                <div class="form-group">
                                    <label>Preço de custo</label>
                                    <div class="input-group input-group-sm mb-3">
                                      <div class="input-group-prepend"> 
                                        <span class="input-group-text" id="inputGroup-sizing-sm">R$</span>
                                      </div>
                                        <input type="text" name="cost_price" class="form-control"
                                        placeholder="Valor do produto...">
                                    </div>
                                </div>
                            </div>
                        </div>


                    <div class="row">
                        <div class="col-md-8 pr-1 m-2">
                            <div class="form-group">
                                <label>Categoria</label>
                                <select name="category" class="form-select" required>
                                    <?php 
                                    $selectAllCategories = Painel::selectAll('categories');
                                    foreach($selectAllCategories as $categorie){
                                    ?>
                                        <option value="<?= $categorie['name'] ?>"><?= $categorie['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="pr-1 m-2">
                            <div class="form-group">
                                <label>Status (se está disponível a venda)</label>
                                <select name="status" class="form-control" required>
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-1 m-2">
                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" name="image" class="form-control" placeholder="Imagem do produto"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="pr-1 m-2">
                            <div class="form-group">
                                <label>Produto em destaque?</label>
                                <select name="highlight" class="form-control" required>
                                    <option value="1">Destacar</option>
                                    <option value="0">Não</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 pr-1 m-2">
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 pr-1 m-2">
                            <div class="form-group">
                                <a onclick="cancelAddProduct()" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 

    if(isset($_POST['submit'])){
       $name = $_POST['name'];
       $sale_price = $_POST['sale_price'];
       $installment_sale = $_POST['installment_sale'];
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
                } else{
                    $image = ['tmp_name' => $_FILES['image']['tmp_name'], 'name' => $_FILES['image']['name']];
                    $img = Painel::uploadFile($image);

                    $cad_product = MySql::conectar()->prepare("INSERT INTO products VALUES (null,?,?,?,?,?,?,?,?,?)");
                    $cad_product->execute(array($name,$sale_price,$cost_price,$installment_sale,$category,$status,$img,$highlight,$copywriting));
                    
                    $lastId = MySql::conectar()->lastInsertId();
                }
            echo "<script>location.href='product?id=".$lastId."'</script>";
        }
    }

?>