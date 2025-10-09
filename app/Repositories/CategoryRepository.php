<?php
declare(strict_types=1);

namespace App\Repositories;

use Core\{Database, Logger};
use App\Models\Category;
use PDO;

class CategoryRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    private function bindSelectParams(\PDOStatement $stmt, QueryOptions $options, Category $model): void
    {
        $stmt->bindValue(':procType', $options->procType);
        $stmt->bindValue(':langValue', $options->langValue);
        $stmt->bindValue(':categoryId', $model->id, PDO::PARAM_INT);
        $stmt->bindValue(':categoryUrl', $model->url);
        $stmt->bindValue(':categoryStatus', $model->status, PDO::PARAM_INT);
    }

    /**
     * Return a single record - (via stored procedure)
     * Stored Procedure: sp_select_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $model object
     * @return ModuleCategory|null
     */
    public function select(QueryOptions $options, Category $model): ?Category
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_select_category(:procType, :langValue, :categoryId, :categoryUrl, :categoryStatus)');
            $this->bindSelectParams($stmt, $options, $model);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            if (!$row) {
                return null;
            }

            return Category::fromArray($row);
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('CategoryRepository: ' . $th->getMessage());
            }
            return null;
        }
    }

    /**
     * Return a list records (via stored procedure).
     * Stored Procedure: sp_select_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $model object
     * @return array - ModuleCategory[]|[]
     */
    public function selectList(QueryOptions $options, Category $model): array
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_select_category(:procType, :langValue, :moduleId, :categoryUrl, :categoryStatus)');
            $this->bindSelectParams($stmt, $options, $model);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = [];
            foreach ($rows as $row) {
                $result[] = Category::fromArray($row);
            }

            // In PDO stored procedure calls, the buffer must be cleared to avoid problems in subsequent queries.
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('CategoryRepository: ' . $th->getMessage());
            }
            return [];
        }
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_insert_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $model object
     * @return bool - true|false
     */
    public function insert(QueryOptions $options, Category $model): bool
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_insert_category(:procType, :categoryName, :categoryHit, :categoryImage, :categorySortOrder, :categoryUrl, :categoryStatus)');
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':categoryName', $model->name);
            $stmt->bindValue(':categoryHit', $model->hit, PDO::PARAM_INT);
            $stmt->bindValue(':categoryImage', $model->image);
            $stmt->bindValue(':categorySortOrder', $model->sort_order, PDO::PARAM_INT);
            $stmt->bindValue(':categoryUrl', $model->url);
            $stmt->bindValue(':categoryStatus', $model->status, PDO::PARAM_INT);

            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('CategoryRepository: ' . $th->getMessage());
            }
            return false;
        }
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_update_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $model object
     * @return bool - true|false
     */
    public function update(QueryOptions $options, Category $model): bool
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_update_category(:procType, :categoryId, :categoryName, :categoryHit, :categoryImage, :categorySortOrder, :categoryUrl, :categoryStatus)');
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':categoryId', $model->id, PDO::PARAM_INT);
            $stmt->bindValue(':categoryName', $model->name);
            $stmt->bindValue(':categoryHit', $model->hit, PDO::PARAM_INT);
            $stmt->bindValue(':categoryImage', $model->image);
            $stmt->bindValue(':categorySortOrder', $model->sort_order, PDO::PARAM_INT);
            $stmt->bindValue(':categoryUrl', $model->url);
            $stmt->bindValue(':categoryStatus', $model->status, PDO::PARAM_INT);

            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('CategoryRepository: ' . $th->getMessage());
            }
            return false;
        }
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_delete_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $model object
     * @return bool - true|false
     */
    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_delete_category(:categoryId)');
            $stmt->bindValue(':categoryId', $id, PDO::PARAM_INT);

            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('CategoryRepository: ' . $th->getMessage());
            }
            return false;
        }
    }
}
