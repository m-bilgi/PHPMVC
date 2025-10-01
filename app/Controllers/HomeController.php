<?php
namespace App\Controllers;

use Core\View;

class HomeController
{
    public function index(): string
    {
        $data = [
            'title' => 'Home Page',
            'user' => 'Mustafa'
        ];
        return View::render('home/index.php', $data);
    }
}
