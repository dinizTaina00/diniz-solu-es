<?php
	
	$configSite = MySql::conectar()->prepare('SELECT * FROM config_site');
	$configSite->execute();
	$configSite = $configSite->fetch();

	if (isset($_POST['att_configSite'])) {
		$company_name = $_POST['company_name'];
		$cnpj = $_POST['cnpj'];
		
		if($_POST['whatsapp'] == ""){
			$whatsapp = "";
		}else{
			$whatsapp = $_POST['whatsapp'];
		}

		if($_POST['facebook'] == ""){
			$facebook = "";
		}else{
			$facebook = $_POST['facebook'];
		}

		if($_POST['instagram'] == ""){
			$instagram = "";
		}else{
			$instagram = $_POST['instagram'];
		}

		$simple_installation = $_POST['simple_installation_price'];
		$wired_installation = $_POST['wired_installation_price'];

		$select = MySql::conectar()->prepare("SELECT * FROM config_site");
		$select->execute();

		if($select->rowCount() > 0){
			$update = MySql::conectar()->prepare("UPDATE config_site SET company_name=?,cnpj=?,whatsapp=?,facebook=?,instagram=?,simple_installation_price=?,wired_installation_price=? WHERE company_name = ?");
			$update->execute(array($company_name,$cnpj,$whatsapp,$facebook,$instagram,$simple_installation,$wired_installation,$configSite['company_name']));
			Painel::alert('success','Informações atualizadas');
			Painel::refresh();
		} else{
			$update = MySql::conectar()->prepare("INSERT INTO config_site VALUES (null,?,?,?,?,?,?,?)");
			$update->execute(array($company_name,$cnpj,$whatsapp,$facebook,$instagram,$simple_installation,$wired_installation));
			Painel::alert('success','Informações cadastradas');
			Painel::refresh();
		}

	}

	if (isset($_POST['update_imgBanner'])) {
			$image = $_FILES['img_banner'];
            $success = true;

            $image = ['type'=>$_FILES['img_banner']['type']];
            if(Painel::validImage($image) == false){
                $success = false;
                Painel::alert("err","A imagem não é válida");
                die();
            }

            if($success){
                $image = ['tmp_name' => $_FILES['img_banner']['tmp_name'], 'name' => $_FILES['img_banner']['name']];
                $img = Painel::uploadFile($image);
            }

            $update = MySql::conectar()->prepare("UPDATE config_site SET img_banner = ? WHERE company_name = ?");
			$update->execute(array($img,$configSite['company_name']));
			Painel::alert('success','Banner atualizado');
			Painel::refresh();
	}
?>

<section class="container my-5">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<h5 class="title+">Configurações do site</h5>
			</div>

			<div class="card-body">
				<form method="post">
					<div class="container my-4">
						<h5 class="">Informações sobre a loja</h5>
						<div class="row col mb-3">
							<div class="form-group">
								<label>Nome da empresa</label>
								<input type="text" name="company_name" class="form-control" value="<?= $configSite['company_name']; ?>" required>
							</div>
						</div>

						<div class="row col mb-3">
							<div class="form-group">
								<label>CNPJ</label>
								<input type="text" name="cnpj" class="form-control" value="<?= $configSite['cnpj']; ?>" required>
							</div>
						</div>
					</div>

					<hr>

					<div class="container my-4">
						<h5 class="">Redes Sociais</h5>
						<div class="row col mb-3">
							<div class="form-group">
								<label>Whatsapp</label>
								<input type="text" name="whatsapp" class="form-control" value="<?= $configSite['whatsapp']; ?>">
							</div>
						</div>

						<div class="row col mb-3">
							<div class="form-group">
								<label>Facebook</label>
								<input type="text" name="facebook" class="form-control" value="<?= $configSite['facebook']; ?>">
							</div>
						</div>

						<div class="row col mb-3">
							<div class="form-group">
								<label>Instagram</label>
								<input type="text" name="instagram" class="form-control" value="<?= $configSite['instagram']; ?>">
							</div>
						</div>
					</div>

					<hr>

					<div class="container my-4">
						<h5 class="">Informações de instalação</h5>
						<div class="row col mb-3">
							<div class="form-group">
								<label>Valor da instalação simples</label>
								<div class="input-group">
									 <div class="input-group-prepend">
									    <span class="input-group-text">$</span>
									  </div>
								<input type="text" name="simple_installation_price" class="form-control" value="<?= $configSite['simple_installation_price']; ?>">
								</div>
							</div>
						</div>

						<div class="row col mb-3">
							<div class="form-group">
								<label>Valor da instalação cabeada</label>
								<div class="input-group">
									 <div class="input-group-prepend">
									 	<span class="input-group-text">$</span>
									 </div>
								<input type="text" name="wired_installation_price" class="form-control" value="<?= $configSite['wired_installation_price']; ?>">
								</div>
							</div>
						</div>
					</div>

					<div class="row col">
						<div class="form-group">
							<input type="submit" name="att_configSite" value="Atualizar informações" class="btn btn-info">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<section class="container">
	<div class="col-md-8">
		<div class="card mb-3">
			<div class="card-header">
				<h5 class="title">Imagem banner</h5>
			</div>
			<div class="card-body">
				<img src="<?= INCLUDE_PATH.'public/images/'.$configSite['img_banner']; ?>" style="width: 100%;">
			</div>
		</div>

		<div class="row form-group">
			<form method="post" enctype="multipart/form-data">
				<input type="file" name="img_banner" class="form-control" required>
				<br>
				<input type="submit" name="update_imgBanner" value="Atualizar banner" class="btn btn-info">
			</form>
		</div>
	</div>
</section>