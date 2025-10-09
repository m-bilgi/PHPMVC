<?php
declare(strict_types=1);

namespace App\Repositories;

use Core\{Database, Logger};
use App\Models\Member;
use PDO;

class MemberRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    private function bindSelectParams(\PDOStatement $stmt, QueryOptions $options, ModuleCategory $model): void
    {
        $stmt->bindValue(':procType', $options->procType);
        $stmt->bindValue(':anyValue01', $options->anyValue01);
        $stmt->bindValue(':anyValue02', $options->anyValue02);
        $stmt->bindValue(':userId', $model->id, PDO::PARAM_INT);
        $stmt->bindValue(':userEmail', $model->email);
        $stmt->bindValue(':username', $model->username);
        $stmt->bindValue(':userPassword', $model->password);
        $stmt->bindValue(':userLevel', $model->level, PDO::PARAM_INT);
        $stmt->bindValue(':userStatus', $model->status, PDO::PARAM_INT);
    }

    /**
     * Return a single record - (via stored procedure)
     * Stored Procedure: sp_select_member(...)
     *
     * @param QueryOptions $options object.
     * @param Member $model object
     * @return Member|null
     */
    public function select(QueryOptions $options, Member $model): ?Member
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_select_member(:procType, :anyValue01, :anyValue02, :userId, :userEmail, :username, :userPassword, :userLevel, :userStatus)');
            $this->bindSelectParams($stmt, $options, $model);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            if (!$row) {
                return null;
            }

            return Member::fromArray($row);
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('MemberRepository: ' . $th->getMessage());
            }
            return null;
        }
    }

    /**
     * Return a list records (via stored procedure).
     * Stored Procedure: sp_select_member(...)
     *
     * @param QueryOptions $options object.
     * @param Member $model object
     * @return array - Member[]
     */
    public function selectList(QueryOptions $options, Member $model): array
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_select_member(:procType, :anyValue01, :anyValue02, :userId, :userEmail, :username, :userPassword, :userLevel, :userStatus)');
            $this->bindSelectParams($stmt, $options, $model);
            $stmt->execute();

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = [];
            foreach ($rows as $row) {
                $result[] = Member::fromArray($row);
            }

            // In PDO stored procedure calls, the buffer must be cleared to avoid problems in subsequent queries.
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('MemberRepository: ' . $th->getMessage());
            }
            return [];
        }
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_insert_member(...)
     *
     * @param QueryOptions $options object.
     * @param Member $model object
     * @return bool - true|false
     */
    public function insert(QueryOptions $options, Member $model): bool
    {
        try {
            $stmt = $this->pdo->prepare('CALL sp_insert_member(:procType, :userFirstname, :userSurname, :userEmail, :username, :userPassword, :userLevel, :userStatus)');
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':userFirstname', $model->name);
            $stmt->bindValue(':userSurname', $model->surname);
            $stmt->bindValue(':userEmail', $model->email);
            $stmt->bindValue(':username', $model->username);
            $stmt->bindValue(':userPassword', $model->password);
            $stmt->bindValue(':userLevel', $model->level, PDO::PARAM_INT);
            $stmt->bindValue(':userStatus', $model->status, PDO::PARAM_INT);

            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('MemberRepository: ' . $th->getMessage());
            }
            return false;
        }
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_update_member(...)
     *
     * @param QueryOptions $options object.
     * @param Member $model object
     * @return bool - true|false
     */
    public function update(QueryOptions $options, Member $model): bool
    {
        try {
            $stmt = $this->pdo->prepare("CALL sp_update_member(:procType, :userId, :userFirstname, :userSurname, :userEmail, :username, :userPassword, :userLevel, :userStatus)");
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':userId', $model->id, PDO::PARAM_INT);
            $stmt->bindValue(':userFirstname', $model->name);
            $stmt->bindValue(':userSurname', $model->surname);
            $stmt->bindValue(':userEmail', $model->email);
            $stmt->bindValue(':username', $model->username);
            $stmt->bindValue(':userPassword', $model->password);
            $stmt->bindValue(':userLevel', $model->level, PDO::PARAM_INT);
            $stmt->bindValue(':userStatus', $model->status, PDO::PARAM_INT);

            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('MemberRepository: ' . $th->getMessage());
            }
            return false;
        }
    }

    /**
     * ...TODO: NOT TESTED...
     * Return bool (via stored procedure).
     * Stored Procedure: sp_delete_member(...)
     *
     * @param QueryOptions $options object.
     * @param Member $model object
     * @return bool - true|false
     */
    public function delete(int $id): bool
    {
        try {
            $stmt = $this->pdo->prepare("CALL sp_delete_member(:userId)");
            $stmt->bindValue(':userId', $id, PDO::PARAM_INT);

            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            if ($_ENV['APP_DEV_MODE']) {
                Logger::error('MemberRepository: ' . $th->getMessage());
            }
            return false;
        }
    }
}
