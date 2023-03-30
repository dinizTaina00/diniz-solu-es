<?php 
    Painel::verificaPermissaoUser(); 
    $configSite = MySql::conectar()->prepare('SELECT * FROM config_site');
    $configSite->execute();
    $configSite = $configSite->fetch();
?>

<div class="container py-4">

    <!-- <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><span style="color: green;"><i style="margin-top:16px" class="fa fa-whatsapp"></i></span> Whatsapp</h1>
        <p class="col-md-8 fs-4">.</p>
        <button class="btn btn-primary btn-lg" type="button">Example button</button>
      </div>
    </div> -->

    <div class="row align-items-md-stretch">
      
      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2 class="display-5 fw-bold"><span style="color: green;"><i style="margin-top:16px" class="fa fa-whatsapp"></i></span> Whatsapp</h2>
          <p>Entre em contato com nosso Whatsapp para tirar suas dúvidas ou realizar orçamento. Retornaremos sua mensagem o mais rápido possível.</p>
          <a href="https://wa.me/<?= $configSite['whatsapp']; ?>?text=Ol%C3%A1%2C+gostaria+de+realizar+um+or%C3%A7amento." target="_blank" class="btn btn-outline-light" type="button">Entrar em contato</a>
        </div>
      </div>

      <hr style="opacity: 0;">

      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2 class="display-5 fw-bold"><span style="color: #833AB4;"><i style="margin-top:16px" class="fa fa-instagram"></i></span> Instagram</h2>
          <p>Siga nosso perfil no Instagram e fique ligado nas nossas postagens e stories e para ficar por dentro das novidades.</p>
          <a href="https://<?= $configSite['instagram']; ?>" target="_blank" class="btn btn-outline-light" type="button">Ver perfil</a>
        </div>
      </div>

      <hr style="opacity: 0;">

      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2 class="display-5 fw-bold"><span style="color: #4267B2;"><i style="margin-top:16px" class="fa-brands fa-facebook"></i></span> Facebook</h2>
          <p>Na nossa página do Facebook publimas muitas novidades e videos explicando, tirando dúvidas e mostrando funcionamento dos produtos.</p>
          <a href="https://<?= $configSite['instagram']; ?>" target="_blank" class="btn btn-outline-light" type="button">Ver perfil</a>
        </div>
      </div>

    </div>

    <footer class="pt-3 mt-4 text-muted border-top">
      © 2022
    </footer>
  </div>