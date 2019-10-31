<?php

    namespace Facades;

    use mysqli;

    class DB
    {
        private static $instance = null;
        private $con;

        private function __construct()
        {
            $dbhost = db("DB_HOST");
            $dbuser = db("DB_USER");
            $dbpassword = db("DB_PASSWORD");
            $dbname = db("DB_NAME");

            $this->db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
        }

        public static function open()
        {
            if (!self::$instance) {
                self::$instance = new DB();
            }
    
            return self::$instance;
        }

        public function stmt_init()
        {
            return $this->db->stmt_init();
        }

        public function prepare($sql)
        {
            return $this->db->prepare($sql);
        }
    }