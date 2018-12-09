<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");


    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->get('/products', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $sTitleFilter = $request->getParam('q', null);


    $db = $this->db;/* @var $db \PDO */
    $sth = $db->prepare('SELECT * FROM products WHERE title LIKE ?');
    $sth->execute([ "%".$sTitleFilter."%"]);
    $aResult = $sth->fetchAll();

    return $response->withJson($aResult, 200);
});
