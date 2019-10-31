<?php
    require '../vendor/autoload.php';
    require "../helpers.php";

    session_start();

    $error_path = "../logs/".date('Y-m-d').".log";
    // $error_path = "../PHP_errors.log";

    if(env('APP_DEBUG') === true) {
        ini_set("log_errors", 1);
        ini_set("error_log", $error_path);
    }

    $router = new AltoRouter();

    $path = env("APP_PATH");

    $router->setBasePath($path);

    include("../web.php");

    $router->addMatchTypes(array(
        "string" => '[A-Za-z0-9_~\-!@#=\$%\^&\*\(\)]?'
    ));

    $match = $router->match();

    list( $controller, $action ) = explode( '@', $match['target'] );

    if(is_callable(array($controller, $action)) ) {
        $obj = new $controller();
        echo call_user_func_array(array($obj, $action), $match['params']);
    }
    elseif(isset($match) && isset($match['target']))
    {
        if($match['target']=='')
        {
            echo 'Error: no route was matched'; 
        }
        else {
            throw new Exception(ErrorException, "Action not found");
        }
    }
    else {
        header("HTTP/1.0 404 Not Found");
        require '../views/errors/404.php';
    }

