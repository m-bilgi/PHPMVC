<?php
declare(strict_types=1);

namespace App\Repositories;

use Core\{Database, Logger};
use App\Models\ModuleConfig;
use PDO;

class ModuleConfigRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    private function bindSelectParams(\PDOStatement $stmt, QueryOptions $options, ModuleCategory $model): void
    {
        $stmt->bindValue(':procType', $options->procType);
        $stmt->bindValue(':langValue', $options->langValue);
        $stmt->bindValue(':moduleId', $model->id, PDO::PARAM_INT);
        $stmt->bindValue(':moduleName', $model->name);
        $stmt->bindValue(':moduleStatus', $model->status, PDO::PARAM_INT);
    }

    private function bindInsertUpdateParams(\PDOStatement $stmt, QueryOptions $options, ModuleCategory $model): void
    {
        $stmt->bindValue(':procType', $options->procType);
        $stmt->bindValue(':moduleId', $model->id, PDO::PARAM_INT);
        $stmt->bindValue(':moduleGuid', $model->guid);
        $stmt->bindValue(':moduleName', $model->name);
        $stmt->bindValue(':memberSelectLevel', $model->member_level, PDO::PARAM_INT);
        $stmt->bindValue(':memberInsertLevel', $model->content_add_member_level, PDO::PARAM_INT);
        $stmt->bindValue(':moduleStatus', $model->status, PDO::PARAM_INT);
        $stmt->bindValue(':uploadFileExtensions', $model->upload_file_extensions);
        $stmt->bindValue(':uploadFileSize', $model->upload_file_size);
        $stmt->bindValue(':memberUploadLevel', $model->upload_file_member_level, PDO::PARAM_INT);
        $stmt->bindValue(':uploadFileStatus', $model->upload_file_status, PDO::PARAM_INT);
    }

    /**
     * Return a single record - (via stored procedure)
     * Stored Procedure: sp_select_module_config(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleConfig $model object
     * @return ModuleConfig|null
     */
    public function select(QueryOptions $options, ModuleConfig $model): ?ModuleConfig
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_select_module_config(:procType, :langValue, :moduleId, :moduleName, :moduleStatus)');
            $this->bindSelectParams($stmt, $options, $model);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            if (!$row) {
                return null;
            }

            return ModuleConfig::fromArray($row);
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('ModuleConfigRepository: ' . $th->getMessage());
            }
            return null;
        }
    }

    /**
     * Return a list records (via stored procedure).
     * Stored Procedure: sp_select_module_config(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleConfig $model object
     * @return array - ModuleConfig[]
     */
    public function selectList(QueryOptions $options, ModuleConfig $model): array
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_select_module_config(:procType, :langValue, :moduleId, :moduleName, :moduleStatus)');
            $this->bindSelectParams($stmt, $options, $model);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = [];
            foreach ($rows as $row) {
                $result[] = ModuleConfig::fromArray($row);
            }

            // In PDO stored procedure calls, the buffer must be cleared to avoid problems in subsequent queries.
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('ModuleConfigRepository: ' . $th->getMessage());
            }
            return [];
        }
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_insert_module_config(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleConfig $model object
     * @return bool - true|false
     */
    public function insert(QueryOptions $options, ModuleConfig $model): bool
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_insert_module_config(:procType, :moduleId, :moduleGuid, :moduleName, :memberSelectLevel, :memberInsertLevel, :moduleStatus, :uploadFileExtensions, :uploadFileSize, :memberUploadLevel, :uploadFileStatus)');
            $this->bindInsertUpdateParams($stmt, $options, $model);
            $result = $stmt->execute();

            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('ModuleConfigRepository: ' . $th->getMessage());
            }
            return false;
        }
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_update_module_config(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleConfig $model object
     * @return bool - true|false
     */
    public function update(QueryOptions $options, ModuleConfig $model): bool
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_update_module_config(:procType, :moduleId, :moduleGuid, :moduleName, :memberSelectLevel, :memberInsertLevel, :moduleStatus, :uploadFileExtensions, :uploadFileSize, :memberUploadLevel, :uploadFileStatus)');
            $this->bindInsertUpdateParams($stmt, $options, $model);
            $result = $stmt->execute();

            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('ModuleConfigRepository: ' . $th->getMessage());
            }
            return false;
        }
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_delete_module_config(...)
     *
     * @param QueryOptions $options object.
     * @param ModuleConfig $model object
     * @return bool - true|false
     */
    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_delete_module_config(:moduleId)');
            $stmt->bindValue(':moduleId', $id, PDO::PARAM_INT);

            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('ModuleConfigRepository: ' . $th->getMessage());
            }
            return false;
        }
    }
}
