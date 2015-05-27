<?php

namespace App\Webhook\Controller;

use Component\Experience\Service\ExperienceService;
use Component\Service\Service\ZendeskService;
use Component\Service\ZendeskException;
use Component\User\Service\UserService;
use Component\User\UserException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WebhookController
{
    /** @var $zendeskService ZendeskService */
    protected $zendeskService;

    /** @var $userService UserService */
    protected $userService;

    /** @var $experienceService ExperienceService */
    protected $experienceService;

    public function __construct(
        ZendeskService $zendeskService,
        UserService $userService,
        ExperienceService $experienceService
    )
    {
        $this->zendeskService    = $zendeskService;
        $this->userService       = $userService;
        $this->experienceService = $experienceService;
    }

    public function handleZendeskAction(Request $request)
    {
        $payload = json_decode($request->request->get('payload'));

        if (isset($payload->id))
        {
            try {
                $ticket = $this->zendeskService->findTicketById($payload->id);
                $user = $this->userService->findUserBySetting('zendesk_user_id', $ticket->assignee_id);
                $settings = $this->userService->getUserSettings($user['id']);
            }
            catch(ZendeskException $e)
            {
                return new Response($e->getMessage(), 404);
            }
            catch(UserException $e)
            {
                return new Response($e->getMessage(), 404);
            }

            return new Response(json_encode($settings, JSON_PRETTY_PRINT));
        }

        return new Response();
    }
}