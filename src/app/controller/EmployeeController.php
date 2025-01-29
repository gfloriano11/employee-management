<?php 

    class EmployeeController{

        public function employee(){

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('profile.html');
            
            $content = $template->render();

            echo $content;
        }
    }