<div class="col-md-8">
		<div class="card shadow">
			<div class="card-header">
				<h5 class="title">Cadastrar novo serviço</h5>
			</div>

			<div class="card-body">
				<div class="row">
					<form method="post" enctype="multipart/form-data">
						<div class="form-group mb-3">
							<label>Serviço</label>
							<input type="text" name="name" placeholder="Nome do serviço..." class="form-control">
						</div>

						<div class="form-group mb-3">
							<label>Descrição</label>
							<textarea name="description" rows="5" class="form-control"></textarea>
						</div>

						<div class="form-group mb-3">
							<label>Imagem</label>
							<input type="file" name="image" class="form-control" required>
						</div>

						<div class="form-group mb-3">
							<label>Posição na sessão</label>
							<input type="text" name="position" class="form-control" required>
						</div>


						<div class="form-group">
							<input type="submit" name="btnAddService" value="Cadastrar serviço" class="btn btn-outline-dark">
						</div>

					</form>
			</div>
			</div>
		</div>
	</div>