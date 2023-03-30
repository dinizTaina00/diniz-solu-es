<?php
if(isset($_POST['delete_tutorial'])){
    $id = $_POST['id_tutorial'];
    $delete = Painel::delete('tutorials','id='.$id);
}

    include 'formAdd-tutorial.php';

?>

<section class="container my-5">
	<!-- <h5 class="title">Tutoriais</h5> -->
    <div class="col-md-4">
        <a onclick="show_addTutorial()" class="btnshowFormAdd btn btn-outline-dark">Adicionar um novo tutorial <i class="fa-solid fa-plus mx-2"></i></a>
    </div>
</section>

<section class="container">
    <div class="row row-cols mt-1">
	<?php 
	$tutoriais = Painel::selectAll('tutorials');
	foreach($tutoriais as $tutorial){
	?>

        <div class="card m-2 shadow" style="max-width: 600px;">
            <div class="row card-box-product">
                <div class="row g-0 overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static card-body-product">
                        <h5 class="mt-3" style="font-weight: 400;"><?= $tutorial['title']; ?></h5>
                        <p class="card-text mb-auto" style="font-weight: 400;"><?= $tutorial['description']; ?></p> 


                        <a href="tutorial?id=<?= $tutorial['id']; ?>" class="text-decoration-none my-3">Ver tutorial</a>
                        
                        <form method="post">
                            <input type="hidden" name="id_tutorial" value="<?= $tutorial['id']; ?>">
                            <button type="submit" name="delete_tutorial" value="Excluir" class="btn btn-default">Excluir</button>
                        </form>
                    
                    </div>
                    <div class="col-auto">
                        <svg class="bd-placeholder-img" width="200" height="200" xmlns="http://www.w3.org/2000/svg"
                            role="img" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <image href="<?php echo INCLUDE_PATH ?>public/images/<?= $tutorial['image']; ?>" height="200"
                                width="200" />
                        </svg>
                    </div>

                </div>
            </div>
        </div>
	
	<?php } ?>
    </div>
</section>