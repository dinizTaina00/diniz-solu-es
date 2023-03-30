<section class="container col-xl-11 col-xxl-9 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h3 class="display-6 mb-4" id="title_login_container">Acesse sua conta para ter mais informações e adquirir nossos produtos e serviços</h3>
        <h3 class="display-6 mb-4" id="title_register_container" style="display: none;">Cadastre para ter mais informações e adquirir nossos produtos e serviços</h3>
        <!-- <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p> -->
      </div>
      <div class="col-md-10 mx-auto col-lg-5" id="login_container">
        <form class="p-4 p-md-5 border rounded-3 bg-light" method="post">
          <div class="form-floating mb-3">
            <input type="text" name="nome_acesso" class="form-control" id="floatingInput" placeholder="nome de acesso">
            <label for="floatingInput">Nome de acesso</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="senha" class="form-control" id="Nome de acesso" placeholder="Password">
            <label for="floatingPassword">Senha de acesso</label>
          </div>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Lembre-me
            </label>
          </div>
          <button class="w-100 btn btn-lg btn-primary" name="login" type="submit">Iniciar sessão</button>
          <hr class="my-4">
          <small class="">Não tem uma conta ainda? <a href="cadastro">Cadastre-se aqui</a></small>
        </form>
      </div>
    </div>

	<div class='d-flex justify-content-center text-center'>
			<?php if(isset($_SESSION['loginerro'])) { 
				Painel::alert('warning','Informações de acesso incorretas'); 
				unset($_SESSION['loginerro']);
			}  ?>	
	</div>
</section>

<?php
	
if(isset($_POST['login'])){
	$nome_acesso = $_POST['nome_acesso'];
	$senha_acesso = MD5($_POST['senha']);

	$query = MySql::conectar()->prepare("SELECT * FROM users WHERE access_name = ? AND access_password = ?");
	$query->execute(array($nome_acesso,$senha_acesso));

	if($query->rowCount() == 1){
		$usuario = $query->fetch();

		$_SESSION['login'] = true;
		$_SESSION['id_user'] = $usuario['id'];
		$_SESSION['nome_acesso'] = $usuario['access_name'];
		$_SESSION['senha_acesso'] = $usuario['access_password'];
		$_SESSION['permissao'] = $usuario['permission'];

		$configSite = MySql::conectar()->prepare('SELECT * FROM config_site');
	    $configSite->execute();
	    $configSite = $configSite->fetch();

	    $_SESSION['company_name'] = $configSite['company_name'];
	    $_SESSION['cnpj'] = $configSite['cnpj'];
	    $_SESSION['whatsapp'] = $configSite['whatsapp'];
	    $_SESSION['facebook'] = $configSite['facebook'];
	    $_SESSION['instagram'] = $configSite['instagram'];
	    $_SESSION['img_banner'] = $configSite['img_banner'];
	    $_SESSION['wired_installation_price'] = $configSite['wired_installation_price'];
	    $_SESSION['simple_installation_price'] = $configSite['simple_installation_price'];

		if($usuario['permission'] == 0){
			Painel::redirect(INCLUDE_PATH_APP);
		} else{
			Painel::redirect(INCLUDE_PATH_PAINEL.'home');
		}
	} else{
		$_SESSION['loginerro'] = 1;
	}
}

?>