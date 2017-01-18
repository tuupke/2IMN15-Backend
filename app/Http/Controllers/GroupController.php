<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Sensor;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function retrieve () {
        return Group::all();
    }

    public function single ($id) {
        return Group::find($id);
    }

    public function delete ($id) {
        $group = Group::findOrFail($id);

        $group->delete();
    }

    public function lamps($id){
        $group = Group::findOrFail($id);

        return $group->lamps;
    }

    public function sensors($id){
        $group = Group::findOrFail($id);

        return $group->sensors;
    }

    public function createLamp($id, Request $r){
        $group = Group::findOrFail($id);

        return $group->lamps()->create($r->all());
    }
    public function createSensor($id, Request $r){
        $group = Group::findOrFail($id);

        return $group->sensors()->create($r->all());
    }

    public function attachSensor($id, $sensorId){
        $group = Group::findOrFail($id);
        $sensor = Sensor::findOrFail($sensorId);

        $group->sensors()->save($sensor);
    }

    public function attachLamp($id, $lampId){
        $group = Group::findOrFail($id);
        $lamp = Lamp::findOrFail($lampId);

        $group->lamps()->save($lamp);
    }

}
