<?php
	
	if (!isset($_POST['btnCadClient'])) {
		if(isset($_SESSION['products_list'])){
			unset($_SESSION['products_list']);
		}

	}

	if (isset($_GET['delClientNeg'])) {
		Painel::delete('jobs','id ='.$_GET['delClientNeg']);
		Painel::delete('jobs_products','id_job='.$_GET['delClientNeg']);
	}
	
	if (isset($_POST['btnCadClient'])) {
		$name = $_POST['name'];
		$situation = "negotiation";
		$city = $_POST['city'];
		$address = $_POST['address'];
		$zone = $_POST['zone'];
		$distance = $_POST['distance'];
		$phone_number = $_POST['phone_number'];
		$data = $_POST['data'];
		$description = $_POST['description'];
		$budget = $_POST['budget'];
		$cost = 0;

		$insert = MySql::conectar()->prepare("INSERT INTO jobs VALUES (null,?,?,?,?,?,?,?,?,?,?,?)");
		$insert->execute(array($name,$situation,$city,$address,$zone,$distance,$phone_number,$data,$description,$budget,$cost));

		$lastId = MySql::conectar()->lastInsertId();

		if (isset($_SESSION['products_list'])) {
			foreach($_SESSION['products_list'] as $product){
			 	$insert_job = MySql::conectar()->prepare("INSERT INTO jobs_products VALUES (null,?,?,?,?,?,?,?)");
			 	$insert_job->execute(array($lastId,$product['product'],$product['quantity'],$product['sale_price'],$product['cost_price'],$product['wired'],$product['installation_price']));
			}
		unset($_SESSION['products_list']);
		}

		Painel::alert('success','Cliente em negociação cadastrado');
	}

?>

<section class="container">

		<div class="row py-1 mb-5" id="form-add-client" style="display: none;">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Cadastrar novo cliente em negociação</h5>
				</div>
				<div class="card-body">
					<form method="post">
						<div class="form-group mb-3">
							<label>Data</label>
							<input type="date" name="data" class="form-control" >
						</div>

						<div class="form-group mb-3">
							<label>Nome completo</label>
							<input type="text" name="name" class="form-control" >
						</div>

						<div class="form-group mb-3">
							<label>Contato</label>
							<input type="text" name="phone_number" class="form-control" >
						</div>

						<div class="form-group mb-3">
							<label>Cidade</label>
							<input type="text" name="city" class="form-control" >
						</div>

						<div class="form-group mb-3">
							<label>Endereço</label>
							<input type="text" name="address" class="form-control" >
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

						<div class="card my-4">
							<div>
								<div class="card-body" id="list_products"></div>
							</div>
						</div>

						<div class="form-group mb-3">
							<label>Valor a cobrar R$</label>
							<input type="text" name="budget" class="form-control">
						</div>				

						<input type="submit" name="btnCadClient" class="btn btn-success mb-3" id="btn-close-form-add" value="Cadastrar">

					</form>
				</div>

			</div>
			<button onclick="closeFormAdd()" class="btn btn-danger my-3 mx-auto" style="width: 100px;">Fechar</button>
		</div>

	</div>

	<h4 class="title mb-4 mt-4">Clientes em negociação <a onclick=""></a></h4> 
	<button class="btn btn-outline-success mb-5" onclick="formAddClientclient()" id="btn-open-form-add-client">Cadastrar novo cliente em negociação</button>
	
	<div style="height: 800px; overflow-y: scroll;">
		<?php
				 $select_clients_negotiation = Painel::selectFetchAllOrderBy('jobs','situation = ?','data DESC',array('negotiation'));
				    foreach($select_clients_negotiation as $clients_negotiation){

				    $phone_number = preg_replace("/[^0-9]/","", $clients_negotiation['phone_number']);
				?> 	
				<div class="row mt-4 mb-4" id="list-negotiation-clients">
					<!-- LIST CLIENTS_NEGOTIATION -->
					<div class="col-md-6 mb-3" id="card-negotiation<?= $clients_negotiation['id']; ?>">
						<div class="card shadow">
							<div class="card-body card-clients mx-4 p-4">
								<p class="m-2 mb-3 data"><?= $clients_negotiation['data']; ?></p>
								<label>Cliente</label>
								<p class="m-2"><span style="font-weight: 500;"><?= $clients_negotiation['name']; ?></span></p>
								<p class="m-2"><?= $clients_negotiation['phone_number']; ?> <a href="https://wa.me/<?= $phone_number ?>?" target="_blank"><i class="fa fa-whatsapp" style="color: green;"></i></a></p>
								<p class="m-2"><?= $clients_negotiation['address'].' - '.$clients_negotiation['city']; ?></p>
								<hr>
								<label>Descrição</label>
								<p class="m-2"><?= $clients_negotiation['description']; ?></p>
								<hr>
								<label>Produtos</label>
								<?php 
								$wired = "";
								foreach (Painel::selectWhere('jobs_products','id_job = ?',array($clients_negotiation['id'])) as $key => $jobs_product) {
									$jobs_product['wired'] == "sim" ? $wired = "<span style='color: green;'>cabeado</span>" : $wired = "<span style='color: red;'>não cabeado</span>";
									echo '<p>'.$jobs_product['quantity'].' - '.$jobs_product['product'].' - '.$wired.'</p>';
								} ?>
								<hr>

								<label>Valor</label>
								<p class="m-2">R$ <?= Painel::convertMoney($clients_negotiation['budget']); ?></p>
								<a href="client-negotiation?id=<?= $clients_negotiation['id']; ?>" class="btn btn-sm btn-outline-primary">Ver</a>
								<a href="?schedule-job=<?= $clients_negotiation['id']; ?>" class="btn btn-sm btn-primary">Agendar instalação</a>
								<a onclick="showFormEdit_listNegotiationClients<?= $clients_negotiation['id']; ?>()" class="btn btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>
								<a href="?delClientNeg=<?= $clients_negotiation['id']; ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
							</div>
						</div>			
					</div>

					<!-- FORM EDIT CLIENT_NEGOTIATION -->
					<div class="col-md-6 mb-3" id="card-edit-negotiation<?= $clients_negotiation['id']; ?>" style="display: none;">
						<div class="card shadow">
							<div class="card-body card-clients mx-4">
								<p class="m-2 mb-3 data"><?= $clients_negotiation['data']; ?></p>
								<form method="post">
									<input type="text" name="name" value="<?= $clients_negotiation['name']; ?>" class="form-control">
									<input type="text" name="phone_number" value="<?= $clients_negotiation['phone_number']; ?>" class="form-control">
									<input type="text" name="city" value="<?= $clients_negotiation['city'] ?>" class="form-control">
									<input type="text" name="address" value="<?= $clients_negotiation['address'] ?>" class="form-control">
									<textarea name="description" class="form-control"><?= $clients_negotiation['description']; ?></textarea>
									<input type="text" name="budget" value="<?= $clients_negotiation['budget'] ?>" class="form-control" >
									<input type="hidden" name="id" value="<?= $clients_negotiation['id']; ?>">

									<button name="btn_editClientNegotiation" class="btn btn-outline-success mt-2">Editar informações</button>
								</form>
							</div>
							<button onclick="close_formEditClientNegotiation<?= $clients_negotiation['id']; ?>()" class="btn btn-danger">Fechar</button>
						</div>			
					</div>
				</div>
					
		<?php 
			echo "
					<script>
					function showFormEdit_listNegotiationClients".$clients_negotiation['id']."(){
						document.getElementById('card-negotiation".$clients_negotiation['id']."').style.display = 'none';
						document.getElementById('card-edit-negotiation".$clients_negotiation['id']."').style.display = 'block';
					}

					function close_formEditClientNegotiation".$clients_negotiation['id']."(){
						document.getElementById('card-negotiation".$clients_negotiation['id']."').style.display = 'block';
						document.getElementById('card-edit-negotiation".$clients_negotiation['id']."').style.display = 'none';
					}
					</script>";
			} 
		?>
	</div>

</section>

<script type="text/javascript">
	function formAddClientclient(){
		document.getElementById('btn-open-form-add-client').style.display = 'none';
		document.getElementById('form-add-client').style.display = 'block';
		document.getElementById('form-add-client').setAttribute('class','animate__animated animate__slideInLeft');
	}

	function closeFormAdd(){
		document.getElementById('btn-open-form-add-client').style.display = 'block';
		document.getElementById('form-add-client').setAttribute('class','animate__animated animate__slideOutLeft');
		setTimeout(function(){
			document.getElementById('form-add-client').style.display = 'none';
		},500)
	}
</script>