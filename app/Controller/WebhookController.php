<?php

namespace Seoshop\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class WebhookController {

    /** @var Application */
    protected $app;
    protected $repository;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($service)
    {
        return new Response($service);
    }
}