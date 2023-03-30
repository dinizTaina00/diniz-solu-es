<?php 
if (isset($_POST['deleteService'])) {
	$id = $_POST['id'];
	$image = $_POST['image'];
	Painel::delete('services_provided','id='.$id);
	@unlink(ROOT.'public/images/'.$image);
}
?>

<section class="container my-4" style="z-index: 1;">

<?php 

include 'formAdd-service.php';

if (isset($_POST['btnAddService'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$position = $_POST['position'];

		$image = $_FILES['image'];
		$success = true;

		$image = ['type'=>$_FILES['image']['type']];
		if(Painel::validImage($image) == false){
			$success = false;
			Painel::alert('err','Imagem inválida');
		} else{
			$searchService = MySql::conectar()->prepare("SELECT * FROM services_provided WHERE name = ?");
			$searchService->execute(array($name));

			if ($searchService->rowCount() == 1) {
				Painel::alert('err', 'O serviço '.$name.' já está cadastrado');
			} else{
				$image = ['tmp_name'=>$_FILES['image']['tmp_name'], 'name'=>$_FILES['image']['name']];
				$img = Painel::uploadFile($image);

				$insert = MySql::conectar()->prepare("INSERT INTO services_provided VALUES (null,?,?,?,?,?)");
				$insert->execute(array($name,$description,$img,$position,1));
				Painel::alert('success','Serviço cadastrado com sucesso');
			}			
		}

	}	
?>
</section>


<?php 
	if(isset($_POST['btnEditService'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$status = $_POST['status'];
		$position = $_POST['position'];

		$success = true;

		if($_FILES['image']['error'] == 4){
			$img = $_POST['current_image'];
		} else{
			$image = ['type'=>$_FILES['image']['type']];
			if (Painel::validImage($image) == false) {
				$success = false;
				Painel::alert('err','Imagem inválida');
			} else{
				$image = ['tmp_name'=>$_FILES['image']['tmp_name'], 'name'=>$_FILES['image']['name']];
				$img = Painel::uploadFile($image);
			}
		}

				$insert = MySql::conectar()->prepare("UPDATE services_provided SET name = ?, description = ?, image = ?, status = ?, position = ? WHERE id = ?");
				$insert->execute(array($name,$description,$img,$status,$position,$id));
				Painel::alert('success','Serviço atualizado com sucesso');
	}
?>

<section class="container my-5">
	<div class="row">
		<div class="">
			<div class="card-body col-md-8" style="position: absolute; z-index: -1;">
				<?php
				$selectAllServices_provided = Painel::selectAllOrder('services_provided', 'position ASC');
				foreach($selectAllServices_provided as $service){
				?>

				<div class="" id="cardbody-services<?= $service['id']; ?>">
					<div class="card shadow mb-4">
						<div class="card-body p-4">
							<div class="row">
								<div class="col-md-8">
									<p><?= $service['name']; ?></p>

									<p><?= $service['description']; ?></p>

									<p><?= $service['status'] == 1 ? "Ativo" : "Desativado"; ?></p>

									<a onclick="showEditService<?= $service['id']; ?>()" class="btn btn-outline-info my-3">Atualizar</a>

									<form method="post">
										<input type="hidden" name="id" value="<?= $service['id']; ?>">
										<input type="hidden" name="image" value="<?= $service['image']; ?>">
										<button type="submit" name="deleteService" class="btn btn-sm btn-danger">
											<i class="fa-solid fa-trash"></i>
										</button>
									</form>
								</div>
								<div class="col">
									<img src="<?= INCLUDE_PATH ?>public/images/<?= $service['image']; ?>" style="width: 100%;">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="" id="cardbody-editService<?= $service['id']; ?>" style="display: none;">
					<div class="card shadow mb-4">
						<div class="card-body p-5">
							<form method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-10">
										<div class="row form-group mb-3">
											<label>Título</label>
											<input type="text" name="name" value="<?= $service['name']; ?>" class="form-control">
										</div>

										<div class="row form-group mb-3">
											<label>Descrição</label>
											<textarea class="form-control" name="description" rows="3"><?= $service['description']; ?></textarea>
										</div>

										<div class="row form-group mb-3">
											<label>Imagem</label>
											<input type="file" name="image" class="form-control">
										</div>

										<div class="row form-group mb-3">
											<label>Status</label>
											<select name="status" class="form-control">
												<option value="1" <?= $service['status'] == 1 ? "selected" : "" ?>>Ativo</option>
												<option value="1" <?= $service['status'] == 0 ? "selected" : "" ?>>Desativado</option>
											</select>
										</div>

										<div class="row form-group mb-3">
											<label>Posição na sessão</label>
											<input type="text" name="position" value="<?= $service['position']; ?>" class="form-control">
										</div>
									</div>

									<div class="col">
										<img src="<?= INCLUDE_PATH ?>public/images/<?= $service['image']; ?>" style="width: 100%;">
									</div>
								</div>

								<input type="hidden" name="id" value="<?= $service['id']; ?>">

								<input type="hidden" name="current_image" value="<?= $service['image']; ?>">
								
								<input class="mb-3 btn btn-info" type="submit" name="btnEditService" value="Editar informações do serviço">

							</form>

							<a onclick="cancelEditService<?= $service['id']; ?>()" class="my-3">Cancelar</a>

						</div>
					</div>
				</div>

				<script type="text/javascript">

					function showEditService<?= $service['id']; ?>(){
						document.getElementById('cardbody-editService<?= $service['id']; ?>').setAttribute('class', 'animate__animated animate__slideInLeft');
						document.getElementById('cardbody-services<?= $service['id']; ?>').style.display = 'none';
						document.getElementById('cardbody-editService<?= $service['id']; ?>').style.display = 'block';
					}

					function cancelEditService<?= $service['id']; ?>(){
						document.getElementById('cardbody-editService<?= $service['id']; ?>').setAttribute('class', 'animate__animated animate__slideOutLeft animate__faster');
						setTimeout(function(){
							document.getElementById('cardbody-services<?= $service['id']; ?>').setAttribute('class', 'animate__animated animate__slideInRight');
							document.getElementById('cardbody-services<?= $service['id']; ?>').style.display = 'block';
							document.getElementById('cardbody-editService<?= $service['id']; ?>').style.display = 'none';
						},300)
					}
				</script>

				<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
