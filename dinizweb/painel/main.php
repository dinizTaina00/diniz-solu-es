<?php 
if (isset($_GET['loggout'])) {
    Painel::loggout();
}

Painel::verificaPermissaoAdmin();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>

    <!-- <script src="https://use.fontawesome.com/releases/vVERSION/js/all.js" data-auto-replace-svg="nest"></script> -->

    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH ?>public/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH ?>public/css/painel.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- <link rel="stylesheet" href="https://kit.fontawesome.com/37d572b530.css" crossorigin="anonymous"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script> -->

   <!--  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script> -->

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>   -->

    <!-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> -->

</head>

<body>

    <div id="sidenav" class="sidenav">
        <a href="javascript:void(0)" class="sidenav-close" onclick="closeNav()">&times;</a>
        <div class="sidenav-logo">
            <p><span class="nameOne-logo">Diniz</span> <span class="nameTwo-logo">Soluções</span></p>
        </div>
        <div class="sidenav-items">
            <a href="<?= INCLUDE_PATH_PAINEL; ?>"><i class="fa-solid fa-house mx-2"></i> Home</a>
            <a href="services"><i class="fa-solid fa-screwdriver-wrench mx-2"></i> Serviços</a>
            <a href="products"> <i class="fa-solid fa-store mx-2"></i> Produtos</a>
            <a href="storages"> <i class="fa-solid fa-store mx-2"></i> Armazenamentos</a>
            <a href="categories"> <i class="fa-solid fa-list mx-2"></i> Categorias</a>
            <a href="tutorials"> <i class="fa-solid fa-person-chalkboard mx-2"></i> Tutoriais</a>
            <a href="material-installation"> <i class="fa-solid fa-screwdriver-wrench mx-2"></i> Materiais de instalação</a>

            <hr style="color: white;">

            <a href="images-jobs-registred"> <i class="fa-solid fa-images mx-2"></i> Imagens registradas</a>

            <a href="jobs-done"> <i class="fa-solid fa-person-chalkboard mx-2"></i> Trabalhos realizados</a>

            <a href="config-site"> <i class="fa-solid fa-gear mx-2"></i> Configurações</a>
            <a href="?loggout"> <i class="fa-solid fa-right-from-bracket mx-2"></i> Sair</a>
        </div>
    </div>


    <div class="main-panel" id="main-panel">

        <div class="panel-header panel-header-sm">
            <span class="openNavSpan" id="openNavSpan" onclick="openNav()">&#9776;</span>
        </div>

        <?php Painel::loadPagePainel(); ?>

    </div>

    <script src="<?= INCLUDE_PATH ?>public/js/jquery.js"></script>
    <script src="<?= INCLUDE_PATH ?>public/js/jquery.mask.js"></script>
    <script src="<?= INCLUDE_PATH ?>public/js/jquery.ajaxform.js"></script>
    <script src="<?= INCLUDE_PATH ?>public/js/ajax.js"></script>
    <script src="https://kit.fontawesome.com/37d572b530.js" crossorigin="anonymous"></script>
    <script src="<?= INCLUDE_PATH.'public/js/forms-animate.js' ?>"></script>
</body>

</html>