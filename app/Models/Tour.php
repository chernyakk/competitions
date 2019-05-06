<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    // разрешаем к заполнению все поля в бд
    protected $guarded = [];

    // получение списка участников - отношение многие ко многим
    public function sportsmen() {
        return $this->belongsToMany('App\Models\Sportsman');
    }

}
