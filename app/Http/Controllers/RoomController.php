<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function retrieve () {
        return Room::all();
    }

    public function create (Request $r) {
        return Room::create($r->all());
    }

    public function single ($id) {
        return Room::find($id);
    }

    public function update ($id, Request $r) {
        $room = Room::findOrFail($id);

        $room->update($r->all());
        $room->save();

        return $room;
    }

    public function delete ($id) {
        $room = Room::findOrFail($id);

        $room->delete();
    }

    public function groups ($id) {
        $room = Room::findOrFail($id);

        return $room->groups();
    }

    public function addGroup ($id, $groupId) {
        $room = Room::findOrFail($id);
        $group = Group::findOrFail($groupId);

        $room->groups()->save($group);
    }

    public function createGroup($id, Request $r){
        $room = Room::findOrFail($id);

        return $room->groups()->create($r->all());
    }

}
