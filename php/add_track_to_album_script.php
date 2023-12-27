<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trackName = $_POST['trackName'];

    $targetDir = '../uploads/';
    $targetFile = $targetDir . basename($_FILES['audioFile']['name']);
    $uploadOk = 1;
    $audioFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Проверка размера файла
    if ($_FILES['audioFile']['size'] > 50000000000) {
        echo 'Файл слишком большой.';
        $uploadOk = 0;
    }

    // Разрешенные форматы файлов
    $allowedAudioFormats = ['mp3', 'wav', 'ogg'];
    if (!in_array($audioFileType, $allowedAudioFormats)) {
        echo 'Допустимы только MP3, WAV и OGG файлы для аудио.';
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo 'Ваш файл не был загружен.';
    } else {
        if (move_uploaded_file($_FILES['audioFile']['tmp_name'], $targetFile)) {
            // Добавление записи в базу данных
            $conn = new mysqli('localhost', 'root', '', 'neonmusic');

            if ($conn->connect_error) {
                die('Ошибка подключения к базе данных: ' . $conn->connect_error);
            }

            // Escape user inputs to prevent SQL injection
            $trackName = $conn->real_escape_string($trackName);
            $login = $conn->real_escape_string($_COOKIE['login']);
            $track_link = "uploads/" . basename($_FILES['audioFile']['name']);

            // Insert track
            $sql = "INSERT INTO `tracks` (`trackname`, `track_link`) VALUES ('$trackName', '$track_link')";
            if ($conn->query($sql) === TRUE) {
                $trackID = $conn->insert_id;

                // Insert album

                    // Get user ID
                    $result = $conn->query("SELECT id FROM users WHERE `login` ='$login'");
                    $row = $result->fetch_assoc();
                    $userID = $row['id'];

                    // Get editor ID
                    $result2 = $conn->query("SELECT id FROM editors WHERE `user_id` ='$userID'");
                    $row2 = $result2->fetch_assoc();
                    $editorID = $row2['id']; 
                    $albumID = $_COOKIE['albumID'];
                    setcookie("albumID", $albumID, time() + 60 * 60 * 24 * 7, '/');
                    // Insert editor for album
                    $sql3 = "INSERT INTO `editors_for_albums` (`editor_id`, `album_id`) VALUES ('$editorID', '$albumID')";
                    $sql4 = "INSERT INTO `tracks_for_albums` (`track_id`, `album_id`) VALUES ('$trackID', '$albumID')";
                    if ($conn->query($sql3) === TRUE) {
                        if ($conn->query($sql4) === TRUE){
                            $conn->close();
                        }
                    } else {
                        echo 'Ошибка при добавлении редактора для альбома: ' . $conn->error;
                    }
            } else {
                echo 'Ошибка при добавлении трека: ' . $conn->error;
            }
        } else {
            echo 'Произошла ошибка при загрузке файла.';
        }
    }
} else {
    echo 'Недопустимый метод запроса.';
}
?>