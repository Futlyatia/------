<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $albumName = $_POST['nameAlbum'];

    $targetDir = '../uploads/';
    $targetFile2 = $targetDir . basename($_FILES['photo']['name']);
    $uploadOk = 1;
    $photoFileType = strtolower(pathinfo($targetFile2, PATHINFO_EXTENSION));

    $allowedPhotoFormats = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($photoFileType, $allowedPhotoFormats)) {
        echo 'Допустимы только JPG, JPEG, PNG и GIF файлы для фото.';
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo 'Ваш файл не был загружен.';
    } else {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile2)) {
            // Добавление записи в базу данных
            $conn = new mysqli('localhost', 'root', '', 'neonmusic');

            if ($conn->connect_error) {
                die('Ошибка подключения к базе данных: ' . $conn->connect_error);
            }

            // Escape user inputs to prevent SQL injection
            $login = $conn->real_escape_string($_COOKIE['login']);
            $album_photo = "uploads/" . basename($_FILES['photo']['name']);

            // Insert track
            $sql = "INSERT INTO `albums` (`album_name`, `photo`) VALUES ('$albumName', '$album_photo')";
            if ($conn->query($sql) === TRUE) {
                $albumID = $conn->insert_id;

                // Insert album
                $sql2 = "INSERT INTO `albums` (`album_name`, `photo`) VALUES ('$trackName', '$track_photo')";

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
                    if ($conn->query($sql3) === TRUE) {
                            $conn->close();
                    } else {
                        echo 'Ошибка при добавлении редактора для альбома: ' . $conn->error;
                    }
            } else {
                echo 'Ошибка при добавлении альбома: ' . $conn->error;
            }
        } else {
            echo 'Произошла ошибка при загрузке файла.';
        }
    }
} else {
    echo 'Недопустимый метод запроса.';
}
?>