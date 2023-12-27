<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trackName = $_POST['trackName'];

    $targetDir = '../uploads/';
    $targetFile = $targetDir . basename($_FILES['audioFile']['name']);
    $targetFile2 = $targetDir . basename($_FILES['photo']['name']);
    $uploadOk = 1;
    $audioFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $photoFileType = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));

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

    $allowedPhotoFormats = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($photoFileType, $allowedPhotoFormats)) {
        echo 'Допустимы только JPG, JPEG, PNG и GIF файлы для фото.';
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo 'Ваш файл не был загружен.';
    } else {
        if (move_uploaded_file($_FILES['audioFile']['tmp_name'], $targetFile) && move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile2)) {
            // Добавление записи в базу данных
            $conn = new mysqli('localhost', 'root', '', 'neonmusic');

            if ($conn->connect_error) {
                die('Ошибка подключения к базе данных: ' . $conn->connect_error);
            }

            // Escape user inputs to prevent SQL injection
            $trackName = $conn->real_escape_string($trackName);
            $login = $conn->real_escape_string($_COOKIE['login']);
            $track_link = "uploads/" . basename($_FILES['audioFile']['name']);
            $track_photo = "uploads/" . basename($_FILES['photo']['name']);

            // Insert track
            $sql = "INSERT INTO `tracks` (`trackname`, `track_link`) VALUES ('$trackName', '$track_link')";
            if ($conn->query($sql) === TRUE) {
                $trackID = $conn->insert_id;

                // Insert album
                $sql2 = "INSERT INTO `albums` (`album_name`, `photo`) VALUES ('$trackName', '$track_photo')";
                if ($conn->query($sql2) === TRUE) {
                    $albumID = $conn->insert_id;

                    // Get user ID
                    $result = $conn->query("SELECT id FROM users WHERE `login` ='$login'");
                    $row = $result->fetch_assoc();
                    $userID = $row['id'];

                    // Get editor ID
                    $result2 = $conn->query("SELECT id FROM editors WHERE `user_id` ='$userID'");
                    $row2 = $result2->fetch_assoc();
                    $editorID = $row2['id']; 

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
                    echo 'Ошибка при добавлении альбома: ' . $conn->error;
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