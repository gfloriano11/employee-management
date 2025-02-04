<?php

    class AdminController{

        public function admin(){

            $user['id'] = $_SESSION['user'];

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/admin');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('menu.html');

            $content = $template->render($user);

            echo $content;
        }

        public function employees(){

            $data['employees'] = Employee::get_employees();

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('employees.html');

            $content = $template->render($data);

            echo $content;
        }
    }