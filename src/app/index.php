<?php
require("./init.php");

$page = (!empty($_GET['page']) ? intval($_GET['page']) : 1);
if ($page < 1) {
    $page = 1;
}
$limite = 5;
$start = ($page - 1) * $limite;
$article = viewAllArticle($db, $start, $limite);
$countArt = countArticle($db);
if ($_GET['page'] > ($countArt['nbArt'] / $limite) + 1) {

    header('location:./');
    exit;
}
require("./header.php");
?>

<div class="row"></div>
<div class="container">
    <?php
    if (!empty($article)) {
        for ($i = 0; $i < count($article); $i++) { ?>

            <div class="col s2"></div>
            <div class="col s8 m7">
                <div class="card horizontal">
                    <?php if (($i % 2) == 0) { ?>
                        <div class="card-image">

                            <img src="./img/<?= $article[$i]['image'] ?>">
                        </div>
                    <?php } ?>
                    <div class="card-stacked">
                        <div class="card-content">
                            <span class="card-title "><?= $article[$i]['title'] ?></span>
                            <p><?= $article[$i]['content'] ?></p>

                            <span class="pad-top-50 ">Auteur :  <?= $article[$i]['username'] ?></span>
                        </div>

                        <div class="card-action center-align">
                            <a class="btn blue wave" href="article.php?id=<?= intval($article[$i]['id']); ?>">Voir
                                plus</a>
                        </div>
                    </div>
                    <?php if (($i % 2) == 1) { ?>
                        <div class="card-image">
                            <img src="./img/<?= $article[$i]['image'] ?>">

                        </div>
                    <?php } ?>
                </div>
            </div>

        <?php }
        if ($page > 1) {
            ?>

            <a class="btn-floating btn-small waves left red" href="?page=<?php echo $page - 1; ?>"><i
                        class="material-icons">arrow_left</i></a>


        <?php }


        if ($countArt['nbArt'] >$limite * $start) {
            ?>
            <a class=" waves-effect waves-teal right btn-flat blue" href="?page=<?php echo $page + 1; ?>"><i
                        class="material-icons">arrow_right</i></a>

        <?php }
    } ?>
</div>
