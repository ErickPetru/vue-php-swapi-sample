<?php
namespace App\Controller;

use GuzzleHttp\Client as HttpClient;
use JsonMapper;

class BaseController
{
  /** @var HttpClient */
  protected $http;

  /** @var JsonMapper */
  protected $mapper;

  public function __construct()
  {
    $this->http = new HttpClient([
      'base_uri' => 'https://swapi.dev/api/',
      'default' => [
        'exceptions' => false,
        'headers' => ['Accept' => 'application/json']
      ]
    ]);

    $this->mapper = new JsonMapper();
  }
}