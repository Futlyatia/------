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
    <link rel="stylesheet" href="styles/music.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https:// cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
</head>
<body class = "container-sm neon-border">
    <?php
        include "header.php";
        include("php/connect.php");
        $searchQuery = isset($_GET['query']) ? $_GET['query'] : '';
        $sql = "SELECT albums.id, tracks.trackname, tracks.track_link, albums.photo, albums.album_name
            FROM tracks
            JOIN tracks_for_albums ON tracks.id = tracks_for_albums.track_id
            JOIN albums ON tracks_for_albums.album_id = albums.id
            WHERE tracks.trackname LIKE '%$searchQuery%'";
        $result = $mysqli->query($sql);
    ?>
    <main class = "container-md">
        <section class = "movie-container container-xxl">
            <div class = "row">
                <?php
                while ($row = $result->fetch_assoc()) {
                    
                 ?>
                <div class = "col-12 col-md-6 col-lg-4 ">
                    <div class = "audio-card">
                       <img src="<?= $row['photo'] ?>" alt="Track Photo" class="track-photo mb-2">
                       <span><?php echo $row['trackname'] ?></span>
                       <span><?php
                       $album_id = $row['id'];
                       $sql2 = "SELECT editors.nickname 
                       FROM editors 
                       JOIN editors_for_albums ON editors.id = editors_for_albums.editor_id WHERE editors_for_albums.album_id = '$album_id'";
                       $result2 = $mysqli->query($sql2);
                       while ($row2 = $result2->fetch_assoc()){
                            echo $row2['nickname'] . " ";
                       }
                       ?>
                       <audio controls>
                            <source src="<?= $row['track_link'] ?>" type="audio/mpeg">
                        </audio>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section>
    </main>
</body>