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

                $page = $uri[0];

                $controller = ucfirst($uri[0]) . 'Controller';
                echo $controller;

                if($page === 'admin'){
                    if($uri[1] === 'funcionarios'){
                        $method = $page;
                        echo $method;
                    } 
                }
            }

            call_user_func_array(array(new $controller, $method), array());
        }
    }