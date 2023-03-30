<?php 
	if (isset($_POST['btncadimages'])) {
		$success = true;

        for($i = 0; $i < count($_FILES['image']['name']); $i++){

            $image = ['type'=>$_FILES['image']['type'][$i]];

                if(Painel::validImage($image) == false){
                    $success = false;
                    Painel::alert("err","A imagem não é válida");
                } else{
                    $image = ['tmp_name' => $_FILES['image']['tmp_name'][$i], 'name' => $_FILES['image']['name'][$i]];
                    $img = Painel::uploadFile($image);
                }

                $cad_image = MySql::conectar()->prepare("INSERT INTO jobs_images_registred VALUES (null,?)");
                $cad_image->execute(array($img));
                //echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
            }
	}

	if(isset($_POST['deleteImage'])){
        $id = $_POST['id'];
        $image = $_POST['image'];
        $delete = Painel::delete('jobs_images_registred','id='.$id);
        @unlink(ROOT.'public/images/'.$image);
    }
?>

<section class="container">
	<form method="post" class="my-5" enctype="multipart/form-data">
		<div class="form-group mb-3">
			<input type="file" name="image[]" class="form-control" multiple="multiple">
		</div>
		<div class="form-group">
			<input type="submit" name="btncadimages" class="btn btn-sm btn-outline-dark">
		</div>
	</form> 
</section>

<section class="container">
	<h4 class="title">Imagens registradas</h4>

	<div class="row">
        <div class="col-lg d-flex flex-wrap">
		<?php  
			foreach(Painel::selectAll('jobs_images_registred') as $image){
			  echo '<div class="col-sm m-3 mb-2" style="max-width: 282px; min-width: 282px; min-height: 400px;">
                        <div class="card-image">
                            <img src="'.INCLUDE_PATH.'/public/images/'.$image['image'].'" style="width: 100%;">
                            </div>
                            <div >
                            <form method="post">
                            <button type="submit" name="deleteImage" class="btn btn-default">Deletar</button>
                            <input type="hidden" name="id" value="'.$image['id'].'">
                            <input type="hidden" name="image" value="'.$image['image'].'">
                            </form>
                        </div>
                    </div>';
			}
		?>
	</div>
	</div>
</section>