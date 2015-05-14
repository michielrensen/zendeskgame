<?php

namespace App\Webhook\Controller;

use Component\Service\Service\ZendeskService;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WebhookController {

    /** @var $app Application */
    protected $app;

    /** @var $service ZendeskService */
    protected $service;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->service = $app['service.zendesk'];
    }

    public function handleAction(Request $request, $service)
    {
        $payload = json_decode($request->request->get('payload'));

        switch($service)
        {
            case 'zendesk':
                $ticket = $this->service->findById($payload->id);
                break;
        }

        return new Response(json_encode($ticket, JSON_PRETTY_PRINT));
    }
}