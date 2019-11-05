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
                $this->post = $_GET;
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
    }