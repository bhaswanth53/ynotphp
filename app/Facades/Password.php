<?php

    namespace Facades;

    class Password
    {
        public function check($password)
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
            $password = password_hash($password, PASSWORD_DEFAULT);
            return $password;
        }

        public function verify($password, $hash)
        {
            return password_verify($password, $hash);
        }
    }