<?php
namespace App\Model;

use App\Model\Film;
use App\Model\IdNamePair;

class FilmDetail extends Film
{
  /** @var IdNamePair[] */
  public $characters;
}