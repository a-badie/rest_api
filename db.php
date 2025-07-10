<?php
    class database{

        // decleration variable
        private $host="localhost";
        private $user="root";
        private $pass="";
        private $dbname="users";
        private $connection;

        // method connection
        public function conn(){
            $this->connection = null;
            try {  
            $this->connection = new pdo("mysql:host=$this->host;dbname=$this->dbname;charset=utf8",$this->user,$this->pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (pdoexception $e) {
            die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
            }
            return $this->connection;
        }
    }
?>



