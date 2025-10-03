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
     * @param ModuleCategory $mc object
     * @return ModuleCategory|null
     */
    public function select(QueryOptions $options, ModuleCategory $mc): ?ModuleCategory
    {
        $stmt = $this->pdo->prepare("CALL sp_select_module_category(:procType, :langValue, :categoyId, :moduleId, :categoryName, :categoryStatus)");
        $stmt->bindValue(':procType', $options->procType);
        $stmt->bindValue(':langValue', $options->langValue);
        $stmt->bindValue(':categoyId', $mc->id, PDO::PARAM_INT);
        $stmt->bindValue(':moduleId', $mc->module_id, PDO::PARAM_INT);
        $stmt->bindValue(':categoryName', $mc->name);
        $stmt->bindValue(':categoryStatus', $mc->status, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        if (!$row) {
            return null;
        }

        return ModuleCategory::fromArray($row);
    }

    /**
     * Return a list records (via stored procedure).
     * Stored Procedure: sp_select_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $mc object
     * @return array - ModuleCategory[]
     */
    public function selectList(QueryOptions $options, ModuleCategory $mc): array
    {
        // without model options

        $stmt = $this->pdo->prepare("CALL sp_select_module_category(:procType, :langValue, :categoyId, :moduleId, :categoryName, :categoryStatus)");
        $stmt->bindValue(':procType', $options->procType);
        $stmt->bindValue(':langValue', $options->langValue);
        $stmt->bindValue(':categoyId', $mc->id, PDO::PARAM_INT);
        $stmt->bindValue(':moduleId', $mc->module_id, PDO::PARAM_INT);
        $stmt->bindValue(':categoryName', $mc->name);
        $stmt->bindValue(':categoryStatus', $mc->status, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = ModuleCategory::fromArray($row);
        }

        // PDO stored procedure çağrılarında, sonraki query'lerde sorun olmaması için
        // buffer temizlenmeli
        $stmt->closeCursor();

        return $categories;
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_insert_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $mc object
     * @return bool - true|false
     */
    public function insert(QueryOptions $options, ModuleCategory $mc): bool
    {
        $stmt = $this->pdo->prepare("CALL sp_insert_module_category(
            :procType:, :moduleId, :categoryGuid, :categoryName, :categoryHit, :categoryImage, :categorySortOrder, :categoryUrl, :categoryStatus)"
        );
        $stmt->bindValue(':procType', $options->procType);
        $stmt->bindValue(':moduleId', $mc->module_id, PDO::PARAM_INT);
        $stmt->bindValue(':categoryGuid', $mc->guid);
        $stmt->bindValue(':categoryName', $mc->name);
        $stmt->bindValue(':categoryHit', $mc->hit, PDO::PARAM_INT);
        $stmt->bindValue(':categoryImage', $mc->image);
        $stmt->bindValue(':categorySortOrder', $mc->sort_order, PDO::PARAM_INT);
        $stmt->bindValue(':categoryUrl', $mc->url);
        $stmt->bindValue(':categoryStatus', $mc->status, PDO::PARAM_INT);

        $result = $stmt->execute();
        $stmt->closeCursor();

        return $result;
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_update_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $mc object
     * @return bool - true|false
     */
    public function update(QueryOptions $options, ModuleCategory $mc): bool
    {
        $stmt = $this->pdo->prepare("CALL sp_update_module_category(
            :procType, :categoryId, :moduleId, :categoryGuid, :categoryName, :categoryHit, :categoryImage, :categorySortOrder, :categoryUrl, :categoryStatus
        )");
        $stmt->bindValue(':procType', $options->procType);
        $stmt->bindValue(':categoryId', $mc->id, PDO::PARAM_INT);
        $stmt->bindValue(':moduleId', $mc->module_id, PDO::PARAM_INT);
        $stmt->bindValue(':categoryGuid', $mc->guid);
        $stmt->bindValue(':categoryName', $mc->name);
        $stmt->bindValue(':categoryHit', $mc->hit, PDO::PARAM_INT);
        $stmt->bindValue(':categoryImage', $mc->image);
        $stmt->bindValue(':categorySortOrder', $mc->sort_order, PDO::PARAM_INT);
        $stmt->bindValue(':categoryUrl', $mc->url);
        $stmt->bindValue(':categoryStatus', $mc->status, PDO::PARAM_INT);

        $result = $stmt->execute();
        $stmt->closeCursor();

        return $result;
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_update_module_category(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleCategory $mc object
     * @return bool - true|false
     */
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("CALL sp_delete_module_category(:categoryId)");
        $stmt->bindValue(':categoryId', $id, PDO::PARAM_INT);

        $result = $stmt->execute();
        $stmt->closeCursor();

        return $result;
    }
}
