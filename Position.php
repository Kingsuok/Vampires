<?php
namespace Vampires;
class Position{
    public  $x = 0;
    public  $y = 0;

    public function __construct(int $x, int $y){
        $this->x = $x;
        $this->y = $y;
    } 
}