<?php
namespace Core;

class Router
{
    private array $routes = [];

    public function get(string $uri, $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post(string $uri, $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    private function addRoute(string $method, string $uri, $action): void
    {
        $uri = trim($uri, '/');
        $segments = $uri === '' ? [] : explode('/', $uri);

        $this->routes[$method][] = [
            'segments' => $segments,
            'action' => $action
        ];
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = trim($uri, '/');
        $uriSegments = $uri === '' ? [] : explode('/', $uri);

        //echo "<pre>Request::uri() = /$uri</pre>";

        $routes = $this->routes[$method] ?? [];

        foreach ($routes as $route) {
            $params = [];
            if ($this->match($uriSegments, $route['segments'], $params)) {
                $this->runAction($route['action'], $params);
                return;
            }
        }

        http_response_code(404);
        echo "<h3>404 Not Found</h3>";
        echo "<pre>Available routes:\n";
        foreach ($routes as $r) {
            echo '/' . implode('/', $r['segments']) . "\n";
        }
        echo "</pre>";
    }

    private function match(array $uriSegments, array $routeSegments, array &$params): bool
    {
        $params = [];
        $uriCount = count($uriSegments);
        $routeCount = count($routeSegments);

        // Optional parameters must be in the last segment
        if ($uriCount > $routeCount) return false;

        for ($i = 0; $i < $routeCount; $i++) {
            $routePart = $routeSegments[$i];
            $uriPart = $uriSegments[$i] ?? null;

            // Optional parameter {param?}
            if (preg_match('/^\{([a-zA-Z_][a-zA-Z0-9_]*)\?\}$/', $routePart, $m)) {
                if ($uriPart !== null) {
                    $params[$m[1]] = $uriPart;
                } else {
                    $params[$m[1]] = null;
                }
                continue;
            }

            // Required parameter {param}
            if (preg_match('/^\{([a-zA-Z_][a-zA-Z0-9_]*)\}$/', $routePart, $m)) {
                if ($uriPart === null) return false;
                $params[$m[1]] = $uriPart;
                continue;
            }

            // Straight segment matching
            if ($routePart !== $uriPart) {
                return false;
            }
        }

        return true;
    }

    private function runAction($action, array $params): void
    {
        if (is_callable($action)) {
            echo call_user_func_array($action, $params);
            return;
        }

        if (is_string($action)) {
            [$controllerName, $methodName] = explode('@', $action);
            $controller = 'App\\Controllers\\' . $controllerName;

            if (!class_exists($controller)) {
                throw new \Exception("Controller not found: {$controller}");
            }

            $instance = new $controller();

            if (!method_exists($instance, $methodName)) {
                throw new \Exception("Method not found: {$methodName}");
            }

            echo call_user_func_array([$instance, $methodName], $params);
        }
    }
}
