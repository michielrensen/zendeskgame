<?php

require_once '../app.php';

/* Routing */

$app->get('/', function() {
    return 'Hello';
});

$app->get('/experience/', 'experience.controller:indexAction');
$app->get('/experience/show/{userid}', 'experience.controller:showAction');
$app->get('/experience/update/{userid}/{mutation}', 'experience.controller:updateAction');

$app->post('/webhook/{service}', 'webhook.controller:handleAction');

$app->run();