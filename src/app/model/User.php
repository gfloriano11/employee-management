<?php

    class User{

        private $id;
        private $password;
        protected $full_name;
        protected $email;
        protected $post;

        public function setEmail($email){
            $this->email = $email;
        }

        public function register($info){

            $conn = Connection::getConn();

            if($conn->connect_error){
                die('algo deu errado');
            }

            foreach($info as $key => $value){
                $$key = $value;
            }

            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users
            (full_name, email, user_pass, post, is_admin)
            VALUES
            (?, ?, ?, ?, ?)";

            $statement = $conn->prepare($query);

            $statement->bind_param('sssss', $full_name, $email, $hash_pass, $post, $admin);

            $statement->execute();
        }

        public function login($info){

            foreach($info as $key => $value){
                $$key = $value;
            }
            
            $conn = Connection::getConn();

            if($conn->connect_error){
                throw new Exception('Algo deu errado');
            }

            $query = "SELECT * FROM users
            WHERE email = ?";

            $statement = $conn->prepare($query);

            $statement->bind_param('s', $email);

            $statement->execute();

            $result = $statement->get_result();

            while($row = $result->fetch_object('user')){
                $data['user'] = $row;
            }

            if(!empty($data)){

                if(password_verify($password, $data['user']->user_pass)){

                    $_SESSION['user'] = $data['user']->id;
                    return;
                } else {
                    echo json_encode([
                        'success' => false,
                        'type' => 'password',
                        'message' => 'Senha incorreta'
                    ]);
                    exit;
                }
            } else {

                echo json_encode([
                    'success' => false,
                    'type' => 'email',
                    'message' => 'E-mail não cadastrado'
                ]);
                exit;
            }
        }
    }