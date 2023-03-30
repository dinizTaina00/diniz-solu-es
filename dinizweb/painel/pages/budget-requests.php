<section class="container px-4 py-5">
	<h4>Solicitações de orçamentos</h4>

	<div class="col-md-5 py-5">

		<?php
		$status = 'aguardando resposta';
		//$budget_requests = Painel::selectWhere('budget_requests','status = ? ORDER BY data DESC',array($status));
		$budget_requests = MySql::conectar()->prepare('SELECT * FROM budget_requests');
		$budget_requests->execute();
		$budget_requests = $budget_requests->fetchAll();
		foreach($budget_requests as $budget_request){
		?>
		<div class="card shadow my-3">
			<div class="card-body card-clients mx-4 m-2">
				<p class="mb-3 data"><?= $budget_request['data']; ?></p>
				<h5 class="title"><?= $budget_request['client_name']; ?></h5>
				<p><?= $budget_request['city']; ?></p>
				<p><?= $budget_request['zone']; ?></p>
				<p><?= $budget_request['distance_from_city']; ?> de distância da cidade</p>
				<p><?= $budget_request['cameras_qtd']; ?> câmeras</p>
				<p><?= $budget_request['client_name']; ?></p>
			</div>
		</div>
		<?php } ?>
	</div>
</section>	