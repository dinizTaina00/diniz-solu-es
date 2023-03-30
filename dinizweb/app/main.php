<?php 
    Painel::verificaPermissaoUser(); 
    $configSite = MySql::conectar()->prepare('SELECT * FROM config_site');
    $configSite->execute();
    $configSite = $configSite->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $configSite['company_name']; ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH ?>public/css/app.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://kit.fontawesome.com/37d572b530.css" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/37d572b530.js" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/vVERSION/js/all.js" data-auto-replace-svg="nest"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <script src="<?php echo INCLUDE_PATH ?>public/js/app.js"></script>

</head>

    <script type="text/javascript">
        function toServices(){
            $("html, body").animate({
                scrollTop: $("#services").offset().top
            }, 'fast');
        }

    </script>

<body>

    <a href="https://<?= $configSite['instagram']; ?>" style="bottom:40px;background-color:#833AB4;" class="icon-social-media-fixed" target="_blank">
            <i style="margin-top:16px" class="fa fa-instagram"></i>
    </a>

    <br>

    <a href="https://wa.me/<?= $configSite['whatsapp']; ?>?text=Ol%C3%A1%2C+gostaria+de+realizar+um+or%C3%A7amento." class="icon-social-media-fixed" target="_blank">
            <i style="margin-top:16px" class="fa fa-whatsapp"></i>
    </a>

    <main>
        <div class="container">
            <header class="d-flex flex-wrap justify-content-center py-4 mb-4 border-bottom">
              <div class="mobile-menu">
                <nav class="navbar bg-body-tertiary fixed-top" style="background-color: white;">
                    <div class="container-fluid">
                        <a id="navbar-brand" class="navbar-brand m-3" href="#"><img src="<?= INCLUDE_PATH ?>public/images/brand2.png" width="250"></a>
                        <!-- <a id="navbar-brand-mobile" class="navbar-brand m-3" style="display: none;" href="#"><img src="<?= INCLUDE_PATH ?>public/images/brand2.png" width="180"></a> -->

                        <button class="btn btn-default" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                          Menu <i class="fa-solid fa-bars" style="font-size: 25px;"></i>
                        </button>
                    </div>
                </nav>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="" style="width: 300px;">
                      <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?= $configSite['company_name']; ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>
                      <div class="offcanvas-body">
                        <ul class="navbar-nav m-5">
                            <li class="nav-item d-flex "><a href="<?php echo INCLUDE_PATH_APP ?>home" class="nav-link">Home</a>
                            </li>
                            <!-- <li class="nav-item d-flex "><a onclick="toServices()" class="nav-link">Serviços</a></li> -->
                            <li class="nav-item d-flex "><a href="<?php echo INCLUDE_PATH_APP ?>produtos" class="nav-link">Produtos</a></li>
                            <li class="nav-item d-flex "><a href="<?php echo INCLUDE_PATH_APP ?>suporte" class="nav-link">Suporte</a></li>
                            <li class="nav-item d-flex "><a href="<?php echo INCLUDE_PATH_APP ?>quem-somos" class="nav-link">Quem somos</a></li> 
                            <li class="nav-item d-flex "><a href="<?php echo INCLUDE_PATH_APP ?>contato" class="nav-link">Contato</a></li> 
                            <?php if(isset($_SESSION['login']) && $_SESSION['permissao'] == 0){ ?>
                                <li class="nav-item d-flex "><a href="<?php echo INCLUDE_PATH_APP ?>?loggout" class="btn btn-sm btn-default"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
                            <?php }else{ ?>
                                <li class="nav-item d-flex "><a href="<?php echo INCLUDE_PATH_APP ?>login" class="btn btn-outline-info me-1 mb-3">Acessar</a></li>
                                <!-- <li class="nav-item d-flex "><a href="<?php echo INCLUDE_PATH_APP ?>cadastro" class="btn btn-outline-info">Cadastrar</a></li> -->
                            <?php } ?>
                        </ul>
                      </div>
                </div>
              </div>

              <!-- <div class="desktop-menu">
                  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto">
                     <img class="logo mx-auto" src="<?php echo INCLUDE_PATH ?>public/images/brand4.png" alt="">
                  </a>

                  <ul class="nav nav-pills">
                        <li class="nav-item"><a href="<?php echo INCLUDE_PATH_APP ?>home" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item"><a onclick="toServices()" class="nav-link">Serviços</a></li>
                        <li class="nav-item"><a href="<?php echo INCLUDE_PATH_APP ?>produtos" class="nav-link">Produtos</a></li>
                        <li class="nav-item"><a href="<?php echo INCLUDE_PATH_APP ?>suporte" class="nav-link">Suporte</a></li>
                        <li class="nav-item"><a href="<?php echo INCLUDE_PATH_APP ?>contato" class="nav-link">Contato</a></li> 
                        <?php if(isset($_SESSION['login']) && $_SESSION['permissao'] == 0){ ?>
                            <li class=""><a href="<?php echo INCLUDE_PATH_APP ?>?loggout" class="btn btn-sm btn-dark me-1"><i class="fa-solid fa-right-from-bracket mx-3"></i> Sair</a></li>
                        <?php }else{ ?>
                            <li class="nav-item"><a href="<?php echo INCLUDE_PATH_APP ?>login" class="btn btn-outline-info me-1">Logar</a></li>
                            <li class="nav-item"><a href="<?php echo INCLUDE_PATH_APP ?>cadastro" class="btn btn-outline-info">Cadastrar</a></li>
                        <?php } ?>
                  </ul>
              </div> -->
            </header>
        </div>

    </main>

        <div class="container-main content mt-5">

            <?php 
                Painel::loadPageApp();
            ?>

        </div>

        <section class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                    <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                        <svg class="bi" width="30" height="24">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    <span class="mb-3 mb-md-0 text-muted">© Diniz Soluções, since 2020  </span>
                </div>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#twitter"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#instagram"></use>
                            </svg></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                                <use xlink:href="#facebook"></use>
                            </svg></a></li>
                </ul>
            </footer>
        </section>

</body>

</html>