<?php

    namespace Controllers;

    class Controller 
    {
        public function render($path, $args=array())
        {
            $path = str_replace(".", "/", $path);
            $path = "../resources/views/" . $path . ".php";
            extract($args);
            ob_start();
			include($path);
			$var=ob_get_contents(); 
			ob_end_clean();
			return $var;
        }

        public function redirect($url, $message="", $type="success")
        {
            if(isset($message) && !empty($message))
            {
                make_flash($type, $message);
            }
            $url = env("APP_PATH").$url;
            ob_start();
            header("Location: ".$url);
        }

        public function back($message = "", $type="error")
        {
            $url = $_SERVER['HTTP_REFERER'];
            if(isset($message) && !empty($message))
            {
                // $url = $url."?flash=".$message;
                make_flash($type, $message);
            }
            ob_start();
            header("Location: ".$url);
        }

        public function json_response($array)
        {
            return json_encode($array);
        }

        public function setstatus($status)
        {
            return http_response_code($status);
        }

        public function response($array, $status = 200)
        {
            if($status !== 200)
            {
                http_response_code($status);
            }
            return json_encode($array);
        }
    }