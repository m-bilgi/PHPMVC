<?php
// $The $router object is created and included in public/index.php.
$router->get('/', 'HomeController@index');

// Without layout
$router->get('/render', 'HomeController@render');

// Parameterized route example
// For numeric value only: {id:\d+}
$router->get('/user/{id}', 'HomeController@showId');

// Optional Parameterized route example
// Example: "show/article/" "show/article/1" "show/gallery/" "show/gallery/3"
$router->get('/show/{category}/{pageNo?}', 'HomeController@optionalParameter');

$router->get('/hello', function () {
    return '<p>Hello!</p><p>This page was rendered without layout.</p>Closure and route worked.';
});

// Category Pages
$router->get('/category', 'CategoryController@index');
$router->get('/category/show/{slug}', 'CategoryController@show');
$router->get('/category/edit/{slug}', 'CategoryController@edit');
$router->get('/category/insert', 'CategoryController@insert');
$router->get('/category/delete/{slug}', 'CategoryController@delete');

$router->post('/category/edit-post', 'CategoryController@editPost');
$router->post('/category/insert-post', 'CategoryController@insertPost');
$router->post('/category/delete-post', 'CategoryController@deletePost');
