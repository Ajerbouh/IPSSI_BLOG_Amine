<?php
require("../protected/init.php");

if (!empty($_SESSION['username'])) {
    if (!empty($_GET['id']) && !empty($_GET['edit'])) {
        $edit = $_GET['edit'];
        $verify = $_GET['id'] . $_SESSION['id'];

        if (password_verify($verify, $edit)) {
            $id = $_GET['id'];
            $article = viewArticle($db, $id);
            if (!empty($_POST['edit'])) {
                $title = htmlentities($_POST['title']);
                $content = htmlentities($_POST['content']);
                if ($_POST['filename'] == $article['image']) {
                    $image = $article['image'];
                } else {
                    $image = deplaceImg($_FILES['img']);
                }
                editArticle($db, $title, $content, $image, $id);
                redirection('./dashboard.php');
            }
        }
    }
}


if (!empty($_SESSION['username'])) {
    require("./header.php");
    ?>
    <div class="row"></div>
    <div class="container">

        <div class="col s8">
            <div class="card ">
                <div class="card-image">
                    <img src="./img/mlp-subscribe.jpg">
                    <span class="card-title font-mlp">Modification d'article</span>
                </div>
                <form class="card-content" id="reg-form" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="title" type="text" class="validate" name="title" value="<?= $article['title'] ?>"
                                   required>
                            <label for="title">Titre</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="content" class="materialize-textarea" name="content"
                                      required><?= $article['content'] ?></textarea>
                            <label for="content">Article</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <div class="file-field input-field">
                                <div class="btn pink pulse">
                                    <span>Image</span>
                                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="img"
                                    >
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" value="<?= $article['image'] ?>"
                                           name="filename">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <a class="btn btn-small btn-register waves-effect waves-light center red pulse" href="dashboard.php">Annuler
                                <i class="material-icons right">cancel</i>
                            </a>
                        </div>
                        <div class="input-field col s6">
                            &nbsp;
                        </div>
                        <div class="input-field col s3">
                            <button class="btn btn-small btn-register waves-effect waves-light purple right pulse" type="submit"
                                    name="edit" value="1">
                                Editer
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
