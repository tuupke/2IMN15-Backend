<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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

        var_dump($match);
        return;

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'http://' . trim($match) . '/api']);

        while (true){

            $response = $client->request('GET', 'register/?host=' . gethostbyname(gethostname()));

            sleep(5);
        }
    }
}
