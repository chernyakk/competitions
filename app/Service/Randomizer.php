<?php

namespace App\Service;

use Illuminate\Support\Facades\DB;

class Randomizer
{
    public $sportsmen;
    public $keys;
    public $array;
    public $newArray = [];
    public $evenArray = [];
    public $notEvenArray = [];
    public $arrayChange = [];
    public $place;
    public static $call = 0;

    public function __construct($a, $b){
        $this->sportsmen = range($a, $b);
        $this->keys = range(1, count($this->sportsmen));
        shuffle($this->keys);
        $this->array = array_combine($this->keys, $this->sportsmen);
        foreach ($this->array as $key => $value){
            if ($key % 2 == 0){
                $this->evenArray[$key] = $value;
            }
            else{
                $this->notEvenArray[$key] = $value;
            }
        }
    }

    public function placeAssignment($contestId)
    {
        $i = 1;
        foreach ($this->evenArray as $key => $value) {
            $this->newArray[$value] = [$key => $i];
            $i++;
        }
        $i = 1;
        foreach ($this->notEvenArray as $key => $value) {
            $this->newArray[$value] = [$key => $i];
            $i++;
        }

        foreach ($this->newArray as $key => $value) {
            DB::table('results')
                ->where('sportsman_id', $key)
                ->where('contest_id', '=', $contestId)
                ->where('tour_id', '=', 1)
                ->update(['sector' => key($value), 'place' => current($value)]);
        }
    }

    public function placeChanger($contestId, $tourId)
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

        foreach ($this->arrayChange as $key => $value) {
            DB::table('results')
                ->where('sportsman_id', $key)
                ->where('contest_id', '=', $contestId)
                ->where('tour_id', '=', $tourId)
                ->update(['sector' => key($value), 'place' => current($value)]);
        }
    }

    public function insertRecord($contestId) {

        $this->placeAssignment($contestId);

        $countTour = $qb = DB::table('results')
            ->where('contest_id', '=', $contestId)
            ->max('tour_id');

        for($i = 2; $i <= $countTour; $i++) {
            $this->placeChanger($contestId, $i);
        }
    }
}
