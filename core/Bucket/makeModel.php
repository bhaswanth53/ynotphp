<?php

    namespace Bucket;

    class makeModel
    {
        private $name;
        private $table;

        public function __construct($name, $table="table_name")
        {
            $this->name = $name;
            $this->table = $table;
        }

        public function dumpContext()
        {
            $str = '<?php
    namespace Models;

    use Facades\QB;

    class '.$this->name.' extends QB
    {
        private static $instance = null;
        
        public static function init()
        {
            if(!self::$instance)
            {
                self::$instance = QB::open()->table("'.$this->table.'");
            }
            return self::$instance;
        }
    }';

            return $str;
        }

        public function create()
        {
            $name = $this->name . ".php";
            $path = "app/Models/" . $name;
            if(!file_exists($path)) {
                $file = fopen($path, "w");
                $context = $this->dumpContext();
                fwrite($file, $context);
                fclose($file);
                echo $this->name . " created successfully";
            } else {
                echo "Model already exists";
            }
        }
    }