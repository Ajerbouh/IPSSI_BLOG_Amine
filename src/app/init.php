<?php
declare(strict_types=1);
session_start();
if ($_GET['disconnect']) {
    session_destroy();
    header("location:./");
}
require("../app/function.php");
$db = initDatabase($host,$dbName,$user, $pass);
if (!empty ($_POST['connect'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    userConnect($db, $username, $password);

}

