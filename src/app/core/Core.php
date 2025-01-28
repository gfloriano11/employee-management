<?php

    class Core{
        
        private $user;
        public function __construct(){
            $this->user = $_SESSION['user'] ?? null;
        }
        public function start_app($url){

            // add "session_start()" after, it possibility to use '$_SESSION';

            $uri_info = Router::router($url, $this->user);

            $controller = $uri_info['controller'];
            $method = $uri_info['method'];

            call_user_func_array(array(new $controller, $method), array());
        }

    }