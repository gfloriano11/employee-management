<?php

    class HomeController{

        public function menu(){

            // $admin = false;

            // if($admin === true){
                $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
                $twig = new Twig\Environment($loader);
                $template = $twig->load('menu.html');
    
                $content = $template->render();
    
                echo $content;
            // } else {
                // echo 'não é adm! sai daqui';
            // }

        }

        public function home(){
            $loader = new Twig\Loader\FilesystemLoader('../src/app/view');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('home.html');

            $content = $template->render();

            echo $content;
        }
    }