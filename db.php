<?php
    class database {

        private static $conn = null;                                                // use singleton pattern

        // decleration variable
        private $host="localhost";
        private $user="root";
        private $pass="";
        private $dbname="users";
        private $connection;
        private $sql;
        private $result;
        private $date_insert;
        private $date_result;
        private $token_insert;
        private $token_result;

        // method connection
        private function __construct(){
            $this->connection = null;
            try {  
            $this->connection = new pdo("mysql:host=$this->host;dbname=$this->dbname;charset=utf8",$this->user,$this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (pdoexception $e) {
            die("faild connect to databse" . $e->getMessage());
            }
        }

        public static function obFromDatabase(){
            if(self::$conn === null){
                self::$conn = new database();
            }
            return self::$conn;
        }


        //return connection to databse:
        public function getConnection(){
            return $this->connection;
        }

        //return result of select email:
        public function select($email){
            $this->sql="select * from user_information where email=?";
            $this->result=$this->connection->prepare($this->sql);
            $this->result->execute([$email]);
            return $this->result;
        }

        //method insert data after validate date in register:
        public function register_insert($name,$email,$password){
            $this->date_insert="insert into user_information (name, email, password) values (?,?,?)";
            $this->date_result=$this->connection->prepare($this->date_insert);
            $this->date_result->execute([$name,$email,$password]);
            return $this->date_result;
        }
        
        // //method make token:
        public function generationToken(){
            return $this->token = bin2hex(random_bytes(32));
        }

        // //method insert tokens:
        public function insert_token($token,$user_id){
            $this->token_insert = "INSERT INTO token (token, user_id) VALUES (?, ?)";
            $this->token_result = $this->connection->prepare($this->token_insert);
            $this->token_result->execute([$token,$user_id]);
            return $this->token_result;
        }
    }

?>



