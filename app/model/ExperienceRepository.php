<?php

namespace Seoshop\Model;

use Seoshop\Model\Contracts\ExperienceRepositoryInterface;
use Doctrine\DBAL\Connection;

class ExperienceRepository implements ExperienceRepositoryInterface{

    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function getList()
    {
        $list = $this->db->fetchAll('SELECT user_id, SUM(mutation) as experience FROM experience GROUP BY user_id');

        return $list;
    }

    public function getByUserId($userid)
    {
        $experience = $this->db->fetchAssoc('SELECT SUM(mutation) as experience FROM experience WHERE user_id = ?', array((int) $userid));

        return $experience['experience'];
    }

    public function mutate($userid, $mutation)
    {
        $this->db->insert('experience', array(
            'user_id' => (int) $userid,
            'mutation' => (int) $mutation,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ));

        return true;
    }
}