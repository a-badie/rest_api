<?php

    header("Content-Type: application/json");

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        echo json_encode([
            "status" => "error",
            "message" => "الطلب غير مسموح"
        ]);
        exit;
    }

    $token = $_POST["token"] ?? null;

    if (!$token) {
        echo json_encode([
            "status" => "error",
            "message" => "من فضلك أرسل التوكن"
        ]);
        exit;
    }

    require_once("db.php");

    $sql="select user_information.id , user_information.name , user_information.email from token
          join user_information on token.user_id = user_information.id  where token.token = ?  limit 1 ";

    $inquire=$connection->prepare($sql);
    $inquire->execute([$token]);

    $info = $inquire->fetch(PDO::FETCH_ASSOC);

    if(!$info){
        echo json_encode([
        "status" => "error",
        "message" => "توكن غير صالح أو منتهي"
    ]);
        exit;
    }

    
    echo json_encode([
    "status" => "success",
    "message" => "تم التحقق من التوكن بنجاح",
    "info" => $info
    ]);



?>