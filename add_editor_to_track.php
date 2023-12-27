<!DOCTYPE html>
<html lang='ru'>
<head>
    <title>Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles/reg_style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.js"></script>
</head>
<body class="container-sm neon-border">
    <?php
        include "header.php";
    ?>
    <div class="container-sm div_reg">
        <form id="uploadForm" class="h-100 d-flex align-items-center justify-content-center form" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nickname" class="form-label">Никнейм исполнителя:</label>
                <input type="text" class="form-control" name="nickname" id="nickname" required>
                <div id = "nicknameValid" class="invalid-feedback">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
    <div class="neon-border"></div>
    <script src="scripts/add_editor_to_track_script.js"></script>
    <script>
    $(document).ready(function() {
        // Определите массив для хранения подсказок
        var availablePerformers = [];

        // Отправка AJAX-запроса для получения подсказок
        $.ajax({
            type: "GET",
            url: "search_performer.php",
            data: { term: '' }, // Пустой term для получения всех исполнителей
            success: function(data) {
                availablePerformers = data;
            },
            error: function(error) {
                console.log(error);
            }
        });

        // Инициализация поля ввода с подсказками
        $("#nickname").autocomplete({
            source: availablePerformers,
            minLength: 2, // Минимальная длина ввода перед показом подсказок
            select: function(event, ui) {
                // Пользователь выбрал подсказку, обработайте действия при выборе
                console.log("Selected: " + ui.item.value);
            }
        });

        // Добавьте обработчик для кнопки "Отправить", чтобы отправить данные формы
        $(".btn-primary").on("click", function() {
            // Здесь можете добавить код для отправки данных формы
            // например, $("#uploadForm").submit();
        });
    });
    </script>
</body>
</html>