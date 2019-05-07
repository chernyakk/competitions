<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    // разрешаем к заполнению все поля в бд
    protected $guarded = [];

    public function contests() {
        return $this->belongsToMany('App\Models\Contest', 'results', 'tour_id', 'contest_id');
    }

    public function sportsmen() {
        return $this->belongsToMany('App\Models\Sportsman', 'results', 'tour_id', 'sportsman_id');
    }
}
