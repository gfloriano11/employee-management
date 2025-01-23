<?php

    class Router{

        public static function router($url){

            // to clarify: predefined url, we use the pretty url's, but for a search, it's ok to use query string!

            $uri = explode('/', $url['url']);

            $controller = ucfirst($uri[0]) . 'Controller'; 

            var_dump($uri);

            if($uri[0] === 'register' || $uri[0] === 'login'){
                $controller = 'AuthController';
                $method = $uri[0];
            }
            
            if($uri[0] === 'menu'){
                $controller = 'HomeController';
                $method = $uri[0];
            }

            if(class_exists($controller)){

                if(!empty($uri[1])){
                    $method = $uri[1];

                    if(!empty($uri[2])){
                        $param = $uri[2];

                        $uri_info['action'] = $param; 

                        if(!empty($uri[3])){
                            $id = $uri[3];

                            $uri_info['id'] = $id;
                        }
                    }

                } else {
                    $method = $uri[0];
                }

                $uri_info['controller'] = $controller;
                $uri_info['method'] = $method;

            } else {

                $controller = 'ErrorController';
                $method = 'error';

                $uri_info['controller'] = $controller;
                $uri_info['method'] = $method;
            }

            return $uri_info;
        }
    }
