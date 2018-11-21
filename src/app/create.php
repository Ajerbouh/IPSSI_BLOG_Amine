<?php

require("./init.php");
if (!empty($_POST['create'])) {
    $title = htmlentities($_POST['title']);
    $content = htmlentities($_POST['content']);
    $image = deplaceImg($_FILES['img']);
    $id = $_SESSION['id'];
    insertArticle($db, $title, $content, $image, $id);
    header('location:./');
    exit;

}


if (!empty($_SESSION['username'])) {
    require("./header.php");
    ?>
    <div class="row"></div>
    <div class="container">

        <div class="col s8">
            <div class="card">
                <form class="card-content" id="reg-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="center-align">
                            <span class="card-title font ">Création d'un article</span>
                        </div>
                        <div class="input-field col s12">
                            <input id="title" type="text" class="validate" name="title" required>
                            <label for="title">Titre</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="content" class="materialize-textarea" name="content" required></textarea>
                            <label for="content">Article</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <div class="file-field input-field">
                                <div class="btn green ">
                                    <span>Image</span>
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="img">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <a class="btn btn-small btn-register waves-effect waves-light center red " href="./">Annuler
                                <i class="material-icons right">cancel</i>
                            </a>
                        </div>
                        <div class="input-field col s6">
                            &nbsp;
                        </div>
                        <div class="input-field col s3">
                            <button class="btn btn-small btn-register waves-effect waves-light right blue"
                                    type="submit" name="create" value="1">
                                Créer
                                <i class="material-icons right">done</i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="col s2"></div>
    </div>


<?php } else {
    header('location:https://www.youtube.com/watch?v=ZcBNxuKZyN4');

} ?>
