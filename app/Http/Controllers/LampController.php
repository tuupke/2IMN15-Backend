<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Lamp;
use App\Models\Priority;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

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

        $arr = $r->c;

        foreach($arr as $key => $value){
            $lamp->priorities()->create(array_merge(["index" => $key], $value));
        }

        $match = \Storage::get('ip');
        $client = new Client(['base_uri' => 'http://' . trim($match) . '/api/']);

        $endpointName ="lights";
        $endpoint = $lamp->endpoint;
        $number = 12;

        $value = gethostbyname(gethostname())."/api/priorities/" . $lampId;

        $r = $client->request('GET', "$endpointName/$endpoint/$number/set?value=" . ("http://" . $value));

        return $this->ownership($lampId);
    }
}
