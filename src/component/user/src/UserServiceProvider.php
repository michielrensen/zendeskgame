<?php
namespace Component\User;

use Component\User\Model\Repository\UserRepository;
use Component\User\Service\UserService;
use Silex\Application;
use Silex\ServiceProviderInterface;

class UserServiceProvider implements  ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['repository.user'] = $app->share(function() use ($app){
            return new UserRepository($app['db']);
        });

        $app['service.user'] = $app->share(function() use($app) {
            return new UserService($app, $app['repository.user']);
        });
    }

    public function boot(Application $app)
    {
        //
    }
}