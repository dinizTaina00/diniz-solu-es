<div class="container my-4">
    <button class="btn btn-primary" id="showFormUpdate" onclick="showFormUpdate()">
            Atualizar informações do tutorial
    </button>

    <button class="btn btn-danger" id="hideFormUpdate" onclick="hideFormUpdate()" style="display: none;">
            Fechar
    </button>

    <div class="col-md-8 my-2" id="formUpdate" style="display: none;">

        <div class="card">
            <div class="card-header">
                <h4><?= $tutorial['title']; ?></h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg px-1 mb-4">
                            <div class="form-group">
                                <label>Titulo</label>
                                <input type="text" class="form-control" width="300" value="<?= $tutorial['title']; ?>" name="title"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg px-1 mb-4">
                            <div class="form-group">
                                <label>Descrição</label>
                                <input type="text" class="form-control" value="<?= $tutorial['description']; ?>" name="description"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-4">
                            <div class="form-group">
                                <label>Permissão para quem não está logado ver?</label>
                                <select name="permission" required>
                                    <option value="1" <?php if($tutorial['permission'] == 1) echo "selected"; ?>>Sim</option>
                                    
                                    <option value="0" <?php if($tutorial['permission'] == 0) echo "selected"; ?>>Não</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" name="image" class="form-control" placeholder="Imagem..."
                                    >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label>Url video</label>
                                <input type="text" name="url_video" class="form-control" value="<?= $tutorial['url_video']; ?>"">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="update" value="Atualizar informações tutorial" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function showFormUpdate(){
        document.getElementById('formUpdate').style.display = "block";
        document.getElementById('formUpdate').setAttribute('class', 'animate__animated animate__fadeInLeft');
        document.getElementById('showFormUpdate').style.display = "none";
        document.getElementById('hideFormUpdate').style.display = "block";
        document.getElementById('formUpdate').style.height = "100%";    
    }

    function hideFormUpdate(){
        document.getElementById('formUpdate').setAttribute('class', 'animate__animated animate__fadeOutLeft');
        document.getElementById('formUpdate').style.height = "0";
        document.getElementById('formUpdate').style.transition = "height 0.5s";
        document.getElementById('hideFormUpdate').style.display = "none";
        document.getElementById('showFormUpdate').style.display = "block";
    }

</script>

<?php 

    if(isset($_POST['update'])){

       $title = $_POST['title'];
       $description = $_POST['description'];
       $permission = $_POST['permission'];
       $url_video = $_POST['url_video'];

        if(empty($url_video)){
            $url_video = "";
        }

        if($_FILES['image']['error'] == 4){
            $img = $tutorial['image'];
            $cad_tutorial = MySql::conectar()->prepare("UPDATE tutorials SET title = ?, description = ?, image = ?, url_video = ?, permission = ?  WHERE title = ?");
            $cad_tutorial->execute(array($title,$description,$img,$url_video,$permission,$title));

            $lastId = MySql::conectar()->lastInsertId();                

                Painel::redirect(INCLUDE_PATH_PAINEL.'tutorial?id='.$lastId);

        }else{
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

                    $cad_tutorial = MySql::conectar()->prepare("UPDATE tutorials SET title = ?, description = ?, image = ?, url_video = ?, permission = ?  WHERE title = ?");
                    $cad_tutorial->execute(array($title,$description,$img,$url_video,$permission));

                    $lastId = MySql::conectar()->lastInsertId();                

                    Painel::redirect(INCLUDE_PATH_PAINEL.'tutorial?id='.$lastId);
                }
            }
       
    }

?>