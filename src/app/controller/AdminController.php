<?php

    class AdminController{

        public function admin(){

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/admin');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('menu.html');

            $content = $template->render();

            echo $content;
        }

        public function employees(){
            echo 'lista de funcionarios:';
        }
    }