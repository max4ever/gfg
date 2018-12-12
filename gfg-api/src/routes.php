<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Gfg\Controller\ProductControllerV1;
use Gfg\Controller\ProductControllerV2;
use Gfg\Auth\Authorization;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->get('/v1/products', ProductControllerV1::class . ':get')->add(new Authorization($app->getContainer()->apiPassword));
$app->get('/v2/products', ProductControllerV2::class . ':get')->add(new Authorization($app->getContainer()->apiPassword));

$app->get('/testapi', function (Request $request, Response $response, array $args) {

    // Render index view
    return $this->renderer->render($response, 'dataTables.phtml', $args);
});