<?php
declare(strict_types=1);

use Core\View;

if (!function_exists('section')) {
    function section(string $name, $content = null): void
    {
        // If there is no content parameter, initialize it for multi-line use.
        if ($content === null) {
            View::startSection($name);
            return;
        }

        // Single-line or callable content
        View::startSection($name);

        if (is_callable($content)) {
            // If callable, execute (output will be captured)
            $content();
        } else {
            // If it is a string or other type, echo it directly.
            echo $content;
        }

        View::endSection();
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

        // If you want all the config values
        if ($key === null) {
            return $config;
        }

        // If you want a single key
        return $config[$key] ?? $default;
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string
    {
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars(csrf_token(), ENT_QUOTES) . '">';
    }
}

if (!function_exists('check_csrf')) {
    function check_csrf(string $token): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}

if (!function_exists('sign_guid')) {
    function sign_guid(string $id): string
    {
        $secretKey = $_ENV['APP_KEY'] ?? 'default_secret_key';
        return hash_hmac('sha256', $id, $secretKey);
    }
}

if (!function_exists('verify_guid')) {
    function verify_guid(string $id, string $signature): bool
    {
        $expected = sign_guid($id);
        return hash_equals($expected, $signature);
    }
}
