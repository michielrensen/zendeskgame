<?php
namespace Component\Experience;

use Component\Experience\Model\Repository\ExperienceRepository;
use Component\Experience\Service\ExperienceService;
use Silex\Application;
use Silex\ServiceProviderInterface;

class ExperienceServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['repository.experience'] = $app->share(function() use ($app){
            return new ExperienceRepository($app['db']);
        });

        $app['service.experience'] = $app->share(function() use($app) {
            return new ExperienceService($app, $app['repository.experience']);
        });
    }

    public function boot(Application $app)
    {
        //
    }
}