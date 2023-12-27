<?php
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);
    if($data['login'] && $data['password'] && $data["nickname"] && $data["about"]){
        $login = $data["login"];
        $password = $data["password"];
        $nickname = $data["nickname"];
        $about = $data["about"];
        if(
        preg_match("/^[a-zA-Z\d]{3,16}$/", $login) &&
        preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!#$%&'()*+,-.\/:;<=>?\\@[\]^_`{|}~]).{6,}$/", 
        $password)
        )
        {
            include("connect.php");
            $result = mysqli_query($mysqli,"SELECT `id` FROM `users` WHERE `login`='$login'");
            $myrow = mysqli_fetch_array($result);
            $result1 = mysqli_query($mysqli,"SELECT `id` FROM `editors` WHERE `nickname`='$nickname'");
            $myrow1 = mysqli_fetch_array($result);
            if(!empty($myrow) && !empty($myrow1)){
                if(!empty($myrow)){
                    $response["busyLogin"] = true;
                }
                else{
                    $response["busyLogin"] = false;
                }
                if(!empty($myrow1)){
                    $response["busyNickname"] = true;
                }
                else{
                    $response["busyNickname"] = false; 
                }
                
            }
            else{
                $response["busyLogin"] = false;
                $response["busyNickname"] = false; 
                $role_id = 3;
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $token = bin2hex(random_bytes(15));
                $reg_prepare = $mysqli->prepare(
                    "INSERT INTO `users`(`login`, `password`, `token`,`role_id`) 
                    VALUES (?,?,?,?)"
                );
                $reg_prepare->bind_param("sssd", $login, $hashPassword, $token, $role_id);
                $reg_prepare->execute();
                $result = mysqli_fetch_assoc(mysqli_query($mysqli,"SELECT id FROM users WHERE `login` ='$login'"));
                $id = $result['id'];
                $reg_prepare1 = $mysqli->prepare(
                    "INSERT INTO `editors` (`nickname`,`about`,`user_id`)
                    VALUES (?,?,?)"
                );
                $reg_prepare1->bind_param("ssd", $nickname, $about,$id);
                $reg_prepare1->execute();
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