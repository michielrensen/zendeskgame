<?php

namespace Component\Experience\Model\Contract;

interface ExperienceRepositoryInterface
{

    public function getList();
    public function getByUserId($userid);
    public function mutate($userid, $mutation);

}