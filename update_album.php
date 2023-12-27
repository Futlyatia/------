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
        include "header.php";
        include "php/connect.php";
        $url = $_SERVER['REQUEST_URI'];
        parse_str (parse_url ( $url, PHP_URL_QUERY ), $arr);
        $album_id = $arr['id'];
        $result = $mysqli->query("SELECT album_name FROM albums WHERE `id` ='$album_id'");
        $row = $result->fetch_assoc();
        $albumName = $row['album_name'];
    ?>
    <div class="container-sm div_reg">
        <form id="uploadForm" class="h-100 d-flex align-items-center justify-content-center form" enctype="multipart/form-data">
            <div class="mb-3" hidden>
                <label for="id" class="form-label">Название трека:</label>
                <input type="text" class="form-control" name="id" id="id" value = "<?= $album_id ?>" required>
            </div>
            <div class="mb-3">
                <label for="trackName" class="form-label">Название альбома:</label>
                <input type="text" class="form-control" name="albumName" id="albumName" value = "<?= $albumName ?>" required>
            </div>

            <button type="button" class="btn btn-primary" onclick="update()">Отправить</button>
        </form>
    </div>
    <div class="neon-border"></div>
    <script type="text/javascript" src="scripts/update_track_script.js"></script>
</body>
</html>