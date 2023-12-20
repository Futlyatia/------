<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
  <link rel="stylesheet" href="styles/header_style.css">
</head>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">NeonMusic</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
              <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <form class="d-flex">
                  <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </ul>
              <?php
                include("php/connect.php");
                if (isset($_COOKIE['login'])){
                  $login = $_COOKIE['login'];
                  $result = mysqli_query($mysqli, "SELECT `token` FROM `users` WHERE `login` = '$login'");
                  $row = mysqli_fetch_row($result);
                  $token = $row[0];
                  $login = $_COOKIE['login'];
                  $result = mysqli_query($mysqli,"SELECT `link_photo` FROM `users` WHERE `login`='$login'");
                  $row = mysqli_fetch_row($result);
                  $photo = $row[0];
                  if (isset($_COOKIE['login']) && isset($_COOKIE['token']) && $_COOKIE['token'] == $token){
                  ?>
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-bs-toggle = "dropdown" href="">
                        <span class = "nickname"><?=$login?></span>
                        <img src="<?= $photo ?>" class = "avatar">
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                          <a class="dropdown-item" href="#">
                            <i class="fas fa-sign-out-alt"></i>
                            Выход
                          </a>
                        </li>
                        <li><a class="dropdown-item" href="#"></a></li>
                      </ul>
                    </li>
                  </ul>
                <?php } } else{
              ?>
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="registration.php">Регистрация</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="authorization.php">Войти</a>
                </li>
              </ul>
              <?php } ?>
            </div>
        </div>
      </nav>
    </header>
