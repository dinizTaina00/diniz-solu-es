	<div class="col-md-8">
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
                                <input type="submit" name="submit" value="Adicionar passo" class="btn btn-outline-dark" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php

if(isset($_POST['submit'])){

$title = $_POST['title'];
$query = MySql::conectar()->prepare("SELECT * FROM tutorials WHERE title = ?");
$query->execute(array($title));

if($quert->rowCount() > 0){
    Painel::alert('err', 'Um tutorial com esse título já está cadastrado');
    die();
}

$id_tutorial = $_GET['id'];
$description = $_POST['description'];
$image = $_FILES['image'];
$success = true;

$image = ['type'=>$_FILES['image']['type']];
    if(Painel::validImage($image) == false){
        $success = false;
        Painel::alert('err','Imagem inválida');
        die();
    }

    if($success == true){
        $image = ['tmp_name' => $_FILES['image']['tmp_name'], 'name' => $_FILES['image']['name']];

        $img = Painel::uploadFile($image);

        $add_step = MySql::conectar()->prepare("INSERT INTO tutorial_steps VALUES (null,?,?,?,?,?)");
        $add_step->execute(array($id_tutorial,$step_number,$title,$description,$img));

        echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
    }


}

?>