<!DOCTYPE html>
<html lang='ru'>
<head>
    <title>Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/auth_style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.js"></script>
</head>
<body class = "container-sm neon-border">
<?php
    include "header.php";
    ob_start();
    require_once "php/connect.php"; 
?>
<div class = "container-sm div_auth">
    <form class = "h-100 d-flex align-items-center justify-content-center form" method="post" id = 'formRegistration'>
        <div class="mb-3">
            <label for="login" class="form-label">Логин</label>
            <input type="text" class="form-control" id="login" name = "login" required>
        </div>
        <div class="mb-3">
            <label for = "password" class="form-label">Пароль</label>
            <input type = "password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary" id = "auth" name = "auth">Войти</button>
    </form>
</div>
    <?php
        if(isset($_POST['auth']) AND !empty($_POST['login']) AND !empty($_POST['password'])){
            $login = $_POST['login'];
            $password = $_POST['password'];
            $result = mysqli_query($mysqli,"SELECT `password` FROM `users` WHERE `login`='$login'");
            $row = mysqli_fetch_row($result);
            $passwordHash = $row[0];
            if (!password_verify($password, $passwordHash)){
                exit("<script>alert('Неверный логин или пароль')</script>");
            }
            else{
                $token = bin2hex(random_bytes(15));
                mysqli_query($mysqli, "UPDATE `users` SET `token` = '$token' WHERE `login` = '$login'");
                setcookie("token", $token, time() + 60 * 60 * 24 * 7, '/');
                setcookie("login", $login, time() + 60 * 60 * 24 * 7, '/');
                Header("location: index.php");
            }
        }
        
    ?>
</body>
</html>
