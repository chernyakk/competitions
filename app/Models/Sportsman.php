<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sportsman extends Model
{
    // разрешаем к заполнению все поля в бд
    protected $guarded = [];

    // получение списка турниров - отношение многие ко многим
    public function tours() {
        return $this->belongsToMany('App\Models\Tour');
    }
}
