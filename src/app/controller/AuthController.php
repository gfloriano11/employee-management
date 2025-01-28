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

        public function register(){
            foreach($_POST as $key => $value){
                $user_info[$key] = $value;
            }

            if($user_info['password'] === $user_info['confirm_password']){
                $user = new User;
                $user->register($user_info);

                header('location: ../menu');
                
            } else {
                header('location: ../');
            }

        }

        public function login(){

            try {
                foreach($_POST as $key => $value){
                    $user_info[$key] = $value;
                }
    
                $user = new User;
                $user->login($user_info);
                
                header('location: ../menu');
            } catch (Exception $error){
                header('location: ../');
            }

            // header('location: ../menu');
        }

        public function logout(){
            unset($_SESSION['user']);
            session_destroy();

            echo 'destruiu';

            header('location: /projects/employee-management');
        }
    }