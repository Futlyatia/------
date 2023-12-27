<!DOCTYPE html>
<html lang='ru'>
<head>
    <title>Index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/album.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https:// cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
</head>
<body class = "container-sm neon-border">
    <?php
        include "header.php";
        include("php/connect.php");
        $login = $_COOKIE['login'];
        $result3 = $mysqli->query("SELECT id FROM users WHERE `login` ='$login'");
        $row3 = $result3->fetch_assoc();
        $userID = $row3['id'];
        $result2 = $mysqli->query("SELECT id FROM editors WHERE `user_id` ='$userID'");
        $row2 = $result2->fetch_assoc();
        $editorID = $row2['id']; 
        $sql = "SELECT albums.id, albums.photo, albums.album_name FROM albums 
        JOIN editors_for_albums ON editors_for_albums.album_id = albums.id
        WHERE editors_for_albums.editor_id = $editorID";
        $result = $mysqli->query($sql);
    ?>
    <main class = "container-md">
        <section class = "movie-container container-xxl">
            <div class = "row">
            <?php
                while ($row = $result->fetch_assoc()) {
                 ?>
                <div class = "col-12 col-md-6 col-lg-4 ">
                    <a href="tracks_from_albums.php?id=<?= $row['id'] ?>">
                        <div class="card">
                            <img src="<?= $row['photo']?>" class="card-img-top" alt="Изображение плейлиста">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['album_name']?></h5>
                                <p class="card-text">
                                    <?php 
                                    $album_id = $row['id'];
                                    $sql2 = "SELECT editors.nickname 
                                    FROM editors 
                                    JOIN editors_for_albums ON editors.id = editors_for_albums.editor_id WHERE editors_for_albums.album_id = '$album_id'";
                                    $result2 = $mysqli->query($sql2);
                                    while ($row2 = $result2->fetch_assoc()){
                                         echo $row2['nickname'] . " ";
                                    }
                                    ?>
                                </p>
                            </div>
                            </a>
                            <a type="button" class="btn btn-primary" href = "update_album.php?id=<?= $album_id ?>">Редактировать</a>
                        </div>
                        
                    
                </div>
                <?php } ?>
            </div>
        </section>
    </main>
</body>