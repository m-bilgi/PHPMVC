<?php
declare(strict_types=1);

namespace App\Repositories;

use Core\Database;
use App\Models\Member;
use PDO;

class MemberRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
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
            $stmt = $this->pdo->prepare("CALL sp_select_member(:procType, :anyValue01, :anyValue02, :userId, :userGuid, :userEmail, :username, :userPassword, :userLevel, :userActivationKey, :userRegisterDate)");
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':anyValue01', $options->anyValue01);
            $stmt->bindValue(':anyValue02', $options->anyValue02);
            $stmt->bindValue(':userId', $model->id, PDO::PARAM_INT);
            $stmt->bindValue(':userGuid', $model->guid);
            $stmt->bindValue(':userEmail', $model->email);
            $stmt->bindValue(':username', $model->username);
            $stmt->bindValue(':userPassword', $model->password);
            $stmt->bindValue(':userLevel', $model->level, PDO::PARAM_INT);
            $stmt->bindValue(':userActivationKey', $model->activation_key);
            $stmt->bindValue(':userRegisterDate', $model->register_date);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt->closeCursor();

            if (!$row) {
                return null;
            }

            return Member::fromArray($row);
        } catch (\Throwable $th) {
            // Error catching and logging
            // \Log::error("Error in select() function 'sp_select_member': " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
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
            $stmt = $this->pdo->prepare("CALL sp_select_member(:procType, :anyValue01, :anyValue02, :userId, :userGuid, :userEmail, :username, :userPassword, :userLevel, :userActivationKey, :userRegisterDate)");
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':anyValue01', $options->anyValue01);
            $stmt->bindValue(':anyValue02', $options->anyValue02);
            $stmt->bindValue(':userId', $model->id, PDO::PARAM_INT);
            $stmt->bindValue(':userGuid', $model->guid);
            $stmt->bindValue(':userEmail', $model->email);
            $stmt->bindValue(':username', $model->username);
            $stmt->bindValue(':userPassword', $model->password);
            $stmt->bindValue(':userLevel', $model->level, PDO::PARAM_INT);
            $stmt->bindValue(':userActivationKey', $model->activation_key);
            $stmt->bindValue(':userRegisterDate', $model->register_date);
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
            // \Log::error("Error in selectList() function 'sp_select_member: " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
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
            $stmt = $this->pdo->prepare("CALL sp_insert_member(:procType, :userFirstname, :userSurname, :userEmail, :username, :userPassword, :userLevel, :userActivationKey, :userAvatarUrl, :userBirthday, :userCountryId, :userGender, :userIp, :userLanguage, :userRegisterDate, :userStatus, :userTheme, :userKey2)");
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':userFirstname', $model->name);
            $stmt->bindValue(':userSurname', $model->surname);
            $stmt->bindValue(':userEmail', $model->email);
            $stmt->bindValue(':username', $model->username);
            $stmt->bindValue(':userPassword', $model->password);
            $stmt->bindValue(':userLevel', $model->level, PDO::PARAM_INT);
            $stmt->bindValue(':userActivationKey', $model->activation_key);
            $stmt->bindValue(':userAvatarUrl', $model->avatar_url);
            $stmt->bindValue(':userBirthday', $model->birthday);
            $stmt->bindValue(':userCountryId', $model->country_id, PDO::PARAM_INT);
            $stmt->bindValue(':userGender', $model->gender);
            $stmt->bindValue(':userIp', $model->ip_address);
            $stmt->bindValue(':userLanguage', $model->language);
            //$stmt->bindValue(':userLastIp', $model->last_ip_address);
            //$stmt->bindValue(':userLastHereDate', $model->last_here_date);
            $stmt->bindValue(':userRegisterDate', $model->register_date);
            $stmt->bindValue(':userStatus', $model->status, PDO::PARAM_INT);
            $stmt->bindValue(':userTheme', $model->theme);
            $stmt->bindValue(':userKey2', $model->key2);
            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            // \Log::error("Error in insert() function 'sp_insert_member: " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
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
            $stmt = $this->pdo->prepare("CALL sp_update_member(:procType, :userId, :userGuid, :userFirstname, :userSurname, :userEmail, :username, :userPassword, :userLevel, :userAvatarUrl, :userBiography, :userBirthday, :userCity, :userCountryId, :userDescription, :userGender, :userHideBirthday, :userHideEmail, :userHideFullname, :userHideOnline, :userHobbies, :userHomepage, :userIp, :userLanguage, :userLastHereDate, :userLastPostDate, :userNewEmail, :userOccupation, :userPageViews, :userPmEmail, :userPmReceive, :userPosts, :userQuote, :userReceiveEmail, :userReply, :userReplyTotal, :userSignature, :userSocialMedia, :userState, :userStatus, :userSubscription, :userTheme, :userTitle)");
            $stmt->bindValue(':procType', $options->procType);
            $stmt->bindValue(':userId', $model->id, PDO::PARAM_INT);
            $stmt->bindValue(':userGuid', $model->guid);
            $stmt->bindValue(':userFirstname', $model->name);
            $stmt->bindValue(':userSurname', $model->surname);
            $stmt->bindValue(':userEmail', $model->email);
            $stmt->bindValue(':username', $model->username);
            $stmt->bindValue(':userPassword', $model->password);
            $stmt->bindValue(':userLevel', $model->level, PDO::PARAM_INT);
            //$stmt->bindValue(':userActivationKey', $model->activation_key);
            $stmt->bindValue(':userAvatarUrl', $model->avatar_url);
            $stmt->bindValue(':userBiography', $model->biography);
            $stmt->bindValue(':userBirthday', $model->birthday);
            $stmt->bindValue(':userCity', $model->city);
            $stmt->bindValue(':userCountryId', $model->country_id, PDO::PARAM_INT);
            $stmt->bindValue(':userDescription', $model->description);
            $stmt->bindValue(':userGender', $model->gender);
            $stmt->bindValue(':userHideBirthday', $model->hide_birthday, PDO::PARAM_INT);
            $stmt->bindValue(':userHideEmail', $model->hide_email, PDO::PARAM_INT);
            $stmt->bindValue(':userHideFullname', $model->hide_fullname, PDO::PARAM_INT);
            $stmt->bindValue(':userHideOnline', $model->hide_online, PDO::PARAM_INT);
            $stmt->bindValue(':userHobbies', $model->hobbies);
            $stmt->bindValue(':userHomepage', $model->homepage);
            $stmt->bindValue(':userIp', $model->ip_address);
            $stmt->bindValue(':userLanguage', $model->language);
            //$stmt->bindValue(':userLastIp', $model->last_ip_address);
            $stmt->bindValue(':userLastHereDate', $model->last_here_date);
            $stmt->bindValue(':userLastPostDate', $model->last_post_date);
            $stmt->bindValue(':userNewEmail', $model->new_email);
            $stmt->bindValue(':userOccupation', $model->occupation);
            $stmt->bindValue(':userPageViews', $model->page_views, PDO::PARAM_INT);
            //$stmt->bindValue(':userPhotoUrl', $model->photo_url);
            $stmt->bindValue(':userPmEmail', $model->pm_email, PDO::PARAM_INT);
            $stmt->bindValue(':userPmReceive', $model->pm_receive, PDO::PARAM_INT);
            $stmt->bindValue(':userPosts', $model->posts, PDO::PARAM_INT);
            $stmt->bindValue(':userQuote', $model->quote);
            $stmt->bindValue(':userReceiveEmail', $model->receive_email, PDO::PARAM_INT);
            //$stmt->bindValue(':userRecMail', $model->recmail, PDO::PARAM_INT);
            //$stmt->bindValue(':userRegisterDate', $model->register_date);
            $stmt->bindValue(':userReply', $model->reply, PDO::PARAM_INT);
            $stmt->bindValue(':userReplyTotal', $model->reply_total, PDO::PARAM_INT);
            $stmt->bindValue(':userSignature', $model->signature);
            $stmt->bindValue(':userSocialMedia', $model->social_media);
            $stmt->bindValue(':userState', $model->state);
            $stmt->bindValue(':userStatus', $model->status, PDO::PARAM_INT);
            $stmt->bindValue(':userSubscription', $model->subscription, PDO::PARAM_INT);
            $stmt->bindValue(':userTheme', $model->theme);
            $stmt->bindValue(':userTitle', $model->title);
            //$stmt->bindValue(':userKey2', $model->key2);
            $result = $stmt->execute();
            $stmt->closeCursor();

            return $result;
        } catch (\Throwable $th) {
            // Error catching and logging
            // \Log::error("Error in update() function 'sp_update_member: " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
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
            // \Log::error("Error in delete() function 'sp_delete_member: " . $th->getMessage());
            if ($_ENV['APP_DEV_MODE']) {
                var_dump($th->getMessage());
            }
            return false;
        }
    }
}
