<?php

require("./init.php");
/*  Check if the GET id and the id is better than zero;
    After I checking if the button submit is good, is good I insert the comment
 */
if (!empty($_GET['id'] && intval($_GET['id']) > 0)) {
    if (!empty($_POST['comment'])) {
        $username = htmlentities($_POST['username']);
        $content = htmlentities($_POST['content']);
        $id = strip_tags($_GET['id']);
        insertComment($db, $username, $content, $id);
        header('location: article.php?id=' . $_GET['id']);
    }
    $id = strip_tags($_GET['id']);
    $article = viewArticle($db, $id);
    $comment = viewComment($db, $id);
    require("./header.php");
    ?>
    <div class="row"></div>
    <div class="container">
        <div class="col s2"></div>
        <div class="col s8">
            <div class="card horizontal">
                <div class="card-image">
                    <img class='materialboxed' src="img/<?= $article['image'] ?>">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title font-mlp"><?= $article['title'] ?></span>
                        <p><?= $article['content'] ?></p>
                    </div>
                    <div class="card-action">
                        <p class="font-mlp right-align">Auteur : <?= $article['username'] ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php while ($viewComment = $comment->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <div class="container">

            <div class="col s8">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title font-mlp"><?= $viewComment['username'] ?></span>
                        <p><?= $viewComment['content'] ?></p>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>


    <div class="container">


        <div class="col s8">
            <div class="card ">
                <form class="card-content" id="reg-form" method="post">
                    <div class="row">
                        <span class="card-title font-mlp">Commentez</span>
                        <div class="input-field col s12">
                            <?php if (!empty($_SESSION['username'])) { ?>
                                <input id="username" type="text" class="validate" name="username"
                                       value="<?= $_SESSION['username'] ?>" required>
                                <label for="username">Utilisateur</label>
                            <?php } else { ?>
                                <input id="username" type="text" class="validate" name="username" required>
                                <label for="username">Utilisateur</label>
                            <?php } ?>

                        </div>

                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="content" class="materialize-textarea" name="content" required></textarea>
                            <label for="content">Commentaire</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s9">
                            &nbsp;
                        </div>
                        <div class="input-field col s3">
                            <button class="btn btn-small btn-register waves-effect waves-light blue" type="submit"
                                    name="comment" value="1">
                                Commenter
                                <i class="material-icons right">done</i>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="col s2"></div>
    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            $('.materialboxed').materialbox();
        });
    </script>
<?php } else {
   header('location:https://www.youtube.com/watch?v=ZcBNxuKZyN4');

} ?>