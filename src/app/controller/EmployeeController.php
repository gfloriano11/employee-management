<?php 

    class EmployeeController{

        public function employee(){

            $url = $_GET['url'];

            $uri = explode('/', $url);

            $id = $uri[1];

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('profile.html');

            $data['user'] = Employee::get_info($id);

            // var_dump($data);

            // echo $data['user']['id'];
            
            $content = $template->render($data);

            echo $content;
        }

        public function account(){
            $id = $_SESSION['user'];

            $loader = new Twig\Loader\FilesystemLoader('../src/app/view/user');
            $twig = new Twig\Environment($loader);
            $template = $twig->load('update_account.html');

            $data['user'] = Employee::edit($id);

            

            $content = $template->render();

            echo $content;
        }
    }