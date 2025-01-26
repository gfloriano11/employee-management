<?php

    class User{

        private $id;
        private $password;
        protected $name;
        protected $surname;
        protected $email;
        protected $post;

        public function setEmail($email){
            $this->email = $email;
        }

        public function __construct($id, $name, $surname, $email, $password){
            $this->id = $id;
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->password = $password;
        }

        public function updateInfo($field, $info){

            $field = strtolower($field);
            switch($field){
                case 'email':
                    $this->email = $info;
                    break;
                case 'name':
                    $this->name = $info;
                    break;
                case 'surname':
                    $this->surname = $info;
                    break;
                case 'password':
                    $this->password = $info;
                    break;
                case 'post':
                    $this->post = $info;
                    break;
                default:
                    echo 'Campo inválido';
                    break;
            }
        }

        public function getInfo($field){
            $field = strtolower($field);
            switch($field){
                case 'email':
                    $info = $this->email;
                    return $info;
                case 'name':
                    $info = $this->name;
                    return $info;
                case 'surname':
                    $info = $this->surname;
                    return $info;
                case 'password':
                    $info = $this->password;
                    return $info;
                case 'post':
                    $info = $this->post;
                    return $info;
                default:
                    echo 'Campo inválido';
            }
        }
    }