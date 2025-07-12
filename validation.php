<?php
    header("Content-Type: application/json");
    require_once("db.php");
    require_once("Register_oop.php");
    require_once("Login_oop.php");

    class validation{

        private $name;
        private $email;
        private $password;
        private $connection;
        private $sql;
        private $result;
        private $info;
        private $token_insert;
        private $result_insert;

        // connect to database by  constructor 
        public function __construct($db){
            $this->connection=$db;
        }

        // validation password - email correct - email repeate
        public function validation_register($name,$email,$password){
            $this->name=$name;
            $this->email=$email;
            $this->password=$password;
            if($this->name && $this->password && $this->email){
                //validation password
                if(strlen($this->password)<=6){
                    echo json_encode([
                    "status"=>"error",
                    "message"=>"password weak"
                    ]);
                    exit;
                //validation email correct or not
                }else{
                    if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
                        echo json_encode([
                        "status"=>"error",
                        "message"=>"email not correct"
                        ]);
                        exit;
                    // validate email repeate or not
                    }else{
                        $this->sql="select * from user_information where email=?";
                        $this->result=$this->connection->prepare($this->sql);
                        $this->result->execute([$this->email]);
                        if($this->result->rowCount()>0){
                            echo json_encode([
                            "status"=>"error",
                            "message"=>"email already exists"
                            ]);
                            exit;
                        }
                    }      
                }
            }else{
            echo json_encode([
            "status"=>"error",
            "message"=>"data not complete"
            ]);
            exit;
            }
        
        }

        public function validation_login($email,$password){
            $this->email=$email;
            $this->password=$password;
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