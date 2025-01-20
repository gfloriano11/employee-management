<?php

    class HomeController{

        public function home(){

            // $admin = false;

            // if($admin === true){
                $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
                $twig = new Twig\Environment($loader);
                $template = $twig->load('home.html');
    
                $content = $template->render();
    
                echo $content;
            // } else {
                // echo 'não é adm! sai daqui';
            // }

        }
    }