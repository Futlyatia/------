<?php
// Подключение к базе данных neonmusic и другие необходимые настройки

if (isset($_GET['term'])) {
    $term = $_GET['term'];

    // Выполните поиск в базе данных neonmusic по введенному термину
    // Здесь вы должны использовать подготовленные запросы для безопасности

    $conn = new mysqli('localhost', 'root', '', 'neonmusic');

    if ($conn->connect_error) {
        die('Ошибка подключения к базе данных: ' . $conn->connect_error);
    }

    $query = "SELECT nickname FROM performers WHERE nickname LIKE ?";
    $stmt = $conn->prepare($query);
    $searchTerm = '%' . $term . '%';
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Выводите результаты в формате JSON
    $performers = [];
    while ($row = $result->fetch_assoc()) {
        $performers[] = $row['nickname'];
    }
    echo json_encode($performers);

    // Закройте подготовленный запрос и соединение с базой данных
    $stmt->close();
    $conn->close();
}
?>