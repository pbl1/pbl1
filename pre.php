<?php
session_start();

$_SESSION["is_login"] = false;
$_SESSION["userId"] = isset($_SESSION["userId"]) ? $_SESSION["userId"] : '';
$_SESSION["userName"] = isset($_SESSION["userName"]) ? $_SESSION["userName"] : '';

$http_host = '//' . $_SERVER['SERVER_NAME'];
$id = "pbl1"; #フォルダ名に変更する

$index_php = $http_host . '/' . $id . '/index.php';
<<<<<<< HEAD
$post_php = $http_host . '/' . $id . '/insert_article/article.php';
=======
$post_php = $http_host . '/' . $id . '/post/post.php';
>>>>>>> 6b023fbe301576bb6d9010692e2b64e2bc4f00d5
$login_php = $http_host . '/' . $id . '/user/login.php';
$logout_php = $http_host . '/' . $id . '/user/logout.php';
$signup_php = $http_host . '/' . $id . '/user/signup.php';

<<<<<<< HEAD
$style_css = $http_host . '/' . $id . '/css/style.css';
=======
$layout_css = $http_host . '/' . $id . '/css/layout.css';
$post_css = $http_host . '/' . $id . '/css/post.css';
>>>>>>> 6b023fbe301576bb6d9010692e2b64e2bc4f00d5