<?php
namespace Component\Service;

use Component\Service\Service\ZendeskService;
use Silex\Application;
use Silex\ServiceProviderInterface;

class ServiceServiceProvider implements ServiceProviderInterface
{

    public function register(Application $app)
    {
        $app['service.zendesk'] = $app->share(function() use($app) {
            return new ZendeskService($app);
        });
    }

    public function boot(Application $app)
    {
        //
    }

}