<?php 

if (!isset($_GET['id'])) {
	die('ID não identificado');
}

?>

<section class="container">

	<?php include 'formAdd-client-negotiation.php'; ?>

	<div class="row">
        <div class="table-responsive">
        	<table class="table">
        		<thead>
        			<tr>
        				<th>Produto</th>
        				<th>Quantidade</th>
        				<th>Preço de venda</th>
        				<th>Preço de custo</th>
        				<th>Cabeado</th>
        				<th>Preço de instalação</th>
        				<th></th>
        			</tr>
        		</thead>
        		<tbody>
        			<?php 
        			foreach(Painel::selectAll('jobs_products','id_job = ?',$_GET['id']) as $jobs_product){
        			?>
        			<tr>
        				<td><?= $jobs_product['product']; ?></td>
        				<td><?= $jobs_product['quantity']; ?></td>
        				<td>R$ <?= Painel::convertMoney($jobs_product['sale_price']); ?></td>
        				<td>R$ <?= Painel::convertMoney($jobs_product['cost_price']); ?></td>
        				<td id="wired"><?= $jobs_product['wired']; ?></td>
        				<td>R$ <?= Painel::convertMoney($jobs_product['installation_price']); ?></td>
        				<td><a href="update?id=<?= $jobs_product['id']; ?>">Atualizar</a></td>
        				<td>	 		<a href="delete?id=<?= $jobs_product['id']; ?>"><i class="fa-solid fa-trash"></i></a></td>
        			</tr>
        			<?php
        			}
        			?>
        		</tbody>
        	</table>
        </div>
    </div>

    <div class="row">
    	<div id="list_products">
    		<h5>Novos produtos</h5>
    	</div>
    	
    				<div class="card my-4">
							<div class="card-body">
								<?php 
								foreach(Painel::selectAll('products') as $product){
								?>
								<div class="my-3">
									<form class="ajax" action="<?= INCLUDE_PATH_PAINEL ?>ajax/formsBudgets.php" method="post">
										<div class="form-group row mb-2" id="">
											<div class="col">
											<p><?= $product['name']; ?></p>
											</div>	
											<div class="col col-md-2">
											Qtd<input type="text" name="quantity" id="qty_<?= $product['id']; ?>" class="form-control">
											</div>
										</div>

										<div class="form-group mb-2">
											<label>Instalação cabeada?</label>
											<input type="radio" name="wired" value="sim" required> Sim
											<input type="radio" name="wired" value="nao" required> Não
										</div>

										<input type="hidden" name="product" value="<?= $product['name']; ?>">
										<input type="hidden" name="sale_price" value="<?= $product['sale_price']; ?>">
										<input type="hidden" name="cost_price" value="<?= $product['cost_price']; ?>">
										<input type="hidden" name="id" value="<?= $product['id'] ?>">

										<div class="form-group">
											<input type="submit" value="Adicionar" class="btn btn-sm- btn-outline-dark my-4">
										</div>
									</form>
								</div>

								<hr>


								<?php } ?>
							</div>
					</div>
    </div>
</section>

<section></section>



