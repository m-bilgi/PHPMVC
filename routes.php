<?php
// The $router object is created and included in public/index.php.
$router->get('/', 'HomeController@index');
$router->get('/hello', function () {
    return 'Hello! Closure and route worked.';
});

// Parameterized route example
$router->get('/user/{id}', 'HomeController@show');
