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

            // var_dump($_GET);

            $data['employees'] = Employee::get_employees();

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('employees.html');
            
            if(isset($_GET['query'])){

                $method = $_GET['query'];

                if($method === 'by_name'){
                    $data['employees'] = Employee::get_employees_by_name();
                }

                if($method === 'by_email'){
                    $data['employees'] = Employee::get_employees_by_email();
                }

                if($method === 'by_post'){
                    $data['employees'] = Employee::get_employees_by_post();
                }
            }

            $content = $template->render($data);

            echo $content;
        }

        public function update_profile(){

            $data = $_POST;
            $img = $_FILES['profile_pic'];

            foreach($data as $key => $value){
                $$key = $value;
                $user[$key] = $$key; 
            }

            Employee::update($user, $img);

        }
    }