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
    <link rel="stylesheet" href="styles/question_style.css">
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
                <h4>Хотите ли вы добавить ещё одного исполнителя на ваш трек?
            </div>
            <div>
                <a class = "btn btn-primary" href="add_editor_to_track.php">Да</a>
                <a class = "btn btn-primary" href="index.php">Нет</a>
            </div>
        </form>
        
    </div>
    <div class = "neon-border"></div>
    <script type="text/javascript" src="scripts/registration_script.js"></script>
</body>
</html>