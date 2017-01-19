<?php

namespace App\Console\Commands;

use App\Models\BaseModel;
use App\Models\Lamp;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;


class poll extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'poll:run';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct () {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle () {
        $match = \Storage::get('ip');
        $client = new Client(['base_uri' => 'http://' . trim($match) . '/api/']);

        while (true) {
            $this->info("Poll iteration");
            $this->pollLamps($client);
            $this->pollSensors($client);

            sleep(3);
        }
    }

    private function pollLamps (Client $client) {
        $this->info("Polling Lamps");

        $response = $client->request('GET', 'lights');

        var_dump($response->getStatusCode());

        $lights = \GuzzleHttp\json_decode($response->getBody()->getContents());

        $arr = [];

        foreach ($lights as $light) {
            $response = $client->request('GET', 'lights/' . $light->endpoint);
            $this->info("Received light. ");
            $arr[] = $light->endpoint;
            $lo = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
            var_dump($lo);

            BaseModel::rawUpsert('lamps',
                [
                    "name"      => $lo["Light ID"],
                    "endpoint"  => $light->endpoint,
                    "x"         => 0 + floatval($lo["Location X"]),
                    "y"         => 0 + floatval($lo["Location Y"]),
                    "color"     => $lo["Light Color"],
                    "state"     => $lo["Light State"],
                    "low_light" => $lo["Low Light"] == "true",
                ]);
        }
        \DB::table('lamps')->whereNotIn('endpoint', $arr)->delete();
    }

    private function pollSensors (Client $client) {
        $this->info("Polling Sensors");

        $response = $client->request('GET', 'sensors');

        var_dump($response->getStatusCode());

        $lights = \GuzzleHttp\json_decode($response->getBody()->getContents());

        $arr = [];

        foreach ($lights as $light) {
            $response = $client->request('GET', 'sensors/' . $light->endpoint);
            $arr[] = $light->endpoint;
            $this->info("Received");
            $lo = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);

            $values = [
                "name"     => $lo["Sensor ID"],
                "endpoint" => $light->endpoint,
                "x"        => 0 + floatval($lo["Location X"]),
                "y"        => 0 + floatval($lo["Location Y"]),
                "state"    => $lo["Sensor State"],
            ];

            $user = User::where('name', $lo["User ID "])->first();
            if (!is_null($user)) {
                $values['user_id'] = $user->id;
            }

            BaseModel::rawUpsert('sensors', $values);
        }

        \DB::table('sensors')->whereNotIn('endpoint', $arr)->delete();
    }
}
