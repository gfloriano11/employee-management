<?php

    class AuthController{

        public function register_form(){
           $loader = new Twig\Loader\FilesystemLoader('../src/app/view/auth');
           $twig = new Twig\Environment($loader);
           $template = $twig->load('register.html'); 

           $content = $template->render();

           echo $content;
        }

        public function login_form(){
            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/auth');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('login.html'); 
 
            $content = $template->render();
 
            echo $content;
        }
    }