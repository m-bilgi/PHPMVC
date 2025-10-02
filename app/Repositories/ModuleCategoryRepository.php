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
     * Fetches all records (via stored procedure).
     * Stored Procedure: sp_module_category_get_all
     *
     * @return ModuleCategory[]
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->prepare("CALL sp_module_category_get_all()");
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($rows as $row) {
            $categories[] = ModuleCategory::fromArray($row);
        }

        // In PDO stored procedure calls, the buffer must be cleared to avoid problems in subsequent queries.
        $stmt->closeCursor();

        return $categories;
    }

    /**
     * Returns a single record with ID (via stored procedure).
     * Stored Procedure: sp_module_category_find_by_id(IN p_id INT)
     */
    public function findById(int $id): ?ModuleCategory
    {
        $stmt = $this->pdo->prepare("CALL sp_module_category_find_by_id(:id)");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt->closeCursor();

        if (!$row) {
            return null;
        }

        return ModuleCategory::fromArray($row);
    }
}
