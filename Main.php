<?php
namespace Vampires;
class Main {

    public $input = "";
    public $vampires = [];
    public $ordinaries = [];
    public $mirrors = [];
    public $map = null;

    public function __construct(string $input)
    {
        $this->input = $input;
    }

    private function processInput(){
        $xArray = [];
        $yArray = [];
        $inputArray = explode(PHP_EOL, $this->input);
        $objectCount = explode(' ', trim($inputArray[0]));
        $vampireMaxIndex = $objectCount[0];
        $ordinaryMaxIndex = $objectCount[0] + $objectCount[1];
        $vampireIndex = 0;
        foreach ($inputArray as $i => $v){
            if ($i == 0){
                continue;
            }
            $valueArray = explode(" ", trim($v));
            if ($i <= $vampireMaxIndex){
                $this->vampires[] = new Vampire(++$vampireIndex, $valueArray[0], $valueArray[1]);
                $xArray[] = $valueArray[0];
                $yArray[] = $valueArray[1];
            }else if ($i <= $ordinaryMaxIndex){
                $this->ordinaries[] = new Ordinary($valueArray[0], $valueArray[1]);
                $xArray[] = $valueArray[0];
                $yArray[] = $valueArray[1];
            }else{
                $mirrorGroup = new MirrorGroup($valueArray[0], $valueArray[1],$valueArray[2],$valueArray[3],$valueArray[4]);
                $this->mirrors = array_merge($this->mirrors, $mirrorGroup->mirrors);
                $xArray[] = $valueArray[1];
                $yArray[] = $valueArray[2];
                $xArray[] = $valueArray[3];
                $yArray[] = $valueArray[4];
            }
        }
        $maxX = max($xArray);
        $maxY = max($yArray);
        $this->map = new Map($maxX, $maxY);
    }

    public function output(){
        $this->processInput();
        $this->map->addObjects($this->ordinaries, $this->mirrors);

        foreach ($this->vampires as $vampire){
            if ($this->map->checkVampireExpose($vampire)){
                echo "vampire " . $vampire->number . " " . implode(" ", $vampire->exposeOrientations);
                echo "</br>";
            }
        }

    }

}

