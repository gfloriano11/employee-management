<?php

    class Core{

        public function start_app($urlGet){

            var_dump($urlGet);



            if($urlGet == null){

                $controller = 'HomeController';

                echo $controller;
                
            } else {

                $teste = explode('/', $urlGet['url']);

                $controller = $teste[0];
                echo $controller; 
            }
        }
    }