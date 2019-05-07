<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sportsman extends Model
{
    // разрешаем к заполнению все поля в бд
    protected $guarded = [];

    public function contests() {
        return $this->belongsToMany('App\Models\Contest', 'results', 'sportsman_id', 'contest_id');
    }

    public function tours() {
        return $this->belongsToMany('App\Models\Tour', 'results', 'sportsman_id', 'tour_id');
    }
}
