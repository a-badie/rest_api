<?php
    header("Content-Type: application/json");
    require_once("db.php");

    class register{

        private $name;
        private $email;
        private $password;
        private $connection;
        private $sql;
        private $result;
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
    

        // validation password - email correct - email repeate
        public function validation(){
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