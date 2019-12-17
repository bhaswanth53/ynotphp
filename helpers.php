<?php

    /* Configuration Utilities */
    function config()
    {
        $config = include("env.php");
        return $config;
    }

    $config = config();

    function database()
    {
        global $config;
        $database = include("config/" . $config['APP_MODE'] . "/db.php");
        return $database;
    }

    function get_mail()
    {
        global $config;
        $database = include("config/" . $config['APP_MODE'] . "/mail.php");
        return $database;
    }

    function menv()
    {
        global $config;
        $database = include("config/" . $config['APP_MODE'] . "/env.php");
        return $database;
    }

    $database = database();

    function env($string)
    {
        global $config;
        return $config[$string];
    }

    function db($string)
    {
        global $database;
        return $database[$string];
    }

    $mail = get_mail();

    function email($string)
    {
        global $mail;
        return $mail[$string];
    }

    $menv = menv();

    function modeenv($string)
    {
        global $menv;
        return $menv[$string];
    }

    /* Asset & URL Utilities */
    function asset($string)
    {
        global $config;
        $string = $config['APP_PATH']."/public/" . $string;
        return $string;
    }

    function request_path()
    {
        global $config;
        $path = $_SERVER['REQUEST_URI'];
        $string = str_replace($config['APP_PATH']."/", "", $path);
        return $string;
    }

    function request_is($query)
    {
        $string = request_path();
        if(substr($string, 0, strlen($query)) === $query)
        {
            return true;
        }
        return false;
    }

    function url($string = "")
    {
        global $config;
        if(!empty($string))
        {
            $url = $config['APP_PATH']."/".$string;
        }
        else {
            $url = $config['APP_PATH'];
        }

        return $url;
    }

    function get_url($string)
    {
        $url = "//".$_SERVER['SERVER_NAME'].url($string);
        return $url;
    }

    /* Storage Utilities */
    function storage_asset($string)
    {
        global $config;
        $string = $config['APP_PATH']."/public/storage/" . $string;
        return $string;
    }

    function storage_exists($path)
    {
        if(file_exists("./storage/".$path))
        {
            return true;
        }
        return false;
    }

    function storage_path($path)
    {
        $file = dirname(__FILE__)."/public/storage/".$path;
        return $file;
    }

    function storage_unlink($path)
    {
        if(storage_exists($path))
        {
            unlink("./storage/".$path);
            return true;
        }
        return false;
    }

    /* View Utilities */
    function parseview($string, $args = array())
    {
        $string = str_replace(".", "/", $string);
        $string = $string.".php";
        $path = "../views/".$string;
        ob_start();
        include($path);
        $var=ob_get_contents(); 
        ob_end_clean();
        echo $var;
    }

    /* Flash Utilities*/ 
    function make_flash($type, $message)
    {
        $_SESSION[$type] = $message;
        return;
    }

    function make_flash_array($type, $array)
    {
        $array = json_encode($array);
        $_SESSION[$type] = $array;
        return;
    }

    function get_flash($type, $html)
    {
        if(isset($_SESSION[$type]) && !empty($_SESSION[$type]))
        {
            $html = str_replace("@flash", $_SESSION[$type], $html);
            unset($_SESSION[$type]);
            echo $html;
            return true;
        }
        return false;
    }

    function get_flash_array($type, $html)
    {
        if(isset($_SESSION[$type]) && !empty($_SESSION[$type]))
        {
            $data = json_decode($_SESSION[$type], true);
            unset($_SESSION[$type]);
            if(isset($data) && is_array($data) && count($data) > 0)
            {
                foreach($data as $key => $item)
                {
                    echo str_replace("@flash", $item, $html);
                }
                return true;
            }
        }
        return false;
    }

    /* Session Utilities */
    function session($name, $value)
    {
        $_SESSION[$name] = $value;
        return true;
    }

    function unset_session($name)
    {
        unset($_SESSION[$name]);
        return true;
    }

    function session_exists($name)
    {
        if(isset($_SESSION[$name]) && !empty($_SESSION[$name]))
        {
            return true;
        }
        return false;
    }

    function get_session($name)
    {
        if(isset($_SESSION[$name]) && !empty($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
        return false;
    }

    /* Random String Generator */
    function str_random($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /* Data Utilities */
    function store_data($data)
    {
        if(isset($data) && is_array($data) && count($data) > 0)
        {
            foreach($data as $key => $value)
            {
                session($key, $value);
            }
            return true;
        }
        return false;
    }

    function old($name)
    {
        if(session_exists($name))
        {
            $value = get_session($name);
            unset_session($name);
            return $value;
        }
        return false;
    }