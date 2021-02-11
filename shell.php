<?php

    require_once "vendor/autoload.php";

    use Bucket\makeController;

    if(defined('STDIN'))
    {
        $one = $argv[1];
        if($one == 'generate-key')
        {
            $key = shell_exec('./vendor/bin/generate-defuse-key');
            echo $key;
        } else if($argv[1] == "make") {
            if($argv[2] == "controller") {
                if(isset($argv[3]) && !empty($argv[3])) {
                    $mc = new makeController($argv[3]);
                    $mc->create();
                }
            }
        }
    }