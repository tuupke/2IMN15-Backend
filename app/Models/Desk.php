<?php

namespace App\Models;

class Desk extends BaseModel {

    protected $fillable = [
        "name",
        "room_id",
    ];

    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
