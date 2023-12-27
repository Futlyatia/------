<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $track_id = $_POST['id'];
    echo "<script>alert("$track_id");</script>";
    $conn = new mysqli('localhost', 'root', '', 'neonmusic');
    $sql = "DELETE FROM `tracks_for_albums` WHERE `track_id` = $track_id";  
    $conn->query($sql);
    $sql2 = "DELETE FROM `tracks` WHERE `id`= $track_id";
    $conn->query($sql2);
    $conn->close();
} else {
    echo 'Недопустимый метод запроса.';
}
?>