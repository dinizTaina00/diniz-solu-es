<section class="container col-xl-11 col-xxl-9 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h3 class="display-6 mb-4" id="title_login_container">Acesse sua conta para ter mais informações e adquirir nossos produtos e serviços</h3>
        <h3 class="display-6 mb-4" id="title_register_container" style="display: none;">Cadastre para ter mais informações e adquirir nossos produtos e serviços</h3>
        <!-- <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> -->
      </div>
      <div class="col-md-10 mx-auto col-lg-5" id="register_container">
        <form class="p-4 p-md-5 border rounded-3 bg-light" method="post">
          <div class="form-floating mb-3">
            <input type="text" name="nome_completo" class="form-control" id="floatingInput" placeholder="nome de acesso">
            <label for="floatingInput">Nome Completo</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" name="num_contato" class="form-control" id="floatingInput" placeholder="nome de acesso">
            <label for="floatingInput">Número para contato (com seu ddd)</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" name="nome_acesso" class="form-control" id="floatingInput" placeholder="nome de acesso">
            <label for="floatingInput">Nome de acesso</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="senha_acesso" class="form-control" id="Nome de acesso" placeholder="Password">
            <label for="floatingPassword">Senha de acesso</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Lembre-me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" name="register" type="submit">Iniciar sessão</button>
          <hr class="my-4">
          <small class="">Já possui uma conta? <a href="login">Iniciar sessão aqui</a></small>
        </form>
      </div>
    </div>

    <div class='d-flex justify-content-center text-center'>
      <?php
          if (isset($_POST['register'])) {
              $nome_completo = $_POST['nome_completo'];
              $num_contato = $_POST['num_contato'];
              $nome_acesso = $_POST['nome_acesso'];
              $senha_acesso = MD5($_POST['senha_acesso']);

              $query = MySql::conectar()->prepare("SELECT * FROM users WHERE access_name = ?");
              $query->execute(array($nome_acesso));

              if ($query->rowCount() > 0) {
                echo '<div>'.Painel::alert("warning","Esse nome de usuário já está cadastrado").'</p></div>';
              }else{
                $insert = MySql::conectar()->prepare("INSERT INTO users VALUES (null,?,?,?,?,?)");
                $insert->execute(array($nome_completo,$num_contato,$nome_acesso,$senha_acesso,0));
                Painel::redirect('login');
              }
            }
        ?>
  </div>
  </section>