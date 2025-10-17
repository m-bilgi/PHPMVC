<?php
namespace Core;

class View
{
    protected static array $sections = [];
    protected static array $sectionStack = [];

    // === Section System ===
    public static function hasSection(string $name): bool
    {
        return isset(self::$sections[$name]);
    }

    public static function startSection(string $name): void
    {
        self::$sectionStack[] = $name;
        ob_start();
    }

    public static function endSection(): void
    {
        $name = array_pop(self::$sectionStack);
        self::$sections[$name] = ob_get_clean();
    }

    // === Yield System ===
    public static function yield(string $name, string $default = ''): void
    {
        echo self::$sections[$name] ?? $default;
    }

    // === View Rendering ===
    public static function render(string $viewPath, array $params = []): string
    {
        $full = __DIR__ . '/../app/Views/' . ltrim($viewPath, '/');
        if (!file_exists($full)) {
            throw new \Exception("View not found: " . $full);
        }

        extract($params, EXTR_OVERWRITE);
        ob_start();
        include $full;
        return ob_get_clean();
    }

    public static function renderWithLayout(string $viewPath, string $layoutPath, array $params = []): string
    {
        // Render content (sections are filled)
        $content = self::render($viewPath, $params);

        // Varsayılan content section’u
        if (!isset(self::$sections['content'])) {
            self::$sections['content'] = $content;
        }

        // Render Layout
        $fullLayout = __DIR__ . '/../app/Views/' . ltrim($layoutPath, '/');
        if (!file_exists($fullLayout)) {
            throw new \Exception("Layout not found: " . $fullLayout);
        }

        extract($params, EXTR_OVERWRITE);
        ob_start();
        include $fullLayout;
        $output = ob_get_clean();

        // Cleaning
        self::$sections = [];
        self::$sectionStack = [];

        return $output;
    }

    // === Include System ===
    public static function include(string $viewPath, array $params = []): void
    {
        echo self::render($viewPath, $params);
    }

    /**
     * Dynamic partial loader.
     * @param array|string $partial
     */
    public static function includePartial(array|string $partial): void
    {
        // If only string is given, simple include
        if (is_string($partial)) {
            self::renderPartial($partial, []);
            return;
        }

        // In serial format: ['view' => '', 'controller' => '', 'method' => '', 'params' => []]
        $view = $partial['view'] ?? null;
        $controllerName = $partial['controller'] ?? null;
        $method = $partial['method'] ?? null;
        $params = $partial['params'] ?? [];

        if (!$view) {
            echo "<!-- Missing 'view' key for partial -->";
            return;
        }

        $data = null;

        // If controller + method is specified, let's get the data from that method
        if ($controllerName && $method) {
            $controllerClass = "\\App\\Controllers\\{$controllerName}";
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass();

                if (method_exists($controller, $method)) {
                    $data = call_user_func_array([$controller, $method], $params);
                }
            }
        }

        // FIX: Resolves nested $data['data'] issue
        if (is_object($data)) {
            // If it is a Model or stdClass object
            self::renderPartial($view, ['data' => $data] + get_object_vars($data));
        } elseif (is_array($data)) {
            // If the series returns
            self::renderPartial($view, $data);
        } else {
            // is null or scalar
            self::renderPartial($view, ['data' => $data]);
        }
    }

    private static function renderPartial(string $viewPath, array $data = []): void
    {
        $fullPath = __DIR__ . '/../app/Views/' . ltrim($viewPath, '/');
        if (!file_exists($fullPath)) {
            echo "<!-- Partial not found: {$viewPath} -->";
            return;
        }

        //extract($data, EXTR_SKIP);
        extract($data, EXTR_OVERWRITE);
        include $fullPath;
    }
}
