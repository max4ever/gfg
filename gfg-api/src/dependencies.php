<?php
// DIC configuration
use Gfg\Error\Handler\CustomErrorHandler;
use Gfg\Helper\DbHelper;
use Gfg\Controller\ProductControllerV1;
use Gfg\Controller\ProductControllerV2;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//mysql
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'], $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$container['errorHandler'] = function ($c) {
    return new CustomErrorHandler();
};

$container['apiPassword'] = function ($c) {
    return $c->get('settings')['apiPassword'];
};

$container = $app->getContainer();

//inject dependency into controller constructor
$container[ProductControllerV1::class] = function ($c) {
    $dbHelper = new DbHelper($c['db']);
    return new ProductControllerV1($c, $dbHelper);
};

//inject dependency into controller constructor
$container[ProductControllerV2::class] = function ($c) {
    $dbHelper = new DbHelper($c['db']);
    return new ProductControllerV2($c, $dbHelper);
};