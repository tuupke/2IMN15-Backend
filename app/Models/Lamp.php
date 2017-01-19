<?php

namespace App\Models;

class Lamp extends BaseModel {
    protected $fillable = [
        "endpoint",
        "x",
        "y",
        "color",
        "low_light",
        "group_id"
    ];

    protected $endpointName = "lights";
    protected $map = [
        "color"                  => 5,
        "low_light"              => 6,
        "priority_ownership_url" => 12,
    ];

    public function group () {
        return $this->belongsTo(Group::class);
    }

    public function priorities () {
        return $this->hasMany(Priority::class);
    }
}
