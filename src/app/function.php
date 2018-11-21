<?php
require('./info.php');

function initDatabase(string $host, string $dbName, string $user, string $pass)
{
    try {

        $dbh = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
        return $dbh;
    } catch (PDOException $e) {
        die('Error' . $e->getMessage());
    }
}


function verifyUsername(PDO $db, string $username)
{
    $sttVerify = $db->prepare('select username from users where username=:username');
    $sttVerify->bindParam(':username', $username);
    $sttVerify->execute();
    $usernameVerify = $sttVerify->fetch();
    if (!empty($usernameVerify)) {
        $usernameExist = TRUE;
    } else {
        $usernameExist = FALSE;
    }
    return (bool)$usernameExist;
}

function insertUser(PDO $db, string $username, string $password)
{
    $sttInsert = $db->prepare('insert into users (username,password) values (:username,:password)');
    $sttInsert->bindParam(':username', $username);
    $sttInsert->bindParam(':password', $password);
    $sttInsert->execute();
}

function userConnect(PDO $db, string $username, string $password)
{
    $sttConnect = $db->prepare('select * from users where username=:username');
    $sttConnect->bindParam(':username', $username);
    $sttConnect->execute();
    $pass = $sttConnect->fetch();
    $hashpass = $pass['password'];

    if (password_verify($password, $hashpass)) {
        $_SESSION['username'] = $pass['username'];
        $_SESSION['id'] = $pass['id'];
    }

}

function countArticle(PDO $db): array
{
    $sttCountArt = $db->query("select count(*) as nbArt from articles");

    return $sttCountArt->fetch(PDO::FETCH_ASSOC);
}

function viewAllArticle(PDO $db, int $start, int $limit): array
{
    $sttViewAll = $db->prepare('select a.id, title,content,image,username from articles a left join users u on a.author = u.id order by a.id DESC limit :start,:limit  ');
    $sttViewAll->bindParam(':limit', $limit, PDO::PARAM_INT);
    $sttViewAll->bindParam(':start', $start, PDO::PARAM_INT);
    $sttViewAll->execute();
    $viewAll = $sttViewAll->fetchAll(PDO::FETCH_ASSOC);
    return $viewAll;
}

function viewArticle(PDO $db, int $id): array
{
    $sttViewArt = $db->prepare('select a.id, title,content,image,username from articles a left join users u on a.author = u.id where a.id=:id ');
    $sttViewArt->bindParam(':id', $id, PDO::PARAM_INT);
    $sttViewArt->execute();
    $viewArt = $sttViewArt->fetch(PDO::FETCH_ASSOC);
    return $viewArt;
}

function viewUserArticle(PDO $db, int $id): array
{
    $sttViewUserArt = $db->prepare('select a.id, title,a.content,image from articles a  where a.author=:id ');
    $sttViewUserArt->bindParam(':id', $id, PDO::PARAM_INT);
    $sttViewUserArt->execute();
    $viewUserArt = $sttViewUserArt->fetchAll(PDO::FETCH_ASSOC);
    return $viewUserArt;
}

function viewComment(PDO $db, int $id)
{
    $sttViewComment = $db->prepare('select c.id,a.id,c.content, username  from articles a right join comments c on a.id = c.article where a.id=:id ');
    $sttViewComment->bindParam(':id', $id, PDO::PARAM_INT);
    $sttViewComment->execute();
    return $sttViewComment;
}

function insertComment(PDO $db, string $username, string $content, int $article)
{
    $sttInsertComment = $db->prepare('insert into comments (username, content, article) values (:username,:content,:article)');
    $sttInsertComment->bindParam(':username', $username);
    $sttInsertComment->bindParam(':content', $content);
    $sttInsertComment->bindParam(':article', $article, PDO::PARAM_INT);
    $sttInsertComment->execute();

}

function deplaceImg(array $file): string
{

    $uploads_dir = './img/';
    $tmp_name = $file['tmp_name'];
    $name = uniqid() . '-' . $file['name'];
    move_uploaded_file($tmp_name, "$uploads_dir/$name");
    return $name;


}

function insertArticle(PDO $db, string $title, string $content, string $image, int $author)
{
    $sttInsertArt = $db->prepare('insert into articles (title,content,image,author) values (:title,:content,:image,:author)');
    $sttInsertArt->bindParam(':title', $title);
    $sttInsertArt->bindParam(':content', $content);
    $sttInsertArt->bindParam(':image', $image);
    $sttInsertArt->bindParam(':author', $author, PDO::PARAM_INT);
    $sttInsertArt->execute();

}

function deleteArticle(PDO $db, int $id)
{
    $sttDeleteArt = $db->prepare('delete from articles where id=:id');
    $sttDeleteArt->bindParam(':id', $id, PDO::PARAM_INT);
    $sttDeleteArt->execute();
}

function editArticle(PDO $db, string $title, string $content, string $image, int $id)
{
    $sttEditArt = $db->prepare('update articles set title=:title,content=:content, image=:image where id=:id');
    $sttEditArt->bindParam(':title', $title);
    $sttEditArt->bindParam(':content', $content);
    $sttEditArt->bindParam(':image', $image);
    $sttEditArt->bindParam(':id', $id, PDO::PARAM_INT);
    $sttEditArt->execute();

}