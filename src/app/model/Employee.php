<?php

    class Employee{

        public static function get_info($user_id){

            $conn = Connection::getConn();
            
            $query = "SELECT * FROM users WHERE id = ?";

            $statement = $conn->prepare($query);

            $statement->bind_param('i', $user_id);

            $statement->execute();

            $result = $statement->get_result();

            while($row = $result->fetch_assoc()){
                $data = $row; 
            }
            
            Connection::endConn();

            if(!$data){
                header('location: ../error');
            }

            return $data;
        }

        public static function edit($user_id){

            $user_id = intval($user_id);

            if(!($user_id === $_SESSION['user'])){
                echo 'acesso negado';
            } else {
                $conn = Connection::getConn();
    
                $query = "SELECT * FROM users WHERE id = $user_id";
    
                $statement = $conn->prepare($query);
    
                $statement->execute();
    
                $result = $statement->get_result();
    
                while($row = $result->fetch_assoc()){
                    $data = $row;
                }
    
                Connection::endConn();
                
                return $data;
            }
        }

        public static function update($user_info, $img){

            if($img === '' || $img === null){
                $img = Employee::get_info($_SESSION['employee']);
            }

            $img_name = $img['name'];

            // echo $img_name;

            $tmp_name = $img['tmp_name'];
            
            $folder = '../src/assets/images/profile_pic/';
            
            $img_extension = '.' . strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
            
            $hash_name = 'img_' . uniqid() . $img_extension;
            
            $path = $folder . $hash_name;

            echo $path . ' ';

            echo $hash_name . ' ';

            if(move_uploaded_file($tmp_name, $path)) {
                echo "Arquivo enviado com sucesso!";
            } else {
                echo "Erro ao mover o arquivo.";
            }

            $conn = Connection::getConn();

            foreach($user_info as $key => $value){
                if($user_info[$key] === '' || $user_info[$key] === null){
                    $key = null;
                } else {
                    $$key = $value;
                }
            }

            $query = "UPDATE users
            SET full_name = ?,
            post = ?,
            email = ?, 
            profile_pic = ?";

            $statement = $conn->prepare($query);

            $statement->bind_param('ssss', $name, $post, $email, $hash_name);

            $statement->execute();

            // header('location: ' . $_SESSION['employee']);

        }
    }