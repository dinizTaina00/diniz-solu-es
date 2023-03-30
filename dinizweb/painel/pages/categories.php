<?php 
	

	if (isset($_GET['deleteCategory'])) {
		$id = $_GET['deleteCategory'];
		Painel::delete('categories','id = '.$id);
	}

	if (isset($_POST['edit_category'])) {
		$name = $_POST['name'];
		$id = $_POST['id'];

		$query = MySql::conectar()->prepare("SELECT * FROM categories WHERE name = ?");
		$query->execute(array($name));

		if ($query->rowCount() > 0) {
			Painel::alert('err','Esse nome de categoria já está cadastrado');
		}else{
			$insert = MySql::conectar()->prepare("UPDATE categories SET name = ? WHERE id = ?");
			$insert->execute(array($name,$id));
		}
	}
?>

<section class="container my-4" style="z-index: 1;">
	
	<?php include 'formAdd-category.php'; ?>

<?php 
if (isset($_POST['btnAddService'])) {
		$name = $_POST['name'];

		$searchService = MySql::conectar()->prepare("SELECT * FROM categories WHERE name = ?");
		$searchService->execute(array($name));

		if ($searchService->rowCount() == 1) {
			Painel::alert('err', 'A categoria '.$name.' já está cadastrada');
			die();
		} else{
			$insert = MySql::conectar()->prepare("INSERT INTO categories VALUES (null,?)");
			$insert->execute(array($name));
			Painel::alert('success','Categoria cadastrada com sucesso');
		}
	}	
?>
</section>

<section class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="card-body">
				<div class="justify-content-center">
					<?php 
					$selectAllCategories = Painel::selectAll('categories');
					foreach($selectAllCategories as $category){
					?>

						<div class="my-2 p-2" id="cardbody-category<?= $category['id']; ?>">
							<div class="card shadow">
								<div class="card-body text-center">
									<p><?= $category['name']; ?></p>

									<a onclick="showEditCategory<?= $category['id']; ?>()" class="btn btn-sm btn-outline-dark text-decoration-none mx-2">Atualizar</a>

									<a href="?deleteCategory=<?= $category['id']; ?>" class="btn btn-sm btn-outline-danger text-decoration-none">Excluir</a>
								</div>
							</div>
						</div>

							<div class="my-5 p-2" id="cardbody-editCategory<?= $category['id']; ?>" style="display: none;">
								<div class="card shadow">
									<div class="card-body text-center">
										<form method="post">
											<input type="text" name="name" value="<?= $category['name']; ?>" class="mb-3 form-control" >
											<br>
											<input type="submit" name="edit_category" value="Editar name da categoria" class="btn btn-sm btn-outline-dark mb-2">

											<input type="hidden" name="id" value="<?= $category['id']; ?>">
										</form>

										<a onclick="cancelEditCategory<?= $category['id']; ?>()" class="text-decoration-none">Cancelar</a>

									</div>
								</div>
							</div>

					<?php

					echo '
						<script type="text/javascript">
							function showEditCategory'.$category['id'].'(){
								document.getElementById("cardbody-category'.$category['id'].'").style.display = "none";
								
								document.getElementById("cardbody-editCategory'.$category['id'].'").style.display = "block";

								document.getElementById("cardbody-editCategory'.$category['id'].'").setAttribute("class", "animate__animated animate__fadeIn");

								document.getElementById("cardbody-editCategory'.$category['id'].'").setAttribute("class", "mt-4 mb-4");
								
							}

							function cancelEditCategory'.$category['id'].'(){
								document.getElementById("cardbody-category'.$category['id'].'").style.display = "block";

		                        document.getElementById("cardbody-editCategory'.$category['id'].'").setAttribute("class", "animate__animated animate__slideOutRight");

		                        document.getElementById("cardbody-editCategory'.$category['id'].'").style.display = "none";

		                        document.getElementById("cardbody-category'.$category['id'].'").setAttribute("class", "animate__animated animate__slideInRight");

		                        document.getElementById("cardbody-category'.$category['id'].'").setAttribute("class", "mt-4 mb-4");
							}

						</script>
					';

					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>