<?php

    class Core{
        
        private $user;
        public function __construct(){
            $this->user = $_SESSION['user'] ?? null;
        }
        public function start_app($url){

            // add "session_start()" after, it possibility to use '$_SESSION';

            $uri_info = Router::router($url);

            $controller = $uri_info['controller'];
            $method = $uri_info['method'];

            if($this->user){
                $routes = ['HomeController/menu'];

                if(isset($controller)){

                    $controller = "HomeController";
                    $method = 'menu';
                } 
            } else {
                $routes = ['', 'HomeController/home', 'AuthController/login', 'AuthController/register'];

                echo 'n tem user ';

                if(isset($controller)){

                    $controller = "HomeController";
                    $method = 'home';
                } 
            }

            call_user_func_array(array(new $controller, $method), array());
        }

    }