<?php

    namespace Facades;

    class Request
    {
        public $post;
        public $get;
        public $files;
        public function __construct($post)
        {
            $this->post = $post;
        }

        public function input($string)
        {
            return $this->post[$string];
        }

        public function get($string)
        {
            return $this->post[$string];
        }

        public function secure($string)
        {
            $data = $this->post[$string];
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        public function hash($password)
        {
            $password = password_hash($password, PASSWORD_DEFAULT);
            return $password;
        }

        public function verify_hash($password, $hash)
        {
            return password_verify($password, $hash);
        }

        public function isDelete()
        {
            if(isset($this->post['DELETE']) && !empty($this->post['DELETE']))
            {
                return true;
            }
            return false;
        }
    }