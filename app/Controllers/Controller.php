<?php

    namespace Controllers;

    class Controller 
    {
        public function render($path, $args=array())
        {
            $path = str_replace(".", "/", $path);
            $path = "../views/" . $path . ".php";
            extract($args);
            ob_start();
			include($path);
			$var=ob_get_contents(); 
			ob_end_clean();
			return $var;
        }

        public function redirect($url)
        {
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

        public function with($type, $message="")
        {
            if(isset($message) && !empty($message))
            {
                make_flash($type, $message);
            }
        }
    }
