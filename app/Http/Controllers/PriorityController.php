<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PriorityController extends Controller
{
    public function ownership($lampId){

        $priorities = Priority::with('user', 'sensor')->where('lamp_id', $lampId)->orderBy('index')->get();

        $arr = [];

        foreach ($priorities as $priority) {
            $arr[] = [
                "user_type" => $priority->user->type,
                "user_id" => $priority->user->name,
                "light_color" => $priority->light_color,
                "low_light" => $priority->low_light == 1,
                "user_location_x" => $priority->user_location_x,
                "user_location_y" => $priority->user_location_y,
                "sensor_id" => $priority->sensor->name,
            ];
        }

        return $arr;
    }
}
