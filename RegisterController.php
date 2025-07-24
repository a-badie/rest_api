<?php

    class RegisterController{

        private $service;

        public function __construct($service){
                $this->service = $service;
        }

        public function handleRegisterRequest(){

            if($_SERVER["REQUEST_METHOD"] !=="POST"){
                echo json_encode(["error" => "method must be post"]);
                exit;
            }
                $name = $_POST["name"] ?? null;
                $email = $_POST["email"] ?? null;
                $password = $_POST["password"] ?? null; 
                
                try {
                    $this->service->register_result($name, $email, $password);
                    echo json_encode(["success" => "success register"]);
                } catch (PDOException $e){
                    echo json_encode(["error" => $e->getMessage()]);
                } catch (Exception $e) {
                    echo json_encode(["error" => $e->getMessage()]);
                }
        }
    }
?>