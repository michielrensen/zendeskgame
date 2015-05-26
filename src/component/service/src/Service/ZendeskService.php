<?php
namespace Component\Service\Service;

use Component\Service\ZendeskException;
use Zendesk\API\Client;
use Zendesk\API\ResponseException;

class ZendeskService
{

    /** @var $client Client */
    protected $client;

    public function __construct()
    {
        $this->client = new Client(getenv('ZENDESK_SUBDOMAIN'), getenv('ZENDESK_USERNAME'));
        $this->client->setAuth('token', getenv('ZENDESK_TOKEN'));
    }

    public function findTicketById($id)
    {
        try {
            $ticket = $this->client->tickets()->find(['id'=>$id, 'sideload'=>['users', 'groups']]);
            return $ticket->ticket;
        }
        catch(ResponseException $e)
        {
            throw new ZendeskException('Ticket could not be found');
        }
    }
}