<?php
require("./init.php");
$id = $_SESSION['id'];
$viewArticle = viewUserArticle($db, $id);
$options = ['cost' => 10];
if (!empty($_SESSION['username'])) {
    if (!empty($_GET['id']) && !empty($_GET['delete'])) {
        $delete = $_GET['delete'];
        $verify = $_GET['id'] . $_SESSION['id'];

        if (password_verify($verify, $delete)) {
            $id = $_GET['id'];
            deleteArticle($db, $id);
            header('location:./dashboard.php');

        } else {
            header('location:https://www.youtube.com/watch?v=ZcBNxuKZyN4');

        }
    }

    require('./header.php');
    ?>
    <div class="container">
    <div class="col s8">
        <div class="card ">
            <div class="card-content">
                <table class="highlight responsive-table">
            <div class="center-align">
                <span class="card-title font">Mon tableau de bord</span>
            </div>
                    <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th class="right-align"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($viewArticle as $article) { ?>
                        <tr>
                            <td>
                                <p><?= $article['title'] ?></p>
                            </td>
                            <td>
                                <p><?= substr($article['content'], 0, 75) . '...' ?></p>
                            </td>
                            <td class="right">
                                <a class="btn-floating blue" href="article.php?id=<?= intval($article['id']); ?>"><i class="material-icons">pageview</i></a>
                                <a class="btn-floating green" href="edit.php?id=<?= $article['id'] ?>&edit=<?= password_hash($article['id'] . $_SESSION['id'], PASSWORD_BCRYPT, $options) ?>"><i class="material-icons">edit</i></a>
                                <a class="btn-floating red"
                                   href="dashboard.php?id=<?= $article['id'] ?>&delete=<?= password_hash($article['id'] . $_SESSION['id'], PASSWORD_BCRYPT, $options) ?>"><i
                                            class="material-icons">remove</i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
            </div>
        </div>
    </div>


<?php } else {
    redirection('https://www.youtube.com/watch?v=ZcBNxuKZyN4');
} ?>