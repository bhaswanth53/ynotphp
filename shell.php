<?php

    require_once "vendor/autoload.php";

    use Bucket\makeController;
    use Bucket\makeModel;

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
            } else if($argv[2] == "model") {
                if(isset($argv[3]) && !empty($argv[3])) {
                    if(isset($argv[4]) && !empty($argv[4]))
                    {
                        $mc = new makeModel($argv[3], $argv[4]);
                    } else {
                        $mc = new makeModel($argv[3]);
                    }
                    $mc->create();
                }
            }
        }
    }