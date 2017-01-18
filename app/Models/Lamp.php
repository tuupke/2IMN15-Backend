<?php

namespace App\Models;

class Lamp extends BaseModel {

    protected $fillable = [
        "x",
        "y",
        "color"
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function priorities(){
        return $this->hasMany(Priority::class);
    }
}
