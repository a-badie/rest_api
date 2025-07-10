<?php

    header("Content-Type: application/json");
    require_once("db.php");

    class login{

        private $email;
        private $password;
        private $connection;
        private $sql;
        private $result;
        private $info;
        private $token;
        private $token_insert;
        private $result_insert;
    
        // connect to database by  constructor 
        public function __construct($db){
            $this->connection=$db;
        }
    
        // is request method == post
        public function handle_request(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
            $this->email=$_POST["email"] ?? null;
            $this->password=$_POST["password"] ?? null;
            }else{
                echo json_encode([
                    "status"=>"error",
                    "message"=>"request method must be post"
                ]);
                exit;
            }
        }
    

        public function validation(){
            if(!$this->email || !$this->password){
            echo json_encode([
                "status"=>"error",
                "message"=>"The entry data is incomplete"
            ]);
            exit;
            }

            $this->sql="select * from user_information where email=?";
            $this->result=$this->connection->prepare($this->sql);
            $this->result->execute([$this->email]); 

            if($this->result->rowCount()==0){
                echo json_encode([
                    "status"=>"error",
                    "message"=>"No found email"
                ]);
                exit;
            }

            $this->info = $this->result->fetch(PDO::FETCH_ASSOC);

            if(!password_verify($this->password,$this->info["PASSWORD"])){
                echo json_encode([
                "status"=>"error",
                "message"=>"incorrect password"
            ]);
            exit;
            }

            $this->token = bin2hex(random_bytes(32));
            $this->token_insert = "INSERT INTO token (token, user_id) VALUES (?, ?)";
            $this->result_insert = $this->connection->prepare($this->token_insert);
            if($this->result_insert->execute([$this->token, $this->info["id"]])){
                echo json_encode([
                "status" => "success",
                "message" => "تم تسجيل الدخول بنجاح",
                "info" => [
                    "id" => $this->info["id"],
                    "name" => $this->info["name"],
                    "email" => $this->info["email"]
                ]
                ]);
                    exit;

                } else {
                    echo json_encode([
                    "status" => "error",
                    "message" => "should use post method"
                ]);

            }
        }
    }








?>