<?php 
if(isset($_GET['id'])){
    $produto = Painel::select('products','id=?',array($_GET['id']));
}else{
    Painel::alert('err','Produto não encontrado');
    die();
}

    Painel::verificaPermissaoUser(); 
    $configSite = MySql::conectar()->prepare('SELECT * FROM config_site');
    $configSite->execute();
    $configSite = $configSite->fetch();

    if (isset($_POST['buy'])) {
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];
        $storage = $_POST['storage'];
    }
?>

<section class="container">
    <div class="mx-auto bg-dark text-white p-3 my-5">
        <h3 class="text-warning text-center">FRETE GRÁTIS NA COMPRA DE 2 OU MAIS UNIDADES</h3>
    </div>        
    <hr style="opacity: 0;">
        <div class="row col-xl-12">
            <div class="col-md-6 d-flex justify-content-end">
                <?php echo "<img class='card-img-top' src='".INCLUDE_PATH."/public/images/".$produto['image']."' style='max-width: 450px; max-height: 475px;'>"; ?>
            </div>

            <div class="col-md-5">
                <div class="card-body p-4 my-5">

                    <div>
                        <h3 class="card-title"><?= $produto['name']; ?></h3>
                        <h5 class="card-text my-4 text-success" style="font-size: 26px; font-weight: 700;">R$<?= Painel::convertMoney($produto['sale_price']); ?> <span class="text-success" style="font-size: 20px;">com desconto à vista</span></h5>
                        <?php
                        $valor_parcelado = $produto['installment_sale'];
                        $parcela = 6;

                        $valor_parcela = $valor_parcelado / $parcela;
                        ?>
                        <h5 class="card-text fw-bold mb-4 text-success">ou 6x sem juros de R$ <?= Painel::convertMoney($valor_parcela); ?> no cartão</h5>
                        <form>

                            <!-- <p>Quantidade:</p>

                            <input type="number" name="quantity" value="1" class="form-control" style="width: 100px;">
 -->
                            <!-- <br>  -->

                            <p>Escolha o tamanho do armazenamento:</p>

                            <?php
                            foreach (Painel::selectWhere('product_storage','id_product = ?',array($produto['id'])) as $key => $product_storage) {
                            ?>
                            <div class="form-group my-3">
                                <input type="radio" name="storage" class="btn-check" id="<?= $product_storage['storage']; ?>" value="<?= $product_storage['storage']; ?>">
                                <label class="btn btn-outline-dark" for="<?= $product_storage['storage']; ?>"><?= $product_storage['storage']; ?> + R$ <?= Painel::convertMoney($product_storage['sale_price']); ?></label>
                            </div>
                            <?php } ?>

                            <input type="hidden" name="product" value="<?= $produto['name']; ?>">

                            <!-- <button class="btn btn-success" type="submit" name="buy">Comprar <i class="fa-solid fa-cart-shopping"></i></button> -->
                        </form>
                    </div>

                    <hr style="opacity: 0;">

                    <div class=" card col-md-12 shadow-lg border border-success">
                        <div class="bg-dark text-white p-4">
                            <h4 class="fw-normal" style="font-size: 18px;">A compra é feita pelo Whatsapp, lá você informa o produto, quantidade e informações de envio. Logo após enviaremos o link para o pagamento.<br>Após a confirmação de pagamento, iremos preparar e enviar o mais rápido possível.<br><br>
                            <span class="text-warning">Para contratar o serviço de instalação também é preciso entrar em contato pelo Whatsapp</span>
                            </h4>

                            <!-- <a href="https://wa.me/<?= $configSite['whatsapp']; ?>?text=Ol%C3%A1%2C+gostaria+de+realizar+um+or%C3%A7amento." class="my-2 btn btn-outline-success" target="_blank"> Mandar mensagem <i class="fa fa-whatsapp"></i> </a> -->

                            <a class="btn btn-sm btn-warning" href="https://wa.me/<?= $configSite['whatsapp']; ?>?text=Ol%C3%A1%2C+gostaria+de+realizar+um+or%C3%A7amento." class="icon-social-media-fixed" target="_blank">
                                Entre em contato para saber o custo de instalação <i class="fa fa-whatsapp"></i>
                            </a>

                        </div>
                    </div>

                    
                </div>

            </div>

        </div>
    </div>
</section>

<hr class="divider" style="opacity: 0;">


<!-- Descrição -->
<section class="container mx-auto">
    <div class="col-md-9 row mx-auto">
        <h4 class="text-muted">Descrição</h4>
        <p class="" style="font-size: 18px;"><?= $produto['description']; ?></p>
    </div>
    <hr class="divider" style="opacity: 0;">
    <div class="col-md-6 mx-auto">
        <?php
            foreach (Painel::selectWhere('product_description_multicolumn', 'id_product=? AND section = ?',array($produto['id'],'descricao1')) as $key => $description1) {
            ?>
                <div class="row featurette d-flex justify-content-center mb-5">
                  <div class="col">
                    <h2 class="fw-normal"><?= $description1['title']; ?></h2>
                    <p class="lead"><?= $description1['description']; ?></p>
                  
                    <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid rounded-4 shadow-lg" width="700" src="<?php echo INCLUDE_PATH ?>public/images/<?= $description1['image']; ?>">
                  </div>
                </div>
            <?php
            }
        ?>       
    </div>
    
    <hr class="divider" style="opacity: 0;">

    <div class="col-md-10 mx-auto my-5">
        <?php 
        $descriptions = Painel::selectWhere('product_description_multicolumn','id_product=? AND section = ? ORDER BY position ASC',array($produto['id'],'descricao2'));
        $countDescriptions = count($descriptions);
        foreach ($descriptions as $key => $description2) {      
        ?>
            <div class="row featurette d-flex justify-content-center mb-5 my-5">
              <div class="col-md-7">
                <h4 class="fw-normal my-3   "><?= $description2['title']; ?></h4>
                <p class="lead"><?= $description2['description']; ?></p>
            </div>
            <div class="col-md-5">
                <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid rounded-4 shadow-lg" width="500" style="max-height: 500px" src="<?php echo INCLUDE_PATH ?>public/images/<?= $description2['image']; ?>">
              </div>
            </div>

            <hr style="opacity: 0;">
            <hr style="opacity: 0;">
            
        <?php } ?>
    </div>
</section>


<!-- Videos -->
<section class="container">
    <div class="row scrollspy-example" data-bs-spy="scroll" data-bs-offset="0">
        <div id="scrollVideos">
            <div class="col-md-10 mx-auto">
                <?php 
                $id_product = $produto['id'];
                $sql_urlVideo = MySql::conectar()->prepare("SELECT * FROM product_video_link WHERE id_product = $id_product");
                $sql_urlVideo->execute();
                $sql_urlVideo = $sql_urlVideo->fetchAll();
                //$urls_video = Painel::select('product_video_link','id = $id');

                foreach($sql_urlVideo as $key => $urlsVideo){
                ?>
                    <div class="d-flex justify-content-center">
                        <div class="p-5">
                            <iframe id="video" width="728" height="350" src="<?php echo $urlsVideo['url']; ?>" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </div>
</section>