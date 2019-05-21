<?php

namespace App\Service;

class Randomizer
{
    public $sportsmen;
    public $keys;
    public $array;
    public $newArray;
    public $arrayChange = [];
    public $place;
    public static $call = 0;

    public function __construct($a, $b){
        $this->sportsmen = range($a, $b);
        $this->keys = range(1, count($this->sportsmen));
        shuffle($this->keys);
        $this->array = array_combine($this->keys, $this->sportsmen);
    }

    public function placeAssignment()
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
        $this->newArray;
    }

    public function placeChanger()
    {
        ++self::$call;
        $sc = intdiv(count($this->sportsmen), 2);
        if(self::$call === 1) {
            foreach ($this->newArray as $sportsmanID => $numPlace) {
                foreach ($numPlace as $number => $place) {
                    if ($number % 2 == 0) {
                        if (($place + 4) <= $sc) {
                            $this->arrayChange[$sportsmanID] = [$number => ($place + 4)];
                        } else {
                            $this->arrayChange[$sportsmanID] = [$number => (($place + 4) - $sc)];
                        }
                    } else {
                        if (1 <= ($place - 4)) {
                            $this->arrayChange[$sportsmanID] = [$number => ($place - 4)];
                        } else {
                            $this->arrayChange[$sportsmanID] = [$number => (($place - 4) + $sc)];
                        }
                    }
                }
            }
        } else {
            foreach ($this->arrayChange as $sportsmanID => $numPlace) {
                foreach ($numPlace as $number => $place) {
                    if ($number % 2 == 0) {
                        if (($place + 4) <= $sc) {
                            $this->arrayChange[$sportsmanID] = [$number => ($place + 4)];
                        } else {
                            $this->arrayChange[$sportsmanID] = [$number => (($place + 4) - $sc)];
                        }
                    } else {
                        if (1 <= ($place - 4)) {
                            $this->arrayChange[$sportsmanID] = [$number => ($place - 4)];
                        } else {
                            $this->arrayChange[$sportsmanID] = [$number => (($place - 4) + $sc)];
                        }
                    }
                }
            }
        }

        $this->arrayChange;
    }

    public function insertRecord($contestId) {

    }
}
