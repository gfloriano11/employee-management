<?php 

    class EmployeeController{

        public function employee(){

            $url = $_GET['url'];

            $uri = explode('/', $url);

            $id = $uri[1];

            $_SESSION['employee'] = $id;

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('profile.html');

            $data['user'] = Employee::get_info($id);
            
            $content = $template->render($data);

            echo $content;

        }

        public function account(){

            $id = $_SESSION['employee'];

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('update_account.html');

            $data['user'] = Employee::edit($id);

            $img = '../src/assets/images/profile_pic/' . $data['user']['profile_pic'];

            $data['user']['profile_pic'] = $img;

            $content = $template->render($data);

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

        public function teste(){

            $data = $_POST;
            $img = $_FILES['profile_pic'];

            foreach($data as $key => $value){
                $$key = $value;
                $user[$key] = $$key; 
            }

            Employee::update($user, $img);

        }
    }