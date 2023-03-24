<?php
namespace Vampires;
class Map{

    public  $max_x = 0;
    public  $max_y = 0;
    public $mapGrid = [];

    public $orientationAxises = ['S' => 'y', 'N' => 'y', 'E' => 'x', 'W' => 'x'];

    public function __construct(int $maxX, int $maxY){
        $this->max_x = $maxX;
        $this->max_y = $maxY;
        $this->initialMap();
    }
    /**
     * The map 0 is safe
     *
     * @return void
     */
    private function initialMap(){
        for($x = 0; $x <= $this->max_x; ++$x){
            $this->mapGrid[$x] = array_fill(0, $this->max_y+1, 0);
        }
    }

    public function addObjects(array $ordinaries, array $mirrors){
        foreach ($ordinaries as $ordinary){
            $this->addObject($ordinary);
        }
        
        foreach ($mirrors as $mirror){
            $this->addObject($mirror);
        }
        
    }

    private function addObject(Position $object){
        $this->mapGrid[$object->x][$object->y] = $object;
    }

    public function checkVampireExpose(Vampire $vampire){
        $expose = false;
        foreach (['x', 'y'] as $axis){
            if ($this->scanAxis($axis, $vampire)){
                $expose = true;
            }
        }
        return $expose;
    }

    private function scanAxis(String $axis, Vampire $vampire){
        $expose = false;
        $oppositeAxis = $axis == 'x'? 'y' : 'x';
        
        $maxValue = "max_{$axis}";
        
        for ($$axis = $vampire->$axis - 1; $$axis >=0; --$$axis){
           
            if ($oppositeAxis == 'y'){
                $targetOrientation = 'E';
                $object = $this->mapGrid[$$axis][$vampire->$oppositeAxis];
            }else{
                $targetOrientation = 'N';
                $object = $this->mapGrid[$vampire->$oppositeAxis][$$axis];
            }
            
            if ($object instanceof Ordinary){
                break;
            }
           
            if ($object instanceof Mirror){
                if ($object->orientation == $targetOrientation){
                    $vampire->addExposeOrientation($targetOrientation);
                    $expose = true;
                    break;
                }else{
                    break;
                }
            }
        }
    
        for ($$axis = $vampire->$axis + 1; $$axis <= $this->$maxValue; ++$$axis){
            if ($oppositeAxis == 'y'){
                $targetOrientation = 'W';
                $object = $this->mapGrid[$$axis][$vampire->$oppositeAxis];
            }else{
                $targetOrientation = 'S';
                $object = $this->mapGrid[$vampire->$oppositeAxis][$$axis];
            }
            if ($object instanceof Ordinary){
                break;
            }
           
            if ($object instanceof Mirror){
                if ($object->orientation == $targetOrientation){
                    $vampire->addExposeOrientation($targetOrientation);
                    $expose = true;
                    break;
                }else{
                    break;
                }
            }
        }
        return $expose;
    }
    

}