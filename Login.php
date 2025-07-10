<?php
    // Post التأكد من البيانات مدخله من داله ال 

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email=$_POST["email"] ?? null;
        $password=$_POST["password"] ?? null;

    //التأكد من البيانات داخله كامله ولا لا

        if(!$email || !$password){
            echo json_encode([
                "status"=>"error",
                "message"=>"The entry data is incomplete"
            ]);
            exit;
        }

    // validation(email not found)

        require_once("db.php");
        $sql="select * from user_information where email=?";
        $inquire=$connection->prepare($sql);
        $inquire->execute([$email]); 
        if($inquire->rowCount()==0){
            echo json_encode([
                "status"=>"error",
                "message"=>"No found email"
            ]);
            exit;
        }

    // برجع صف واحد من البيانات

        $info = $inquire->fetch(PDO::FETCH_ASSOC);

    // بتاكد من كلمه السر 

        if(!password_verify($password,$info["PASSWORD"])){
                echo json_encode([
                "status"=>"error",
                "message"=>"incorrect password"
            ]);
            exit;
        }

        $token = bin2hex(random_bytes(32));

        $insertTokenSql = "INSERT INTO token (token, user_id) VALUES (?, ?)";
        $insertTokenStmt = $connection->prepare($insertTokenSql);
        $insertTokenStmt->execute([$token, $info["id"]]);

        
        echo json_encode([
        "status" => "success",
        "message" => "تم تسجيل الدخول بنجاح",
        "info" => [
            "id" => $info["id"],
            "name" => $info["name"],
            "email" => $info["email"]
        ]
        ]);
            exit;

        } else {
            echo json_encode([
            "status" => "error",
            "message" => "should use post method"
        ]);

    }








?>