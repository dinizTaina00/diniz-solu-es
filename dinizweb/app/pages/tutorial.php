<?php
    if(isset($_GET['id'])){
        $tutorial = Painel::select('tutorials','id = ?',array($_GET['id']));
        //echo "<script>window.alert('".$id."')</script>";
    }else{
        Painel::alert('err','Produto não encontrado');
        die();
    }
?>

<section class="container py-5 px-5">
    <div class="col-lg-8 col-md-8 mx-auto">
        <h4 title="display-7"><?= $tutorial['title'] ?></h4>
    </div>
</section>

<!-- Video -->
<section class="container">
    <div id="scrollVideos">
        <div class="col-md-10 mx-auto">
            <div class="">
                <div class="p-5">
                    <iframe id="video" width="728" height="350" src="<?php echo $tutorial['url_video']; ?>" title="YouTube video player"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container mb-5 py-5 px-5">

    <div class="mb-5 border-bottom col-lg-8 mx-auto">
        <h5 class="" style="font-weight: 300;">Passo n° 1</h5>
        <div class="row ">

            <div class="">
                <div class="row flex-md-row h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static mt-5">
                        <h5>Baixar o aplicativo</h5>
                        <p class="card-text">Vá até a PlayStore caso seja Android, ou AppleStore, caso seja
                            Apple.
                        </p>
                        <p class="card-text">Pesquise pelo aplicativo ICSee e clique em instalar.
                        </p>
                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="400" height="400" xmlns="http://www.w3.org/2000/svg"
                            role="img">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="300"
                                width="300" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 border-bottom col-lg-8 mx-auto">
        <h5 class="" style="font-weight: 300;">Passo n° 2</h5>
        <div class="row">

            <div class="">
                <div class="row flex-md-row h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static mt-5">
                        <h5>Abrir o aplicativo</h5>
                        <p class="card-text">- Após a instalação finalizar, abra o aplicativo.
                        </p>
                        <p class="card-text">- Caso apareça essa tela pra você. Clique no botão "IR PARA O APP" na parte superior da tela.
                        </p>
                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="400" height="400" xmlns="http://www.w3.org/2000/svg"
                            role="img">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="300"
                                width="300" />
                        </svg>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 border-bottom col-lg-8 mx-auto">
        <h5 class="" style="font-weight: 300;">Passo n° 3</h5>
        <div class="row">

            <div class="">
                <div class="row flex-md-row h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static mt-5">
                        <h5>Criar a conta</h5>
                        <p class="card-text">- Essa é a tela inicial do aplicativo. Para criar uma nova conta clique no botão "PARA SE REGISTRAR" no canto superior direito da tela.
                        </p>
                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="400" height="400" xmlns="http://www.w3.org/2000/svg"
                            role="img">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="300"
                                width="300" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 border-bottom col-lg-8 mx-auto">
        <h5 class="" style="font-weight: 300;">Passo n° 4</h5>
        <div class="row">

            <div class="">
                <div class="row flex-md-row h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static mt-5">
                        <h5>Concordar com as politicas de privacidade</h5>
                        <p class="card-text ">- Irá aparecer uma mensagem na sua tela, para concordar com as
                            politicas de privacidade do aplicativo, clique no botão do lado direito escrito "AGREE".
                        </p>
                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="400" height="400" xmlns="http://www.w3.org/2000/svg"
                            role="img">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="300"
                                width="300" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 border-bottom col-lg-8 mx-auto">
        <h5 class="" style="font-weight: 300;">Passo n° 5</h5>
        <div class="row ">

            <div class="">
                <div class="row flex-md-row h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static mt-5">
                        <h5>Digite seu endereço de e-mail de uso</h5>
                        <p class="card-text">- Clique no campo escrito "Please, enter the correct email address"
                            e
                            digite seu e-mail de uso. </p>
                        <p class="card-text">- E depois clique em "Próxima etapa".</p>
                        </p>
                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="400" height="400" xmlns="http://www.w3.org/2000/svg"
                            role="img">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="300"
                                width="300" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 border-bottom col-lg-8 mx-auto">
        <h5 class="" style="font-weight: 300;">Passo n° 6</h5>
        <div class="row">

            <div class="">
                <div class="row flex-md-row h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static mt-5">
                        <h5>Digitar o código de verificação</h5>
                        <p class="card-text ">- Após de ter digitado o e-mail o aplicativo irá enviar um código
                            de verificação pro seu e-mail. </p>
                        <p class="card-text">- No nome de Service. </p>
                        <p class="card-text"> - Digite o código de verificação na tela. </p>
                        </p>
                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="400" height="400" xmlns="http://www.w3.org/2000/svg"
                            role="img">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="300"
                                width="300" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 border-bottom col-lg-8 mx-auto">
        <h5 class="" style="font-weight: 300;">Passo n° 7</h5>
        <div class="row ">

            <div class="">
                <div class="row flex-md-row h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static mt-5">
                        <h5>Registrar um Nome de Usuário e Senha</h5>
                        <p class="card-text">- Nessa etapa você irá criar um UserName (nome de usuário) e uma
                            Password (senha) pra que consiga acessar o aplicativo futuramente</p>
                        <p class="card-text"> - No primeiro campo "UserName" digite um nome de usuario. Por exemplo,
                            joaodasilva0908.
                            - No campo abaixo, digite a senha. Certifique-se que a senha tenha pelo menos 6 letras e 2
                            numeros. </p>
                        <p class="card-text"> - Depois clique no botão Finalizar. </p>
                        </p>
                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="400" height="400" xmlns="http://www.w3.org/2000/svg"
                            role="img">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="300"
                                width="300" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 border-bottom col-lg-8 mx-auto">
        <div>
            <h5 class="" style="font-weight: 300;">Passo n° 8</h5>
            <div class="row ">

                <div class="">
                    <div class="row flex-md-row h-md-250 position-relative">
                        <div class="col d-flex flex-column position-static mt-5">
                            <h5>Iniciar a sessão</h5>
                            <p class="card-text ">- Após criar a conta, o aplicativo irá voltar para a tela inicial
                                com as suas informações de acesso.</p>
                            <p class="card-text ">- Basta você clicar em "Iniciar Sessão".</p>
                            </p>
                        </div>
                        <div class="col-auto">
                            <svg class="bd-placeholder-img" width="400" height="400" xmlns="http://www.w3.org/2000/svg"
                                role="img">
                                <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="300"
                                    width="300" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</section>