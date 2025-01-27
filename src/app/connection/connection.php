<?php

    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'employee_management');

    abstract class Connection{

        private static $conn;

        public static function getConn(){

            if(self::$conn === null){
                self::$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            }

            return self::$conn;
        }

        public static function endConn(){
            if(self::$conn){
                self::$conn->close();
            }
        }
    }