<?php

namespace App\Console\Commands;

use App\Models\BaseModel;
use App\Models\Lamp;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;


class mdns extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mdns:run';
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

        /*        $outp = "

                 * Lookup Broker-Room-1._http._tcp..local
        DATE: ---Tue 17 Jan 2017---
        19:50:53.562  ...STARTING...
        19:50:53.562  Broker-Room-1._http._tcp.local. can be reached at Equipo.local.:8080 (interface 5)
         “/broker
                 ";*/

        $outp = `gtimeout 3s dns-sd -L Broker-Room-2 _http._tcp. local`;
        $matches = [];
        $match = null;

        (preg_match("/can be reached .*? \\(/", $outp, $matches));
        if (count($matches)) {
            $match = str_replace(['can be reached at ', '('], ['', ''], $matches[0]);
        }

        if (!is_null($match)) {

            $this->info("Found broker at $match");
            Storage::put('ip', trim($match));

            // Create a client with a base URI
            $client = new Client(['base_uri' => 'http://' . trim($match) . '/api/']);
            // Send a request to https://foo.com/api/test
            $response = $client->request('GET', 'register/?host=' . gethostbyname(gethostname()));

//            if ($response->getStatusCode() === 200) {
//                $this->info("Successfull registration at: $match");
//
//                $this->pollSensors($client);
//                $this->pollLamps($client);
//
//                return;
//            }
        }

        $this->info("Not found");
    }
}
