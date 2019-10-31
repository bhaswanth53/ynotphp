<?php

    // Map Method, Route, Controller, Name of the route
    
    $router->map('GET', '/', 'Controllers\\HomeController@home', 'home');
    $router->map('GET', '/about/[i:id]/[i:kd]/route/[i:name]', 'Controllers\\HomeController@about', 'about');
    $router->map('GET', '/test-route', 'Controllers\\HomeController@test');