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
<body class="container-sm neon-border">
    <?php
        include "header.php"
    ?>
    <form class = "h-100 d-flex align-items-center justify-content-center form" method="post" id = 'formChangePassword' name="formChangePassword">
        <div class="mb-3">
            <label for = "password" class="form-label">Старый пароль</label>
            <input type = "password" class="form-control" id="oldPassword" name="oldPassword" required>
            <div id = "oldPasswordValid" class="invalid-feedback">
            </div>
        </div>
        <div class="mb-3">
            <label for="password_submit" class="form-label">Новый пароль</label>
            <input type = "password" class="form-control" id="password" name="password" oninput="checkPassword(this)" required>
            <div id = "passwordValid" class="invalid-feedback">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" id = "save" name = "save">Сохранить</button>
        <a href="index.php" class="btn btn-primary">Отмена</a>
    </form>
    <script type="text/javascript" src="scripts/change_password_script.js"></script>
</body>
</html>
