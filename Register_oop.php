<?php
    header("Content-Type: application/json");
    require_once("db.php");

    class register{

        private $name;
        private $email;
        private $password;
        private $connection;
        private $hash;
        private $sql_insert;
        private $result_insert;

        // connect to database by  constructor 
        public function __construct($db){
            $this->connection=$db;
        }

        // is request method == post
        public function handle_request(){
            if($_SERVER["REQUEST_METHOD"]=="POST"){
            $this->name=$_POST["name"] ?? null;
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

        public function setname(){
            return $this->name;
        }

        public function setemail(){
            return $this->email;
        }

        public function setpassword(){
            return $this->password;
        }
    
        // hash password
        public function hash(){
            $this->hash=password_hash($this->password,PASSWORD_DEFAULT);
        }

        // verify register success or not
        public function verify_register(){
            $this->sql_insert="insert into user_information (name, email, password) values (?,?,?)";
            $this->result_insert=$this->connection->prepare($this->sql_insert);
            if($this->result_insert->execute([$this->name,$this->email,$this->hash])){
                echo json_encode([
                    "status"=>"success",
                    "message"=>"success register"
                ]);
                    exit;
                }else{
                    echo json_encode([
                        "status"=>"error",
                        "message"=>"failed register"
                    ]);
                    exit;
                }
        }
    }

    


    
?>