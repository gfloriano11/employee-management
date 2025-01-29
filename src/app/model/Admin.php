<?php

    class Admin{

        public static function verify_permission($user_id){

            $conn = Connection::getConn();

            $query = "SELECT is_admin
            FROM users WHERE id = ?";

            $statement = $conn->prepare($query);

            $statement->bind_param('i', $user_id);

            $statement->execute();

            $result = $statement->get_result();

            $row = $result->fetch_assoc();

            return $row['is_admin'];

        }
    }