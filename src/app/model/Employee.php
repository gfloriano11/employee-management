<?php

    class Employee{

        public static function get_info($user_id){

            $conn = Connection::getConn();
            
            $query = "SELECT * FROM users WHERE id = ?";

            $statement = $conn->prepare($query);

            $statement->bind_param('i', $user_id);

            $statement->execute();

            $result = $statement->get_result();

            $data = array();

            while($row = $result->fetch_assoc()){
                $data = $row; 
            }
            
            Connection::endConn();

            if(!$data){
                header('location: ../error');
            }

            return $data;
        }
    }