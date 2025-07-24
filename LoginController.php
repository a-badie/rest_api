<?php

    class LoginController{

        private $service;

        public function __construct($service){
                $this->service = $service;
        }

        public function handleLoginRequest(){

            if($_SERVER["REQUEST_METHOD"] !=="POST"){
                echo json_encode(["error" => "method must be post"]);
                exit;
            }
                $email = $_POST["email"] ?? null;
                $password = $_POST["password"] ?? null; 
                
                try {
                    $this->service->Login_result($email, $password);
                    echo json_encode(["success" => "success Login"]);
                    
                } catch (PDOException $e){
                    echo json_encode(["error" => $e->getMessage()]);
                } catch (Exception $e) {
                    echo json_encode(["error" => $e->getMessage()]);
                }
        }
    }
?>