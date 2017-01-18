<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function retrieve () {
        return Sensor::all();
    }

    public function single ($id) {
        return Sensor::find($id);
    }

    public function update ($id, Request $r) {
        $sensor = Sensor::findOrFail($id);

        $sensor->update($r->all());
        $sensor->save();

        return $sensor;
    }

    public function delete ($id) {
        $sensor = Sensor::findOrFail($id);

        $sensor->delete();
    }

    public function getGroup ($id) {
        $sensor = Sensor::findOrFail($id);

        return $sensor->group;
    }
}
