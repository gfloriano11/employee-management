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
            
            $user_info = json_decode(file_get_contents('php://input'), true);

            if($user_info['password'] === $user_info['confirm_password']){
                $user = new User;
                $user->register($user_info);

                $user->login($user_info);

                $admin = Admin::verify_permission($_SESSION['user']);

                if($admin === 'YES'){
                    // header('location: ../admin');
                    echo json_encode([
                        'success' => true,
                        'redirect' => 'admin'
                    ]);
                } else {
                    // header('location: ../menu');
                    echo json_encode([
                        'success' => true,
                        'redirect' => 'menu'
                    ]);
                }
            }
        }

        public function login(){

            $user_info = json_decode(file_get_contents('php://input'), true);
    
            $user = new User;
            $user->login($user_info);
                
            $admin = Admin::verify_permission($_SESSION['user']);

            if($admin === 'YES'){
                echo json_encode([
                    'success' => true,
                    'redirect' => 'admin'
                ]);
            } else {
                echo json_encode([
                    'success' => true,
                    'redirect' => 'menu'
                ]);
            }

        }

        public function logout(){
            unset($_SESSION['user']);
            session_destroy();

            header('location: ../employee-management');
        }
    }