<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    // разрешаем к заполнению все поля в бд
    protected $guarded = [];

    public function tours() {
        return $this->belongsToMany('App\Models\Tour', 'results', 'contest_id', 'tour_id');
    }

    public function sportsmen() {
        return $this->belongsToMany('App\Models\Sportsman', 'results', 'contest_id', 'sportsman_id');
    }
}
