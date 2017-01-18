<?php

namespace App\Models;

class Group extends BaseModel {

    public function room(){
        return $this->belongsTo(Room::class);
    }

    public function lamps(){
        return $this->hasMany(Lamp::class);
    }

    public function sensors(){
        return $this->hasMany(Sensor::class);
    }

    public function rooms() {
        return $this->hasMany(Group::class);
    }
}
