<?php
$jsonData = file_get_contents("php://input");
$data = json_decode($jsonData, true);
    if($data['nickname']){
        $nickname = $data["nickname"];
        include("connect.php");
        $result = mysqli_query($mysqli,"SELECT `id` FROM `editors` WHERE `nickname`='$nickname'");
        $myrow = mysqli_fetch_array($result);
        if(empty($myrow)){
            if(empty($myrow)){
                $response["noNickname"] = true;
            }
        } 
        else {
            $result2 = $mysqli->query("SELECT id FROM editors WHERE `nickname` ='$nickname'");
            $row2 = $result2->fetch_assoc();
            $editorID = $row2['id']; 
            $albumID = $_COOKIE['albumID'];
            $result3 = mysqli_query($mysqli,"SELECT `id` FROM `editors_for_albums` WHERE `album_id`='$albumID' AND `editor_id` = '$editorID'");
            $myrow2 = mysqli_fetch_array($result);
            if (!empty($myrow2))
            {
                $response["editorInList"] = true;
            }
            $reg_prepare = $mysqli->prepare(
                "INSERT INTO `editors_for_albums`(`editor_id`, `album_id`) 
                VALUES (?,?)"
            );
            $reg_prepare->bind_param("dd", $editorID, $albumID );
            $reg_prepare->execute();
            $response['redirect'] = "question.php";
        }
    }
    else{
        $response["data"] = "Ошибка отправки данных";
    }
    echo json_encode($response);
    ?>