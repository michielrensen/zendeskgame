<?php

namespace Seoshop\Model;

use Seoshop\Model\Contracts\ExperienceRepositoryInterface;
use Doctrine\DBAL\Connection;

class ExperienceRepository implements ExperienceRepositoryInterface{

    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getList()
    {
        $list = $this->connection->fetchAll('
           SELECT users.name,
                  experience.user_id,
                  SUM(experience.mutation) as experience
            FROM experience
      INNER JOIN users
              ON experience.user_id = users.id
        GROUP BY user_id');

        return $list;
    }

    public function getByUserId($userid)
    {
        $experience = $this->connection->fetchAssoc('SELECT SUM(mutation) as experience FROM experience WHERE user_id = ?', [(int) $userid]);

        return $experience['experience'];
    }

    public function mutate($userid, $mutation)
    {
        $this->connection->insert('experience', [
            'user_id' => (int) $userid,
            'mutation' => (int) $mutation,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return true;
    }
}