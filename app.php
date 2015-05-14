<?php

require 'vendor/autoload.php';
Dotenv::load(__DIR__);

$app = new Silex\Application();
$app['debug'] = getenv('DEBUG');

/* Services */

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
$app->register(new Silex\Provider\TwigServiceProvider(), ['twig.path' => __DIR__.'/resources/views',]);
$app->register(new Component\Service\ServiceServiceProvider());
$app->register(new Component\Experience\ExperienceServiceProvider());

/* Controllers */

$app['experience.controller'] = $app->share(function() use ($app) {
    return new App\Experience\Controller\ExperienceController($app, $app['experience.repository']);
});

$app['webhook.controller'] = $app->share(function() use ($app) {
    return new App\Webhook\Controller\WebhookController($app);
});