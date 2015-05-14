<?php

namespace Component\Experience\Model\Contract;

interface ExperienceRepositoryInterface
{

    public function get();
    public function getByUserId($userid);
    public function mutate($userid, $mutation);

}