<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Finalizer;

class BaseModel extends Model {
    public $timestamps = false;
    protected $map = [];
    protected $endpointName = "";

    protected static function boot () {
        parent::boot();

        static::saving(function ($baseModel) {


            $dirty = $baseModel->getDirty();
            $endpoint = $baseModel->endpoint;
            $endpointName = $baseModel->endpointName;
            $map = $baseModel->map;

            Finalizer::register(function () use ($dirty, $endpoint, $endpointName, $map) {
                $match = \Storage::get('ip');
                $client = new Client(['base_uri' => 'http://' . trim($match) . '/api/']);

                foreach ($dirty as $name => $value) {
                    if (key_exists($name, $map)) {
//                        `say sending $name`;
                        // Update the broker
                        $number = $map[$name];
                        $r = $client->request('GET', "$endpointName/$endpoint/$number/set?value=" . ("" . $value));
                        // URL: IP/api/$name/$endpoint/$number
                        $status = $r->getStatusCode();
//                        `say sent $name $status`;
                    }

                }
            });
        }, 10000000);
    }

    public static function rawUpsert($table, $values){

        $keys = array_keys($values);
        $names = implode("`,`", $keys);

        $placeholders = implode(",", array_fill ( 0, count($values), '?' ));

        $fill = [];

        foreach ($keys as $value) {
            if ($value == "endpoint")
                continue;

            $fill[] = "$value=VALUES($value)";
        }

        $replace = implode(",", $fill);

        \DB::insert("insert into $table (`$names`)
                    values ($placeholders) ON DUPLICATE KEY UPDATE $replace", array_values($values));
    }
}
