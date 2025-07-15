<?php

    class repository{
        
        private $user;
        private $db;
        private $conn;
        private $token;
        private $info;
        private $result;
        private $hashd;
        private $result_insert;


        public function __construct(database $db , user $user){
            $this->db = $db;
            $this->user = $user;
        }

        public function email_reapet(){
            $this->result = $this->db->select($this->user->getemail());
            if($this->result->rowCount()>0){
                $this->user->response(["message" => "email already exists"],"error");
            }
        }

        public function email_exist(){
            if($this->db->select($this->user->getemail())->rowCount()==0){
                $this->user->response(["message" => "email not found"],"error");
            }
        }

        public function selectResult(){
            $email = $this->user->getemail();
            // ✅ اطبع الإيميل عشان تتأكد إنه بيوصل صح
            echo json_encode(["email_received" => $email]);
            $this->result = $this->db->select($email);
        }

        public function getinfo(){
            return $this->info = $this->result->fetch(PDO::FETCH_ASSOC);
        }

        public function hash(){
            return $this->hashd=password_hash($this->user->getpassword(),PASSWORD_DEFAULT);
        }


        public function insert_tokens(){
            $this->token = $this->db->generationToken();
            $this->selectResult();
            $this->info = $this->getinfo();
            if($this->db->insert_token($this->token,$this->info["id"])){
                    $this->user->response([
                        "message" => "info",
                        "info" => [
                            "id" => $this->info["id"],
                            "name" => $this->info["name"],
                            "email" => $this->info["email"]
                        ]
                    ], "success");
                } else {
                    $this->user->response(["message" => "should use post method"],"error");
                }
        }

        public function insert_data(){
            $success = $this->db->register_insert($this->user->getname(),$this->user->getemail(),$this->hash());
            if($success){
                $this->user->response(["message" => "sucess register"],"sucess");
            }else{
                $this->user->response(["message" => "failed register"],"error");
            };
        }
    }
    
?>