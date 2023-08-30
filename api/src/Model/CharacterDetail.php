<?php
namespace App\Model;

use App\Model\Character;
use App\Model\IdTitlePair;

class CharacterDetail extends Character
{
  /** @var IdTitlePair[] */
  public $films;
}