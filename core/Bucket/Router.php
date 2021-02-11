<?php

    namespace Bucket;

    class Router
    {
        private static $routes = array();

        public static function get($path, $action, $name="null")
        {
            self::$routes[] = array(
                "path" => $path,
                "action" => $action,
                "name" => $name,
                "method" => "GET"
            );
        }

        public static function post($path, $action, $name="null")
        {
            self::$routes[] = array(
                "path" => $path,
                "action" => $action,
                "name" => $name,
                "method" => "POST"
            );
        }

        public function fetch()
        {
            return self::$routes;
        }
    }