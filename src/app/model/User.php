<?php

    class User{

        private $id;
        private $password;
        protected $name;
        protected $surname;
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
                echo $$key . ' ';
            }

            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->password = $password;

            $hash_pass = password_hash($password, PASSWORD_DEFAULT);

            echo $hash_pass;

            if(password_verify($password, $hash_pass)){
                echo 'igual krai';
            } else {
                echo 'ih ala mo burro';
            }

            $query = "INSERT INTO users
            (first_name, surname, email, user_pass, post, is_admin)
            VALUES
            (?, ?, ?, ?, ?, ?)";

            $statement = $conn->prepare($query);

            $statement->bind_param('ssssss', $name, $surname, $email, $hash_pass, $post, $admin);

            $statement->execute();
        }

        public function login($info){

            foreach($info as $key => $value){
                $$key = $value;
                echo $$key . ' ';
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

            if(password_verify($password, $data['user']->user_pass)){
                echo 'logando...';
            } else {
                echo 'senha invalida';
            }

            if(!empty($data)){

                if(password_verify($password, $data['user']->user_pass)){
                    echo 'logando...';

                    $_SESSION['user'] = $data['user']->id;
                    return true;
                } else {
                    echo 'senha invalida';
                }
            } else {
                
                throw new Exception("Info inválida");
            } 
        }

        public function updateInfo($field, $info){

            $field = strtolower($field);
            switch($field){
                case 'email':
                    $this->email = $info;
                    break;
                case 'name':
                    $this->name = $info;
                    break;
                case 'surname':
                    $this->surname = $info;
                    break;
                case 'password':
                    $this->password = $info;
                    break;
                case 'post':
                    $this->post = $info;
                    break;
                default:
                    echo 'Campo inválido';
                    break;
            }
        }

        public function getInfo($field){
            $field = strtolower($field);
            switch($field){
                case 'email':
                    $info = $this->email;
                    return $info;
                case 'name':
                    $info = $this->name;
                    return $info;
                case 'surname':
                    $info = $this->surname;
                    return $info;
                case 'password':
                    $info = $this->password;
                    return $info;
                case 'post':
                    $info = $this->post;
                    return $info;
                default:
                    echo 'Campo inválido';
            }
        }
    }