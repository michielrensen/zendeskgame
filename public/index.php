<?php

require '../vendor/autoload.php';
require '../app/config.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => 'pdo_mysql',
        'host'      => 'localhost',
        'dbname'    => 'zendeskgame',
        'user'      => 'homestead',
        'password'  => 'secret',
        'charset'   => 'utf8',
    ),
));

$app->get('/user/{user_id}', function($user_id) use ($app) {
    $model = new \Seoshop\Model\Experience($app['db']);
    $experience = $model->findByUserId(1);

    return print_r($experience, true);
});

$app->get('/user/mutate/{userid}/{mutation}', function($userid, $mutation) use ($app) {
    $model = new \Seoshop\Model\Experience($app['db']);
    $experience = $model->mutate($userid, $mutation);

    return print_r($experience, true);
});

$app->run();