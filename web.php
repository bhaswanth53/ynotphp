<?php

    use Bucket\Router;
    // Map Method, Route, Controller, Name of the route
    
    // $router->map('GET', '/', 'Controllers\\HomeController@home', 'home');
    Router::get("/", "Controllers\\HomeController@home", "home");
    Router::get("/about", "Controllers\\HomeController@about");