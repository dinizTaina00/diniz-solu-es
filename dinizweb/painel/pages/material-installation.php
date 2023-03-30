<?php 
	if(isset($_GET['delete_material'])){
		$id = $_GET['delete_material'];
		Painel::delete('material_installation',$id);
	}

	if (isset($_POST['btnAddMaterial'])) {
		$material = $_POST['material'];
		$value = $_POST['value'];

		$insert = MySql::conectar()->prepare("INSERT INTO material_installation VALUES (null,?,?)");
		$insert->execute(array($material,$value));
	}
?>

<section class="container py-5">
	<div class="col-md-8">
		<div class="card shadow">
			<div class="card-header">
				<h5 class="title">Cadastrar material de instalação</h5>
			</div>

			<div class="card-body">
				<div class="row">
					<form method="post">
						<div class="form-group mb-3">
							<label>Material</label>
							<input type="text" name="material" placeholder="Nome do material..." class="form-control">
						</div>

						<div class="form-group mb-3">
							<label>Valor</label>
							<input type="text" name="value" placeholder="Valor do material..." class="form-control">
						</div>

						<div class="form-group">
							<input type="submit" name="btnAddMaterial" value="Cadastrar material" class="btn btn-outline-dark">
						</div>

					</form>
			</div>
			</div>
		</div>
	</div>
</section>

<section class="container">
	<div class="row">
		<div class="card-body mx-3">
			<?php 
			$selectMaterial_installation = Painel::selectAll('material_installation');
			foreach($selectMaterial_installation as $material_installation){
			?>
				<div class="col-md-8 cardbody-material<?= $material_installation['material']; ?>">
					<div class="card shadow mb-4">
						<div class="card-body p-4">
							<p><?= $material_installation['material']; ?></p>

							<p>R$ <?= Painel::convertMoney($material_installation['value']); ?></p>

							<a onclick="showEditMaterial<?= $material_installation['id']; ?>" class="btn btn-sm btn-outline-info">Atualizar</a>

							<a href="?delete_material=<?= $material_installation['id']; ?>" class="btn btn-sm btn-outline-danger">Excluir</a>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</section>