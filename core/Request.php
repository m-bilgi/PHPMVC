<?php
namespace Core;

class Request
{
    public static function uri(): string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        // If you want to remove the base path if index.php is in a subdirectory, add logic here.
        return rtrim($uri, '/') === '' ? '/' : rtrim($uri, '/');
    }

    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }
}
