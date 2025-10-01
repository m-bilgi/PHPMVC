<?php
namespace Core;

class View
{
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
        $content = self::render($viewPath, $params);

        $fullLayout = __DIR__ . '/../app/Views/' . ltrim($layoutPath, '/');
        if (!file_exists($fullLayout)) {
            throw new \Exception("Layout not found: " . $fullLayout);
        }

        extract($params, EXTR_OVERWRITE);
        ob_start();
        include $fullLayout;
        return ob_get_clean();
    }
}
