<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    public function retrieve () {
        return User::all();
    }

    public function create (Request $r) {
        return User::create($r->all());
    }

    public function single ($id) {
        return User::find($id);
    }

    public function update ($id, Request $r) {
        $user = User::findOrFail($id);

        $user->update($r->all());
        $user->save();

        return $user;
    }

    public function delete ($id) {
        $user = User::findOrFail($id);

        $user->delete();
    }
}
