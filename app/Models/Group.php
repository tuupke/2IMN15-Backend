<?php

namespace App\Models;

class Group extends BaseModel {

    protected $fillable = [
        "name",
        "desk_id"
    ];

    public function desk(){
        return $this->belongsTo(Desk::class);
    }

    public function lamps(){
        return $this->hasMany(Lamp::class);
    }

    public function sensors(){
        return $this->hasMany(Sensor::class);
    }
}
