<?php
declare(strict_types=1);

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

if (!function_exists('yieldContentOr')) {
    function yieldContentOr(string $name, callable $callback): void
    {
        if (!View::hasSection($name)) {
            echo $callback();
        } else {
            yieldContent($name);
        }
    }
}

if (!function_exists('config')) {
    function config(string $key = null, mixed $default = null): mixed
    {
        static $config = null;

        if ($config === null) {
            $config = require __DIR__ . '/config.php';
        }

        // Tüm config değerlerini istiyorsa
        if ($key === null) {
            return $config;
        }

        // Tek bir anahtar istiyorsa
        return $config[$key] ?? $default;
    }
}
