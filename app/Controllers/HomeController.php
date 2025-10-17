<?php
namespace App\Controllers;

use Core\View;

class HomeController
{
    // Layout Retun
    public function index(): string
    {
        $data = [
            'title' => 'Home Page',
            'user'  => 'Mustafa'
        ];
        return View::renderWithLayout('home/index.php', 'layouts/main.php', $data);
    }

    // Without Layout Retun
    public function render(): string
    {
        $data = [
            'title' => 'Home Page',
            'user' => 'Mustafa'
        ];
        return View::render('home/index.php', $data);
    }

    public function showId(string $id): string
    {
        return "<p>This page was rendered without layout.</p>User Id: " . htmlspecialchars($id);
    }

    public function optionalParameter(string $category, ?int $pageNo = 1): string
    {
        if ($pageNo < 1) $pageNo = 1;
        return '<p>This page was rendered without layout.</p>' .
                '<p>Category:' . htmlspecialchars($category) . '</p>' .
                '<p>PageNo: '. $pageNo .'</p>' .
                '<a href="/show/articles/1">1</a> | <a href="/show/articles/2">2</a> | <a href="/show/articles/3">3</a> | <a href="/show/articles/4">4</a> | <a href="/show/articles/5">5</a>';
    }
}
