<?php
    class database {

        private static $conn = null;                                                

        private $host="localhost";
        private $user="root";
        private $pass="";
        private $dbname="users";
        private $connection;

        private function __construct(){
            $this->connection = null;
            try {  
            $this->connection = new pdo("mysql:host=$this->host;dbname=$this->dbname;charset=utf8",$this->user,$this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (pdoexception $e) {
            die("faild connect to databse" . $e->getMessage());
            }
        }

        public static function getConnection(){
            if(self::$conn === null){
                self::$conn = new database();
            }
            return self::$conn;
        }

        public function query($sql,$data=[]){
            $stmt=$this->connection->prepare($sql);
            $stmt->execute($data);
            return $stmt;
        }
    }

?>



