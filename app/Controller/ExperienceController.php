<?php

namespace Seoshop\Controller;

use Seoshop\Model\ExperienceRepository;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExperienceController {

    protected $repository;

    public function __construct(ExperienceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function indexAction(Request $request, Application $app)
    {
        return $app['twig']->render('experience/index.twig', [
            'list' => $this->repository->getList()
        ], new Response());
    }

    public function showAction(Request $request, Application $app, $userid)
    {
        return new Response($this->repository->getByUserId($userid));
    }

    public function updateAction(Request $request, Application $app, $userid, $mutation)
    {
        return new Response($this->repository->mutate($userid, $mutation));
    }
}