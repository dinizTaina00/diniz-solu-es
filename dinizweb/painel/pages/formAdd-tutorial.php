<div class="row" id="formAddTutorial" style="display: none;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Adicionar novo tutorial</h5>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg px-1 mb-4">
                            <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control" width="300" placeholder="Titulo do tutorial..." name="title"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg px-1 mb-4">
                            <div class="form-group">
                                <label>Descrição</label>
                                <input type="text" class="form-control" placeholder="Descrição do tutorial..." name="description"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-4">
                            <div class="form-group">
                                <label>Permissão para quem não está logado ver?</label>
                                <select name="permission" required>
                                    <option value="1">Sim</option>
                                    <option value="0">Não</option>
                                </select>
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
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label>Url video</label>
                                <input type="text" name="url_video" class="form-control" placeholder="Url do seu video tutorial...">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Cadastrar tutorial" class="btn btn-outline-dark">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                        
                        </div>
                    </div>
                </form>

                <a onclick="cancel_addTutorial()" class="btn btn-danger">Cancelar</a>
            </div>
        </div>
    </div>
</div>

<?php 

    if(isset($_POST['submit'])){

       $title = $_POST['title'];
        $query = MySql::conectar()->prepare("SELECT * FROM tutorials WHERE title = ?");
        $query->execute(array($title));

        if($query->rowCount() > 0){
            Painel::alert('err', 'Um tutorial com esse título já está cadastrado');
            die();
        }

        $url_video = $_POST['url_video'];

        if(empty($url_video)){
            $url_video = "";
        }

       $description = $_POST['description'];
       $permission = $_POST['permission'];
       $image = $_FILES['image'];
       $success = true;

        $image = ['type'=>$_FILES['image']['type']];
            if(Painel::validImage($image) == false){
                $success = false;
                Painel::alert("err","A imagem 1 não é válida");
                die();
            }

            if($success == true) {
                $image = ['tmp_name' => $_FILES['image']['tmp_name'], 'name' => $_FILES['image']['name']];
                $img = Painel::uploadFile($image);

                $cad_tutorial = MySql::conectar()->prepare("INSERT INTO tutorials VALUES (null,?,?,?,?,?)");
                $cad_tutorial->execute(array($title,$description,$img,$url_video,$permission));

				$lastId = MySql::conectar()->lastInsertId();                

                Painel::redirect(INCLUDE_PATH_PAINEL.'tutorial?id='.$lastId);
            }
    }

?>