<?php


namespace App\Services;

use Illuminate\Support\Facades\DB;

class ResultCounter
{
    public $contestId;
    public $tourId;
    public $haul1;
    public $haul2;
    public $s1;
    public $s2;

    public function __construct($s1, $s2, $a, $b, $contestId, $tourId)
    {
        $this->s1 = $s1;
        $this->s2 = $s2;
        $this->haul1 = $a;
        $this->haul2 = $b;
        $this->contestId = $contestId;
        $this->tourId = $tourId;
    }

    public function result(){
        if ($this->haul1 > $this->haul2){
            DB::table('results')
                ->where('sportsman_id', $this->s1)
                ->where('contest_id', $this->contestId)
                ->where('tour_id', $this->tourId)
                ->update(['point' => 3]);
            if ($this->haul2 != 0){
                # тут сопернику в таблицу записывается 0.5
                DB::table('results')
                    ->where('sportsman_id', $this->s2)
                    ->where('contest_id', $this->contestId)
                    ->where('tour_id', $this->tourId)
                    ->update(['point' => 0.5]);
            }
            else{
                # тут сопернику в таблицу записывается 0
                DB::table('results')
                    ->where('sportsman_id', $this->s2)
                    ->where('contest_id', $this->contestId)
                    ->where('tour_id', $this->tourId)
                    ->update(['point' => 0]);
            }
        }
        elseif ($this->haul1 < $this->haul2) {
            if ($this->haul1 != 0) {
                DB::table('results')
                    ->where('sportsman_id', $this->s1)
                    ->where('contest_id', $this->contestId)
                    ->where('tour_id', $this->tourId)
                    ->update(['point' => 0.5]);
            } else {
                DB::table('results')
                    ->where('sportsman_id', $this->s1)
                    ->where('contest_id', $this->contestId)
                    ->where('tour_id', $this->tourId)
                    ->update(['point' => 0]);
            }
            # именно тут прописывается insert сопернику в 3 балла
            DB::table('results')
                ->where('sportsman_id', $this->s2)
                ->where('contest_id', $this->contestId)
                ->where('tour_id', $this->tourId)
                ->update(['point' => 3]);
        }
        else{
            if ($this->haul1 != 0){
                # записываем себе 1.5 балла в таблицу
                DB::table('results')
                    ->where('sportsman_id', $this->s1)
                    ->where('contest_id', $this->contestId)
                    ->where('tour_id', $this->tourId)
                    ->update(['point' => 1.5]);

                # сопернику тоже 1.5 балла в таблицу
                DB::table('results')
                    ->where('sportsman_id', $this->s2)
                    ->where('contest_id', $this->contestId)
                    ->where('tour_id', $this->tourId)
                    ->update(['point' => 1.5]);
            }
            else{
                # записываем себе 0 баллов в таблицу
                DB::table('results')
                    ->where('sportsman_id', $this->s1)
                    ->where('contest_id', $this->contestId)
                    ->where('tour_id', $this->tourId)
                    ->update(['point' => 0]);
                # сопернику тоже 0 баллов в таблицу
                DB::table('results')
                    ->where('sportsman_id', $this->s2)
                    ->where('contest_id', $this->contestId)
                    ->where('tour_id', $this->tourId)
                    ->update(['point' => 0]);
            }
        }
    }
}
