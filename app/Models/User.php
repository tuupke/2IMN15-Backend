<?php

namespace App\Models;

class User extends BaseModel {

    protected $fillable = [
        "name",
        "password",
        "email",
        "facepattern",
        "type",
        "desk_id",
        "group_id",
    ];

    public function desk() {
        return $this->belongsTo(Desk::class);
    }
}
