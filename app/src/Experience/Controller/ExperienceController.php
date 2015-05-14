<?php

namespace App\Experience\Controller;

use Component\Experience\Service\ExperienceService;
use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class ExperienceController {

    /** @var Application */
    protected $app;
    protected $service;

    public function __construct(Application $app, ExperienceService $service)
    {
        $this->app = $app;
        $this->service= $service;
    }

    public function indexAction()
    {
        return $this->app['twig']->render('experience/index.twig', [
            'list' => $this->service->findAll()
        ], new Response());
    }

    public function showAction($userid)
    {
        return new Response($this->service->findById($userid));
    }

    public function updateAction($userid, $mutation)
    {
        return new Response($this->repository->mutate($userid, $mutation));
    }
}