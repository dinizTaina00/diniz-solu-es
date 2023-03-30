

<section class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Adicionar nova categoria</h5>
				</div>
				<div class="card-body">
					<form method="post">
						<div class="row mb-4">
							<div class="col-md-6">
								<div class="form-group">
									<label>Categoria</label>
									<input type="text" name="name" class="form-control" placeholder="Nome da categoria...">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<input type="submit" name="add_category" value="Adicionar categoria" class="btn btn-info">
							</div>
						</div>

						<!-- <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label></label>
								</div>
							</div>
						</div> -->
					</form>
				</div>
			</div>
		</div> 
	</div>
</section>

<?php 
	if (isset($_POST['add_category'])) {
		$name = $_POST['name'];

		$query = MySql::conectar()->prepare("SELECT * FROM categories WHERE name = ?");
		$query->execute(array($name));

		if ($query->rowCount() > 0) {
			Painel::alert('err','Esse nome de categoria já está cadastrado');
		}else{
			$insert = MySql::conectar()->prepare("INSERT INTO categories VALUES (null,?)");
			$insert->execute(array($name));
			Painel::alert('success','Categoria cadastrada com sucesso');
		}
	}
?>