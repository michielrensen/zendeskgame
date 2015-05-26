<?php

namespace App\Webhook\Controller;

use Component\Service\Service\ZendeskService;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WebhookController {

    /** @var $app Application */
    protected $app;

    /** @var $zendeskService ZendeskService */
    protected $zendeskService;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->zendeskService = $app['service.zendesk'];
    }

    public function handleZendeskAction(Request $request)
    {
        $payload = json_decode($request->request->get('payload'));

        if (isset($payload->id))
        {
            $ticket = $this->zendeskService->findTicketById($payload->id);
            return new Response(json_encode($ticket, JSON_PRETTY_PRINT));
        }

        return new Response();
    }
}