<?php

use Core\View;

if (!function_exists('section')) {
    function section(string $name): void
    {
        View::startSection($name);
    }
}

if (!function_exists('endsection')) {
    function endsection(): void
    {
        View::endSection();
    }
}

if (!function_exists('yieldContent')) {
    function yieldContent(string $name, string $default = ''): void
    {
        View::yield($name, $default);
    }
}

if (!function_exists('includeFile')) {
    function includeFile(string $viewPath, array $params = []): void
    {
        View::include($viewPath, $params);
    }
}
