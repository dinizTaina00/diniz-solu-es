<section class="container mt-4">
    <div class="col-md-8 border-bottom">
        <h4>Produtos</h4>
    </div>
</section>

<section class="container mb-4">
    <div class="row row-cols-1">
        <?php 
        $selectAllProducts = Painel::selectAllOrder('products','category ASC');
        foreach($selectAllProducts as $key => $produto){
        ?>
        <div class="card col-md-8 mt-5 shadow card-product">
            <div class="row g-0 mt-4 card-box-product mx-auto">

                <div class="col-md-4">
                    <?php echo "<a href='produto?id=".$produto['id']."'><img class='card-img-top' src='".INCLUDE_PATH."/public/images/".$produto['image']."'></a>"; ?>
                </div>
                <div class="col-md-8 card-body-product">
                    <div class="card-body">
                        <blockquote class="blockquote d-inline-block mb-3">
                            <p><?php echo $produto['category']; ?></p>
                        </blockquote>
                        <a href="produto?id=<?php echo $produto['id']; ?>">
                            <h5 class="card-title" style="font-size: 18px;"><?php echo $produto['name']; ?></h5>
                            <p class="card-text fw-bold" style="font-size: 18px;">R$ <?= Painel::convertMoney($produto['sale_price']); ?></p>
                        </a>
                        <!-- <p class="card-text">Descricao da camera </p> -->
                    </div>
                </div>

            </div>
        </div>

        <?php } ?>
    </div>
</section>

<div class="divider"></div>