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

            if(!$data){
                header('location: ../error');
            }

            return $data;
        }

        public static function get_employees(){

            $query = "SELECT * FROM users";

            $conn = Connection::getConn();

            $statement = $conn->prepare($query);

            // $statement->bind_param('', $teste);

            $statement->execute();

            $result = $statement->get_result();

            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }

            return $data;
        }

        public static function get_employees_by_name(){
            
            $query = "SELECT * FROM users
            ORDER BY full_name";

            $conn = Connection::getConn();

            $statement = $conn->prepare($query);

            // $statement->bind_param('', $teste);

            $statement->execute();

            $result = $statement->get_result();

            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }

            return $data;
        }

        public static function get_employees_by_email(){
            
            $query = "SELECT * FROM users
            ORDER BY email";

            $conn = Connection::getConn();

            $statement = $conn->prepare($query);

            // $statement->bind_param('', $teste);

            $statement->execute();

            $result = $statement->get_result();

            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }

            return $data;
        }
        
        public static function get_employees_by_post(){
            
            $query = "SELECT * FROM users
            ORDER BY post";

            $conn = Connection::getConn();

            $statement = $conn->prepare($query);

            // $statement->bind_param('', $teste);

            $statement->execute();

            $result = $statement->get_result();

            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }

            return $data;
        }

        public static function edit($user_id){

            $user_id = intval($user_id);

            $is_admin = Admin::verify_permission($_SESSION['user']);

            if($is_admin === 'YES'){
                $conn = Connection::getConn();
    
                $query = "SELECT * FROM users WHERE id = $user_id";
    
                $statement = $conn->prepare($query);
    
                $statement->execute();
    
                $result = $statement->get_result();
    
                while($row = $result->fetch_assoc()){
                    $data = $row;
                }
                
                return $data;
            }

            if(!($user_id === $_SESSION['user'])){
                header('location: ../');
            } else {
                $conn = Connection::getConn();
    
                $query = "SELECT * FROM users WHERE id = $user_id";
    
                $statement = $conn->prepare($query);
    
                $statement->execute();
    
                $result = $statement->get_result();
    
                while($row = $result->fetch_assoc()){
                    $data = $row;
                }
                
                return $data;
            }
        }

        public static function update($user_info, $img){

            if($img['name'] === '' || $img['name'] === null){

                $img = Employee::get_info($_SESSION['employee']);
                $hash_name = $img['profile_pic'];

            } else {
                $img_name = $img['name'];
    
                $tmp_name = $img['tmp_name'];
                
                $folder = '../src/assets/images/profile_pic/';
                
                $img_extension = '.' . strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                
                $hash_name = 'img_' . uniqid() . $img_extension;
                
                $path = $folder . $hash_name;

                if(move_uploaded_file($tmp_name, $path)) {
                    echo "Arquivo enviado com sucesso!";
                } else {
                    echo "Erro ao mover o arquivo.";
                }
            }



            $conn = Connection::getConn();

            var_dump($user_info);

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
            profile_pic = ?
            WHERE id = ?";

            $statement = $conn->prepare($query);

            $statement->bind_param('ssssi', $name, $post, $email, $hash_name, $_SESSION['employee']);

            $statement->execute();

            Connection::endConn();

            header('location: ' . $_SESSION['employee']);

        }
    }