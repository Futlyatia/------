<?php
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);
    if($data['oldPassword'] && $data['password']){
        $oldPassword = $data['oldPassword'];
        $password = $data['password'];
        if(
        preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!#$%&'()*+,-.\/:;<=>?\\@[\]^_`{|}~]).{6,}$/", 
        $password)
        )
        {
            include("connect.php");
            $login = $_COOKIE['login'];
            $result = mysqli_query($mysqli,"SELECT `password` FROM `users` WHERE `login`='$login'");
            $row = mysqli_fetch_row($result);
            $passwordHash = $row[0];
            if(!password_verify($oldPassword, $passwordHash)){
                $response['wrongPassword'] = true;
            }
            else if(!strcmp($oldPassword, $password)){
                $response['similarPasswords'] = true;
            }
            else {
                $newHashPassword = password_hash($password, PASSWORD_DEFAULT);
                $reg_prepare = $mysqli->prepare("UPDATE `users` SET `password` = ? WHERE `login` = ?");
                $reg_prepare->bind_param("ss", $newHashPassword, $login);
                $reg_prepare->execute();
                $response["data"] = "успешно";
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