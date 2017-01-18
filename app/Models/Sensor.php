<?php

namespace App\Models;

class Sensor extends BaseModel {

    protected $fillable = [
        "x",
        "y",
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function sits(){
        return $this->hasOne(User::class);
    }
}
