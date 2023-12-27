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
        <form class = "d-flex form" method="post" id = 'uploadForm' name="uploadForm" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nameAlbum" class="form-label">Название альбома</label>
                <input type="text" class="form-control" id="nameAlbum" name = "nameAlbum" required>
                <div id = "loginValid" class="invalid-feedback">
                </div>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Выберите обложку:</label>
                <input type="file" class="form-control" name="photo" id="photo" accept="image/*" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="uploadTrack()">Отправить</button>
        </form>
        
    </div>
    <div class = "neon-border"></div>
    <script type="text/javascript" src="scripts/add_album_script.js"></script>
</body>
</html>