<?php

    class Core{

        public function start_app($url){

            // add "session_start()" after, it possibility to use '$_SESSION';

            $uri_info = Router::router($url);

            $controller = $uri_info['controller'];
            $method = $uri_info['method'];

            call_user_func_array(array(new $controller, $method), array());
        }
    }