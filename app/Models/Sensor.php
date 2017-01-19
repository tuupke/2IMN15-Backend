<?php

namespace App\Models;

class Sensor extends BaseModel {
    protected $fillable = [
        "x",
        "y",
        "group_id",
        "room_id",
    ];

    protected $endpointName = "sensors";

    protected $map = [
        "x"        => 5,
        "y"        => 6,
        "group_id" => 4,
        "room_id"  => 7,
    ];

    public function group () {
        return $this->belongsTo(Group::class);
    }
}
