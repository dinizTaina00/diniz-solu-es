
<section class="container py-4">
	<h1>Painel de administração</h1>
</section>

<?php

	if (isset($_POST['btnCadJob'])) {
		$name = $_POST['name'];
		$situation = "scheduled";
		$city = $_POST['city'];
		$address = $_POST['address'];
		$distance = $_POST['distance'];
		$phone_number = $_POST['phone_number'];
		$data = $_POST['data'];
		$description = $_POST['description'];
		$budget = $_POST['budget'];
		$cost = 0;

		$insert = MySql::conectar()->prepare("INSERT INTO jobs VALUES (null,?,?,?,?,?,?,?,?,?,?)");
		$insert->execute(array($name,$situation,$city,$address,$distance,$phone_number,$data,$description,$budget,$cost));
		Painel::alert('success','Cliente cadastrado');
	}

	if (isset($_POST['btn_editClientNegotiation'])) {
		$name = $_POST['name'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$phone_number = $_POST['phone_number'];
		$description = $_POST['description'];
		$budget = $_POST['budget'];
		$id = $_POST['id'];

		$insert = MySql::conectar()->prepare("UPDATE jobs SET name=?,city=?,address=?,phone_number=?,description=?,budget=? WHERE id = ?");
		$insert->execute(array($name,$city,$address,$phone_number,$description,$budget,$id));
		Painel::alert('success','Informações atualizadas');
	}

	if (isset($_GET['delete_scheduled'])) {
		Painel::delete('jobs',$_GET['delete_scheduled']);
	}

	if(isset($_GET['schedule-job'])){
		$update = MySql::conectar()->prepare("UPDATE jobs SET situation = 'scheduled' WHERE id = ?");
		$update->execute(array($_GET['schedule-job']));
	}

	if(isset($_GET['job-done'])){
		$update = MySql::conectar()->prepare("UPDATE jobs SET situation = 'jobdone' WHERE id = ?");
		$update->execute(array($_GET['job-done']));
	}
?>

<script type="text/javascript">

	function showScheduleServices(){
		// document.getElementById('btn-show-schedule-services').style.display = 'none';
		// document.getElementById('list-schedule-services').setAttribute('class','animate__animated animate__slideInLeft');
		// document.getElementById('list-schedule-services').style.display = 'block';
	}
	

</script>

<section class="container py-1">

	<div class="row rpw-cols">
		<div class="bg-light rounded col-md-5 shadow text-center p-3 mx-2 my-3 border border-info">
	        <h5>Solicitações de orçamentos</h5>
	        <p class="lead">Novos orçamentos recebidos</p>
	        <a class="btn btn-sm btn-outline-primary" href="budget-requests" role="button">Ver »</a>
	    </div>	

	    <div class="bg-light rounded col-md-5 shadow text-center p-3 mx-2 my-3 border border-info">
	        <h5>Clientes em negociação</h5>
	        <p class="lead">Ver clientes em negociação</p>
	        <a class="btn btn-sm btn-outline-primary" href="clients-negotiation" role="button">Ver »</a>
	    </div>

	    <div class="bg-light rounded col-md-5 shadow text-center p-3 mx-2 my-3 border border-info">
	        <h5>Faturamento</h5>
	        <p class="lead">Lista de faturamento</p>
	        <a class="btn btn-sm btn-outline-primary" href="../../components/navbar/" role="button">Ver »</a>
	    </div>
	</div>

</section> 

<section class="container mt-4">
	<div class="row py-1 mb-4" id="form-schedule-service" style="display: none;">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h5 class="title">Agendar serviço</h5>
				</div>
				<div class="card-body">
					<form method="post">
						<div class="form-group mb-3">
							<label>Data</label>
							<input type="date" name="data" class="form-control" required>
						</div>

						<div class="form-group mb-3">
							<label>Nome do cliente</label>
							<input type="text" name="name" class="form-control" required>
						</div>

						<div class="form-group mb-3">
							<label>Cidade</label>
							<input type="text" name="city" class="form-control" required>
						</div>

						<div class="form-group mb-3">
							<label>Endereço</label>
							<input type="text" name="address" class="form-control" required>
						</div>

						<div class="form-group mb-3">
							<label>Distância</label>
							<input type="text" name="distance" class="form-control" required>
						</div>

						<div class="form-group mb-3">
							<label>Contato</label>
							<input type="text" name="phone_number" class="form-control" required>
						</div>

						<div class="form-group mb-3">
							<label>Descrição</label>
							<textarea rows="5" name="description" class="form-control" required></textarea>
						</div>

						<div class="form-group mb-3">
							<label>Valor a cobrar</label>
							<input type="text" name="budget" class="form-control">
						</div>						

						<button type="submit" name="btnCadJob" class="btn btn-outline-dark mb-3" id="btn-close-form-add">Cadastrar</button>

					</form>
					<button onclick="closeFormAdd()" class="btn btn-danger">Fechar</button>
				</div>
			</div>
		</div>
	</div>

	<h4 class="title mb-1">Serviços agendados <a onclick="showScheduleServices()" id="btn-show-schedule-services"></a></h4>
	<button class="btn btn-outline-dark mb-5 mt-3" onclick="showFormScheduleService()" id="btn-open-form-schedule-service">Agendar um serviço</button>
	
	<div class="row mb-4" id="list-schedule-services" style="overflow-y: scroll; height: 500px;">
		<?php
				 $select_jobs_scheduled = Painel::selectWhere('jobs','situation = ?',array('scheduled'));
				    foreach($select_jobs_scheduled as $job_scheduled){
				?> 
					<div class="col-md-6 mb-3">
						<div class="card shadow ">
							<div class="card-body card-clients mx-4">
								<p class="m-2 mb-3 data"><?= $job_scheduled['data']; ?></p>
								<p class="m-2"><span style="font-weight: 500;"><?= $job_scheduled['name']; ?></span></p>
								<p class="m-2"><?= $job_scheduled['phone_number']; ?> <a href="" target="_blank"><i class="fa fa-whatsapp" style="color: green;"></i></a></p>
								<p class="m-2"><?= $job_scheduled['address'].' - '.$job_scheduled['city']; ?></p>

								<hr>

								<p class="m-2"><?= $job_scheduled['description']; ?></p>
								<p class="m-2">R$<?= Painel::convertMoney($job_scheduled['budget']); ?></p>

								<a href="?job-done=<?= $job_scheduled['id']; ?>" class="btn btn-sm btn-success">Instalação finalizada</a>
								<a href="?delete_scheduled=<?= $job_scheduled['id']; ?>" class="btn btn-sm btn-danger">Excluir</a>
							</div>
						</div>			
					</div>
		<?php } ?>

	</div>
</section>
