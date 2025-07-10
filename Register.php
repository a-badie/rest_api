<?php
    header("Content-Type: application/json");

    // Post التأكد من البيانات مدخله من داله ال 

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name=$_POST["name"] ?? null;
        $email=$_POST["email"] ?? null;
        $password=$_POST["password"] ?? null;

    //التأكد من البيانات داخله كامله ولا لا

    if(!$name || !$password || !$email){
        echo json_encode([
            "status"=>"Error",
            "message"=>"The entry data is incomplete"
        ]);
            exit;
    }

    // validation(password > 6)

    if(strlen($password) <= 6){
        echo json_encode([
            "status"=>"Error",
            "message"=>"Weak Password"
        ]);
        exit;
    }


    // validation(email not correct)

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            "status"=>"Error",
            "message"=>"email not correct"
        ]);
        exit;
    }

    // validation(email not repeate) 

    require_once("db.php");

    $sql="select * from user_information where email=?";
    $inquire=$connection->prepare($sql);
    $inquire->execute([$email]);
    if($inquire->rowCount() > 0){
        echo json_encode([
            "status"=>"error",
            "message"=>"repeate email"
        ]);
        exit;
    }

    // تشفير الباسورد

    $hashed=password_hash($password,PASSWORD_DEFAULT);

    //تسجيل البيانات

    $insert_sql="insert into user_information (name,email,password) values (?,?,?)";
    $insert_inquire=$connection->prepare($insert_sql);
    if($insert_inquire->execute([$name,$email,$hashed])){
        echo json_encode([
            "status"=>"success",
            "message"=>"تم التسجيل بنجاح"
        ]);
    }else{
        echo json_encode([
            "status"=>"error",
            "message"=>"فشل التسجيل"
        ]);
    }
    }
    














?>