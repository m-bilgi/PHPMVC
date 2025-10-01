<?php
// The $router object is created and included in public/index.php.
$router->get('/', 'HomeController@index');

// Without layout
$router->get('/render', 'HomeController@render');

$router->get('/hello', function () {
    return 'Hello! Closure and route worked.';
});

// Parameterized route example
// For numeric value only: {id:\d+}
$router->get('/user/{id}', 'HomeController@show');
