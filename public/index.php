<?php

require '../vendor/autoload.php';
require '../config/app.php';

$app = new Silex\Application();
$app['debug'] = DEBUG;

/* Registering services */

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver'    => 'pdo_mysql',
        'host'      => HOST,
        'dbname'    => DATABASE,
        'user'      => USERNAME,
        'password'  => PASSWORD,
        'charset'   => 'utf8',
    ]
]);

$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../resources/views',
));
$app->register(new Knp\Provider\ConsoleServiceProvider(), array(
    'console.name'              => 'Zendeskgame',
    'console.version'           => '1.0.0',
    'console.project_directory' => __DIR__.'/..'
));
$app->register(new Knp\Provider\MigrationServiceProvider(), array(
    'migration.path' => __DIR__.'/../db/migration'
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