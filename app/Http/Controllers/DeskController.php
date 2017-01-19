<?php

namespace App\Http\Controllers;

use App\Models\Desk;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    public function retrieve () {
        return Desk::all();
    }

    public function create (Request $r) {
        return Desk::create($r->all());
    }

    public function single ($id) {
        return Desk::find($id);
    }

    public function update ($id, Request $r) {
        $Desk = Desk::findOrFail($id);

        $Desk->update($r->all());
        $Desk->save();

        return $Desk;
    }

    public function delete ($id) {
        $Desk = Desk::findOrFail($id);

        $Desk->delete();
    }

    public function groups ($id) {
        $Desk = Desk::findOrFail($id);

        return $Desk->groups;
    }

    public function users ($id) {
        $Desk = Desk::findOrFail($id);

        return $Desk->users;
    }

    public function createGroup($id, Request $r){
        $Desk = Desk::findOrFail($id);

        return $Desk->groups()->create($r->all());
    }

}
