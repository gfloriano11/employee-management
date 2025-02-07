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
            // foreach($_POST as $key => $value){
            //     $user_info[$key] = $value;
            // }

            

            $user_info = json_decode(file_get_contents('php://input'), true);

            if($user_info['password'] === $user_info['confirmPassword']){
                $user = new User;
                $user->register($user_info);

                $user->login($user_info);

                $admin = Admin::verify_permission($user);

                if($admin === 'YES'){
                    // header('location: ../admin');
                    echo json_encode([
                        'success' => true,
                        'redirect' => '../admin'
                    ]);
                } else {
                    // header('location: ../menu');
                    echo json_encode([
                        'success' => true,
                        'redirect' => '../menu'
                    ]);
                }
            }
        }

        public function login(){

            
            foreach($_POST as $key => $value){
                $user_info[$key] = $value;
            }
    
            $user = new User;
            $user->login($user_info);
                
            $admin = Admin::verify_permission($user);

            if($admin === 'YES'){
                header('location: ../admin');
            } else {
                header('location: ../menu');
            }

            // header('location: ../menu');
        }

        public function logout(){
            unset($_SESSION['user']);
            session_destroy();

            header('location: ../employee-management');
        }
    }