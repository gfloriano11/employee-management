<?php

    class Core{

        public function start_app($urlGet){

            // var_dump($urlGet);

            if(empty($urlGet)){

                // make auth verification

                $controller = 'HomeController';
                $method = ' home';

                echo $controller;
                echo $method;
                
            } else {

                // make if to home, and if to auth

                $uri = explode('/', $urlGet['url']);

                $controller = $uri[0];
                echo $controller;

                if(!empty($uri[1])){
                    $method = $uri[1];
                    echo $method;
                }
            }

            // call_user_func_array(array(new $controller, $method), array());
        }
    }