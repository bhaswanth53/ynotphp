<?php

    namespace Facades;

    class Request
    {
        public $post;
        public $ajax;
        public $get;
        public function __construct()
        {
            if(isset($_POST))
            {
                $this->post = $_POST;
            }

            if(isset($_GET))
            {
                $this->get = $_GET;
            }

            $body = file_get_contents("php://input");
            $body = json_decode($body, true);
            $this->ajax = $body;
        }

        public function input($string)
        {
            return $this->post[$string];
        }

        public function get($string)
        {
            return $this->get[$string];
        }

        public function ajax($string)
        {
            return $this->ajax[$string];
        }

        public function secure_input($string)
        {
            $data = $this->post[$string];
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function secure_get($string)
        {
            $data = $this->get[$string];
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function secure_ajax($string)
        {
            $data = $this->ajax[$string];
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function password_check($password)
        {
            $pattern = ' ^.*(?=.{7,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$ ';
            if(strlen($password) < 10)
            {
                return false;
            }

            if(strlen($password) > 32)
            {
                return false;
            }

            if(!preg_match($pattern, $password))
            {
                return false;
            }

            return true;
        }

        public function hash($password)
        {
            $password = password_hash($password, PASSWORD_BCRYPT);
            return $password;
        }

        public function verify_hash($password, $hash)
        {
            return password_verify($password, $hash);
        }

        public function all($method)
        {
            if($method == 'post')
            {
                return $this->post;
            } 
            else if($method == 'get')
            {
                return $this->get;
            }
            else if($method == 'ajax')
            {
                return $this->ajax;
            }
            else {
                return false;
            }
        }
    }