<?php
declare(strict_types=1);

namespace App\Services;

use Core\{Cache, ServiceResponse};
use App\Repositories\{QueryOptions, CategoryRepository};
use App\Models\Category;

class CategoryService
{
    private CategoryRepository $repo;
    private Cache $cache;

    public function __construct()
    {
        $this->repo = new CategoryRepository();
        $this->cache = new Cache();
    }

    // Return operation using Service Response.
    public function getAll(): ?ServiceResponse
    {
        $key = 'categoryList';

        if ($this->cache->has($key)) {
            $result = $this->cache->get($key);
        } else {
            $options = new QueryOptions(procType: 'catList');
            $model = new Category();
            $result = $this->repo->selectList($options, $model);
            $this->cache->set($key, $result, 60); // 60 saniye cache
        }

        return new ServiceResponse(true, $result, count($result) . ' records found.');
    }

    public function getByUrl(string $slug): ?Category
    {
        $options = new QueryOptions(procType: 'catByUrl');
        $model = new Category();
        $model->url = $slug;

        $data = $this->repo->select($options, $model);

        if ($data->status === 1) {
            $this->updateHit($data->id);
        }

        return $data;
    }

    public function create(array $data): bool
    {
        $options = new QueryOptions(procType: 'insert');
        $model = new Category($data);
        $result = $this->repo->insert($options, $model);

        if ($this->cache->has('categoryList')) {
            $this->cache->delete('categoryList');
        }

        return $result;
    }

    public function update(array $data): bool
    {
        $options = new QueryOptions(procType: 'update');
        $model = new Category($data);
        $result = $this->repo->update($options, $model);

        if ($this->cache->has('categoryList')) {
            $this->cache->delete('categoryList');
        }

        return $result;
    }

    public function delete(int $id): bool
    {
        $options = new QueryOptions(procType: 'delete');
        $model = new Category();
        $model->id = $id;
        $result = $this->repo->delete($options, $model);

        if ($this->cache->has('categoryList')) {
            $this->cache->delete('categoryList');
        }

        return $result;
    }

    private function updateHit(int $id): void
    {
        $options = new QueryOptions(procType: 'updateHit');
        $model = new Category();
        $model->id = $id;

        $this->repo->update($options, $model);
    }
}
