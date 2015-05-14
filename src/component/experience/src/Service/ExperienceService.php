<?php
namespace Component\Experience\Service;

use Component\Experience\Model\Repository\ExperienceRepository;
use Silex\Application;

class ExperienceService
{
    /** @var Application */
    protected $app;

    /** @var ExperienceRepository */
    protected $repository;

    public function __construct(Application $app, ExperienceRepository $repository)
    {
        $this->app = $app;
        $this->repository = $repository;
    }

}