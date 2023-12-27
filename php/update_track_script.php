<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trackName = $_POST['trackName'];
    $track_id = $_POST['id'];
    $conn = new mysqli('localhost', 'root', '', 'neonmusic');
    $sql = "UPDATE `tracks` SET `trackname` = '$trackName' WHERE id = $track_id";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
    } else {
        echo 'Ошибка при добавлении редактора для альбома: ' . $conn->error;
    }
} else {
    echo 'Недопустимый метод запроса.';
}
?>