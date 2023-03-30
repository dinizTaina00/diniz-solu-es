<section class="container">
	<h4 class="title mb-4 mt-4">Trabalhos realizados</h4> 
		<?php
				 $selectJobs_done = Painel::selectWhere('jobs','situation = ? ORDER BY data DESC',array('jobdone'));
				    foreach($selectJobs_done as $job_done){

				    $phone_number = preg_replace("/[^0-9]/","", $job_done['phone_number']);
				?> 	
					<!-- LIST JOB DONE -->
				<div class="row mb-4" id="list-negotiation-clients">
					<div class="col-md-6 mb-3" id="card-negotiation<?= $job_done['id']; ?>">
						<div class="card shadow">
							<div class="card-body card-clients mx-4">
								<p class="m-2 mb-3 data"><?= $job_done['data']; ?></p>
								<p class="m-2"><span style="font-weight: 500;"><?= $job_done['name']; ?></span></p>
								<p class="m-2"><?= $job_done['phone_number']; ?> <a href="https://wa.me/<?= $phone_number ?>?" target="_blank"><i class="fa fa-whatsapp" style="color: green;"></i></a></p>
								<p class="m-2"><?= $job_done['address'].' - '.$job_done['city']; ?></p>
								<p class="m-2"><?= $job_done['description']; ?></p>
								<p class="m-2">R$ <?= Painel::convertMoney($job_done['budget']); ?></p>

								<div class="d-flex">
								<form method="post">
									<label for="file-input" style="cursor: pointer;" class="mx-2 btn btn-sm btn-outline-primary"><i class="fa-regular fa-images" ></i></label>
									<input type="file" id="file-input" name="images[]" style="display: none;" value="">
								</form>
								<a href="?delClientNeg=<?= $job_done['id']; ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
								</div>
							</div>
						</div>			
					</div>
				</div>
				<?php } ?>

</section>