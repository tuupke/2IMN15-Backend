<?php

namespace App\Models;

class User extends BaseModel {

    protected $fillable = [
        "name",
        "password",
        "type",
    ];
}