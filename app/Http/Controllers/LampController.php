<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Lamp;
use App\Models\Priority;
use Illuminate\Http\Request;

class LampController extends Controller
{
    public function retrieve () {
        return Lamp::all();
    }

    public function single ($id) {
        return Lamp::find($id);
    }

    public function update ($id, Request $r) {
        $lamp = Lamp::findOrFail($id);

        $lamp->update($r->all());
        $lamp->save();

        return $lamp;
    }

    public function delete ($id) {
        $lamp = Lamp::findOrFail($id);

        $lamp->delete();
    }

    public function getGroup ($id) {
        $lamp = Lamp::findOrFail($id);

        return $lamp->group;
    }

    public function ownership($lampId){
        $priorities = Priority::where('lamp_id', $lampId)->orderBy('index')->get();

        return $priorities;
    }
    public function setOwnership($lampId, Request $r){
        $lamp = Lamp::findOrFail($lampId);
        \DB::table('priorities')->where('lamp_id', $lampId)->delete();

        $arr = $r->all();
        foreach($arr as $key => $value){
            $lamp->priorities()->create(array_merge(["index" => $key], $value));
        }

        return $this->ownership($lampId);
    }
}
