<?php


namespace App\Service;


class Randomizer
{
    public $sportsmen;
    public $keys;
    public $array;
    public $newArray;
    public $place;

    public function __construct($a, $b){
        $this->sportsmen = range($a, $b);
        $this->keys = range(1, count($this->sportsmen));
        shuffle($this->keys);
        $this->array = array_combine($this->keys, $this->sportsmen);
    }

    public function randomize()
    {
        $this->newArray = array();
        $i = 1;
        foreach ($this->array as $key => $value) {
            if ($i <= intdiv(count($this->array), 2)) {
                $this->newArray[$value] = [$key => $i];
            } else {
                $i = 1;
                $this->newArray[$value] = [$key => $i];
            }
            $i++;
        }
    }

    public function placeChanger()
    {
        $sc = intdiv(count($this->sportsmen), 2);
        foreach ($this->newArray as $sportsmanID => $numPlace) {
            foreach ($numPlace as $number => $place) {
                if ($number % 2 == 0) {
                    if (($place + 4) <= $sc) {
                        echo $this->place = $place + 4;
                        echo "t1"."<br>";
                    } else {
                        echo $this->place = ($place + 4) - $sc;
                        echo "t2"."<br>";
                    }
                } else {
                    if (1 - ($place - 4)) {
                        echo $this->place = $place + 4;
                        echo "t3". "<br>";
                    } else {
                        echo $this->place = ($place - 4) + $sc;
                        echo "t4" ."<br>";
                    }
                }
            }
        }
    }
}
