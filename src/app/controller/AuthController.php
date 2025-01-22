<?php

    class AuthController{

        public function register(){
           $loader = new Twig\Loader\FilesystemLoader('../src/app/view/auth');
           $twig = new Twig\Environment($loader);
           $template = $twig->load('register.html'); 

           $content = $template->render();

           echo $content;
        }

        public function login(){
            echo 'fazer login!';
        }
    }