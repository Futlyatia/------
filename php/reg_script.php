<?php
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);
    if($data['login'] && $data['password']){
        $login = $data["login"];
        $password = $data["password"];
        if(
        preg_match("/^[a-zA-Z\d]{3,16}$/", $login) &&
        preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!#$%&'()*+,-.\/:;<=>?\\@[\]^_`{|}~]).{6,}$/", 
        $password)
        )
        {
            include("connect.php");
            $result = mysqli_query($mysqli,"SELECT `id` FROM `users` WHERE `login`='$login'");
            $myrow = mysqli_fetch_array($result);
            if(!empty($myrow)){
                if(!empty($myrow)){
                    $response["busyLogin"] = true;
                }
            } 
            else {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $token = bin2hex(random_bytes(15));
                $reg_prepare = $mysqli->prepare(
                    "INSERT INTO `users`(`login`, `password`, `token`) 
                    VALUES (?,?,?)"
                );
                $reg_prepare->bind_param("sss", $login, $hashPassword, $token);
                $reg_prepare->execute();
                setcookie("token", $token, time() + 60 * 60 * 24 * 7, '/');
                setcookie("login", $login, time() + 60 * 60 * 24 * 7, '/');
                $response["data"] = "регистрация";
                $response['redirect'] = "index.php";
            }
        }
        else{
            $response["data"] = "Данные введены неверно";
        }
    }
    else{
        $response["data"] = "Ошибка отправки данных";
    }
    echo json_encode($response);
    ?>