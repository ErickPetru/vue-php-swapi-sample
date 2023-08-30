<?php
namespace App\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController
{
  public function index(Request $request, Response $response, array $args = []): Response
  {
    $url = $request->getUri();
    $data = array('people' => $url . 'people/', 'films' => $url . 'films/');
    $payload = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
  }
}