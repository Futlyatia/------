<?php
    ob_start();
    require_once "connect.php";
    $login = $_COOKIE['login'];
    $token = bin2hex(random_bytes(15));
    mysqli_query($mysqli, "UPDATE `users` SET `token` = '$token' WHERE `login` = '$login'");
    header('Location: ../index.php');
?>