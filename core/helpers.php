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

if (!function_exists('yield_content')) {
    function yield_content(string $name, string $default = ''): void
    {
        View::yield($name, $default);
    }
}

if (!function_exists('include_view')) {
    function include_view(string $viewPath, array $params = []): void
    {
        View::include($viewPath, $params);
    }
}
