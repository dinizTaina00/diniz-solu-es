<?php
    $configSite = MySql::conectar()->prepare('SELECT * FROM config_site');
    $configSite->execute();
    $configSite = $configSite->fetch();

        if (isset($_POST['budget_requests'])) {
            $client_name = $_POST['client_name'];
            $city = $_POST['city'];
            $zone = $_POST['zone'];
            $distance_from_city = $_POST['distance_from_city'];
            if($distance_from_city == ""){
                $distance_from_city = "";
            }
            $cameras_qtd = $_POST['cameras_qtd'];
            $internet_conection = $_POST['internet_conection'];
            $description = $_POST['description'];   
            $status = "aguardando resposta";
            $data = date('Y-m-d');

            $insert = MySql::conectar()->prepare('INSERT INTO budget_requests VALUES (NULL,?,?,?,?,?,?,?,?,?)');
            $insert->execute(array($client_name,$city,$zone,$distance_from_city,$cameras_qtd,$internet_conection,$description,$status,$data));
            echo "<script>alert('Sua solicitação de orçamento foi enviada com sucesso, iremos entrar em contato o mais rápido possível.')</script>";
        }

?>

<!-- <section class="container bg-dark mx-auto px-4 py-4 text-white border border-success">
    <h4 class="fw-normal" style="font-size: 18px;">Você pode comprar nossos produtos aqui pelo site mesmo.<br> Porém para contratar nossos serviços de instalação você precisa deixar uma solicitação de orçamento ou entrar em contato com nosso Whatsapp</h4>

    <a href="https://wa.me/<?= $configSite['whatsapp']; ?>?text=Ol%C3%A1%2C+gostaria+de+realizar+um+or%C3%A7amento." class="my-2 btn btn-outline-success" target="_blank"> Mandar mensagem <i class="fa fa-whatsapp"></i> </a>


</section>

<hr class="" style="opacity: 0;"> -->

<section class="container px-4 py-5" id="services">
    <div class="col-md-10 mx-auto">
        <?php
            foreach (Painel::selectWhere('services_provided', 'status=? ORDER BY position ASC',array(1)) as $key => $service) {
             ?>

             <div class="row d-flex justify-content-center">
              <div class="col-md-7 <?= (int)$key%2==0 ? "order-md-2" : "";?>">
                <h3 class="fw-normal"><?= $service['name']; ?></h3>
                <p class="lead"><?= $service['description']; ?></p>
              </div>
              <div class="col-md-5">
                <img class="service-provided-img bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid rounded-4 shadow-lg" width="500" height="400" src="<?php echo INCLUDE_PATH ?>public/images/<?= $service['image']; ?>">
              </div>
            </div>

            <hr class="my-5" style="opacity: 0;">
        
        <?php } ?>
    </div>
</section>

<div class="divider"></div>

<section class="container px-4 py-5">
    <div class=""><h4 class="fw-normal text-center mb-5">Veja quais são as melhores opções para o seu projeto. Desde pequenos, médios a grandes projetos</h4></div>
    <div class=" d-flex justify-content-center flex-wrap">
        <div class="m-2 mb-5 ">
            <img src="<?= INCLUDE_PATH ?>public/images/residencial2.png" class="bd-placeholder-img rounded-2 mb-3 shadow-lg" width="400" height="220">
        </div>

        <div class=" m-2 mb-5 ">
            <img src="<?= INCLUDE_PATH ?>public/images/comercio2.png" class="bd-placeholder-img rounded-2 mb-3 shadow-lg" width="400" height="220">
        </div>

        <div class="m-2 mb-5 ">
            <img src="<?= INCLUDE_PATH ?>public/images/armazem.png" class="bd-placeholder-img rounded-2  mb-3 shadow-lg" width="400" height="220">
        </div>

        <div class="m-2 mb-5 ">
            <img src="<?= INCLUDE_PATH ?>public/images/fazenda.png" class="bd-placeholder-img rounded-2  mb-3 shadow-lg" width="400" height="220">
        </div>
    </div>
    
    <div class="row py-5 p-4 d-flex flex-wrap justify-content-center">

        <?php
        $selectHighlights = Painel::selectWhere('products','highlight = ?',array(1));
        foreach($selectHighlights as $product_highlight){
        ?>
        <div class="card col-sm-3 m-3 card-box-product shadow">
            <img class="card-img-top pb-2" src="<?= INCLUDE_PATH.'public/images/'.$product_highlight['image']; ?>" alt="">
            <div class="card-body pt-5">
                <p class="card-text"><?= $product_highlight['name']; ?></p>
                <p class="card-text fw-bold">R$ <?= Painel::convertMoney($product_highlight['sale_price']); ?> com desconto à vista</p>
                <?php
                        $valor_parcelado = $product_highlight['installment_sale'];
                        $parcela = 6;

                        $valor_parcela = $valor_parcelado / $parcela;
                        ?>
                        <p class="card-text fw-bold mb-4 text-success">ou 6x sem juros de R$ <?= Painel::convertMoney($valor_parcela); ?></p>
                <!-- <p class="card-text">Câmera com todas as novas tecnologias do mercado: Imagem em
                    alta resolução, Microfone e Autofalantes, giro ed 300°, Imagem colorida à noite. A melhor
                    escolha para pequenos projetos onde a infraestrutura requer uma instalação simples.</p> -->
                <div class="btn-group d-flex mx-auto">
                    <a href="produto?id=<?= $product_highlight['id']; ?>" class="btn btn-md btn-outline-dark">Saiba mais</a>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</section>

<div class="divider"></div>

<section class="container px-4 py-5">
    <h2 class="text-danger pb-2 text-center">Leia as seguintes informações abaixo com atenção </h2>
    <hr style="opacity: 0;">
    <h2 class="fw-normal pb-2 text-center">Envio para todo o Brasil</h2>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-sm-2 py-2 p-4 justify-content-center mb-5">
        <div class="border-bottom">
            <p>Realizamos o envio dos produtos através dos correios.</p>
            <p>Logo após a confirmação do pagamento, preparamos os produtos e despachamos até o correio e lhe enviaremos via Whatsapp o código de rastreio.</p>
        </div>
    </div>

    <h2 class="fw-normal pb-2 text-center">Cidades em que realizamos instalações</h2>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-sm-2 py-2 p-4 justify-content-center mb-5">
        <div class="border-bottom">
            <p>Em todas as cidades da região, no raio de distância de até 150km de Tupanciretã.</p>
            <p>Tupanciretã, Quevedos, Jari, Julio de Castilhos, Itaara, Santa Maria, Cruz Alta, Boa Vista do Cadeado</p>
        </div>
    </div>

    <h2 class="fw-normal pb-2 text-center">Manutenções</h2>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-sm-2 py-2 p-4 justify-content-center mb-5">
        <div class="border-bottom">
            <p>Procuramos trabalhar com produtos que requeiram menos manutenção ao decorrer dos anos, como por exemplo
                nossas câmeras IP, que a manutenção delas é praticamente zero.</p>
            <p>Mas é claro quer sempre há chances de precisar dar alguma manutenção, nesse caso damos todo o suporte, o
                valor varia de manutenção para manutenção, e o valor é cobrado separado.</p>
        </div>
    </div>

    <h2 class="fw-normal pb-2 text-center">Suporte</h2>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-sm-2 py-2 p-4 justify-content-center mb-5">
        <div class="border-bottom">
            <p>Você terá todo o suporte que precisa. Caso compre nosso produto sem os serviços de instalação, você conseguirá instalar sem problemas, pois na página de cada produto tem um video de como instalá-lo para lhe auxiliar.</p>
            <p>Procuramos trabalhar com produtos que requeiram menos manutenção ao decorrer dos anos, como por exemplo
                nossas câmeras IP, que a manutenção delas é praticamente zero.</p>
            <p>Mas é claro quer sempre há chances de precisar dar alguma manutenção, nesse caso damos todo o suporte que precisar</p>
        </div>
    </div>

    <h2 class="fw-normal pb-2 text-center">Como faço para comprar ou contratar os serviços?</h2>
    <div class="row row-cols-1 row-cols-sm-1 row-cols-sm-2 py-2 p-4 justify-content-center mb-5">
        <div class="border-bottom">
            <p>Você pode preencher os dados abaixo na sessão "Solicite orçamento", entraremos em contato o mais rápido possível.</p>
            <p>Ou mande uma mensagem no Whatsapp, diga-nos qual o produto você deseja comprar, quantidade e informações de envio, e logo após lhe enviaremos o link de pagamento.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<section class="container">
    <div class="justify-content-center d-flex py-5 p-4">
        <div class="col-md-7">
            <h3 class="fw-normal">Quem está por trás da Diniz Soluções?</h3>
            <p class="lead">Me chamo Tainã Diniz, iniciei a empresa Diniz Soluções em 2020, com foco na parte de vendas de produtos para monitoramento. Com o passar do tempo, fui expandindo para instalações e dar suporte na minha cidade, e após muitas indicações de clientes, passei a instalar em toda a região. <br>
                Hoje em dia presto serviço para toda a região e realizo o envio para todo o Brasil. O foco e objetivo é levar segurança para as casas e comércios com um preço acessível para a maioria. Desde pequenso, médios e grandes projetos.</p>
                <br>
                <p class="lead">Próximo passo é expandir os serviços para mais cidades, e popularizar as vendas em todo o Brasil</p>
            <span class="mb-3 mb-md-0 text-muted">© Diniz Soluções, since 2020</span>
        </div>
        <div class="col-md-3">
            <img class="service-provided-img bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid rounded-circle shadow-lg" width="300" height="200" src="<?php echo INCLUDE_PATH ?>public/images/taina.jpg">
        </div>
    </div>
</section>



<div class="divider"></div>

<section class="px-4 py-5 bg-dark">
    <h2 class="fw-normal pb-2 text-center text-white">Formas de pagamento</h2>
    <div class="d-flex justify-content-center">
        <div class="row p-3 col-md-8">
        <div class="card-body col-sm-1 shadow border border-success mb-3 p-3">
            <p class="d-flex justify-content-center text-success"><i class="fa-brands fa-pix" style="font-size: 20px;"></i></p>
            <p class="fw-normal text-center">Pix</p>  
        </div>

        <div class="card-body col-sm-1 shadow border border-success mb-3 p-3">
            <p class="d-flex justify-content-center text-success"><i class="fa-regular fa-credit-card" style="font-size: 20px;"></i></p>
            <p class="fw-normal text-center">Cartão de crédito até 12x</p>
        </div>

        <div class="card-body col-sm-1 shadow border border-success mb-3 p-3">
            <p class="d-flex justify-content-center text-success"><i class="fa-regular fa-credit-card" style="font-size: 20px;"></i></p>
            <p class="fw-normal text-center">Cartão de débito</p>
        </div>

        <div class="card-body col-sm-1 shadow border border-success mb-3 p-3">
            <p class="d-flex justify-content-center text-success"><i class="fa-sharp fa-solid fa-money-check-dollar" style="font-size: 20px;"></i></p>
            <p class="fw-normal text-center">Boleto</p>
        </div>
    </div>
    </div>
</section>

<div class="divider"></div>

<section class="container py-5">
    <h2 class="fw-normal pb-2 border-bottom text-center mb-5">Trabalhos realizados</h2>
        <div class="row mx-auto">
            <div class="d-flex flex-wrap mx-auto">
                <?php  
                    foreach(Painel::selectAll('jobs_images_registred') as $image){
                      echo '<div class="col-sm m-2 mb-2" style="max-width: 282px; min-width: 282px; min-height: 400px;">
                                <div class="card-image">
                                    <img src="'.INCLUDE_PATH.'/public/images/'.$image['image'].'" style="width: 100%;">
                                    </div>
                                    <div >
                                </div>
                            </div>';
                    }
                ?>
            </div>
        </div>
</section>

<div class="divider"></div>

<section class="px-4 py-5 bg-dark text-secondary text-white">
    <h2 class="fw-normal pb-2 text-center mb-5">Solicite orçamento</h2>
    
    <div class="d-flex justify-content-center">
        <form method="post">
        <div class="form-group m-4">
            <label>Qual seu nome?</label>
            <input type="text" name="client_name" class="form-control" placeholder="Seu nome completo...">
        </div>

        <div class="form-group m-4">
            <label>Instalação em qual cidade?</label>
            <input type="text" name="city" class="form-control" placeholder="Seu nome completo...">
        </div>

        <div class="form-group m-4">
            <label>Zona rural ou urbana?</label>
            <input type="radio" name="zone" value="rural" onchange="showInputRural()"> Rural
            <input type="radio" name="zone" value="urbana" onchange="closeInputRural()"> Urbana
        </div>

        <div class="form-group m-4" id="inputRural" style="display: none;">
            <label>Local fica quantos km da cidade?</label>
            <input type="text" name="distance_from_city" class="form-control" placeholder="Quantos km da cidade?">
        </div>

        <div class="form-group m-4">
            <label>De quantas câmeras você precisa?</label>
            <input type="text" name="cameras_qtd" class="form-control" placeholder="Seu nome completo...">
        </div>

        <div class="form-group m-4">
            <label>Possui internet no local onde as câmeras serão instaladas?</label>
            <input type="radio" name="internet_conection" value="sim"> Sim
            <input type="radio" name="internet_conection" value="nao"> Não
        </div>

        <div class="form-group m-4">
            <label>Deixe uma preve descrição de como você quer a instalação, exemplo: onde você deseja instalar, o que você deseja instalar</label>
            <textarea rows="5" name="description" class="form-control" placeholder="Breve descrição da instalação..."></textarea>
        </div>

        <button type="submit" name="budget_requests" class="btn btn-outline-info d-flex mx-auto">Solicitar orçamento</button>
    </form>
    </div>
</section>

<script type="text/javascript">
    function showInputRural(){
        document.getElementById('inputRural').style.display = 'block';
    }

    function closeInputRural(){
        document.getElementById('inputRural').style.display = 'none';
    }
</script>