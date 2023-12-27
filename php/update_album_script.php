<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $albumName = $_POST['albumName'];
    $album_id = $_POST['id'];
    $conn = new mysqli('localhost', 'root', '', 'neonmusic');
    $sql = "UPDATE `albums` SET `album_name` = '$albumName' WHERE id = $album_id";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
    } else {
        echo 'Ошибка при добавлении редактора для альбома: ' . $conn->error;
    }
} else {
    echo 'Недопустимый метод запроса.';
}
?>