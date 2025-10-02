<?php
declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../core/helpers.php';

use Core\Router;
use Core\Request;

session_start();

// Creating a router instance and filling it with the routes file
$router = new Router();
require_once __DIR__ . '/../routes.php';

// Dispatch - controller is called based on the incoming URI and method
try {
    $router->dispatch(Request::uri(), Request::method());
} catch (Throwable $e) {
    http_response_code(500);
    echo "500 - Internal Server Error<br>";
    echo htmlspecialchars($e->getMessage());
}
