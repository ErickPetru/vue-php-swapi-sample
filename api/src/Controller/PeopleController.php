<?php
namespace App\Controller;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Model\Character;
use App\Model\CharacterDetail;
use App\Model\IdTitlePair;

class PeopleController extends BaseController
{
  // Gets all people, or search if query param is present.
  public function index(Request $req, Response $res, array $args = []): Response
  {
    $search = $req->getQueryParams()["search"] ?? false;
    $data = json_decode($this->http->request("GET", $search ? "people/?search=$search" : "people/")->getBody());

    $payload = [];
    foreach ($data->results as $row) {
      $character = $this->mapper->map($row, new Character());
      $character->id = intval(preg_replace("/[^0-9]/", "", $row->url));
      $payload[] = $character;
    }

    $res->getBody()->write(json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    return $res->withHeader("Content-Type", "application/json");
  }

  // Get single character by id.
  public function show(Request $req, Response $res, array $args = []): Response
  {
    $id = $args["id"];
    $data = json_decode($this->http->request("GET", "people/$id/")->getBody());

    $character = $this->mapper->map($data, new CharacterDetail());
    $character->id = intval(preg_replace("/[^0-9]/", "", $data->url));

    // Traverse each film url and get the film data.
    $films = [];
    foreach ($data->films as $url) {
      try {
        $row = json_decode($this->http->request("GET", $url)->getBody());
        $row->id = intval(preg_replace("/[^0-9]/", "", $url));
        $films[] = $this->mapper->map($row, new IdTitlePair());
      } catch (\Exception $e) {
        $row = new IdTitlePair();
        $row->id = intval(preg_replace("/[^0-9]/", "", $url));
        $row->title = "Unknown";
      }
    }
    $character->films = $films;

    $res->getBody()->write(json_encode($character, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    return $res->withHeader("Content-Type", "application/json");
  }
}