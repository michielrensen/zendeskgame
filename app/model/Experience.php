<?php

namespace Seoshop\Model;

class Experience {

    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findByUserId($userid)
    {
        $experience = $this->db->fetchASsoc('SELECT * FROM experience WHERE user_id = ?', array((int) $userid));

        return $experience;
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