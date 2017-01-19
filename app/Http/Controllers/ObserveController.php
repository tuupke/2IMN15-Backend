<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use App\Models\Priority;
use Illuminate\Http\Request;

class ObserveController extends Controller {
    public function lightUpdate ($endpoint, Request $r) {

        $lightMap = [
            "Light ID"    => "name",
            "Location X"  => "x",
            "Location Y"  => "y",
            "Light Color" => "color",
            "Light State" => "state",
            "Low Light"   => "low_light",
            "User ID"     => "user_id",
        ];

        $values = $r->all();

        foreach ($values as $key => $value) {
            if (key_exists($key, $lightMap)) {
                $key = $lightMap[$key];

                if ($key == "user_id") {

                    $user = User::where('name', $value)->first();
                    if (!is_null($user)) {
                        $value = $user->id;
                    }
                }

                \DB::insert("update lamps set `$key`=\"$value\" where endpoint=\"$endpoint\"");
            }
        }
    }

    public function sensorUpdate ($endpoint, Request $r) {
        $lightMap = [
            "Sensor State" => "state",
            "User ID "     => "user_id",
        ];

        $values = $r->all();

        \Log::info("Updating $endpoint");

        foreach ($values as $key => $value) {
            if (key_exists($key, $lightMap)) {
                $key = $lightMap[$key];

                if ($key == "user_id") {

                    $user = User::where('name', $value)->first();
                    if (!is_null($user)) {
                        $value = $user->id;
                        \Log::info("Found, $value");
                    } else {
                        \Log::info("Failed to find, $value");
                        continue;
                    }
                }

                \DB::insert("update sensors set `$key`=\"$value\" where endpoint=\"$endpoint\"");
            }
        }
    }
}
