<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
  <link rel="stylesheet" href="styles/header_style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>
    <header class = "container-sm">
      <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #000000">
        <div class="container-fluid">
          <a class="navbar-brand " href="index.php">
            <h3 class = "neon-text">NeonMusic</h3>
          </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
              <ul class="navbar-nav mr-auto mb-2 mb-lg-0 menu">
                <li class="nav-item">
                  <a class="nav-link" href="tracks.php">Треки</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="albums.php">Албомы</a>
                </li>
                <form class="d-flex">
                  <input type="text" class="form-control" id="searchInput" name="query" placeholder="Search" aria-label="Search">
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
                  $result = mysqli_fetch_assoc(mysqli_query($mysqli,"SELECT role_id FROM users WHERE `login` ='$login'"));
                  $role = $result['role_id'];
                  if (isset($_COOKIE['login']) && isset($_COOKIE['token']) && $_COOKIE['token'] == $token){
                  ?>
                  <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" data-bs-toggle = "dropdown" href="">
                        <span class = "nickname"><?=$login?></span>
                        <img src="<?= $photo ?>" class = "avatar">
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if ($role == 3) { ?>
                        <li>
                          <a class="dropdown-item" href="add_track.php">
                          <i class="fas fa-music"></i>
                            Добавить трек
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="add_album.php">
                          <i class="fas fa-record-vinyl"></i>
                            Добавить альбом
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="albums_from_editor.php">
                          <i class="fas fa-record-vinyl"></i>
                            Ваши альбомы
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="tracks_from_editor.php">
                          <i class="fas fa-record-vinyl"></i>
                            Ваши треки
                          </a>
                        </li>
                        <?php } ?>
                        <li>
                          <a class="dropdown-item" href="changePassword.php">
                            <i class="fas fa-key"></i>
                            Сменить пароль
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item" href="php/logout.php">
                            <i class="fas fa-sign-out-alt"></i>
                            Выход
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                <?php } else{
              ?>
              <ul class="navbar-nav ml-auto menu">
                <li class="nav-item">
                  <a class="nav-link" href="registration.php">Регистрация</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="authorization.php">Вход</a>
                </li>
              </ul>
              <?php } } else{
                ?>
                <ul class="navbar-nav ml-auto menu">
                <li class="nav-item">
                  <a class="nav-link" href="registration.php">Регистрация</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="authorization.php">Вход</a>
                </li>
              </ul>
              <?php } ?>
            </div>
        </div>
      </nav>
    </header>
