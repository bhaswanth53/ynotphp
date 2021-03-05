<?php

    namespace Bucket;

    class makeController
    {
        private $name;

        public function __construct($name)
        {
            $this->name = $name;
        }

        public function dumpContext()
        {
            $str = "<?php
    namespace Controllers;

    use Facades\Request;

    class {$this->name} extends Controller
    {
        /*
        * Write your methods
        */
    }";

            return $str;
        }

        public function create()
        {
            $name = $this->name . ".php";
            $path = "app/Controllers/" . $name;
            if(!file_exists($path)) {
                $file = fopen($path, "w");
                $context = $this->dumpContext();
                fwrite($file, $context);
                fclose($file);
                echo $this->name . " created successfully";
            } else {
                echo "Controller already exists";
            }
        }
    }