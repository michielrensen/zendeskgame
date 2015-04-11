<?php

namespace Seoshop\Model\Contracts;

interface ExperienceRepositoryInterface {

    public function getList();
    public function getByUserId($userid);
    public function mutate($userid, $mutation);

}