<?php
namespace Vampires;
class Mirror extends Position{
    public $orientation = "";

    public function __construct(String $orientation, int $x, int $y)
    {
        $this->orientation = $orientation;
        parent::__construct($x, $y);
    }
}