<?php
namespace Vampires;
class Vampire extends Position{
    public $oppositeOrientations = ['N' => 'south', 'S' => 'north', 'E' => 'west', 'W' => 'east'];
    public $number = 0;
    public $exposeOrientations = [];

    public function __construct(int $number, int $x, int $y)
    {
        $this->number = $number;
        parent::__construct($x, $y);
    }

    public function addExposeOrientation(String $exposeOrientation){
        $this->exposeOrientations[] = $this->oppositeOrientations[$exposeOrientation];
    }
}