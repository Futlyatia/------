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
    <link rel="stylesheet" type="text/css" href="styles/demo.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="https:// cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.js"></script>
    <script src="//ulogin.ru/js/ulogin.js"></script>
    
</head>
<body class = "container-sm neon-border">
    <?php
        include "header.php";
        include("php/connect.php");
        if (isset($_COOKIE['login'])){
            $login = $_COOKIE['login'];
            $result = mysqli_query($mysqli,"SELECT `link_photo` FROM `users` WHERE `login`='$login'");
            $row = mysqli_fetch_row($result);
            $photo = $row[0]; 
            $result = mysqli_fetch_assoc(mysqli_query($mysqli,"SELECT track_link FROM tracks WHERE `id`  = 5 "));
            $track_link = $result['track_link'];
        } 
    ?>
    <main class="container-md">
        <h1>Добро пожаловать на NeonMusic!</h1>

        <!-- Секция с описанием проекта -->
        <section>
            <h2>О нашем проекте</h2>
            <p>
                NeonMusic - это музыкальная платформа, созданная для того, чтобы вы могли наслаждаться своей любимой музыкой в любое время и в любом месте.
                Обнаруживайте новые треки, создавайте собственные плейлисты и наслаждайтесь уникальным музыкальным опытом.
            </p>
            <p>
                Наша цель - предоставить вам легкий и удобный способ наслаждаться музыкой, а также быть в курсе последних релизов и новинок музыкальной индустрии.
                Присоединяйтесь к NeonMusic и окунитесь в мир звуков и ритмов прямо сейчас!
            </p>
        </section>

        <!-- Секция для отображения плейлистов, новых релизов и рекомендуемых треков -->
        <!-- (Код секции о плейлистах, новых релизах и рекомендуемых треках, как в предыдущих примерах) -->
    </main>
</body>