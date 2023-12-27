<?php
?>
<!DOCTYPE html>
<html lang='ru'>
<head>
    <title>Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/reg_style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.js"></script>
</head>
<body class = "container-sm neon-border">
    <?php
      
        include "header.php";
    ?>
    <div class = "container-sm div_reg ">
        <form class = "d-flex form" method="post" id = 'formRegistration' name="formRegistration" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="login" class="form-label">Логин</label>
                <input type="text" class="form-control" id="login" name = "login" oninput = "checkLogin(this)" required>
                <div id = "loginValid" class="invalid-feedback">
                </div>
            </div>
            <div class="mb-3">
                <label for = "password" class="form-label">Пароль</label>
                <input type = "password" class="form-control" id="password" name="password" oninput="checkPassword(this)" required>
            </div>
            <div class="mb-3">
                <label for="password_submit" class="form-label">Повторите пароль</label>
                <input type = "password" class="form-control" id="password_submit" name="password_submit" oninput="checkSubmitPassword(this)" required>
            </div>
            <div class="mb-3">
                <label for="nickname" class="form-label">Никнейм</label>
                <input type = "text" class="form-control" id="nickname" name="nickname" required>
            </div>
            <div class="input-group">
                <label for="biography" class="form-label">О себе</label>
                <textarea class="form-control" aria-label="С текстовым полем" id="about" name="about"></textarea>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreement" required>
                <label class="form-check-label" for="agreement">Я согласен на обработку персональных данных</label>
            </div>
            <button type="submit" class="btn btn-primary" id = "register" name = "register">Зарегистрироваться</button>
        </form>
        
    </div>
    <script type="text/javascript" src="scripts/reg_editor_script.js"></script>
</body>
</html>