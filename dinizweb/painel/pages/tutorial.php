<?php 
	if(!isset($_GET['id'])){
		Painel::redirect(INCLUDE_PATH_PAINEL.'tutorials');
	}

	$tutorial = Painel::select('tutorials','id=?',array($_GET['id']));

?>

<section class="container">
    <?php include 'update-tutorial.php'; ?>
</section>

<section class="container mx-2">
    <?php include 'formAdd-tutorial-step.php'; ?>
</section>

<section class="divider"></section>

<section class="container mb-5 py-5 px-5">

	<?php
	$tutorial_steps = Painel::selectFetchAllOrderBy('tutorial_steps','id_tutorial=?','step_number ASC',array($_GET['id']));
	foreach($tutorial_steps as $tutorial_step){
	?>
    <div class="mb-5 border-bottom col-lg-8 mx-auto">
        <h5 class="" style="font-weight: 300;">Passo n° <?= $tutorial_step['step_number']; ?></h5>
        <div class="row ">

            <div id="tutorialStep<?= $tutorial_step['id']; ?>">
                <div class="row flex-md-row h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static mt-5">
                        <h5><?= $tutorial_step['title']; ?></h5>
                        
                        <?php 
                        $description = explode(';', $tutorial_step['description']);

                        foreach($description as $tutorial_step_description){
                        	echo '<p class="card-text">- '.$tutorial_step_description.'</p>';
                        }
                        ?>

                        <!-- botão edit tutorial -->
                        <button type="button" class="btn btn-primary" onclick="showEditPasso<?= $tutorial_step['id']; ?>();">Editar passo</button>

                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="400" height="400" xmlns="http://www.w3.org/2000/svg"
                            role="img">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/63e9409eb3e8b" height="300"
                                width="300" />
                        </svg>
                    </div>
                </div>
            </div>

            <div id="editPasso<?= $tutorial_step['id']; ?>" style="display: none;">
                <div class="row flex-md-row h-md-250 position-relative">
                    <div class="col d-flex flex-column position-static mt-5">
                        <div class="card">
            <div class="card-header">
                <h5 class="title">Adicionar novo passo ao tutorial</h5>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-lg px-1 mb-4">
                            <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control" placeholder="Titulo do tutorial..." name="title"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg px-1 mb-4">
                            <div class="form-group">
                                <label>Descrição</label>
                                <textarea class="form-control" name="description" placeholder="Divida a descrição em ';'" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" name="image" class="form-control" placeholder="Imagem..."
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Adicionar passo" class="btn btn-primary" >
                            </div>
                        </div>
                    </div>
                </form>

                <button class="btn btn-outline-danger" onclick="cancelEditStep<?= $tutorial_step['id']; ?>()">Cancelar</button>
            </div>
        </div>
                    </div>
                </div>

                <?php echo "
                <script type='text/javascript'>
                    function showEditPasso".$tutorial_step['id']."(){
                        document.getElementById('tutorialStep".$tutorial_step['id']."').style.display = 'none';
                        document.getElementById('editPasso".$tutorial_step['id']."').style.display = 'block';
                        document.getElementById('editPasso".$tutorial_step['id']."').setAttribute('class', 'animate__animated animate__slideInLeft');
                    }

                    function cancelEditStep".$tutorial_step['id']."(){
                        document.getElementById('tutorialStep".$tutorial_step['id']."').style.display = 'block';
                        document.getElementById('editPasso".$tutorial_step['id']."').setAttribute('class', 'animate__animated animate__slideOutLeft');
                        document.getElementById('editPasso".$tutorial_step['id']."').style.display = 'none';
                        document.getElementById('tutorialStep".$tutorial_step['id']."').setAttribute('class', 'animate__animated animate__slideInRight');
                    }
                </script>
                "; ?>
            </div>

        </div>
    </div>
    

	<?php } ?>
</section>