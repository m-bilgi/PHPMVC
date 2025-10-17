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

    // Partial
    public function partialData()
    {
        $data = [
            'title' => 'Include partial content',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'
            ];
        return $data;
    }
}
