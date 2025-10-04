<?php
declare(strict_types=1);

namespace App\Repositories;

use Core\Database;
use App\Models\ModuleCategory;
use PDO;

class ModuleCategoryRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Return a single record - (via stored procedure)
     * Stored Procedure: sp_select_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $model object
     * @return ModuleCategory|null
     */
    public function select(QueryOptions $options, ModuleCategory $model): ?ModuleCategory
    {
        try {
            $stmt = $this->pdo->prepare("CALL sp_select_module_category(:procType, :langValue, :categoyId, :moduleId, :categoryName, :categoryStatus)");
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':langValue', $options->langValue);
            $stmt->bindValue(':categoyId', $model->id, PDO::PARAM_INT);
            $stmt->bindValue(':moduleId', $model->module_id, PDO::PARAM_INT);
            $stmt->bindValue(':categoryName', $model->name);
            $stmt->bindValue(':categoryStatus', $model->status, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            if (!$row) {
                return null;
            }

            return ModuleCategory::fromArray($row);
        } catch (\Throwable $th) {
            // Error catching and logging
            // \Log::error("Error in select() function 'sp_select_module_category': " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
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
     * @return array - ModuleCategory[]
     */
    public function selectList(QueryOptions $options, ModuleCategory $model): array
    {
        try {
            $stmt = $this->pdo->prepare("CALL sp_select_module_category(:procType, :langValue, :categoyId, :moduleId, :categoryName, :categoryStatus)");
            $stmt->bindValue(':procTypeX', $options->procType);
            $stmt->bindValue(':langValue', $options->langValue);
            $stmt->bindValue(':categoyId', $model->id, PDO::PARAM_INT);
            $stmt->bindValue(':moduleId', $model->module_id, PDO::PARAM_INT);
            $stmt->bindValue(':categoryName', $model->name);
            $stmt->bindValue(':categoryStatus', $model->status, PDO::PARAM_INT);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $categories = [];
            foreach ($rows as $row) {
                $categories[] = ModuleCategory::fromArray($row);
            }

            // In PDO stored procedure calls, the buffer must be cleared to avoid problems in subsequent queries.
            $stmt->closeCursor();

            return $categories;
        } catch (\Throwable $th) {
            // Error catching and logging
            // \Log::error("Error in selectList() function 'sp_select_module_category: " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
            }
            return null;
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
    public function insert(QueryOptions $options, ModuleCategory $model): bool
    {
        try {
            $stmt = $this->pdo->prepare("CALL sp_insert_module_category(
                :procType:, :moduleId, :categoryGuid, :categoryName, :categoryHit, :categoryImage, :categorySortOrder, :categoryUrl, :categoryStatus)"
            );
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':moduleId', $model->module_id, PDO::PARAM_INT);
            $stmt->bindValue(':categoryGuid', $model->guid);
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
            // \Log::error("Error in insert() function 'sp_insert_module_category: " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
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
    public function update(QueryOptions $options, ModuleCategory $model): bool
    {
        try {
            $stmt = $this->pdo->prepare("CALL sp_update_module_category(
                :procType, :categoryId, :moduleId, :categoryGuid, :categoryName, :categoryHit, :categoryImage, :categorySortOrder, :categoryUrl, :categoryStatus
            )");
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':categoryId', $model->id, PDO::PARAM_INT);
            $stmt->bindValue(':moduleId', $model->module_id, PDO::PARAM_INT);
            $stmt->bindValue(':categoryGuid', $model->guid);
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
            // \Log::error("Error in update() function 'sp_update_module_category: " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
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
            $stmt = $this->pdo->prepare("CALL sp_delete_module_category(:categoryId)");
            $stmt->bindValue(':categoryId', $id, PDO::PARAM_INT);

            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            // \Log::error("Error in delete() function 'sp_delete_module_category: " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
            }
            return false;
        }
    }
}
