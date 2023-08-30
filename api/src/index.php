<?php
use DI\Container;
use Slim\Factory\AppFactory;
use Slim\HttpCache\Cache;
use Slim\HttpCache\CacheProvider;

$rootPath = realpath(__DIR__ . '/..');

include_once($rootPath . '/vendor/autoload.php');

$container = new Container();
$container->set('cacheProvider', function () {
  return new CacheProvider();
});

$app = AppFactory::createFromContainer($container);

$app->add(new Cache('public', 86400));

$routes = require $rootPath . '/src/routes.php';
$routes($app);

$app->run();