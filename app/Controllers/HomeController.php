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
        //return View::renderWithLayout('home/index.php', 'layouts/main.php', ['user' => 'Mustafa'])
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

    public function show(string $id): string
    {
        return "User Id: " . htmlspecialchars($id);
    }
}
