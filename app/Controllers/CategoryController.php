<?php
namespace App\Controllers;

use Core\View;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryController
{
    private CategoryService $service;

    public function __construct()
    {
        $this->service = new CategoryService();
    }

    // Return operation using Service Response.
    public function index()
    {
        $title = 'Category page';
        $errorMsg = null;
        $serviceResponse = $this->service->getAll();
        if ($serviceResponse->success) {
            $dataList = $serviceResponse->data;
        } else {
            $errorMsg = $serviceResponse->message ?? 'An unexpected error occurred.';
        }

        return View::renderWithLayout('category/index.php', 'layouts/main.php', ['title' => $title, 'dataList' => $dataList, 'errorMsg' => $errorMsg]);
    }

    public function show(string $slug)
    {
        $data = $this->service->getByUrl($slug);

        $title = 'Category: ' . $data->name;

        return View::renderWithLayout('category/show.php', 'layouts/main.php', ['title' => $title, 'data' => $data]);
    }

    public function edit(string $slug)
    {
        $data = $this->service->getByUrl($slug);
        $data->signature = sign_guid($data->id);

        $title = 'Edit page: '. $data->name;

        return View::renderWithLayout('category/edit.php', 'layouts/main.php', ['title' => $title,'data' => $data]);
    }

    public function editPost(): void
    {
        if (!check_csrf($_POST['csrf_token'] ?? '')) {
            die('CSRF verification failed.');
        }

        if (!verify_guid($_POST['id'], $_POST['sig'])) {
            die('Invalid signature! Transaction rejected.');
        }

        if (empty($_POST['name']) || empty($_POST['url'])) {
            echo 'Please fill in the required fields.';
            return;
        }

        $data = [
            'id' => $_POST['id'] ?? '',
            'name' => $_POST['name'] ?? '',
            'url' => $_POST['url'] ?? '',
            'image' => $_POST['image'] ?? '',
            'sort_order' => $_POST['sort_order'] ?? 0,
            'status' => $_POST['status'] ?? 1,
        ];

        $result = $this->service->update($data);
        if ($result) {
            header('Location: /category');
            exit;
        }

        echo 'An error occurred during the update.';
    }

    public function insert()
    {
        $title = 'Category insert page';
        return View::renderWithLayout('category/insert.php', 'layouts/main.php', ['title' => $title]);
    }

    public function insertPost(): void
    {
        if (!check_csrf($_POST['csrf_token'] ?? '')) {
            die('CSRF verification failed.');
        }

        if (empty($_POST['name']) || empty($_POST['url'])) {
            echo 'Please fill in the required fields.';
            return;
        }

        $data = [
            'name' => $_POST['name'] ?? '',
            'url' => $_POST['url'] ?? '',
            'image' => $_POST['image'] ?? '',
            'sort_order' => $_POST['sort_order'] ?? 0,
            'status' => $_POST['status'] ?? 0,
        ];

        $result = $this->service->create($data);
        if ($result) {
            header('Location: /category');
            exit;
        }

        echo 'An error occurred while creating a new record.';
    }

    public function delete(string $slug)
    {
        $data = $this->service->getByUrl($slug);
        $data->signature = sign_guid($data->id);

        $title = 'Delete page: '. $data->name;

        return View::renderWithLayout('category/delete.php', 'layouts/main.php', ['title' => $title, 'data' => $data]);
    }

    public function deletePost(): void
    {
        if (!check_csrf($_POST['csrf_token'] ?? '')) {
            die('CSRF verification failed.');
        }

        if (!verify_guid($_POST['id'], $_POST['sig'])) {
            die('Invalid signature! Transaction rejected.');
        }

        $id = $_POST['id'];
        $result = $this->service->delete($id);
        if ($result) {
            header('Location: /category');
            exit;
        }

        echo 'There was a problem while deleting the record.';
    }
}
