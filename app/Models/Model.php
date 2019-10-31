<?php

    namespace Models;

    use mysqli;

    class Model 
    {
        public $db;
        
        public function __construct()
        {
            $dbhost = db("DB_HOST");
            $dbuser = db("DB_USER");
            $dbpassword = db("DB_PASSWORD");
            $dbname = db("DB_NAME");
            $this->db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
        }
    }
