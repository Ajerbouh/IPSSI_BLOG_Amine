<?php

session_start();
$host = 'blog_mariadb';
$dbname = 'blog_bdd';
$bddUsername = 'root';
$bddPassword = 'root';

$bdd = new PDO("mysql:host=$host; dbname=$dbname", $bddUsername, $bddPassword);

function databaseUserInit(PDO $bdd)
{
    $createRequest = "CREATE TABLE user (
id INT Unsigned AUTO_INCREMENT PRIMARY KEY,
username VARCHAR (30) NOT NULL,
password VARCHAR (30) NOT NULL,
CONSTRAINT username_unique UNIQUE (username)
)";

    $bdd->exec($createRequest);
}

function databaseArticleInit(PDO $bdd)
{
    $createRequest = "CREATE TABLE article (
id INT Unsigned AUTO_INCREMENT PRIMARY KEY,
title VARCHAR (30) NOT NULL,
password VARCHAR (30) NOT NULL,
CONSTRAINT username_unique UNIQUE (username)
)";

    $bdd->exec($createRequest);
}
try {
databaseUserInit($bdd);
}
catch (Exception $e) {
    echo $e->getMessage();
}
?>