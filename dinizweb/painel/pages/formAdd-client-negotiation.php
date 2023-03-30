	<div class="row py-1 mb-5 d-flex justify-content-center" id="form-add-client">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Cadastrar novo cliente em negociação</h5>
				</div>
				<div class="card-body">
					<form method="post">
						<div class="form-group mb-3">
							<label>Data de cadastro</label>
							<input type="date" name="data" class="form-control" >
						</div>

						<div class="row">
							<div class="col-md-6 form-group mb-3">
								<label>Nome completo</label>
								<input type="text" name="name" class="form-control" >
							</div>

							<div class="col-md-6 form-group mb-3">
								<label>Contato</label>
								<input type="text" name="phone_number" class="form-control" >
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 form-group mb-3">
								<label>Cidade</label>
								<input type="text" name="city" class="form-control" >
							</div>

							<div class="col-md-6 form-group mb-3">
								<label>Endereço</label>
								<input type="text" name="address" class="form-control" >
							</div>
						</div>

						<div class="form-group mb-3">
							<label>Zona rural ou urbana?</label>
							<input type="radio" name="zone" value="rural" class=""> Rural
							<input type="radio" name="zone" value="rural" class="" > Urbana 
						</div>

						<div class="form-group mb-3">
							<label>Distância</label>
							<input type="text" name="distance" class="form-control" >
						</div>

						<div class="form-group mb-3">
							<label>Descrição</label>
							<textarea rows="5" name="description" class="form-control" ></textarea>
						</div>

						<div class="form-group mb-3">
							<div class="row">
								<div class="form-group col-md-3">
									<label>Custo total</label>
									<input type="text" name="budget" class="form-control">
								</div>
								<div class="form-group col-md-3">
									<label>Faturamento total</label>
									<input type="text" name="budget" class="form-control">
								</div>

								<div class="form-group col-md-3">
									<label>Desconto</label>
									<input type="text" name="budget" class="form-control">
								</div>

								<div class="form-group col-md-3">
									<label>Valor a cobrar</label>
									<input type="text" name="budget" class="form-control">
								</div>
							</div>
						</div>				

						<input type="submit" name="btnCadClient" class="btn btn-success mb-3" id="btn-close-form-add" value="Cadastrar">

					</form>
				</div>
			</div>
		</div>

	</div>