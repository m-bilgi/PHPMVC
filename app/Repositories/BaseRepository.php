<?php
declare(strict_types=1);

namespace App\Repositories;

use Core\Database;
use PDO;

abstract class BaseRepository
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Calls the Stored Procedure and returns the result.
     * @param string $procedureName  -> Procedure name to be CALL
     * @param array  $params         -> parameters to bind
     * @param bool   $fetchAll       -> true: all lines, false: single line
     */
    protected function callProcedure(string $procedureName, array $params = [], bool $fetchAll = true): array|null
    {
        // Prepare parameters as :key
        $placeholders = [];
        foreach ($params as $key => $val) {
            $placeholders[] = ':' . $key;
        }
        $placeholdersStr = implode(', ', $placeholders);

        $sql = "CALL {$procedureName}({$placeholdersStr})";
        $stmt = $this->pdo->prepare($sql);

        // bind values
        foreach ($params as $key => $val) {
            $stmt->bindValue(':' . $key, $val);
        }

        $stmt->execute();

        if ($fetchAll) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $rows = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        }

        $stmt->closeCursor();

        return $rows;
    }

    /**
     * Returns the QueryOptions parameters as an array
     */
    protected function applyQueryOptions(QueryOptions $options): array
    {
        return $options->toArray();
    }
}
