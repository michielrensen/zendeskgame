<?php
namespace Component\Service\Service;

use Zendesk\API\Client;

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
        return $this->client->tickets()->find(['id'=>$id, 'sideload'=>['users', 'groups']]);
    }
}