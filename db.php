<?php
    class database {

        // decleration variable
        private $host="localhost";
        private $user="root";
        private $pass="";
        private $dbname="users";
        private $connection;
        private $sql;
        private $sql_insert;
        private $sql_result;
        private $result;
        private $token_insert;
        private $result_insert;

        // method connection
        public function __construct(){
            $this->connection = null;
            try {  
            $this->connection = new pdo("mysql:host=$this->host;dbname=$this->dbname;charset=utf8",$this->user,$this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (pdoexception $e) {
            die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
            }
        }

        public function getConnection(){
            return $this->connection;
        }

        public function select($email){
            $this->sql="select * from user_information where email=?";
            $this->result=$this->connection->prepare($this->sql);
            $this->result->execute([$email]);
            return $this->result;
        }

        public function insert_token($token,$user_id){
            $this->token_insert = "INSERT INTO token (token, user_id) VALUES (?, ?)";
            $this->result_insert = $this->connection->prepare($this->token_insert);
            return $this->result_insert->execute([$token,$user_id]);
        }

        public function generationToken(){
        return $this->token = bin2hex(random_bytes(32));
        }

        public function register_insert($name,$email,$password){
            $this->sql_insert="insert into user_information (name, email, password) values (?,?,?)";
            $this->sql_result=$this->connection->prepare($this->sql_insert);
            return $this->sql_result->execute([$name,$email,$password]);
        }

    }

?>



