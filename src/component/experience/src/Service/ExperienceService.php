<?php
namespace Component\Experience\Service;

use Component\Experience\Model\Repository\ExperienceRepository;

class ExperienceService
{
    /** @var ExperienceRepository */
    protected $repository;

    public function __construct(ExperienceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll()
    {
        return $this->repository->get();
    }

    public function findById($id)
    {
        return $this->repository->getByUserId($id);
    }

    public function mutate($userid, $mutation)
    {
        return $this->repository->mutate($userid, $mutation);
    }
}