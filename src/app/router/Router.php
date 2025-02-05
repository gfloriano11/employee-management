<?php

    class Router{

        public static function router($url, $user){

            // to clarify: predefined url, we use the pretty url's, but for a search, it's ok to use query string!

            if(empty($url)){
                $url['url'] = 'error';
            }

            $uri = explode('/', $url['url']);

            $controller = ucfirst($uri[0]) . 'Controller'; 

            if($uri[0] === 'register' || $uri[0] === 'login' || $uri[0] === 'logout'){
                $controller = 'AuthController';
            }
            
            if($uri[0] === 'menu'){
                $controller = 'HomeController';
                $method = $uri[0];
            }

            if($uri[0] === 'employees'){
                $controller = 'EmployeeController';
                $method = $uri[0];
            }

            
            if(class_exists($controller)){
                
                if(!empty($uri[1])){
                    $method = $uri[1];
                    
                    if(is_numeric($uri[1])){
                        $method = $uri[0];
                    }
                    
                    if(!empty($uri[2])){
                        $param = $uri[2];
                        
                        $uri_info['action'] = $param; 
                        
                        if(!empty($uri[3])){
                            $id = $uri[3];
                            
                            $uri_info['id'] = $id;
                        }
                    }
                    
                } else {
                    $method = $uri[0];
                    
                    if($uri[0] === 'register' || $uri[0] === 'login'){
                        $method = $uri[0] . '_form';
                    }
                    
                    if($uri[0] === 'logout'){
                        $method = $uri[0];
                    }
                }
                
            } else {
                
                $controller = 'ErrorController';
                $method = 'error';
            }
            
            if($user != null){
                
                
                $admin = Admin::verify_permission($user);
                
                if($admin === 'YES'){
                    
                    $controllers = ['HomeController', 'AdminController', 'EmployeeController', 'AuthController', 'ErrorController'];
                    $methods = ['admin', 'employees', 'account', 'employee', 'logout', 'error', 'teste'];
                    
                    if(in_array($controller, $controllers)){
                        
                        if($method === 'employee' && (!isset($uri[1]) || $uri[1] === '')){
                            header('location: /projects/employee-management/employee/' . $user);
                        }
                        
                        if(!in_array($method, $methods)){
                            
                            header('location: /projects/employee-management/admin');
                            
                        } 
                    } else {
                        header('location: /projects/employee-management/admin');
                    }
                } else {
                    
                    $controllers = ['HomeController', 'EmployeeController', 'AuthController', 'ErrorController'];
                    $methods = ['menu', 'employee', 'employees', 'account', 'logout', 'error'];
                    
                    if(in_array($controller, $controllers)){

                        if($method === 'employee' && (!isset($uri[1]) || $uri[1] === '')){
                            header('location: /projects/employee-management/employee/' . $user);
                        }
                        
                        if(!in_array($method, $methods)){
                            
                            header('location: /projects/employee-management/menu');
                            
                        } 
                    } else {
                        header('location: /projects/employee-management/menu');
                    }
                }
                
            } else {
                
                $controllers = ['HomeController', 'AuthController', 'ErrorController'];
                $methods = ['home', 'register_form', 'login_form', 'register', 'login', 'error'];
                
                if(in_array($controller, $controllers)){
                    
                    if(!in_array($method, $methods)){
                        
                        header('location: /projects/employee-management/');
                        
                    } 
                } else {
                    header('location: /projects/employee-management/');
                }
            }
            
            $uri_info['controller'] = $controller;
            $uri_info['method'] = $method;

            return $uri_info;
        }
    }
