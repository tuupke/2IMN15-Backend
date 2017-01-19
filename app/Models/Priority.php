<?php

namespace App\Models;

class Priority extends BaseModel {

    protected $fillable = [
        "index",
        "user_location_x",
        "user_location_y",
        "low_light",
        "light_color",
        "user_id",
        "sensor_id",
    ];

    public function lamp(){
        return $this->belongsTo(Lamp::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function sensor(){
        return $this->belongsTo(Sensor::class);
    }
}
