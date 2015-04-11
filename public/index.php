<?php

require '../vendor/autoload.php';
require '../app/config.php';

$app = new Silex\Application();
$app['debug'] = true;

/* Registering services */

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'zendeskgame',
        'user'      => 'homestead',
        'password'  => 'secret',
        'charset'   => 'utf8',
    ]
]);

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

/* Defining Dependencies */

$app['experience.repository'] = $app->share(function() use ($app){
   return new Seoshop\Model\ExperienceRepository($app['db']);
});

$app['experience.controller'] = $app->share(function() use ($app) {
    return new Seoshop\Controller\ExperienceController($app['experience.repository']);
});

/* Routing */

$app->get('/experience', 'experience.controller:indexAction');
$app->get('/experience/show/{userid}', 'experience.controller:showAction');
$app->get('/experience/update/{userid}/{mutation}', 'experience.controller:updateAction');

$app->run();