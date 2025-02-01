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
    }