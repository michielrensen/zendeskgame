<?php
namespace Component\User\Model\Repository;

use Component\User\Model\Contract\UserRepositoryInterface;
use Doctrine\DBAL\Connection;

class UserRepository implements UserRepositoryInterface
{
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get()
    {
        $list = $this->connection->fetchAll('
            SELECT users.id,
                   users.name,
                   users.email
              FROM users
        ');

        return $list;
    }

    public function getSettings($userId)
    {
        $settings = [];
        $this->connection->project(
            $this->connection->prepare('
            SELECT key,
                   value
              FROM user_settings
             WHERE user_id = ?
            '),
            [ (int) $userId ],
            function($row) use($settings) {
                $return[$row['key']] = $row['value'];
            }
        );

        return $settings;
    }

    public function getById($userId)
    {
        $user = $this->connection->fetchAssoc('
            SELECT users.id,
                   users.name,
                   users.email
              FROM users
             WHERE users.id = ?
        ', [ (int) $userId ]);

        return $user;
    }

    public function getByEmail($email)
    {
        $user = $this->connection->fetchAssoc('
            SELECT users.id,
                   users.name,
                   users.email
              FROM users
             WHERE users.email = ?
        ', [ (string) $email ]);

        return $user;
    }

    public function getBySetting($key, $value)
    {
        $user = $this->connection->fetchAssoc('
            SELECT users.id,
                   users.name,
                   users.email
              FROM users
        INNER JOIN user_settings
                ON user_settings.user_id = users.id
               AND user_settings.key = ?
               AND user_settings.value = ?
        ', [
            (string) $key,
            (string) $value
        ]);

        return $user;
    }
}