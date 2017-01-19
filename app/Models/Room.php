<?php

namespace App\Models;

class Room extends BaseModel {

    protected $fillable = [
        "name",
    ];

    public function desks(){
        return $this->hasMany(Desk::class);
    }
}
