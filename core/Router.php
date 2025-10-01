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

        // Convert {param} parts to regex
        $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<\1>[^/]+)', $uri);
        $pattern = '#^' . $pattern . '$#';

        $this->routes[$method][] = [
            'pattern' => $pattern,
            'action'  => $action
        ];
    }

    protected function normalize(string $uri): string
    {
        $path = parse_url($uri, PHP_URL_PATH) ?? $uri;
        $path = '/' . trim($path, '/');
        return $path === '/' ? '/' : rtrim($path, '/');
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = $this->normalize($uri);
        $methodRoutes = $this->routes[$method] ?? [];

        foreach ($methodRoutes as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                $action = $route['action'];

                // Capture parameters
                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }

                if (is_callable($action)) {
                    echo call_user_func_array($action, $params);
                    return;
                }

                if (is_string($action)) {
                    [$controllerShort, $methodName] = explode('@', $action);
                    $controller = str_contains($controllerShort, '\\')
                        ? $controllerShort
                        : 'App\\Controllers\\' . $controllerShort;

                    if (!class_exists($controller)) {
                        throw new \Exception("Controller {$controller} not found.");
                    }

                    $instance = new $controller();

                    if (!method_exists($instance, $methodName)) {
                        throw new \Exception("Method {$methodName} not found in {$controller}.");
                    }

                    echo call_user_func_array([$instance, $methodName], $params);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
