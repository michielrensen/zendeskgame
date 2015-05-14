<?php

require '../vendor/autoload.php';
Dotenv::load(__DIR__ . '../');

$app = new Silex\Application();
$app['debug'] = getenv('DEBUG');

/* Registering services */

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver'    => 'pdo_mysql',
        'host'      => getenv('HOST'),
        'dbname'    => getenv('DATABASE'),
        'user'      => getenv('DB_USERNAME'),
        'password'  => getenv('DB_PASSWORD'),
        'charset'   => getenv('DB_CHARSET'),
    ]
]);

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../resources/views',
));

/* Defining Dependencies */

$app['experience.repository'] = $app->share(function() use ($app){
   return new Seoshop\Model\ExperienceRepository($app['db']);
});

$app['experience.controller'] = $app->share(function() use ($app) {
    return new Seoshop\Controller\ExperienceController($app, $app['experience.repository']);
});

/* Routing */

$app->get('/experience/', 'experience.controller:indexAction');
$app->get('/experience/show/{userid}', 'experience.controller:showAction');
$app->get('/experience/update/{userid}/{mutation}', 'experience.controller:updateAction');

$app->run();