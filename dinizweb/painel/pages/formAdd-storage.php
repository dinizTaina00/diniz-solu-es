

<section class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Adicionar novo armazenamento</h5>
				</div>
				<div class="card-body">
					<form method="post">
						<div class="row mb-4">
							<div class="col-md-6">
								<div class="form-group">
									<label>Título</label>
									<input type="text" name="title" class="form-control" placeholder="Titulo...">
								</div>
							</div>
						</div>

						<div class="row mb-4">
							<div class="col-md-6">
								<div class="form-group">
									<label>Tamanho</label>
									<input type="text" name="size" class="form-control" placeholder="Tamanho...">
								</div>
							</div>
						</div>

						<div class="row mb-4">
							<div class="col-md-6">
								<div class="form-group">
									<label>Custo de aquisição</label>
									<input type="text" name="cost_price" class="form-control" placeholder="Valor...">
								</div>
							</div>
						</div>

						<div class="row mb-4">
							<div class="col-md-6">
								<div class="form-group">
									<label>Valor de venda</label>
									<input type="text" name="sale_price" class="form-control" placeholder="Valor...">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<input type="submit" name="add_storage" value="Adicionar armazenamento" class="btn btn-info">
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
	if (isset($_POST['add_storage'])) {
		$title = $_POST['title'];
		$size = $_POST['size'];
		$cost_price = $_POST['cost_price'];
		$sale_price = $_POST['sale_price'];

		$query = MySql::conectar()->prepare("SELECT * FROM storages WHERE title = ?");
		$query->execute(array($title));

		if ($query->rowCount() > 0) {
			Painel::alert('err','Esse título de armazenamento já está cadastrado');
		}else{
			$insert = MySql::conectar()->prepare("INSERT INTO storages VALUES (null,?,?,?,?)");
			$insert->execute(array($title,$size,$cost_price,$sale_price));
			Painel::alert('success','Armazenamento cadastrado com sucesso');
		}
	}
?>