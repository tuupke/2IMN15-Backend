<?php

namespace App\Models;

class Room extends BaseModel {

    protected $fillable = [
        "name",
    ];

    public function groups(){
        return $this->hasMany(Group::class);
    }
}
