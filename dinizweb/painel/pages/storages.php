<?php 
	

	if (isset($_GET['deleteStorage'])) {
		$id = $_GET['deleteStorage'];
		Painel::delete('storages','id = '.$id);
	}

	if (isset($_POST['edit_category'])) {
		$title = $_POST['title'];
		$size = $_POST['size'];
		$cost_price = $_POST['cost_price'];
		$sale_price = $_POST['sale_price'];
		$id = $_POST['id'];

		$query = MySql::conectar()->prepare("SELECT * FROM storages WHERE title = ?");
		$query->execute(array($title));

		$insert = MySql::conectar()->prepare("UPDATE storages SET title = ?, size = ?, cost_price = ?, sale_price = ? WHERE id = ?");
		$insert->execute(array($title,$size,$cost_price,$sale_price,$id));
		
	}
?>

<section class="container my-4" style="z-index: 1;">
	
	<?php include 'formAdd-storage.php'; ?>

</section>

<section class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card-body">
				<div class="justify-content-center">
					<?php 
					$selectAllStorages = Painel::selectAll('storages');
					foreach($selectAllStorages as $storage){
					?>

						<div class="my-2 p-2" id="cardbody-storage<?= $storage['id']; ?>">
							<div class="card shadow">
								<div class="card-body text-center">
									<p><?= $storage['title']; ?></p>
									<p>Custo de R$<?= Painel::convertMoney($storage['cost_price']); ?></p>
									<p>Venda R$<?= Painel::convertMoney($storage['sale_price']); ?></p>

									<a onclick="showEditStorage<?= $storage['id']; ?>()" class="btn btn-sm btn-outline-dark text-decoration-none mx-2">Atualizar</a>

									<a href="?deleteStorage=<?= $storage['id']; ?>" class="btn btn-sm btn-outline-danger text-decoration-none">Excluir</a>
								</div>
							</div>
						</div>

							<div class="my-5 p-2" id="cardbody-editStorage<?= $storage['id']; ?>" style="display: none;">
								<div class="card shadow">
									<div class="card-body text-center">
										<form method="post">
											<input type="text" name="title" value="<?= $storage['title']; ?>" class="mb-3 form-control" >
											<br>
											<input type="text" name="size" value="<?= $storage['size']; ?>" class="mb-3 form-control">
											<br>
											Custo R$<input type="text" name="cost_price" value="<?= $storage['cost_price']; ?>" class="mb-3 form-control">
											<br>
											Venda R$<input type="text" name="sale_price" value="<?= $storage['sale_price']; ?>" class="mb-3 form-control">
											<br>
											<input type="submit" name="edit_category" value="Editar informações" class="btn btn-sm btn-outline-dark mb-2">

											<input type="hidden" name="id" value="<?= $storage['id']; ?>">
										</form>

										<a onclick="cancelEditStorage<?= $storage['id']; ?>()" class="text-decoration-none">Cancelar</a>

									</div>
								</div>
							</div>

					<?php

					echo '
						<script type="text/javascript">
							function showEditStorage'.$storage['id'].'(){
								document.getElementById("cardbody-storage'.$storage['id'].'").style.display = "none";
								
								document.getElementById("cardbody-editStorage'.$storage['id'].'").style.display = "block";

								document.getElementById("cardbody-editStorage'.$storage['id'].'").setAttribute("class", "animate__animated animate__fadeIn");

								document.getElementById("cardbody-editStorage'.$storage['id'].'").setAttribute("class", "mt-4 mb-4");
								
							}

							function cancelEditStorage'.$storage['id'].'(){
								document.getElementById("cardbody-storage'.$storage['id'].'").style.display = "block";

		                        document.getElementById("cardbody-editStorage'.$storage['id'].'").setAttribute("class", "animate__animated animate__slideOutRight");

		                        document.getElementById("cardbody-editStorage'.$storage['id'].'").style.display = "none";

		                        document.getElementById("cardbody-storage'.$storage['id'].'").setAttribute("class", "animate__animated animate__slideInRight");

		                        document.getElementById("cardbody-storage'.$storage['id'].'").setAttribute("class", "mt-4 mb-4");
							}

						</script>
					';

					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>