<section class="py-5 container text-center">
    <div class="col-lg-8 col-md-8 mx-auto">
        <div class="container-fluid">
            <h1 class="display-7" style="font-weight: 300;">Suporte</h1>
            <p class="fs-3" style="font-weight: 300;">Aqui você vai encontrar a solução para qualquer dúvida que está
                tendo referente a
                instalação do aplicativo, criação de contas, instalação das câmeras no aplicativo e muito mais.</p>
        </div>
    </div>
</section>

<div class="divider"></div>

<section class="container mb-5 p-4">
    <h1 class="display-7 border-bottom mb-3" style="font-weight: 300;">Tutoriais</h1>

    <div class="row row-cols">

        <?php
        $selectTutoriais = Painel::selectAll('tutorials');
        foreach($selectTutoriais as $tutorial){
        ?>

        <div class="card mt-5 m-2 shadow" style="max-width: 600px;">
            <div class="row card-box-product">
                <div class="row g-0 overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static card-body-product">
                        <h5 class="mt-3" style="font-weight: 400;"><?= $tutorial['title']; ?></h5>
                        <!-- <p class="card-text mb-auto" style="font-weight: 400;">This is a wider card with supporting text
                        below as
                        a natural
                        lead-in to
                        additional content.</p> -->
                        <a href="tutorial?id=<?= $tutorial['id']; ?>" class="stretched-link text-decoration-none">Ver tutorial</a>
                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="200" height="200" xmlns="http://www.w3.org/2000/svg"
                            role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="200"
                                width="200" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</section>

<div class="divider"></div>