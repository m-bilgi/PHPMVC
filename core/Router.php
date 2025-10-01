<?php
namespace Core;

class Router
{
    protected array $routes = [];

    public function get(string $uri, $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    protected function addRoute(string $method, string $uri, $action): void
    {
        $uri = $this->normalize($uri);
        $this->routes[$method][$uri] = $action;
    }

    /**
     * Normalize a given URI (remove duplicate slashes, trailing slash except root, ensure leading slash).
     */
    protected function normalize(string $uri): string
    {
        // If a full URI is received, omit the query part.
        $path = parse_url($uri, PHP_URL_PATH) ?? $uri;

        // Start with a single prefix slash, trimming the /s inside
        $path = '/' . trim($path, '/');

        // If root, directly "/"
        if ($path === '/' || $path === '/.') {
            return '/';
        }

        // Remove trailing slash (except root)
        return rtrim($path, '/');
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = $this->normalize($uri);
        $methodRoutes = $this->routes[$method] ?? [];
        $action = $methodRoutes[$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        if (is_callable($action)) {
            echo call_user_func($action);
            return;
        }

        if (is_string($action)) {
            // Expected format "HomeController@index"
            [$controllerShort, $methodName] = explode('@', $action);

            // Namespace check: use default if full namespace not given
            $controller = str_contains($controllerShort, '\\')
                ? $controllerShort
                : 'App\\Controllers\\' . $controllerShort;

            if (!class_exists($controller)) {
                throw new \Exception("Controller {$controller} Not Found.");
            }

            $instance = new $controller();
            if (!method_exists($instance, $methodName)) {
                throw new \Exception("Method {$methodName} not found in {$controller}.");
            }

            echo call_user_func([$instance, $methodName]);
            return;
        }

        throw new \Exception("Invalid route action type.");
    }
}
