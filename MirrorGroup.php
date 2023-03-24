<?php
namespace Vampires;
class MirrorGroup{

    public $orientation = '';
    public $startPosition = ['x' => 0, 'y' => 0];
    public $endPosition = ['x' => 0, 'y' => 0];
    public $mirrors = [];

    public function __construct(String $orientation, int $startX, int $startY,int $endX,int $endY){
        $this->orientation = $orientation;
        $this->startPosition =['x' => $startX, 'y' => $startY];
        $this->endPosition =['x' => $endX, 'y' => $endY];
        $this->explodeMirrorGroup();
    }

    public function explodeMirrorGroup(){
        if ($this->orientation == 'S' || $this->orientation == 'N'){
           $axis = 'x';
           $oppositeAxis = 'y';
        }else{
            $axis = 'y';
            $oppositeAxis = 'x';
        }
        if ($this->startPosition[$axis] < $this->endPosition[$axis]){
            $min = $this->startPosition[$axis];
            $max = $this->endPosition[$axis];
        }else{
            $min = $this->endPosition[$axis];
            $max = $this->startPosition[$axis];
        }
        for($i = $min; $i <= $max; ++$i){
            if ($axis == 'x'){
                $this->mirrors[] = new Mirror($this->orientation, $i, $this->startPosition[$oppositeAxis]);
            }else{
                $this->mirrors[] = new Mirror($this->orientation, $this->startPosition[$oppositeAxis], $i);
            }
            
        }
    }
}