<?php
namespace App\Controller;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use App\Model\Film;
use App\Model\FilmDetail;
use App\Model\IdNamePair;

class FilmController extends BaseController
{
  // Gets all films, or search if query param is present.
  public function index(Request $req, Response $res, array $args = []): Response
  {
    $search = $req->getQueryParams()["search"] ?? false;
    $data = json_decode($this->http->request("GET", $search ? "films/?search=$search" : "films/")->getBody());

    $payload = [];
    foreach ($data->results as $row) {
      $film = $this->mapper->map($row, new Film());
      $film->id = intval(preg_replace("/[^0-9]/", "", $row->url));
      $payload[] = $film;
    }

    $res->getBody()->write(json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    return $res->withHeader("Content-Type", "application/json");
  }

  // Get single film by id.
  public function show(Request $req, Response $res, array $args = []): Response
  {
    $id = $args["id"];
    $data = json_decode($this->http->request("GET", "films/$id/")->getBody());

    $film = $this->mapper->map($data, new FilmDetail());
    $film->id = intval(preg_replace("/[^0-9]/", "", $data->url));

    // Traverse each character url and get the character data.
    $characters = [];
    foreach ($data->characters as $url) {
      try {
        $row = json_decode($this->http->request("GET", $url)->getBody());
        $row->id = intval(preg_replace("/[^0-9]/", "", $url));
        $characters[] = $this->mapper->map($row, new IdNamePair());
      } catch (\Exception $e) {
        $row = new IdNamePair();
        $row->id = intval(preg_replace("/[^0-9]/", "", $url));
        $row->name = "Unknown";
      }
    }
    $film->characters = $characters;

    $res->getBody()->write(json_encode($film, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    return $res->withHeader("Content-Type", "application/json");
  }
}