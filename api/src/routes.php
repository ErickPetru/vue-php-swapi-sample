<?php
use Slim\App;

return function (App $app) {
  $app->get('/', 'App\Controller\HomeController:index');
  $app->get('/films', 'App\Controller\FilmController:index');
  $app->get('/films/{id}', 'App\Controller\FilmController:show');
  $app->get('/people', 'App\Controller\PeopleController:index');
  $app->get('/people/{id}', 'App\Controller\PeopleController:show');

  $app->options('/{routes:.+}', function ($req, $res, $args) {
    return $res;
  });

  $app->add(function ($req, $handler) {
    $res = $handler->handle($req);
    return $res
      ->withHeader('Access-Control-Allow-Origin', 'http://localhost:3000')
      ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
      ->withHeader('Access-Control-Allow-Methods', 'GET, OPTIONS');
  });
};