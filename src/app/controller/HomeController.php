<?php

    class HomeController{

        public function menu(){

            $user['id'] = $_SESSION['user'];

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('menu.html');
    
            $content = $template->render($user);
    
            echo $content;
        }

        public function home(){
            $loader = new Twig\Loader\FilesystemLoader('../src/app/view');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('home.html');

            $content = $template->render();

            echo $content;
        }
    }