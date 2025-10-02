<?php
namespace Core;

class View
{
    protected static array $sections = [];
    protected static array $sectionStack = [];

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
        // Render the content (sections will also be filled in during this time)
        $content = self::render($viewPath, $params);

        // Default content section
        if (!isset(self::$sections['content'])) {
            self::$sections['content'] = $content;
        }

        // Render layout
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

    // === Section / Yield System ===

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

    public static function yield(string $name, string $default = ''): void
    {
        echo self::$sections[$name] ?? $default;
    }

    // === Include System ===
    public static function include(string $viewPath, array $params = []): void
    {
        echo self::render($viewPath, $params);
    }
}
